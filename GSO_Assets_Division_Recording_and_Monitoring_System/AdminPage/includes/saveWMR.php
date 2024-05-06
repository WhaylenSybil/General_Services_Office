<?php
//Include database connection
require('./../database/connection.php');

//Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the uploaded file is not empty
    if (isset($_FILES['scannedDocs']) && $_FILES['scannedDocs']['error'] == 0) {
        $targetDirectory = './WMR SCANNED DOCUMENTS/';

        // Extract wmrno and propertyNo from the form data
        $wmrNo = $_POST['wmrNo']; // Assuming it's a single value, adjust as needed
        $propertyNo = $_POST['propertyNo']; // Assuming it's a single value, adjust as needed

        // Create the new file name based on the specified format
        $newFileName = "WMR_" . $wmrNo . " (" . $propertyNo . ")";
        $fileExtension = pathinfo($_FILES['scannedDocs']['name'], PATHINFO_EXTENSION);
        $targetFile = $targetDirectory . $newFileName . "." . $fileExtension;

        // Check if the file already exists in the target directory
        if (file_exists($targetFile)) {
            echo "The file already exists. Please rename the file and try again.";
        } else {
            // Attempt to move the uploaded file to the target directory with the new name
            if (move_uploaded_file($_FILES['scannedDocs']['tmp_name'], $targetFile)) {
                echo "The scanned document has been uploaded successfully.";
                // Store the file path in the database
                $scannedWMR = $targetFile;
            } else {
                echo "Error in uploading the scanned document.";
            }
        }
    }

    $article = isset($_POST["article"]) ? strtoupper($_POST["article"]) : '';
    $brand = isset($_POST["brand"]) ? strtoupper($_POST["brand"]) : '';
    $serialNo = isset($_POST['serialNo']) ? $_POST['serialNo'] : '';
    $particulars = isset($_POST["particulars"]) ? $_POST["particulars"] : '';
    $eNGAS = isset($_POST['eNGAS']) ? $_POST['eNGAS'] : '';
    $acquisitionDate = isset($_POST["acquisitionDate"]) ? $_POST["acquisitionDate"] : '';
    $totalValue = isset($_POST["acquisitionCost"]) ? $_POST["acquisitionCost"] : '';
    $propertyNo = isset($_POST["propertyNo"]) ? $_POST["propertyNo"] : '';
    $accountNumber = isset($_POST['accountNumber']) ? $_POST['accountNumber'] : '';
    $estimatedLife = isset($_POST["estimatedLife"]) && $_POST["estimatedLife"] !== '' ? $_POST["estimatedLife"] : null;
    $unitOfMeasure = isset($_POST["unitOfMeasure"]) ? $_POST["unitOfMeasure"] : '';
    $unitValue = isset($_POST["unitValue"]) ? $_POST["unitValue"] : '';
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '';
    $onhandPerCount = isset($_POST["onhandPerCount"]) ? $_POST["onhandPerCount"] : '';
    $officeName = isset($_POST['officeName']) ? $_POST['officeName'] : '';
    $accountablePerson = isset($_POST["accountablePerson"]) ? $_POST["accountablePerson"] : '';

    // Prepare and bind SQL statement for generalproperties table
    $stmtGen = $connect->prepare("INSERT INTO generalproperties (
        article, 
        brand, 
        serialNo, 
        particulars, 
        eNGAS, 
        acquisitionDate, 
        acquisitionCost, 
        propertyNo, 
        accountNumber, 
        estimatedLife, 
        unitOfMeasure, 
        unitValue, 
        quantity,
        onhandPerCount,
        officeName, 
        accountablePerson,
        scannedDocs)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmtGen->bind_param("sssssssssssssssss",
        $article, 
        $brand, 
        $serialNo, 
        $particulars, 
        $eNGAS, 
        $acquisitionDate, 
        $totalValue, 
        $propertyNo, 
        $accountNumber, 
        $estimatedLife, 
        $unitOfMeasure, 
        $unitValue, 
        $quantity,
        $onhandPerCount,
        $officeName, 
        $accountablePerson,
        $scannedWMR);

    if ($stmtGen->execute()) {
        $soQty = isset($_POST["soQty"]) ? $_POST["soQty"] : '';
        $soValue = isset($_POST["soValue"]) ? $_POST["soValue"] : '';
        $airemarks = isset($_POST["remarks"]) ? $_POST["remarks"] : '';

        // Retrieve the last inserted propertyID
        $propertyID = $connect->insert_id;

        // Prepare and bind SQL statement for are_ics_gen_properties table
        $stmtIcs = $connect->prepare("INSERT INTO are_ics_gen_properties (
            propertyID,
            soQty, 
            soValue,
            airemarks) 
        VALUES (?, ?, ?, ?)");
        $stmtIcs->bind_param("isss", 
            $propertyID,
            $soQty, 
            $soValue,
            $airemarks);

        if ($stmtIcs->execute()) {
            $ICSno = isset($_POST["ICSno"]) ? $_POST["ICSno"] : '';

            // Retrieve the last inserted ARE_ICS_id
            $ARE_ICS_id = $connect->insert_id;

            // Prepare and bind SQL statement for inserting into ics_properties table
            $stmtIcsProperties = $connect->prepare("INSERT INTO ics_properties (propertyID, ARE_ICS_id, ICSno) VALUES (?, ?, ?)");
            $stmtIcsProperties->bind_param("iis", $propertyID, $ARE_ICS_id, $ICSno);

            if ($stmtIcsProperties->execute()) {
                $dateReturned = isset($_POST["dateReturned"]) ? $_POST["dateReturned"] : '';
                $itemNo = isset($_POST['itemNo']) ? $_POST['itemNo'] : '';
                $iirup = isset($_POST['iirup']) ? $_POST['iirup'] : '';
                $iirupDate = isset($_POST['iirupDate']) ? $_POST['iirupDate'] : '';
                $withAttachment = isset($_POST['withAttachment']) ? "YES" : "NONE";
                $withCoverPage = isset($_POST['withCoverPage']) ? "YES" : "NONE";

                //Retrieve the last inserted ICSID
                $ICSid = $connect->insert_id;

                //Prepare and bind SQL statement for inserting into prs_wmr_gen_properties table
                $stmtWmrProperties = $connect->prepare("INSERT INTO prs_wmr_gen_properties (
                    propertyID,
                    dateReturned,
                    itemNo,
                    iirup,
                    iirupDate,
                    withAttachment,
                    withCoverPage
                )
                VALUES(?, ?, ?, ?, ?, ?, ?)");

                $stmtWmrProperties->bind_param("issssss",
                    $propertyID,
                    $dateReturned,
                    $itemNo,
                    $iirup,
                    $iirupDate,
                    $withAttachment,
                    $withCoverPage);

                if ($stmtWmrProperties->execute()) {
                    $wmrNo = isset($_POST['wmrNo']) ? $_POST['wmrNo'] : '';

                    $PRS_WMR_id = $connect->insert_id;

                    $stmtWMR = $connect->prepare("INSERT INTO wmr_properties (
                        propertyID,
                        PRS_WMR_Id,
                        wmrNo)
                    VALUES (?,?,?)");

                    $stmtWMR->bind_param("iis",
                        $propertyID,
                        $PRS_WMR_id,
                        $wmrNo);

                    if ($stmtWMR->execute()) {
                        $wmrID = $connect->insert_id;
                        $stmtModeOfDisposal = null;

                        //Insert data into the mode_of_disposal table
                        $modeOfDisposal = isset($_POST['modeOfDisposalOptions']) ? $_POST['modeOfDisposalOptions'] : '';

                        // Set default values for variables used in mode_of_disposal table
                        $partDestroyed = '';
                        $dateOfSale = '';
                        $dateOfAuction = '';
                        $transferDate = '';
                        $recipient = '';
                        $modeRemarks = '';
                        $ORdate = '';
                        $ORnumber = '';
                        $amount = '';

                        if ($modeOfDisposal === "By Destruction Or Condemnation") {
                            $partDestroyed = isset($_POST['partDestroyedThrown']) ? $_POST['partDestroyedThrown'] : '';
                            $modeRemarks = isset($_POST['remarksDestroyed']) ? $_POST['remarksDestroyed'] : '';

                        } elseif ($modeOfDisposal === "Sold Through Negotiation") {
                            $dateOfSale = isset($_POST['dateOfSale']) ? $_POST['dateOfSale'] : '';
                            $ORdate = isset($_POST['dateOfORNego']) ? $_POST['dateOfORNego'] : '';
                            $ORnumber = isset($_POST['ORnumberNego']) ? $_POST['ORnumberNego'] : '';
                            $amount = isset($_POST['amountNego']) ? $_POST['amountNego'] : '';
                            $modeRemarks = isset($_POST['notesNego']) ? $_POST['notesNego'] : '';

                        } elseif ($modeOfDisposal === "Sold Through Public Auction") {
                            $dateOfAuction = isset($_POST['dateOfAuction']) ? $_POST['dateOfAuction'] : '';
                            $ORdate = isset($_POST['dateOfORAuction']) ? $_POST['dateOfORAuction'] : '';
                            $ORnumber = isset($_POST['ORnumberAuction']) ? $_POST['ORnumberAuction'] : '';
                            $amount = isset($_POST['amountAuction']) ? $_POST['amountAuction'] : '';
                            $modeRemarks = isset($_POST['notesAuction']) ? $_POST['notesAuction'] : '';

                        } elseif ($modeOfDisposal === "Transferred Without Cost") {
                            $transferDate = isset($_POST['transferDateWithoutCost']) ? $_POST['transferDateWithoutCost'] : '';
                            $recipient = isset($_POST['recipientTransfer']) ? $_POST['recipientTransfer'] : '';
                            $modeRemarks = isset($_POST['notesTransfer']) ? $_POST['notesTransfer'] : '';

                        } elseif ($modeOfDisposal === "Continued In Service") {
                            $transferDate = isset($_POST['transferDateContinued']) ? $_POST['transferDateContinued'] : '';
                            $recipient = isset($_POST['recipientContinued']) ? $_POST['recipientContinued'] : '';
                            $modeRemarks = isset($_POST['notesContinued']) ? $_POST['notesContinued'] : '';

                        } else {
                            $modeOfDisposal = '';
                        }

                        // Prepare and bind SQL statement for mode_of_disposal table
                        $stmtModeOfDisposal = $connect->prepare("INSERT INTO mode_of_disposal (wmrID, modeOfDisposal, partDestroyed, dateOfSale, dateOfAuction, transferDate, recipient, ORdate, ORnumber, amount, modeRemarks)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        $stmtModeOfDisposal->bind_param("issssssssss", 
                            $wmrID, 
                            $modeOfDisposal, 
                            $partDestroyed, 
                            $dateOfSale, 
                            $dateOfAuction, 
                            $transferDate, 
                            $recipient, 
                            $ORdate, 
                            $ORnumber, 
                            $amount, 
                            $modeRemarks);

                        if ($stmtModeOfDisposal->execute()) {
                            $stmtUpdates = null;

                            //Insert data into the update_or_status table
                            $currentStatus = isset($_POST['updatesCurrentStatus']) ? $_POST['updatesCurrentStatus'] : '';

                            // Set default values for variables used in update_or_status table
                            $jevDropped = '';
                            $dateDropped = '';
                            $notesDropped = '';
                            $existingRemarks = '';

                            if ($currentStatus === "Dropped In Both Records") {
                                $jevDropped = isset($_POST['jevNoDropped']) ? $_POST['jevNoDropped'] : '';
                                $dateDropped = isset($_POST['dateDropped']) ? $_POST['dateDropped'] : '';
                                $notesDropped = isset($_POST['notesDropped']) ? $_POST['notesDropped'] : '';

                            } elseif ($currentStatus === "Existing In Inventory Report") {
                                $existingRemarks = isset($_POST['remarksExisting']) ? $_POST['remarksExisting'] : '';

                            } else {
                                $currentStatus = '';
                            }

                            // Prepare and bind SQL statement for updates_or_status table
                            $stmtUpdates = $connect->prepare("INSERT INTO updates_or_status(wmrID, currentStatus, jevNoDropped, dateDropped, actionsToBeTaken)
                                VALUES (?, ?, ?, ?, ?)");
                            $stmtUpdates->bind_param("issss", 
                                $wmrID, 
                                $currentStatus, 
                                $jevDropped, 
                                $dateDropped, 
                                $existingRemarks);

                            if ($stmtUpdates) {
                                if ($stmtUpdates->execute()) {
                                    // Success
                                    function displayModalWithRedirect($message, $redirectPage){
                                        echo '<div class="modal-background">';
                                        echo '<div class="modal-content">';
                                        echo '<div class="modal-message">' . $message . '</div>';
                                        echo '<button class="ok-button" onclick="redirectToPage(\'' . $redirectPage . '\')">OK</button>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    //Show modal dialog with the message and redirect
                                    displayModalWithRedirect("Added WMR", "WMR.php");
                                } else {
                                    echo "Error: " .$stmtUpdates->error;
                                }
                            } else {
                            echo "Error: " . $stmtModeOfDisposal->error;
                        }
                        $stmtModeOfDisposal->close();
                    } else {
                        // Error occurred
                        echo "Error: " . $stmtWMR->error;
                    }
                    // Close the wmr_properties statement
                    $stmtWMR->close();
                } else {
                    // Error occurred
                    echo "Error: " . $stmtWmrProperties->error;
                }
                // Close the prs_wmr_gen_properties
                $stmtWmrProperties->close();
            } else {
                // Error occurred
                echo "Error: " . $stmtIcsProperties->error;
            }
            // Close the ics_properties
            $stmtIcsProperties->close();
        } else {
            // Error occurred
            echo "Error: " . $stmtIcs->error;
        }
        // Close the are_ics_gen_properties
        $stmtIcs->close();
    } else {
        // Error occurred
        echo "Error: " . $stmtGen->error;
    }
    // Close the generalproperties
    $stmtGen->close();
    // Close the database connection
    $connect->close();
    // Redirect the page
    echo '<script type="text/javascript">
            function redirectToPage(page) {
                window.location.href = page;
            }
        </script>';
}
}
?>