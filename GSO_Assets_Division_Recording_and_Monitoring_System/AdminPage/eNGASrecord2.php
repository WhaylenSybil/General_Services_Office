<?php
require('../loginPage/login_session.php');
if (!isset($_SESSION['employeeID'])) {
  header('Location: ../loginPage/login.php');
  // code...
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GSO Assets Division | Recording and Monitoring System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../plugins/bootstrap 4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
    <link href="../dist/img/baguiologo.png" rel="icon">
    <link rel="apple-touch-icon" href="img/baguiologo.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


    <style>
      .editable{
        display: none;
      }
    </style>

</head>
<body class="hold-transition skin-blue sidebar-mini fixed"><br>
  <div class="wrapper">
    <?php include ("../AdminPage/header/header.php") ?>
    <?php include ("../AdminPage/sidebar/sidebar.php") ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="ion-android-checkmark-circle"></i> eNGAS RECORDS</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="ion-android-checkmark-circle"> eNGAS RECORDS</i></a></li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="w-100 d-flex pposition-relative justify-content">
          <button class="btn btn-flat btn-primary" id="add_eNGAS" type="button"> Add eNGAS</button>
        </div><br>
        
        <div class="box">
          <div class="table-responsive">
            <form>
              <input type="hidden" name="eNGASid" value="">
              <table class="table table-hover table-stripped table-bordered" id="engasRecordTable">
                <colgroup>
                  <col width="12%">
                  <col width="12%">
                  <col width="25%">
                  <col width="6%">
                  <col width="5%">
                  <col width="20%">
                  <col width="10%">
                  <col width="10%">
                </colgroup>
                <thead>
                  <tr>
                    <th class="text-center p-1">OLD Property Number</th>
                    <th class="text-center p-1">NEW Property Number</th>
                    <th class="text-center p-1">Description</th>
                    <th class="text-center p-1">Acquisition Date</th>
                    <th class="text-center p-1">Estimated Useful Life</th>
                    <th class="text-center p-1">Responsibility Center</th>
                    <th class="text-center p-1">Acquisition Cost</th>
                    <th class="text-center p-1">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  require('./../database/connection.php');
                  $sql = "SELECT * FROM engasRecords";
                  $pre_stmt = $connect->prepare($sql);
                  $pre_stmt->execute();
                  $result = $pre_stmt->get_result();

                  while ($rows = $result->fetch_assoc()){;
                  ?>
                  <tr data-id = '<?php echo $rows["engasID"]; ?>'>
                    <td name = "oldPropertyNo"><?php echo $rows["oldPropertyNo"] ?></td>
                    <td name = "newPropertyNo"><?php echo $rows["newPropertyNo"] ?></td>
                    <td name = "description"><?php echo $rows["description"] ?></td>
                    <td name="acquisitionDate"><?php echo date("m/d/Y", strtotime($rows["acquisitionDate"])) ?></td>
                    <td name = "estimatedLife"><?php echo $rows["estimatedLife"] ?></td>
                    <td name = "responsibilityCenter"><?php echo $rows["responsibilityCenter"] ?></td>
                    <td name = "acquisitionCost"><?php echo $rows["acquisitionCost"] ?></td>
                    <td class="text-center">
                      <button class="btn btn-primary btn-sm rounded-0 py-0 editRow noneditable" type="button">Edit</button>
                      <button class="btn btn-danger btn-sm rounded-0 py-0 deleteRow noneditable" type="button">Delete</button>
                      <button class="btn btn-sm btn-primary btn-flat rounded-0 px-2 py-0 editable">Save</button>
                      <button class="btn btn-sm btn-dark btn-flat rounded-0 px-2 py-0 editable" onclick="cancel_button($(this))" type="button">Cancel</button>
                    </td>
                  </tr>
                  <?php 
                  }
                  ?>
                </tbody>
              </table>
            </form>
          </div><!-- table-responsive -->
        </div><!-- box -->
      </section>
    </div><!-- content-wrapper -->
  </div><!-- wrapper -->

  <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/custom/eNGASscript.js"></script>
</body>