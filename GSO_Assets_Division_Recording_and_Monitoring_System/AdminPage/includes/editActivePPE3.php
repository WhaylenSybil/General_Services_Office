<?php
require('./../database/connection.php');

// Check if propertyID is set in the URL
if (isset($_GET['propertyID'])) {
    $propertyID = $_GET['propertyID'];

    // Select query to fetch data for the specified propertyID
    $sql = "SELECT gp.*,
            ap.AREno,
            agp.dateReceived,
            agp.soQty,
            agp.soValue,
            agp.previousCondition,
            agp.location,
            agp.currentCondition,
            agp.dateOfPhysicalInventory,
            agp.airemarks,
            agp.supplier,
            agp.POnumber,
            agp.AIRnumber,
            agp.notes,
            agp.jevNo
            FROM generalproperties gp
            LEFT JOIN are_ics_gen_properties agp ON gp.propertyID = agp.propertyID
            LEFT JOIN are_properties ap ON gp.propertyID = ap.propertyID
            WHERE gp.propertyID = ?";

    $pre_stmt = $connect->prepare($sql);
    $pre_stmt->bind_param('i', $propertyID);
    $pre_stmt->execute();
    $result = $pre_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: activePPE.php");
        exit();
    }
}

// Check if the form is submitted
if (isset($_POST['btn_updateARE'])) {

    // Handle file upload only if a new file is selected or if the form data for the file has changed
    if (isset($_FILES['scannedDocs']) && $_FILES['scannedDocs']['name'] !== '') {
        $file_name = $_FILES['scannedDocs']['name'];
        $file_tmp = $_FILES['scannedDocs']['tmp_name'];

        // Extract original AREno and propertyNo from the form data
        $original_AREno = implode('', $_POST['AREno']);
        $original_propertyNo = implode('', $_POST['propertyNo']);

        // Extract new AREno and propertyNo from the form data
        $new_AREno = implode('', $_POST['AREno']);
        $new_propertyNo = implode('', $_POST['propertyNo']);

        // Create the new file name based on the specified format
        $new_file_name = "ARE_" . $new_AREno . " (" . $new_propertyNo . ").pdf"; // Assuming the file is in PDF format

        $file_destination = './ARE SCANNED DOCUMENTS/' . $new_file_name; // Specify the destination directory

        // Check if the file already exists in the destination directory
        if (file_exists($file_destination)) {
            // Rename the existing file only if either AREno or propertyNo has changed
            if ($original_AREno !== $new_AREno || $original_propertyNo !== $new_propertyNo) {
                // Rename the existing file with the new AREno and propertyNo
                $existing_file_name = basename($file_destination, ".pdf");
                $existing_file_extension = pathinfo($file_destination, PATHINFO_EXTENSION);
                $new_existing_file_name = "ARE_" . $new_AREno . " (" . $new_propertyNo . ")_old_" . time() . "." . $existing_file_extension;
                $existing_file_path = './ARE SCANNED DOCUMENTS/' . $new_existing_file_name;

                // Rename the existing file
                if (!rename($file_destination, $existing_file_path)) {
                    // Handle the renaming error, e.g., display an error message
                    echo "Error renaming existing file.";
                    exit();
                }
            }
        }

        // Move the uploaded file to the destination with the new name
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $file_path = $file_destination; // Set the file path to be stored in the database
        } else {
            // Handle the file upload error, e.g., display an error message
            echo "File upload failed.";
            exit();
        }
    } else {
        // No new file uploaded, retain the existing file path
        $file_path = $row['scannedDocs']; // Assuming $row['scannedDocs'] contains the existing file path
    }

    // Sanitize and validate form inputs
    $dateReceived = mysqli_real_escape_string($connect, $_POST['dateReceived']);
    $officeName = mysqli_real_escape_string($connect, $_POST['officeName']);
    $acquisitionDate = mysqli_real_escape_string($connect, $_POST['acquisitionDate']);
    $acquisitionCost = mysqli_real_escape_string($connect, $_POST['acquisitionCost']);
    $AREno = mysqli_real_escape_string($connect, implode('', $_POST['AREno']));
    $unitValue = mysqli_real_escape_string($connect, $_POST['unitValue']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
    $totalValue = mysqli_real_escape_string($connect, $_POST['acquisitionCost']);
    $article = mysqli_real_escape_string($connect, strtoupper($_POST['article']));
    $brand = mysqli_real_escape_string($connect, strtoupper($_POST['brand']));
    $serialNo = mysqli_real_escape_string($connect, implode('', $_POST['serialNo']));
    $particulars = mysqli_real_escape_string($connect, $_POST['particulars']);
    $eNGAS = mysqli_real_escape_string($connect, $_POST['eNGAS']);
    $propertyNo = mysqli_real_escape_string($connect, implode('', $_POST['propertyNo']));
    $accountNumber = mysqli_real_escape_string($connect, $_POST['accountNumber']);
    $estimatedLife = mysqli_real_escape_string($connect, $_POST['estimatedLife']);
    $unitOfMeasure = mysqli_real_escape_string($connect, $_POST['unitOfMeasure']);
    $balancePerCard = mysqli_real_escape_string($connect, $_POST['quantity']);
    $onhandPerCount = mysqli_real_escape_string($connect, $_POST['onhandPerCount']);
    $soQty = mysqli_real_escape_string($connect, $_POST['soQty']);
    $soValue = mysqli_real_escape_string($connect, $_POST['soValue']);
    $accountablePerson = mysqli_real_escape_string($connect, implode('', $_POST['accountablePerson']));
    $previousCondition = mysqli_real_escape_string($connect, $_POST['previousCondition']);
    $location = mysqli_real_escape_string($connect, implode('', $_POST['location']));
    $currentCondition = mysqli_real_escape_string($connect, $_POST['currentCondition']);
    $dateOfPhysicalInventory = mysqli_real_escape_string($connect, $_POST['dateOfPhysicalInventory']);
    $gpremarks = mysqli_real_escape_string($connect, $_POST['airemarks']);
    $supplier = mysqli_real_escape_string($connect, strtoupper($_POST['supplier']));
    $POnumber = mysqli_real_escape_string($connect, $_POST['POno']);
    $AIRRISNo = mysqli_real_escape_string($connect, $_POST['AIRnumber']);
    $notes = mysqli_real_escape_string($connect, $_POST['notes']);
    $jevNo = mysqli_real_escape_string($connect, $_POST['jevNo']);
    $yearsOfService = mysqli_real_escape_string($connect, $_POST['yearsOfService']);
    $monthlyDepreciation = mysqli_real_escape_string($connect, $_POST['monthlyDepreciation']);
    $accumulatedDepreciation = mysqli_real_escape_string($connect, $_POST['accumulatedDepreciation']);
    $bookValue = mysqli_real_escape_string($connect, $_POST['bookValue']);

    // Update query for generalproperties table
    $sql_generalproperties = "UPDATE generalproperties
        SET
            article = ?,
            brand = ?,
            serialNo = ?,
            particulars = ?,
            eNGAS = ?,
            acquisitionDate = ?,
            acquisitionCost = ?,
            propertyNo = ?,
            accountNumber = ?,
            estimatedLife = ?,
            unitOfMeasure = ?,
            unitValue = ?,
            quantity = ?,
            onhandPerCount = ?,
            officeName = ?,
            accountablePerson = ?,
            scannedDocs = ?,
            yearsOfService = ?,
            monthlyDepreciation = ?,
            accumulatedDepreciation = ?,
            bookValue = ?,
            gpremarks = ?
        WHERE propertyID = ?";

    $stmt_generalproperties = $connect->prepare($sql_generalproperties);
    $stmt_generalproperties->bind_param('ssssssssssssssssssssi',
        $article,
        $brand,
        $serialNo,
        $particulars,
        $eNGAS,
        $acquisitionDate,
        $acquisitionCost,
        $propertyNo,
        $accountNumber,
        $estimatedLife,
        $unitOfMeasure,
        $unitValue,
        $quantity,
        $onhandPerCount,
        $officeName,
        $accountablePerson,
        $file_path,
        $yearsOfService,
        $monthlyDepreciation,
        $accumulatedDepreciation,
        $bookValue,
        $gpremarks,
        $propertyID
    );

    if ($stmt_generalproperties->execute()) {
        // Update query for are_ics_gen_properties table
        $sql_are_ics_gen_properties = "UPDATE are_ics_gen_properties
            SET
                dateReceived = ?,
                soQty = ?,
                soValue = ?,
                previousCondition = ?,
                location = ?,
                currentCondition = ?,
                dateOfPhysicalInventory = ?,
                airemarks = ?,
                supplier = ?,
                POnumber = ?,
                AIRNumber = ?,
                notes = ?,
                jevNo = ?
            WHERE propertyID = ?";

        $stmt_are_ics_gen_properties = $connect->prepare($sql_are_ics_gen_properties);
        $stmt_are_ics_gen_properties->bind_param('ssssssssssssssi',
            $dateReceived,
            $soQty,
            $soValue,
            $previousCondition,
            $location,
            $currentCondition,
            $dateOfPhysicalInventory,
            $gpremarks,
            $supplier,
            $POnumber,
            $AIRRISNo,
            $notes,
            $jevNo,
            $propertyID
        );

        if ($stmt_are_ics_gen_properties->execute()) {
            // Update query for are_properties table
            $sql_are_properties = "UPDATE are_properties
                SET
                    AREno = ?
                WHERE propertyID = ?";

            $stmt_are_properties = $connect->prepare($sql_are_properties);
            $stmt_are_properties->bind_param('si', $AREno, $propertyID);

            if ($stmt_are_properties->execute()) {
                // Activity log entry
                date_default_timezone_set('Asia/Manila');
                $date_now = date('Y-m-d');
                $time_now = date('H:i:s');
                $action = 'Updated the ARE properties';
                $employeeID = $_SESSION['employeeID'];

                $query = "INSERT INTO activity_log (employeeID, firstName, date_log, time_log, action) VALUES (?,?,?,?,?)";
                $stmt = $connect->prepare($query);
                $stmt->bind_param('issss', $employeeID, $_SESSION['firstName'], $date_now, $time_now, $action);

                if ($stmt->execute()) {
                    // Success message and redirection
                    function displayModalWithRedirect($message, $redirectPage) {
                        echo '<div class="modal-background">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-message">' . $message . '</div>';
                        echo '<button class="ok-button" onclick="window.location.href=\'' . $redirectPage . '\'">OK</button>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Show modal dialog with the message and redirect
                    displayModalWithRedirect("Updated Successfully", "activePPE.php");
                } else {
                    // Handle the activity log insertion error
                    echo "Activity log entry failed: " . $stmt->error;
                }
            } else {
                // Handle the are_properties update error
                echo "Update failed for are_properties: " . $stmt_are_properties->error;
            }

            $stmt_are_properties->close();
        } else {
            // Handle the are_ics_gen_properties update error
            echo "Update failed for are_ics_gen_properties: " . $stmt_are_ics_gen_properties->error;
        }

        $stmt_are_ics_gen_properties->close();
    } else {
        // Handle the generalproperties update error
        echo "Update failed for generalproperties: " . $stmt_generalproperties->error;
    }

    $stmt_generalproperties->close();
}

$connect->close();
?>