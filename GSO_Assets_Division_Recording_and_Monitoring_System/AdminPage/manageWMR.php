<?php 
    require('./../database/connection.php');

    $sql = "SELECT ip.*, gp.*, agp.*,wmr.*, pwgp.*, disposal.*, us.*, ac.accountNumber AS classification,
                COALESCE(co.officeName, no.officeName) AS office
                FROM ics_properties ip
                LEFT JOIN generalproperties gp ON ip.propertyID = gp.propertyID
                LEFT JOIN are_ics_gen_properties agp ON ip.ARE_ICS_id = agp.ARE_ICS_id
                LEFT JOIN wmr_properties wmr ON gp.propertyID = wmr.propertyID
                LEFT JOIN prs_wmr_gen_properties pwgp ON gp.propertyID = pwgp.propertyID
                LEFT JOIN account_codes ac ON gp.accountNumber = ac.accountNumber
                LEFT JOIN cityoffices co ON gp.officeName = co.officeName
                LEFT JOIN nationaloffices no ON gp.officeName = no.officeName
                LEFT JOIN conditions c ON agp.currentCondition = c.conditionName
                LEFT JOIN mode_of_disposal disposal ON wmr.wmrID = disposal.wmrID
                LEFT JOIN updates_or_status us ON wmr.wmrID = us.wmrID
                WHERE 
                    ((agp.airemarks LIKE '%with wmr%')
                        OR (agp.currentCondition = 'Returned'))
                    OR (wmr.propertyID IN (SELECT propertyID FROM generalproperties))
                    ORDER BY
                        CAST(SUBSTRING_INDEX(wmr.wmrNo, '-', 1) AS UNSIGNED), 
                        CAST(SUBSTRING_INDEX(wmr.wmrNo, '-', -1) AS UNSIGNED)";



    $pre_stmt = $connect->prepare($sql) or die(mysqli_error($connect));
    $pre_stmt->execute();
    $result = $pre_stmt->get_result();

    while ($rows = mysqli_fetch_array($result)) {

        
        $formattedDateReceived = (!empty($rows["dateReceived"]) && $rows["dateReceived"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateReceived"])) : "";
        $formattedDateReturned = (!empty($rows["dateReturned"]) && $rows["dateReturned"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateReturned"])) : "";
        $formattedAcquisitionDate = (!empty($rows["acquisitionDate"]) && $rows["acquisitionDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["acquisitionDate"])) : "";
        $formattediirupDate = (!empty($rows["iirupDate"]) && $rows["iirupDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["iirupDate"])) : "";
        $formattedDateOfSale = (!empty($rows["dateOfSale"]) && $rows["dateOfSale"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateOfSale"])) : "";
        $formattedDateOfAuction = (!empty($rows["dateOfAuction"]) && $rows["dateOfAuction"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateOfAuction"])) : "";
        $formattedORdate = (!empty($rows["ORdate"]) && $rows["ORdate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["ORdate"])) : "";
        $formattedTransferDate = (!empty($rows["transferDate"]) && $rows["transferDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["transferDate"])) : "";


        $scannedPRSPath = $rows["scannedDocs"];

        // Conditionally create the "View Scanned Supporting document" link
        if (!empty($scannedPRSPath)) {
            // Extract the property number
            $propertyNo = $rows["propertyNo"];

            // Create the new filename
            $newFilename = "WMR_" . $rows["wmrNo"] . "(" . $propertyNo . ")";

            // Get the file extension
            $fileExtension = pathinfo($scannedPRSPath, PATHINFO_EXTENSION);

            // Create the new link with the renamed file
            $scannedPRSLink = '<a href="' . $scannedPRSPath . '" target="_blank">' . $newFilename . '</a>';
        } else {
            $scannedPRSLink = ''; // Empty link if scannedARE is null
        }

 ?>

 <tr>
    <td class="editable-file"><?php echo isset($scannedPRSLink) ? $scannedPRSLink : ''; ?></td>
    <td class="editable-date">
        <?php 
            if (!empty($formattedDateReturned)) {
                echo $formattedDateReturned;
            } else {
                echo $formattedDateReceived;
            }
        ?>
    </td>
    <td class="editable"><?php echo isset($rows['itemNo']) ? $rows['itemNo'] : ''; ?></td>
    <td class="editable"><?php echo isset($rows['wmrNo']) ? $rows['wmrNo'] : ''; ?></td>
    <td class="editable"><?php echo isset($rows['article']) ? $rows['article'] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["brand"]) ? $rows["brand"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["serialNo"]) ? $rows["serialNo"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["particulars"]) ? $rows["particulars"] : ''; ?></td>
    <td class="editable" style="white-space: nowrap;"><?php echo isset($rows["ICSno"]) ? $rows["ICSno"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["eNGAS"]) ? $rows["eNGAS"] : ''; ?></td>
    <td class="editable"><?php echo isset($formattedAcquisitionDate) ? $formattedAcquisitionDate : ''; ?></td>
    <td class="editable"><?php echo isset($rows["acquisitionCost"]) ? $rows["acquisitionCost"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["propertyNo"]) ? $rows["propertyNo"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["accountNumber"]) ? $rows["accountNumber"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["estimatedLife"]) ? $rows["estimatedLife"] : null; ?></td>
    <td class="editable"><?php echo isset($rows["unitOfMeasure"]) ? $rows["unitOfMeasure"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["unitValue"]) ? $rows["unitValue"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["onhandPerCount"]) ? $rows["onhandPerCount"] : ''; ?></td>
    <td class="editable" style="white-space: nowrap;"><?php echo isset($rows["office"]) ? $rows["office"] : ''; ?></td>
    <td class="editable" style="white-space: nowrap;"><?php echo isset($rows["accountablePerson"]) ? $rows["accountablePerson"] : ''; ?></td>
    <td class="editable">
        <?php 
            // Initialize the display variable
            $display = '';

            // Check if "currentCondition" is not empty, concatenate it to the display variable
            if (!empty($rows["currentCondition"])) {
                $display .= $rows["currentCondition"];
            }

            // Check if "airemarks" is not empty, concatenate it to the display variable
            if (!empty($rows["airemarks"])) {
                // If display already contains data, append a separator before adding this field
                $display .= !empty($display) ? ' ; ' . $rows["airemarks"] : $rows["airemarks"];
            }

            // Check if "prsWmrRemarks" is not empty, concatenate it to the display variable
            if (!empty($rows["prsWmrRemarks"])) {
                // If display already contains data, append a separator before adding this field
                $display .= !empty($display) ? ' ; ' . $rows["prsWmrRemarks"] : $rows["prsWmrRemarks"];
            }

            // Output the concatenated result
            echo $display;
        ?>
    </td>
    <td class="editable"><?php echo isset($rows["withAttachment"]) ? $rows["withAttachment"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["withCoverPage"]) ? $rows["withCoverPage"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["iirup"]) ? $rows["iirup"] : ''; ?></td>
    <td class="editable-date"><?php echo isset($formattediirupDate) ? $formattediirupDate : ''; ?></td>


    <td class="editable"><?php echo isset($rows["modeOfDisposal"]) ? $rows["modeOfDisposal"] : ''; ?></td>
    <td class="editable">
        <?php 
            if ($rows["modeOfDisposal"] == "Sold Through Negotiation") {
                echo $formattedDateOfSale;
            } elseif ($rows["modeOfDisposal"] == "Sold Through Public Auction") {
                echo $formattedDateOfAuction;
            }
        ?>
    </td>
    <td class="editable"><?php echo isset($formattedORdate) ? $formattedORdate : ''; ?></td>
    <td class="editable" style="white-space: nowrap;"><?php echo isset($rows["ORnumber"]) ? $rows["ORnumber"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["amount"]) ? $rows["amount"] : ''; ?></td>
    <td class="editable"><?php echo isset($rows["partDestroyed"]) ? $rows["partDestroyed"] : ''; ?></td>
    <td class="editable" style="white-space: nowrap;">
        <?php 
            // Initialize the display variable
            $modeOfDisposalRemarks = '';

            // Additional information based on modeOfDisposal
            if ($rows["modeOfDisposal"] == "Continued In Service" || $rows["modeOfDisposal"] == "Transferred Without Cost") {
                // Construct additional information
                $RemarksForModeOfDisposal = "Date of Transfer: " . $formattedTransferDate . " ; Recipient: " . $rows["recipient"] . " ; Notes: " . $rows["modeRemarks"];
                
                // Split the additional information by semicolons
                $parts = explode(';', $RemarksForModeOfDisposal);

                // Join the parts with semicolon and line breaks
                $modeOfDisposalRemarks = implode(';<br>', $parts);
            }
            else {
               $modeOfDisposalRemarks = $rows["modeRemarks"]; 
            }

            // Output the result
            echo $modeOfDisposalRemarks;
        ?>
    </td>
    <td class="editable"><?php echo isset($rows["currentStatus"]) ? $rows["currentStatus"] : ''; ?></td>
    <td class="editable" style="white-space: nowrap;">
        <?php 
            // Initialize the display variable
            $currentStatusRemarks = '';

            // Additional information based on currentStatus
            if ($rows["currentStatus"] == "Dropped In Both Records") {
                // Construct additional information
                $actionsToBeTaken = "JEV #: " . $rows["jevNoDropped"] . " ; Date Dropped: " . $rows["dateDropped"];
                
                // Split the additional information by semicolons
                $parts = explode(';', $actionsToBeTaken);

                // Join the parts with semicolon and line breaks
                $currentStatusRemarks = implode(';<br>', $parts);
            }
            elseif ($rows["currentStatus"] == "Existing In Inventory Report") {
                $currentStatusRemarks = $rows["actionsToBeTaken"]; 
            }

            // Output the result
            echo $currentStatusRemarks;
        ?>
    </td>

    <td>
      <a href="managePRSEditTable.php?propertyID=<?php echo $rows['propertyID']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
    </td>
 </tr>

 <?php 
    } // End of while loop
 ?>