<?php
require('./../database/connection.php');
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {   
    $updateField='';
    if(isset($input['oldPropertyNo'])) {
        $updateField.= "oldPropertyNo='".$input['oldPropertyNo']."'";
    } else if(isset($input['newPropertyN'])) {
        $updateField.= "newPropertyN='".$input['newPropertyN']."'";
    } else if(isset($input['description'])) {
        $updateField.= "description='".$input['description']."'";
    } else if(isset($input['acquisitionDate'])) {
        $updateField.= "acquisitionDate='".$input['acquisitionDate']."'";
    } else if(isset($input['acquisitionCost'])) {
        $updateField.= "acquisitionCost='".$input['acquisitionCost']."'";
    } else if(isset($input['responsibilityCenter'])) {
        $updateField.= "responsibilityCenter='".$input['responsibilityCenter']."'";
    }
    if($updateField && $input['engasID']) {
        $sqlQuery = "UPDATE engasRecord SET $updateField WHERE engasID='" . $input['engasID'] . "'";   
        mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));      
    }
}
?>