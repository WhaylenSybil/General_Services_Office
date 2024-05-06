<?php
require('./../database/connection.php');

if (isset($_GET['propertyID'])) {
    $propertyID = $_GET['propertyID'];

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

    //Current condition
    $currentCondition = $_POST['currentCondition'];
    // Check if the condition is not on the list
    $check_condition_query = $connect->prepare("SELECT conditionID FROM conditions WHERE conditionName = ?");
    $check_condition_query->bind_param("s", $currentCondition);
    $check_condition_query->execute();
    $check_condition_result = $check_condition_query->get_result();

    if ($check_condition_result->num_rows === 0) {
        // Insert the new condition into the conditions table
        $insert_condition_query = $connect->prepare("INSERT INTO conditions (conditionName) VALUES (?)");
        $insert_condition_query->bind_param("s", $currentCondition);
        $insert_condition_query->execute();

        // Get the ID of the inserted condition
        $currentConditionName = $currentCondition;
    } else {
        // Condition already exists, retrieve its ID
        $condition_row = $check_condition_result->fetch_assoc();
        $currentConditionName = $condition_row['conditionName'];
    }

    // Get and sanitize form inputs
    $dateReceived = $_POST['dateReceived'];
    $officeName = $_POST['officeName'];
    $acquisitionDate = $_POST['acquisitionDate'];
    $acquisitionCost = $_POST['acquisitionCost'];
    $AREno = implode('', $_POST['AREno']);
    $unitValue = $_POST['unitValue'];
    $quantity = $_POST['quantity'];
    $totalValue = $_POST['acquisitionCost'];
    $article = strtoupper($_POST['article']);
    $brand = strtoupper($_POST['brand']);
    $serialNo = implode('', $_POST['serialNo']);
    $particulars = $_POST['particulars'];
    $eNGAS = $_POST['eNGAS'];
    $propertyNo = implode('', $_POST['propertyNo']);
    $accountNumber = $_POST['accountNumber'];
    $estimatedLife = $_POST['estimatedLife'];
    $unitOfMeasure = $_POST['unitOfMeasure'];
    $balancePerCard = $_POST['quantity'];
    $onhandPerCount = $_POST['onhandPerCount'];
    $soQty = $_POST['soQty'];
    $soValue = $_POST['soValue'];
    $accountablePerson = implode('', $_POST['accountablePerson']);
    $previousCondition = $_POST['previousCondition'];
    $location = implode('', $_POST['location']);
    $currentCondition = $_POST['currentCondition'];
    $dateOfPhysicalInventory = $_POST['dateOfPhysicalInventory'];
    $gpremarks = $_POST['airemarks'];
    $supplier = strtoupper($_POST['supplier']);
    $POnumber = $_POST['POno'];
    $AIRnumber = $_POST['AIRnumber'];
    $notes = $_POST['notes'];
    $jevNo = $_POST['jevNo'];
    $yearsOfService = $_POST['yearsOfService'];
    $monthlyDepreciation = $_POST['monthlyDepreciation'];
    $accumulatedDepreciation = $_POST['accumulatedDepreciation'];
    $bookValue = $_POST['bookValue'];

    // Insert into generalproperties table
    $sql_generalproperties = "UPDATE generalproperties
        SET
            article=?,
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
    $stmt_generalproperties->bind_param('ssssssssssssssssssssssi',
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

    $stmt_generalproperties->execute();

    //get the ID of the inserted property
    $propertyID = $stmt_generalproperties->insert_id;

    //Insert into are_ics_gen_properties table
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
    $stmt_are_ics_gen_properties->bind_param('sssssssssssssi',
        $dateReceived,
        $soQty,
        $soValue,
        $previousCondition,
        $location,
        $currentConditionName,
        $dateOfPhysicalInventory,
        $airemarks,
        $supplier,
        $POnumber,
        $AIRnumber,
        $notes,
        $jevNo,
        $propertyID);

    $stmt_are_ics_gen_properties->execute();

    // Insert into are_properties table
    $sql_are_properties = "UPDATE are_properties
    SET
        AREno = ?
        WHERE propertyID = ?";

    $stmt_are_properties = $connect->prepare($sql_are_properties);
    $stmt_are_properties->bind_param('si', $AREno, $propertyID);

    $stmt_are_properties->execute();

    // Execute the update query
    if ($stmt_generalproperties->execute()) {
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
        // Handle the update error, e.g., display an error message
        echo "Update failed: " . $stmt_generalproperties->error;
    }

    // Close statements and database connection
    $stmt_generalproperties->close();
    $stmt_are_ics_gen_properties->close();
    $stmt_are_properties->close();
    $connect->close();

    // Redirect or display success message
    /*header("Location: activePPE.php");
    exit();*/
}

?>