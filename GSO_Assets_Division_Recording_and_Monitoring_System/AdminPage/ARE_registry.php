<?php
require('./../database/connection.php');
require('../loginPage/login_session.php');
include('../AdminPage/includes/saveAREregistry.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GSO Assets Division | Recording and Monitoring System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../AdminPage/header/header.php");?>
        <?php include_once("../AdminPage/sidebar/sidebar.php");?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header"><br>
                <h1>ACKNOWLEDGEMENT RECEIPT OF EQUIPMENT REGISTRY
                    <small>Registry of New ARE-Issued PPE</small>
                </h1>
            </section>

            <!-- Main Content -->
            <section class="content container-fluid">
                <div class="box">
                    <div class="box-header bg-blue" align="center">
                        <h4 class="box-title">ACKNOWLEDGEMENT RECEIPT OF EQUIPMENT-ISSUED PROPERTY, PLANT AND EQUIPMENT</h4><br>
                    </div>

                    <!-- Container Fluid for the Registry Form -->
                    <form method="POST" action="" enctype="multipart/form-data" id="AddNewAREregistry">
                        <div class="box-body">
                            <div class="row">
                                <?php include("./addNewARE.php") ?>
                                <?php include("./AREaddAdditionalDetails.php") ?>
                                <?php include("./AREreconciliation.php") ?>
                                
                                <!-- ARE Registry Button -->
                                <div class="col-md-12">
                                    <div class="form-group" align="center">
                                        <button type="button" class="btn btn-primary" name="saveARE" id="saveARE">SAVE ARE</button>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- box-body -->
                    </form><!-- AddNewAREregistry -->
                </div><!-- box -->
            </section><!-- content -->
        </div><!-- content-wrapper -->
    </div><!-- wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date("Y"); ?>
            <a href="#">General Services Office - Asset Division: Recording and Monitoring System</a>.
        </strong> All rights reserved.
    </footer>

    <!-- JavaScript includes and script tags -->
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <script>
        // Add event listener to the input field
        document.getElementById('unitOfMeasure').addEventListener('change', function() {
            var input = this.value.trim();
            var datalist = document.getElementById('unitOfMeasure_options');
            // Check if the input value is already in the datalist options
            var options = datalist.querySelectorAll('option');
            var exists = Array.from(options).some(option => option.value === input);
            // If the input value is not in the datalist options, add it
            if (!exists) {
                var option = document.createElement('option');
                option.value = input;
                datalist.appendChild(option);
            }
        });
    </script>
    <!-- End Unit of Measure -->

    <!-- Accessories modal -->
    <div id="accessoryModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>ACCESSORIES DETAILS</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Brand</th>
              <th>Serial Number</th>
              <th>Particulars</th>
              <th>Unit Cost</th>
            </tr>
          </thead>
          <tbody id="accessoryTableBody">
            <!-- Accessory rows will be dynamically added here -->
          </tbody>
        </table>
        <button type="button" id="addAccessoryRow" class="btn btn-primary">Add Accessory</button>
        <button  type="button" id="saveAccessoryDetails" class="btn btn-primary">Save</button>
      </div>
    </div>

    <script>
      // Paste the JavaScript code here
     // Get the modal element
     var modal = document.getElementById('accessoryModal');

     // Get the close button inside the modal
     var closeButton = modal.querySelector('.close');

     // Get the form element
     var form = document.getElementById('AddNewAREregistry');

     // Get the button that opens the modal
     var unitOfMeasureInput = document.getElementById("unitOfMeasure");

     // When the user changes the unitOfMeasure input
     unitOfMeasureInput.addEventListener('change', function() {
       var unitOfMeasureValue = this.value.toLowerCase();
       if (unitOfMeasureValue === 'set' || unitOfMeasureValue === 'lot') {
         modal.style.display = "block";
       }
     });

     // Function to close the modal
     function closeModal() {
       modal.style.display = "none";
     }

     // Event listener for the close button inside the modal
     closeButton.addEventListener('click', closeModal);

     // Event listener for the Save button inside the modal
     document.getElementById('saveAccessoryDetails').addEventListener('click', function() {
       // Save accessory details here (e.g., send data to server)
       // After saving, close the modal
       closeModal();
     });

     // Event listener to add a new row to the accessory table
     document.getElementById('addAccessoryRow').addEventListener('click', function() {
         // Check if a row is already added
         var existingRow = document.querySelector('#accessoryTableBody tr');
         if (!existingRow) { // If no row exists, add a new row
             console.log('Adding row...'); // Debugging statement
             var tableBody = document.getElementById('accessoryTableBody');
             var newRow = document.createElement('tr');
             newRow.innerHTML = `
                 <td><input type="text" class="accessoryName" name="accessoryName[]" autocomplete="off"></td>
                 <td><input type="text" class="accessoryBrand" name="accessoryBrand[]" autocomplete="off"></td>
                 <td><input type="text" class="accessorySerialNo" name="accessorySerialNo[]" autocomplete="off"></td>
                 <td><input type="text" class="accessoryParticulars" name="accessoryParticulars[]" autocomplete="off"></td>
                 <td><input type="text" class="accessoryValue" name="accessoryValue[]" autocomplete="off"></td>
                 <td><button type="button" class="remove-row">x</button></td>
             `;
             tableBody.appendChild(newRow);

             // Add event listener to the newly added row's cost input
             var newCostInput = newRow.querySelector('.accessoryValue');
             newCostInput.addEventListener('input', function() {
                 var inputValue = this.value.trim();
                 // Remove commas
                 var numberValue = parseFloat(inputValue.replace(/,/g, ''));
                 if (!isNaN(numberValue)) {
                     // Format the value with commas for thousands and two decimal places
                     var formattedValue = numberValue.toLocaleString('en-US', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     });
                     this.value = formattedValue;
                 }
             });
         }
     });

     // Event listener to remove a row from the accessory table
     document.addEventListener('click', function(event) {
       if (event.target.classList.contains('remove-row')) {
         event.target.closest('tr').remove();
       }
     });
 </script>
    <!-- Accessories modal -->

