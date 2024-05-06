<?php
require('./../database/connection.php');

if (isset($_GET['propertyID'])) {
    $propertyID = $_GET['propertyID'];

    $sql = "SELECT gp.*, ip.ICSno, agp.dateReceived, agp.soQty, agp.soValue, agp.previousCondition,
            agp.location, agp.currentCondition, agp.dateOfPhysicalInventory, agp.airemarks, agp.supplier,
            agp.POnumber, agp.AIRnumber, agp.notes, agp.jevNo
            FROM generalproperties gp
            LEFT JOIN are_ics_gen_properties agp ON gp.propertyID = agp.propertyID
            LEFT JOIN ics_properties ip ON gp.propertyID = ip.propertyID
            WHERE gp.propertyID = ?";

    $pre_stmt = $connect->prepare($sql);
    $pre_stmt->bind_param('i', $propertyID);
    $pre_stmt->execute();
    $result = $pre_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: inactiveSemiPPE.php");
        exit();
    }
}

// Check if the form is submitted
if (isset($_POST['btn_updateICS'])) {

    // Handle file upload only if a new file is selected or if the form data for the file has changed
    if (isset($_FILES['scannedDocs']) && $_FILES['scannedDocs']['name'] !== '') {
        $file_name = $_FILES['scannedDocs']['name'];
        $file_tmp = $_FILES['scannedDocs']['tmp_name'];

        $original_ICSno = implode('', $_POST['ICSno']);
        $original_propertyNo = implode('', $_POST['propertyNo']);

        $new_ICSno = implode('', $_POST['ICSno']);
        $new_propertyNo = implode('', $_POST['propertyNo']);

        $new_file_name = "ICS_" . $new_ICSno . " (" . $new_propertyNo . ").pdf"; // Assuming the file is in PDF format

        $file_destination = './ICS SCANNED DOCUMENTS/' . $new_file_name;

        if (file_exists($file_destination)) {
            if ($original_ICSno !== $new_ICSno || $original_propertyNo !== $new_propertyNo) {
                $existing_file_name = basename($file_destination, ".pdf");
                $existing_file_extension = pathinfo($file_destination, PATHINFO_EXTENSION);
                $new_existing_file_name = "ICS_" . $new_ICSno . " (" . $new_propertyNo . ")_old_" . time() . "." . $existing_file_extension;
                $existing_file_path = './ICS SCANNED DOCUMENTS/' . $new_existing_file_name;

                if (!rename($file_destination, $existing_file_path)) {
                    echo "Error renaming existing file.";
                    exit();
                }
            }
        }

        if (move_uploaded_file($file_tmp, $file_destination)) {
            $file_path = $file_destination;
        } else {
            echo "File upload failed.";
            exit();
        }
    } else {
        $file_path = $row['scannedDocs'];
    }

    $currentCondition = $_POST['currentCondition'];

    // Check if the condition exists
    $check_condition_query = $connect->prepare("SELECT conditionName FROM conditions WHERE conditionName = ?");
    $check_condition_query->bind_param("s", $currentCondition);
    $check_condition_query->execute();
    $check_condition_result = $check_condition_query->get_result();

    if ($check_condition_result->num_rows === 0) {
        // If the condition doesn't exist, insert it into the database
        $insert_condition_query = $connect->prepare("INSERT INTO conditions (conditionName) VALUES (?)");
        $insert_condition_query->bind_param("s", $currentCondition);
        $insert_condition_query->execute();

        $currentConditionName = $currentCondition;
    } else {
        // If the condition exists, retrieve its name
        $condition_row = $check_condition_result->fetch_assoc();
        $currentConditionName = $condition_row['conditionName'];
    }

    $dateReceived = $_POST['dateReceived'];
    $officeName = $_POST['officeName'];
    $acquisitionDate = $_POST['acquisitionDate'];
    $acquisitionCost = $_POST['acquisitionCost'];
    $ICSno = implode('', $_POST['ICSno']);
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
    $airemarks = $_POST['airemarks'];
    $supplier = strtoupper($_POST['supplier']);
    $POnumber = $_POST['POno'];
    $AIRnumber = $_POST['AIRnumber'];
    $notes = $_POST['notes'];
    $jevNo = $_POST['jevNo'];
    $yearsOfService = $_POST['yearsOfService'];
    $monthlyDepreciation = $_POST['monthlyDepreciation'];
    $accumulatedDepreciation = $_POST['accumulatedDepreciation'];
    $bookValue = $_POST['bookValue'];

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
            bookValue = ?
        WHERE propertyID = ?";

    $stmt_generalproperties = $connect->prepare($sql_generalproperties);
    $stmt_generalproperties->bind_param('sssssssssssssssssssssi',
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
        $propertyID
    );

    $stmt_generalproperties->execute();

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

    $sql_ics_properties = "UPDATE ics_properties
        SET
            ICSno = ?
        WHERE propertyID = ?";

    $stmt_ics_properties = $connect->prepare($sql_ics_properties);
    $stmt_ics_properties->bind_param('si', $ICSno, $propertyID);

    $stmt_ics_properties->execute();

    if ($stmt_generalproperties && $stmt_are_ics_gen_properties && $stmt_ics_properties) {
        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d');
        $time_now = date('H:i:s');
        $action = 'Updated the Inactive Semi-Expendable PPE properties';
        $employeeID = $_SESSION['employeeID'];

        $query = "INSERT INTO activity_log (employeeID, firstName, date_log, time_log, action) VALUES (?,?,?,?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param('issss', $employeeID, $_SESSION['firstName'], $date_now, $time_now, $action);

        if ($stmt->execute()) {
            echo '<div class="modal-background">';
            echo '<div class="modal-content">';
            echo '<div class="modal-message">Updated Inactive Semi-Expendable PPE Successfully</div>';
            echo '<button class="ok-button" onclick="window.location.href=\'inactiveSemiPPE.php\'">OK</button>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "Activity log entry failed: " . $stmt->error;
        }
    } else {
        echo "Update failed: " . $stmt_generalproperties->error;
    }

    $stmt_generalproperties->close();
    $stmt_are_ics_gen_properties->close();
    $stmt_ics_properties->close();
    $connect->close();
}
?>