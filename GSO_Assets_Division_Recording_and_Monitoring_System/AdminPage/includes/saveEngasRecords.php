<?php
require_once('./../database/connection.php');

class API extends DBConnection {
    public function __construct(){
        parent::__construct();
    }

    public function __destruct(){
        parent::__destruct();
    }

    function save_record(){
        $data = "";
        foreach($_POST as $k => $v){
            // excluding id 
            if($k !== 'id'){
                // add comma if data variable is not empty
                if(!empty($data)) $data .= ", ";
                $data .= " `{$k}` = '{$v}' ";
            }
        }
        if(empty($_POST['id'])){
            // Insert New Record
            $sql = "INSERT INTO `engasrecords` SET {$data}";
        }else{
            // Update Record
            $id = $_POST['id'];
            $sql = "UPDATE `engasrecords` SET {$data} WHERE engasID = '{$id}'";
        }

        $save = $this->conn->query($sql);

        if($save && !$this->conn->error){
            $resp['status'] = 'success';
            if(empty($_POST['engasID']))
                $resp['msg'] = 'Record successfully added';
            else
                $resp['msg'] = 'Record successfully updated';
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = 'An error occurred while saving the data';
            $resp['error'] = $this->conn->error;
        }

        return json_encode($resp);
    }

    function delete_record(){
        $id = $_POST['engasID'];
        $delete = $this->conn->query("DELETE FROM `engasrecords` WHERE engasID = '{$id}'");
        
        if($delete){
            $resp['status'] = 'success';
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = 'An error occurred while deleting the data';
            $resp['error'] = $this->conn->error;
        }

        return json_encode($resp);
    }

}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$api = new API();

switch ($action){
    case('save'):
        echo $api->save_record();
        break;
    case('delete'):
        echo $api->delete_record();
        break;
    default:
        echo json_encode(array('status'=>'failed','error'=>'unknown action'));
        break;
}
?>