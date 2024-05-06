<?php
require('../loginPage/login_session.php');
if (!isset($_SESSION['employeeID'])) {
  header('Location: ../loginPage/login.php');
  // code...
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">
    <?php include("../AdminPage/header/header.php");?>
    <?php include("../AdminPage/sidebar/sidebar.php");?>
    <div class="content-wrapper">
      <section class="content-header"><br>
        <h1><i class="ion-android-checkmark-circle"></i> eNGAS RECORDS</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="ion-android-checkmark-circle"> eNGAS Records</i></a></li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <a href="addClearance.php" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>&nbsp ADD</a>
        <br>
        <div class="box">
          <br>
          <div class="table-responsive">
            <table id="engasRecord" class="table table-hover responsive" cellpadding="0" width="100%">
              <thead>
                <tr>
                  <th>OLD Property Number</th>
                  <th>NEW Property Number</th>
                  <th>Description</th>
                  <th>Acquisition Date</th>
                  <th>Estimated Useful Life</th>
                  <th>Responsibility Center</th>
                  <th>Acquisition Cost</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  require('./../database/connection.php');
                  $sql = "SELECT * FROM engasRecords";
                  $pre_stmt = $connect->prepare($sql);
                  $pre_stmt->execute();
                  $result = $pre_stmt->get_result();

                  while ($row = $result->fetch_assoc()) {
                    $formattedDate = (!empty($row["acquisitionDate"]) && $row["acquisitionDate"] != "0000-00-00") ? date("m/d/Y", strtotime($row["acquisitionDate"])) : " ";
                ?>
                  <tr>
                    <td><?php echo $row["oldPropertyNo"]; ?></td>
                    <td><?php echo $row["newPropertyNo"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td class="datePicker"><?php echo $formattedDate; ?></td>
                    <td><?php echo $row["estimatedLife"]; ?></td>
                    <td><?php echo $row["responsibilityCenter"]; ?></td>
                    <td><?php echo $row["acquisitionCost"]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div><!-- content-wrapper -->
  </div><!-- wrapper -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
      $(document).ready(function() {
        $('#engasRecord').DataTable({
          "paging": true,
          "lengthChange": true,
          "lengthMenu": [10, 25, 50, 100, 200, 300, 400, 500],
          "searching": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "order": [],
          "columnDefs": [{
            "targets": 'no-filter',
            "searchable": false,
          }]
        });

        $('.datePicker').datepicker({
          dateFormat: 'mm/dd/yyyy' // You can change the date format as needed
        });
      });
    </script>

  <script>
  $(document).ready(function() {
    // Toggle submenu on click
    $('.treeview > a').click(function(event) {
      event.preventDefault(); // Prevent the default link behavior
      $(this).next('.treeview-menu').slideToggle();
    });

    // Close other submenus when one is opened
    $('.treeview > a').click(function() {
      $('.treeview-menu').not($(this).next('.treeview-menu')).slideUp();
    });
  });
  </script>
  <script>
    $(document).ready(function() {
      $('.sidebar-toggle').click(function() {
        $('body').toggleClass('sidebar-collapse');
      });
    });
  </script>
  
</body>
</html>