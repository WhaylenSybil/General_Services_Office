<?php
/*require('./../database/connection.php');*/
require('../loginPage/login_session.php');
if (!isset($_SESSION['employeeID'])) {
  header('Location: ../loginPage/login.php');
}
include('../AdminPage/includes/editActiveSemiPPE.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GSO Assets Division | Recording and Monitoring System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
  <link href="../dist/img/baguiologo.png" rel="icon">
  <link rel="apple-touch-icon" href="img/baguiologo.png">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
  
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
      border-left: 3px solid #ddd;
      padding-left: 10px; /* Adjust the padding based on your design */
      padding-right: 10px; /* Adjust the padding based on your design */
    }
    .horizontal-line {
      border-top: 3px solid lightblue;
      margin-top: 10px; /* Adjust the margin based on your design */
      margin-bottom: 10px; /* Adjust the margin based on your design */
    }
    textarea {
      width: 100%;
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
    <?php include_once("../AdminPage/header/header.php");?>
    <?php include_once("../AdminPage/sidebar/sidebar.php");?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <section class="content-header"><br>
        <h1>UPDATE INVENTORY CUSTODIAN SLIP(ICS)
        </h1>
      </section><!-- <section class="content-header"> -->

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="box">
          <div class="box-header bg-blue" align="center">
            <h4 class="box-title">UPDATE ICS-ISSUED PROPERTY, PLANT AND EQUIPMENT</h4><br>
          </div><!-- <div class="box-header bg-blue" align="center"> -->

        <!-- Container Fluid for the Registry Form -->
        <form method="POST" enctype="multipart/form-data" id="editICSform" name="editICSform">
          <div class="box-body">
            <div class="row">

              <?php include ("./editICS1.php") ?>
              <?php include ("./editICS2.php") ?>
              <?php include ("./editICS3.php") ?>
            
              <!-- ICS Registry Button -->
              <div class="col-md-12">
                <div class="form-group" align="center">
                  <button type="submit" class="btn btn-success" name="btn_updateICS" id="btn_updateICS">UPDATE ICS</button>
                </div>
              </div>
            </div><!-- row -->
          </div><!-- <div class="box-body"> -->
        </form><!-- <form method="POST" action="" enctype="multipart/form-data" id="editAREform"> -->
        </div><!-- <div class="box"> -->
      </section><!-- <section class="content container-fluid"> -->
    </div><!-- <div class="content-wrapper"> -->
  </div><!-- <div class="wrapper"> -->

<!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">General Services Office - Asset Division: Recording and Monitoring System</a>.</strong> All rights reserved
  </footer>


  <!-- jQuery 2.2.3 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>

  <!-- Include jQuery library -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include Bootstrap JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Include other scripts -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
  
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
      // Function to calculate and update acquisition cost, shortage/overage qty, and shortage/overage value
      function updateCalculations() {
          var unitValue = parseFloat(document.getElementById("unitValue").value.replace(/,/g, '')) || 0;
          var balancePerCard = parseFloat(document.getElementById("balancePerCard").value) || 0;
          var onHandPerCount = parseFloat(document.getElementById("onhandPerCount").value) || 0;

          // Calculate acquisition cost: unit value * balance per card
          var acquisitionCost = unitValue * balancePerCard;

          // Calculate shortage/overage qty: balance per card - on hand per count
          var shortageOverageQty = balancePerCard - onHandPerCount;

          // Calculate shortage/overage value: unit value * shortage/overage qty
          var shortageOverageValue = unitValue * shortageOverageQty;

          // Format the acquisition cost with commas
          var formattedAcquisitionCost = acquisitionCost.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2});
          var formattedShortageOverageValue = shortageOverageValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2});

          // Format the shortage/overage qty and shortage/overage value as strings with two decimal places
          var formattedShortageOverageQty = shortageOverageQty;

          // Update the acquisition cost, shortage/overage qty, and shortage/overage value inputs
          document.getElementById("acquisitionCost").value = formattedAcquisitionCost;
          document.getElementById("soQty").value = formattedShortageOverageQty;
          document.getElementById("soValue").value = formattedShortageOverageValue;
      }

      // Add event listeners to unit value, balance per card, and on hand per count inputs
      document.getElementById("unitValue").addEventListener("input", updateCalculations);
      document.getElementById("balancePerCard").addEventListener("input", updateCalculations);
      document.getElementById("onhandPerCount").addEventListener("input", updateCalculations);

      // Initial calculation when the page loads (optional)
      updateCalculations();
  </script>
  <script>
    function validateUnitValue(input) {
        // Get the input value and remove any existing commas
        var value = input.value.replace(/,/g, '');
        
        // Check if the input value is empty
        if (value === '') {
            // Clear the error message
            document.getElementById('errorMessage').innerText = "";
            return;
        }
        
        // Parse the value as a float
        var floatValue = parseFloat(value);
        
        // Check if the parsed value is NaN or less than 50000
        if (isNaN(floatValue) || floatValue > 50000) {
            // If the parsed value is NaN or less than 50000, display an error message
            document.getElementById('errorMessage').innerText = " Please enter unit value that is less than 50,000.00";
            // Reset the input value
            input.value = '';
            // Clear values of other input fields
            document.getElementById('quantity').value = '';
            document.getElementById('acquisitionCost').value = '';
            // Return focus to the unitValue input field
            input.focus();
            return;
        } else {
            // Clear the error message if the value is valid
            document.getElementById('errorMessage').innerText = "";
        }

        // Format the value with commas for thousandths place and two decimal places
        var formattedValue = floatValue.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        // Update the input value
        input.value = formattedValue;
    }
  </script>
  <script>
      // Add event listener to the office selection input
      document.getElementById('officeName').addEventListener('change', function() {
          var selectedOffice = this.value;
          fetchEmployeesByOffice(selectedOffice);
      });

      // Function to fetch accountable employees based on the selected office
      function fetchEmployeesByOffice(selectedOffice) {
          // Make an Ajax request to the server
          var xhr = new XMLHttpRequest();
          xhr.open('GET', 'fetchEmployees.php?office=' + encodeURIComponent(selectedOffice), true);
          xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                      // Parse the JSON response
                      var employees = JSON.parse(xhr.responseText);
                      // Update the datalist options
                      updateDatalistOptions(employees);
                  } else {
                      console.error('Error fetching employees');
                  }
              }
          };
          xhr.send();
      }

      // Function to update the datalist options with the fetched employees
      function updateDatalistOptions(employees) {
          var datalist = document.getElementById('accountable_options');
          datalist.innerHTML = ''; // Clear existing options
          employees.forEach(function(employee) {
              var option = document.createElement('option');
              option.value = employee;
              datalist.appendChild(option);
          });
      }
    </script>
    <script>
      $(document).ready(function() {
        $('.sidebar-toggle').click(function() {
          $('body').toggleClass('sidebar-collapse');
        });
      });
    </script>
</body>