<script>
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("saveARE").addEventListener("click", function() {
          // You can add validation or additional logic here before submitting the form
          document.getElementById('AddNewAREregistry').submit();
          
          // Alternatively, you can use AJAX to submit the form data
          var form = document.getElementById("AddNewAREregistry");
          var formData = new FormData(form);

          // Send form data to the server using AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "saveARERegistry.php", true);
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
  $(document).ready(function() {
      // Function to add a new row
      $(".add-row").click(function() {
          var newRow = '<tr>' +
              '<td><input type="text" class="form-control" name="accountablePerson[]" autocomplete="off" list = "accountable_options"><datalist id="accountable_options"></datalist></td>' +
              '<td><input type="text" class="form-control" name="AREno[]" autocomplete = "off"></td>' +
              '<td><textarea type="text" class="form-control" name="serialNo[]" autocomplete="off" style="resize: vertical; height: 2.4em;"></textarea></td>' +
              '<td><input type="text" class="form-control" name="propertyNo[]" autocomplete = "off"></td>' +
              '<td><input type="text" class="form-control" name="location[]" autocomplete = "off"></td>' +
              '<td><button type="button" class="btn btn-danger remove-row">X</button></td>' +
              '</tr>';
          $('#dynamicFields tbody').append(newRow);
      });

      // Function to remove a row
      $(document).on('click', '.remove-row', function() {
          $(this).closest('tr').remove();
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
      if (isNaN(floatValue) || floatValue < 50000) {
          // If the parsed value is NaN or less than 50000, display an error message
          document.getElementById('errorMessage').innerText = " Please enter unit value that is 50,000.00 or above";
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
    // Toggle submenu on click
    $('.treeview > a').click(function(event) {
      event.preventDefault(); // Prevent the default link behavior
      $(this).next('.treeview-menu').slideToggle();
      // Close other submenus when one is opened
      $('.treeview-menu').not($(this).next('.treeview-menu')).slideUp();
    });

    // Toggle sidebar collapse
    $('.sidebar-toggle').click(function() {
      $('body').toggleClass('sidebar-collapse');
    });
  });
</script>
</body>
</html>