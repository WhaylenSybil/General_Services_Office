<?php
require('./../database/connection.php');
require('../loginPage/login_session.php');

// Establish a connection to the database
$mysqli = new mysqli("localhost", "root", "", "gso_asset");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query to retrieve data from the 'accessories' table
$sql = "SELECT accessoryName, accessoryBrand, accessorySerialNo, accessoryParticulars, accessoryCost FROM accessories WHERE propertyID = ? ";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Bind the parameter
$propertyID = $_GET['propertyID']; // Assuming propertyID is passed through GET
$stmt->bind_param("i", $propertyID); // Assuming propertyID is an integer

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if the query was successful
if ($result) {
    // Initialize an empty array to store the fetched data
    $accessories = array();

    // Fetch associative array for each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append each row to the $accessories array
        $accessories[] = $row;
    }

    // Free result set
    $result->free();
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the statement
$stmt->close();

// Close the connection
$mysqli->close();

// Output the result
/*echo "<pre>";
print_r($accessories);
echo "</pre>";*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GSO Assets Division | Recording and Monitoring System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
    <!-- Favicons -->
    <link  href="../dist/img/baguiologo.png" rel="icon">
    <link rel="apple-touch-icon" href="img/baguiologo.png">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>

  <!-- Style for the vertical line after each column -->
  <style>
    /* Style the modal background */
    .modal-background {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Style the modal content for both modals */
     .modal-content {
       background-color: #ffffff; /* White background */
       color: black;
       padding: 20px;
       border-radius: 5px;
       text-align: center;
       z-index: 2;
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
     }

    /* Style the OK button */
    .ok-button {
      background-color: #0074E4; /* Blue background color for OK button */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px; /* Add margin to separate the message and the button */
    }

    /* Add this style to create vertical lines between columns */
    .row-flex{
      display: flex;
      align-items: stretch;
    }
    .vertical-line {
      border-left: 1px solid #ddd;
      padding-left: 10px; /* Adjust the padding based on your design */
      padding-right: 10px; /* Adjust the padding based on your design */
    }
    .horizontal-line {
      border-top: 1px solid #ddd;
      margin-top: 10px; /* Adjust the margin based on your design */
      margin-bottom: 10px; /* Adjust the margin based on your design */
      /*Progress bar*/
    .progress {
        margin-top: 20px;
    }
    .import-btn {
      margin-top: 20px;
    }
  </style>
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

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <section class="content-header">
        <h1>ACCESSORY DETAILS
          <small>ACCESSORY DETAILS</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>ACCESSORIES</a></li>
          <li class="active">ACCESSORY DETAILS</li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header bg-blue" align="center">
            <h4 class="box-title">ACCESSORY DETAILS</h4>
          </div><br>

          <div class="table-responsive">
            <div class="col-md-12">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>NAME</th>
                          <th>BRAND</th>
                          <th>SERIAL NUMBER</th>
                          <th>PARTICULARS</th>
                          <th>COST</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($accessories as $accessory): ?>
                          <tr>
                              <td><?php echo $accessory['accessoryName']; ?></td>
                              <td><?php echo $accessory['accessoryBrand']; ?></td>
                              <td><?php echo $accessory['accessorySerialNo']; ?></td>
                              <td><?php echo $accessory['accessoryParticulars']; ?></td>
                              <td><?php echo $accessory['accessoryCost']; ?></td>
                              <td><a href="manageActivePPETable.php?propertyID=<?php echo $item['propertyID']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
            </div>
          </div><!-- table-responsive -->    
        </div><!-- div-box -->
      </section>
    </div><!-- content-wrapper -->
  </div><!-- wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">GSO Asset Division - Recording and Monitoring System</a>.</strong> All rights reserved.
  </footer>

  <!-- REQUIRED JAVASCRIPTS -->
  <!-- jQuery 2.2.3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>

  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Include Bootstrap JavaScript -->
 <!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

  <!-- Include other scripts -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>


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
