<?php
require('./../database/connection.php');
require('../loginPage/login_session.php');
include('../AdminPage/includes/saveWMR.php');
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
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
    }
    .additional-info {
      display: none;
    }
    .updates-currentStatus {
      display: none;
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
      <section class="content-header">
        <h1> WASTE MATERIAL REPORT
          <small>WMR</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>WMR</a></li>
          <li class="active">Waste Material Report</li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="box"><br>

          <!-- Container fluid for the Registry form -->
          <form method="post" action="" enctype="multipart/form-data" id="addPRSform">
            <div class="row-flex">
              <?php include_once("./../AdminPage/wmrParts/group1.php"); ?>
              <?php include_once("./../AdminPage/wmrParts/group2.php"); ?>
              <?php include_once("./../AdminPage/wmrParts/group3.php"); ?>
              <?php include_once("./../AdminPage/wmrParts/group4.php"); ?>
              <?php include_once("./../AdminPage/wmrParts/group5.php"); ?>

            </div><!-- row-flex -->

            <!-- Add ARE Registry Save button -->
            <div class="form-group" align="center" >
              <button type="button" class="btn btn-primary" name="saveWMR" id="saveWMR">Add WMR</button><br><br>
            </div>
          </form><!-- addPRSform -->     
        </div><!-- div-box -->
      </section>
    </div><!-- content-wrapper -->
  </div><!-- wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" style="text-align: center;">
    <strong>Copyright &copy; 2024 <a href="#">GSO Asset Division - Recording and Monitoring System</a>.</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

  <!-- REQUIRED JAVASCRIPTS -->
  <!-- jQuery 2.2.3 -->
  <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <!-- <script src="../dist/js/app.min.js"></script> -->
  <script src="../plugins/slimScroll/jquery.slimscroll.js"></script>


<!-- Script for the calculation of soQty, soValue, and formatting unitValue to accounting format -->

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
<!-- End of Script for the calculation of soQty, soValue, and formatting unitValue to accounting format -->

<!-- End of Script for the validation of unit value input -->
<script>
    function validateUnitValue(input) {
        // Get the input value and remove any existing commas
        var value = input.value.replace(/,/g, '');
        // Parse the value as a float
        var floatValue = parseFloat(value);
        
        // Format the value with commas for thousandths place and two decimal places
        var formattedValue = floatValue.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        // Update the input value
        input.value = formattedValue;
    }
</script>
<!-- End of Script for the validation of unit value input -->

<!-- Script for saving the inputs -->

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("saveWMR").addEventListener("click", function() {
            // You can add validation or additional logic here before submitting the form
            document.getElementById('addPRSform').submit();
            
            // Alternatively, you can use AJAX to submit the form data
            var form = document.getElementById("addPRSform");
            var formData = new FormData(form);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "saveWMR.php", true);
            xhr.onload = function() {
                // Handle response from the server
                if (xhr.status === 200) {
                    // Display success message or handle any other actions
                    console.log(xhr.responseText);
                } else {
                    // Handle errors
                    console.error("Error: " + xhr.statusText);
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                console.error("Network Error");
            };
            xhr.send(formData);
        });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("saveWMR").addEventListener("click", function() {
            // Get all input fields in the accountable person section
            var accountableInputs = document.querySelectorAll('[name^="accountablePerson"]');
            
            // Create an array to store the input values
            var inputValues = [];

            // Iterate over each input field
            accountableInputs.forEach(function(input) {
                // Get the input value
                var inputValue = input.value;
                
                // Push the input value into the array
                inputValues.push(inputValue);
            });

            // Prepare the data to send to the server
            var data = {
                accountablePersons: inputValues
            };

            // Send data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "saveWMR.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = function() {
                // Handle response from the server
                if (xhr.status === 200) {
                    // Display success message or handle any other actions
                    console.log(xhr.responseText);
                } else {
                    // Handle errors
                    console.error("Error: " + xhr.statusText);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error("Network Error");
            };

            // Convert data object to JSON before sending
            xhr.send(JSON.stringify(data));
        });
    });
  </script>

  <!-- script for fetching employees names based on the selected office -->
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
    function ShowSelectedForm() {
      // Get the selected value from the dropdown
      var selectedOption = document.getElementById("modeOfDisposalOptions").value;

      // Hide all additional-info divs
      var additionalInfos = document.getElementsByClassName("additional-info");
      for (var i = 0; i < additionalInfos.length; i++) {
        additionalInfos[i].style.display = "none";
      }

      // Show the selected additional-info div
      if (selectedOption) {
        var selectedAdditionalInfo = document.getElementById("form-" + selectedOption.replace(/\s+/g, ''));
        if (selectedAdditionalInfo) {
          selectedAdditionalInfo.style.display = "block";
        }
      }
    }

    function ShowSelectedUpdate() {
        // Get the selected value from the dropdown
        var selectedUpdate = document.getElementById("updatesCurrentStatus").value;

        // Hide all updates-currentStatus divs
        var updatesCurrentStatus = document.getElementsByClassName("updates-currentStatus");
        for (var i = 0; i < updatesCurrentStatus.length; i++) {
          updatesCurrentStatus[i].style.display = "none";
        }

        // Show the selected updates-currentStatus div
        if (selectedUpdate) {
          var selectedUpdateDiv = document.getElementById("form-" + selectedUpdate.replace(/\s+/g, ''));
          if (selectedUpdateDiv) {
            selectedUpdateDiv.style.display = "block";
          }
        }
      }
  </script>

<!-- Accessible sidebar anywhere the page -->
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
