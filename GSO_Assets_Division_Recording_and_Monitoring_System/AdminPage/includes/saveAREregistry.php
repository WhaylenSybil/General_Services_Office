<?php 
// Include database connection
require('./../database/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // File upload handling

    // Check if the uploaded file is not empty
    if (isset($_FILES['scannedDocs']) && $_FILES['scannedDocs']['error'] == 0) {
        $targetDirectory = './ARE SCANNED DOCUMENTS/';
        
        // Extract AREno and propertyNo from the form data
        $AREno = $_POST['AREno'][0]; // Assuming it's a single value, adjust as needed
        $propertyNo = $_POST['propertyNo'][0]; // Assuming it's a single value, adjust as needed

        // Create the new file name based on the specified format
        $newFileName = "ARE_" . $AREno . " (" . $propertyNo . ")";
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
                $scannedARE = $targetFile;
            } else {
                echo "Error in uploading the scanned document.";
            }
        }
    }

    // Check if the entered condition is set and not empty
    if (isset($_POST['currentCondition']) && !empty($_POST['currentCondition'])) {
        $currentCondition = $_POST['currentCondition'];

        // Prepare and execute SELECT query to check if the condition exists
        $check_condition_query = $connect->prepare("SELECT conditionID FROM conditions WHERE conditionName = ?");
        if ($check_condition_query) {
            $check_condition_query->bind_param("s", $currentCondition);
            $check_condition_query->execute();
            $check_condition_query->store_result();

            if ($check_condition_query->num_rows == 0) {
                // Condition doesn't exist, insert it into the conditions table
                $insert_condition_query = $connect->prepare("INSERT INTO conditions (conditionName) VALUES (?)");
                if ($insert_condition_query) {
                    $insert_condition_query->bind_param("s", $currentCondition);
                    if ($insert_condition_query->execute()) {
                        echo "New condition saved successfully.";
                    } else {
                        echo "Error executing INSERT query: " . $insert_condition_query->error;
                    }
                    $insert_condition_query->close(); // Close the INSERT query
                } else {
                    echo "Error preparing INSERT query: " . $connect->error;
                }
            }
            $check_condition_query->close(); // Close the SELECT query
        } else {
            echo "Error preparing SELECT query: " . $connect->error;
        }
    } else {
        echo "Current condition not set or empty.";
    }

    //Dynamic fields
    $accountablePersons = isset($_POST["accountablePerson"]) ? $_POST["accountablePerson"] : [];
    $serialNos = isset($_POST['serialNo']) ? $_POST['serialNo'] : [];
    $propertyNos = isset($_POST["propertyNo"]) ? $_POST["propertyNo"] : [];
    $AREnos = isset($_POST["AREno"]) ? $_POST["AREno"] : [];
    $locations = isset($_POST["location"]) ? $_POST["location"] : [];


    foreach ($accountablePersons as $key => $accountablePerson) {

        // Check if the accountable person exists in the employees table
        $check_employee_query = $connect->prepare("SELECT idNumber FROM employees WHERE employeeName = ?");
        if ($check_employee_query) {
            $check_employee_query->bind_param("s", $accountablePerson);
            $check_employee_query->execute();
            $check_employee_query->store_result();

            if ($check_employee_query->num_rows == 0) {
                // Accountable person doesn't exist, insert them into the employees table
                $officeName = isset($_POST['officeName']) ? $_POST['officeName'][$key] : '';
                $insert_employee_query = $connect->prepare("INSERT INTO employees (employeeName, office) VALUES (?, ?)");
                if ($insert_employee_query) {
                    $insert_employee_query->bind_param("ss", $accountablePerson, $officeName);
                    if ($insert_employee_query->execute()) {
                        echo "New employee added successfully.";
                    } else {
                        echo "Error executing INSERT query: " . $insert_employee_query->error;
                    }
                    $insert_employee_query->close(); // Close the INSERT query
                } else {
                    echo "Error preparing INSERT query: " . $connect->error;
                }
            }
            $check_employee_query->close(); // Close the SELECT query
        } else {
            echo "Error preparing SELECT query: " . $connect->error;
        }

        //for generalproperties table
        $article = isset($_POST["article"]) ? strtoupper($_POST["article"]) : '';
        $brand = isset($_POST["brand"]) ? strtoupper($_POST["brand"]) : '';
        $particulars = isset($_POST["particulars"]) ? $_POST["particulars"] : '';
        $eNGAS = isset($_POST['eNGAS']) ? $_POST['eNGAS'] : '';
        $acquisitionDate = isset($_POST["acquisitionDate"]) ? $_POST["acquisitionDate"] : '';
        $totalValue = isset($_POST["acquisitionCost"]) ? $_POST["acquisitionCost"] : '';
        $accountNumber = isset($_POST['accountNumber']) ? $_POST['accountNumber'] : '';
        $estimatedLife = isset($_POST["estimatedLife"]) && $_POST["estimatedLife"] !== '' ? $_POST["estimatedLife"] : null;
        $unitOfMeasure = isset($_POST["unitOfMeasure"]) ? $_POST["unitOfMeasure"] : '';
        $unitValue = isset($_POST["unitValue"]) ? $_POST["unitValue"] : '';
        $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '';
        $officeName = isset($_POST['officeName']) ? $_POST['officeName'] : '';
        $gpremarks = isset($_POST["gpremarks"]) ? $_POST["gpremarks"] : '';
        $yearsOfService = isset($_POST["yearsOfService"]) ? $_POST["yearsOfService"]:'';
        $monthlyDepreciation = isset($_POST["monthlyDepreciation"]) ? $_POST["monthlyDepreciation"]:'';
        $accumulatedDepreciation = isset($_POST["accumulatedDepreciation"]) ? $_POST["accumulatedDepreciation"]:'';
        $bookValue = isset($_POST["bookValue"]) ? $_POST["bookValue"]:'';


        //For are_ics_gen_properties table
        $dateReceived = isset($_POST["dateReceived"]) ? $_POST["dateReceived"]:'';
        $onhandPerCount = isset($_POST["onhandPerCount"]) ? $_POST["onhandPerCount"]:'';
        $soQty = isset($_POST["soQty"]) ? $_POST["soQty"]:'';
        $soValue = isset($_POST["soValue"]) ? $_POST["soValue"]:'';
        $previousCondition = isset($_POST["previousCondition"]) ? $_POST["previousCondition"]:'';
        $currentCondition = isset($_POST["currentCondition"]) ? $_POST["currentCondition"]:'';
        $dateOfPhysicalInventory = isset($_POST["dateOfPhysicalInventory"]) ? $_POST["dateOfPhysicalInventory"]:'';
        $airemarks = isset($_POST["remarks"]) ? $_POST["remarks"]:'';
        $supplier = isset($_POST["supplier"]) ? strtoupper($_POST["supplier"]) : '';
        $POnumber = isset($_POST["POno"]) ? $_POST["POno"]:'';
        $AIRnumber = isset($_POST["AIRnumber"]) ? $_POST["AIRnumber"]:'';
        $notes = isset($_POST["notes"]) ? $_POST["notes"]:'';
        $jevNo = isset($_POST["jevNo"]) ? $_POST["jevNo"]:'';

        // Insert data into generalproperties table
        $insertGeneralPropertiesQuery = "INSERT INTO generalproperties (
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
            scannedDocs, 
            yearsOfService, 
            monthlyDepreciation, 
            accumulatedDepreciation, 
            bookValue
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)";
        $stmt = $connect->prepare($insertGeneralPropertiesQuery);
        $stmt->bind_param("sssssssssssssssssssss",
            $article, 
            $brand, 
            $serialNos[$key], 
            $particulars, 
            $eNGAS, 
            $acquisitionDate, 
            $totalValue, 
            $propertyNos[$key], 
            $accountNumber, 
            $estimatedLife, 
            $unitOfMeasure, 
            $unitValue, 
            $quantity,
            $onhandPerCount, 
            $officeName, 
            $accountablePerson,
            $scannedARE, 
            $yearsOfService, 
            $monthlyDepreciation, 
            $accumulatedDepreciation, 
            $bookValue);
        $stmt->execute();
        $propertyID = $stmt->insert_id;
        $stmt->close();

        // Insert data into are_ics_gen_properties table
        $insertAREICSGENPropertiesQuery = "INSERT INTO are_ics_gen_properties (
            propertyID, 
            dateReceived,
            soQty, 
            soValue, 
            previousCondition, 
            location, 
            currentCondition, 
            dateOfPhysicalInventory,
            airemarks, 
            supplier, 
            POnumber, 
            AIRnumber, 
            notes, 
            jevNo
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($insertAREICSGENPropertiesQuery);
        $stmt->bind_param("isssssssssssss",
            $propertyID, 
            $dateReceived,
            $soQty, 
            $soValue, 
            $previousCondition, 
            $locations[$key], 
            $currentCondition, 
            $dateOfPhysicalInventory,
            $airemarks,
            $supplier, 
            $POnumber, 
            $AIRnumber, 
            $notes, 
            $jevNo);
        $stmt->execute();
        $ARE_ICS_id = $stmt->insert_id;
        $stmt->close();

        // Insert data into are_properties table
        $insertAREPropertiesQuery = "INSERT INTO are_properties (propertyID, ARE_ICS_id, AREno) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($insertAREPropertiesQuery);
        $stmt->bind_param("iis", $propertyID, $ARE_ICS_id, $AREnos[$key]);
        $stmt->execute();
        $stmt->close();

        //Insert data to the activity Log
        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d');
        $time_now = date('H:i:s');
        $action = 'Added ARE Properties: Article - ' .$article . 'with Accountable Person - ' . $accountablePerson;
        $query = "INSERT INTO activity_log (employeeID, firstName, date_log, time_log, action) VALUES(?,?,?,?,?)";
        $stmtLog = $connect->prepare($query);
        $stmtLog->bind_param('issss', $_SESSION['employeeID'], $_SESSION['firstName'], $date_now, $time_now, $action);
        $stmtLog->execute();
        //Display message after successful execution
        displayModalWithRedirect("Added an ARE Property", "activePPE.php");
    }/*foreach*/

    // Save accessory details
    if (
        isset($_POST['accessoryName']) &&
        isset($_POST['accessoryBrand']) &&
        isset($_POST['accessorySerialNo']) &&
        isset($_POST['accessoryParticulars']) &&
        isset($_POST['accessoryValue'])
    ) {
        $accessoryNames = $_POST['accessoryName'];
        $accessoryBrands = $_POST['accessoryBrand'];
        $accessorySerialNos = $_POST['accessorySerialNo'];
        $accessoryParticulars = $_POST['accessoryParticulars'];
        $accessoryCosts = $_POST['accessoryValue'];

        foreach ($accessoryNames as $key => $accessoryName) {
            // Insert accessory details into the database
            $insertAccessoryQuery = "INSERT INTO accessories (propertyID, accessoryName, accessoryBrand, accessorySerialNo, accessoryParticulars, accessoryCost) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($insertAccessoryQuery);
            $stmt->bind_param("isssss", $propertyID, $accessoryName, $accessoryBrands[$key], $accessorySerialNos[$key], $accessoryParticulars[$key], $accessoryCosts[$key]);
            $stmt->execute();
            $stmt->close();
        }
    }

    
    // Close database connection
    $connect->close();
}
// Function to display modal with redirect
function displayModalWithRedirect($message, $redirectPage) {
    echo '<div class="modal-background">';
    echo '<div class="modal-content">';
    echo '<div class="modal-message">' . $message . '</div>';
    echo '<button class="ok-button" onclick="redirectToPage(\'' . $redirectPage . '\')">OK</button>';
    echo '</div>';
    echo '</div>';
}

/*// Show modal dialog with the message and redirect
displayModalWithRedirect("Added ARE property", "activePPE.php");*/
// JavaScript function to redirect to a page
echo '<script type="text/javascript">
    function redirectToPage(page) {
        window.location.href = page;
    }
</script>';
 ?>
