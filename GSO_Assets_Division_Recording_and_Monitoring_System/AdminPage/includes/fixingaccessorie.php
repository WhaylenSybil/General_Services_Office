<?php 
    require('./../database/connection.php');

    $sql = "SELECT
                ap.*,
                gp.*,
                agp.*,
                ad.*,
                ac.accountNumber AS classification,
                COALESCE(co.officeName, no.officeName) AS officeName,
                c.conditionName AS currentCondition
            FROM
                are_properties ap
            LEFT JOIN
                are_ics_gen_properties agp ON ap.ARE_ICS_id = agp.ARE_ICS_id
            LEFT JOIN
                generalproperties gp ON ap.propertyID = gp.propertyID
            LEFT JOIN
                account_codes ac ON gp.accountNumber = ac.accountNumber
            LEFT JOIN
                cityoffices co ON gp.officeName = co.officeName
            LEFT JOIN
                nationaloffices no ON gp.officeName = no.officeName
            LEFT JOIN
                conditions c ON agp.currentCondition = c.conditionName
            LEFT JOIN
                (SELECT propertyID,
                    GROUP_CONCAT(accessoryName) AS accessoryName,
                    GROUP_CONCAT(accessoryBrand) AS accessoryBrand,
                    GROUP_CONCAT(accessorySerialNo) AS accessorySerialNo,
                    GROUP_CONCAT(accessoryParticulars) AS accessoryParticulars
                 FROM accessories
                 GROUP BY propertyID) ad ON ad.propertyID = gp.propertyID
            WHERE
                ((agp.remarks IS NULL)
                OR (agp.remarks NOT LIKE '%with prs%' AND agp.remarks NOT LIKE '%with wmr%'))
                AND (agp.currentCondition <> 'Returned' OR agp.currentCondition IS NULL)
                AND gp.propertyID NOT IN (SELECT propertyID FROM prs_properties)
                AND ap.AREno IN (SELECT AREno FROM are_properties)
            ORDER BY
                agp.dateReceived";


    
    $pre_stmt = $connect->prepare($sql) or die(mysqli_error($connect));
    $pre_stmt->execute();
    $result = $pre_stmt->get_result();

    // Debugging: Print out the number of rows fetched
    /*echo "Number of rows fetched: " . $result->num_rows . "<br>";*/

    $previousPropertyID = null; // To keep track of the previous propertyID
    $previousItem = null; // Initialize previous item
    $accessories = array(); // To store accessories associated with the current item

    while ($rows = mysqli_fetch_array($result)) {
        // Debugging: Print out the contents of each row
            /*echo "Processing row: " . print_r($rows, true) . "<br>";*/

        // Check if the current item has the same propertyID as the previous item
        if ($rows['propertyID'] == $previousPropertyID) {
            // If yes, add the accessory details to the accessories array
            $accessories[] = $rows;
        } else {
            // If not, display the previous item along with its accessories (if any)
            if ($previousItem != null) {
                displayItemWithAccessories($previousItem, $accessories);
            }

            // Reset the accessories array for the new item
            $accessories = array();
            $accessories[] = $rows;
        }

        // Save the current propertyID as the previous propertyID for the next iteration
        $previousPropertyID = $rows['propertyID'];
        $previousItem = $rows;
    }

    // Display the last item with its accessories (if any)
    if ($previousItem != null) {
        displayItemWithAccessories($previousItem, $accessories);
    }

    function displayItemWithAccessories($item, $accessories) {
        // Display the main item details
        ?>
        <tr>
            <td>
                <?php 
                // Conditionally create the "View Scanned Supporting document" link
                $scannedAREPath = $item["scannedDocs"];
                if (!empty($scannedAREPath)) {
                    // Extract the property number
                    $propertyNo = $item["propertyNo"];

                    // Create the new filename
                    $newFilename = "ARE_" . $item["AREno"] . "(" . $propertyNo . ")";

                    // Get the file extension
                    $fileExtension = pathinfo($scannedAREPath, PATHINFO_EXTENSION);

                    // Create the new link with the renamed file
                    $scannedARELink = '<a href="' . $scannedAREPath . '" target="_blank">' . $newFilename . '</a>';
                    echo $scannedARELink;
                } else {
                    echo ''; // Empty link if scannedARE is null
                }
                ?>
            </td>
            <td><?php echo isset($item["dateReceived"]) && $item["dateReceived"] != "0000-00-00" ? date("m/d/Y", strtotime($item["dateReceived"])) : ''; ?></td>
            <td><?php echo isset($item['article']) ? $item['article'] : ''; ?></td>
            <td>
                <?php 
                // Display the main brand
                echo isset($item["brand"]) ? $item["brand"] : '';

                // Check if there are accessories
                if (!empty($accessories)) {
                    // Loop through each accessory and concatenate their details with the main brand
                    foreach ($accessories as $accessory) {
                        if(isset($accessory["accessoryBrand"]) && !empty($accessory["accessoryBrand"])) {
                            echo " ; " . $accessory["accessoryName"] . ": " . $accessory["accessoryBrand"];
                        }
                    }
                }
                ?>
            </td>
            <td>
                <?php 
                // Display the main serial number
                echo isset($item["serialNo"]) ? $item["serialNo"] : '';

                // Check if there are accessories
                if (!empty($accessories)) {
                    // Loop through each accessory and concatenate their details with the main brand
                    foreach ($accessories as $accessory) {
                        if(isset($accessory["accessorySerialNo"]) && !empty($accessory["accessorySerialNo"])) {
                            echo " ; " . $accessory["accessoryName"] . ": " . $accessory["accessorySerialNo"];
                        }
                    }
                }
                ?>
            </td>
            <td>
                <?php 
                // Display the main particulars
                echo isset($item["particulars"]) ? $item["particulars"] : '';

                // Check if there are accessories
                if (!empty($accessories)) {
                    // Loop through each accessory and concatenate their details with the main brand
                    foreach ($accessories as $accessory) {
                        if(isset($accessory["accessoryParticulars"]) && !empty($accessory["accessoryParticulars"])) {
                            echo " ; " . $accessory["accessoryName"] . ": " . $accessory["accessoryParticulars"];
                        }
                    }
                }
                ?>
            </td>

            <td style="white-space: nowrap;"><?php echo isset($item["AREno"]) ? $item["AREno"] : ''; ?></td>
            <td><?php echo isset($item["eNGAS"]) ? $item["eNGAS"] : ''; ?></td>
            <td><?php echo isset($item["acquisitionDate"]) && $item["acquisitionDate"] != "0000-00-00" ? date("m/d/Y", strtotime($item["acquisitionDate"])) : ''; ?></td>
            <td><?php echo isset($item["acquisitionCost"]) ? $item["acquisitionCost"] : ''; ?></td>
            <td><?php echo isset($item["propertyNo"]) ? $item["propertyNo"] : ''; ?></td>
            <td><?php echo isset($item["accountNumber"]) ? $item["accountNumber"] : ''; ?></td>
            <td><?php echo isset($item["estimatedLife"]) ? $item["estimatedLife"] : ''; ?></td>
            <td><?php echo isset($item["unitOfMeasure"]) ? $item["unitOfMeasure"] : ''; ?></td>
            <td><?php echo isset($item["unitValue"]) ? $item["unitValue"] : ''; ?></td>
            <td><?php echo isset($item["quantity"]) ? $item["quantity"] : ''; ?></td>
            <td><?php echo isset($item["onhandPerCount"]) ? $item["onhandPerCount"] : ''; ?></td>
            <td><?php echo isset($item["soQty"]) ? $item["soQty"] : ''; ?></td>
            <td><?php echo isset($item["soValue"]) ? $item["soValue"] : ''; ?></td>
            <td><?php echo isset($item["officeName"]) ? $item["officeName"] : ''; ?></td>
            <td style="white-space: nowrap;"><?php echo isset($item["accountablePerson"]) ? $item["accountablePerson"] : ''; ?></td>
            <td><?php echo isset($item["previousCondition"]) ? $item["previousCondition"] : ''; ?></td>
            <td><?php echo isset($item["location"]) ? $item["location"] : ''; ?></td>
            <td><?php echo isset($item["currentCondition"]) ? $item["currentCondition"] : ''; ?></td>
            <td><?php echo isset($item["dateOfPhysicalInventory"]) && $item["dateOfPhysicalInventory"] != "0000-00-00" ? date("m/d/Y", strtotime($item["dateOfPhysicalInventory"])) : ''; ?></td>
            <td><?php echo isset($item["gpremarks"]) ? $item["gpremarks"] : (isset($item["remarks"]) ? $item["remarks"] : ''); ?></td>
            <td><?php echo isset($item["supplier"]) ? $item["supplier"] : ''; ?></td>
            <td><?php echo isset($item["POnumber"]) ? $item["POnumber"] : ''; ?></td>
            <td><?php echo isset($item["AIRnumber"]) ? $item["AIRnumber"] : ''; ?></td>
            <td><?php echo isset($item["notes"]) ? $item["notes"] : ''; ?></td>
            <td><?php echo isset($item["jevNo"]) ? $item["jevNo"] : ''; ?></td>
            <td>
                <a href="manageActivePPETable.php?propertyID=<?php echo $item['propertyID']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
            </td>
        </tr>
    <?php
    }
?>