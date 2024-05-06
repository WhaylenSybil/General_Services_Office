<?php 
require('./../database/connection.php');

function displayItemWithAccessories($item) {
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
                $newFilename = "ICS_" . $item["ICSno"] . "(" . $propertyNo . ")";

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
        <td style="text-align: center;">
            <?php 
            // Display the article
            echo $item['article'];
            ?>
            <br>
            <?php 
            // Check if unitOfMeasure is 'set' or empty
            if ($item['unitOfMeasure'] == 'set' || empty($item['unitOfMeasure'])) {
                // If conditions are met, create a button to open the modal
                ?>
                <!-- <button type="button" class="btn btn-primary view-accessory-btn" style="white-space: nowrap;">
                    View Accessory
                </button> -->

              <a href="accessories.php?propertyID=<?php echo $item['propertyID']; ?>" class="btn btn-primary btn-sm" style="white-space: nowrap;"><i class="fa fa-eye"></i>View Accessories</a>
               <!-- <button type="button" class="btn btn-primary" style="white-space: nowrap;" data-toggle="modal" data-target="#accessoryModal" data-propertyid="<?php echo $item['propertyID']; ?>"><i class="fa fa-eye"></i> View Accessories</button> -->

               <!-- <a href="#" class="btn btn-primary btn-sm view-accessories-btn" data-toggle="modal" data-target="#accessoryModal" data-propertyid="<?php echo $item['propertyID']; ?>" style="white-space: nowrap;">
                   <i class="fa fa-eye"></i> View Accessories
               </a> -->
                <?php
            }
            ?>
        </td>
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

        <td style="white-space: nowrap;"><?php echo isset($item["ICSno"]) ? $item["ICSno"] : ''; ?></td>
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
        <td><?php echo isset($item["gpremarks"]) ? $item["gpremarks"] : (isset($item["airemarks"]) ? $item["airemarks"] : ''); ?></td>
        <td><?php echo isset($item["supplier"]) ? $item["supplier"] : ''; ?></td>
        <td><?php echo isset($item["POnumber"]) ? $item["POnumber"] : ''; ?></td>
        <td><?php echo isset($item["AIRnumber"]) ? $item["AIRnumber"] : ''; ?></td>
        <td><?php echo isset($item["notes"]) ? $item["notes"] : ''; ?></td>
        <td><?php echo isset($item["jevNo"]) ? $item["jevNo"] : ''; ?></td>
        <td>
            <a href="manageActivePPETable.php?propertyID=<?php echo $item['propertyID']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
        </td>
        <!-- You can use the existing code from your original displayItemWithAccessories function -->
    </tr>
    <?php  
}/*function displayItemWithAccessories($item)*/

$sql = "SELECT
            ip.*,
            gp.*,
            agp.*,
            ac.accountNumber AS classification,
            COALESCE(co.officeName, nos.officeName) AS officeName,
            c.conditionName AS currentCondition
        FROM
            ics_properties ip
        LEFT JOIN
            are_ics_gen_properties agp ON ip.ARE_ICS_id = agp.ARE_ICS_id
        LEFT JOIN
            generalproperties gp ON ip.propertyID = gp.propertyID
        LEFT JOIN
            account_codes ac ON gp.accountNumber = ac.accountNumber
        LEFT JOIN
            cityoffices co ON gp.officeName = co.officeName
        LEFT JOIN
            nationaloffices nos ON gp.officeName = nos.officeName
        LEFT JOIN
            conditions c ON agp.currentCondition = c.conditionName
        WHERE
            ((gp.gpremarks IS NULL)
            OR (gp.gpremarks NOT LIKE '%with prs%' AND gp.gpremarks NOT LIKE '%with wmr%'))
            AND (agp.currentCondition <> 'Returned' OR agp.currentCondition IS NULL)
            AND gp.propertyID NOT IN (SELECT propertyID FROM wmr_properties)
            AND ip.ICSno IN (SELECT ICSno FROM ics_properties)
        ORDER BY
            agp.dateReceived";

$pre_stmt = $connect->prepare($sql) or die(mysqli_error($connect));
$pre_stmt->execute();
$result = $pre_stmt->get_result();

// Debugging: Print out the number of rows fetched
/*echo "Number of rows fetched: " . $result->num_rows . "<br>";*/

while ($item = mysqli_fetch_array($result)) {
    // Check if the property has accessories
    if (!empty($item['propertyID'])) {
        // If accessories exist, display the item along with its accessories
        displayItemWithAccessories($item);
    } else {
        // If no accessories exist, display the item without accessories
        displayItemWithAccessories($item);
    }
}

?>