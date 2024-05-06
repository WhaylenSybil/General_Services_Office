<?php
require ('./../database/connection.php');
require('../loginPage/login_session.php');

//Define an array of CSS classes with different background colors
$bgColors = ['bg-green', 'bg-blue', 'bg-red', 'bg-orange', 'bg-purple', 'bg-yellow', 'bg-teal', 'bg-maroon'];

// Retrieve the accountable person data from the ARE_properties table
$AccountablePersonArray = [];
$sql = "SELECT DISTINCT
            gp.accountablePerson,
            ap.AREno
        FROM
            generalproperties gp
        LEFT JOIN
            are_properties ap ON gp.propertyID = ap.propertyID
        WHERE
            ap.propertyID IS NOT NULL
        GROUP BY
            gp.accountablePerson;";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $accountablePerson = $row['accountablePerson'];
        // Skip empty accountable person names
        if (!empty($accountablePerson)) {
            // Randomly select a background color class
            $randomColorClass = $bgColors[array_rand($bgColors)];
            
            // Add the accountable person and random color class to the array
            $AccountablePersonArray[] = ['accountablePerson' => $accountablePerson, 'colorClass' => $randomColorClass];
        }
    }
}

    //Sort the $AccountablePersonArray alphabetically by the accountablePerson field
    usort($AccountablePersonArray, function($a, $b){
        return strcmp($a['accountablePerson'], $b['accountablePerson']);
    });

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
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
    <link href="../dist/img/baguiologo.png" rel="icon">
    <link rel="apple-touch-icon" href="img/baguiologo.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="fa fa archive"></i>ARE Accountable Employees</h1>
        <ol class="breadcrumb">
          <li><a href="AREreports.php"><i class="fa fa-dashboard">ARE Accountable Employees</i></a></li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="box">
          <div class=" box-header bg-blue text-center">
            <h4 class="box-title">ARE ACCOUNTABLE EMPLOYEES</h4>
          </div>
          <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" name="employeeSearch" id="employeeSearch" class="form-control" placeholder="Search for an employee ...">
                    </div><!-- form-group -->
                </div><!-- col-md-3 -->
            </div><!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($AccountablePersonArray as $accountablePerson) : ?>
                        <div class="col-md-3 employee-box">
                            <a href="AREpropertiesByAccountablePerson.php?accountablePerson=<?php echo urlencode($accountablePerson['accountablePerson']); ?>" class="box-link" target="_blank">
                                <div class="small-box <?php echo $accountablePerson['colorClass']; ?>">
                                    <div class="inner">
                                        <h4 class="employee-name" align="center"><?php echo $accountablePerson['accountablePerson']; ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- row-flex -->
          </div><!-- box-body -->
        </div><!-- box -->
      
          </section>
    </div><!-- content-wrapper -->
    </div><!-- wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>

    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

    
    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Your existing JavaScript code...
            
            // Add an event listener to the search input field
            $('#employeeSearch').on('keyup', function() {
                var searchText = $(this).val().toLowerCase(); // Get the search text in lowercase
                $('.employee-box').each(function() { // Loop through employee boxes
                    var employeeName = $(this).find('.employee-name').text().toLowerCase(); // Get employee name in lowercase
                    if (employeeName.includes(searchText)) { // Check if the name contains the search text
                        $(this).show(); // Show the employee box if it matches
                    } else {
                        $(this).hide(); // Hide the employee box if it doesn't match
                    }
                });
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