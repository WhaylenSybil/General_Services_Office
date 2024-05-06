<?php
require('./../database/connection.php');
require('../loginPage/login_session.php');
include ('../AdminPage/includes/manageEditClearance.php');
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
    td {
      white-space: nowrap;
      text-align: center;
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
        <h1><i class="ion-android-checkmark-circle"></i> UPDATE CLEARANCE</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="ion-android-checkmark-circle"> Edit Clearance</i></a></li>
        </ol>
      </section>

		<!-- Main Content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header bg-blue" align="center">
					<h4 class="box-title">Clearance of Employee</h4>
				</div><br>
				<div class="row">
					<form action="save_addClearance.php" id="clearance_form"></form>
					<div class="col-md-12">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="col-md-3"><!-- Date Cleared By GSO -->
								<div class="form-group">
									<label for="dateCleared"> Date Cleared By GSO</label>
									<input type="date" class="form-control" id="dateCleared" placeholder="Date Cleared By GSO" name="dateCleared" value="<?php echo $row['dateCleared']; ?>">
								</div>
							</div><!-- End Date Cleared By GSO -->

							<div class="col-md-3"><!--Control Number -->
								<div class="form-group">
									<label for="controlNo"> Control Number</label>
									<input type="text" class="form-control" id="controlNo" placeholder="Control Number" name="controlNo" value="<?php echo $row['controlNo']; ?>">
								</div>
							</div><!-- End Control Number -->

							<div class="col-md-3"><!-- Scanned Documents -->
						        <div class="form-group">
						            <label for="scannedDocs">Scanned Document</label>
						            <input type="file" class="form-control" id="scannedDocs" name="scannedDocs" accept=".pdf">
						        </div>
						    </div><!-- End Scanned Documents -->
						    <div class="col-md-3">
						        <div class="form-group">
						            <label for="saved_scanned_file">Saved Scanned Document</label>
						            <input type="text" class="form-control" id="saved_scanned_file" name="saved_scanned_file" value="<?php echo $row['scannedDocs']; ?>" readonly>
						        </div>
						    </div>

						    <div class="col-md-3"><!-- Accountable Person  -->
							    <div class="form-group">
							        <br><label for="employeeName"> Employee Name</label>
							        <input list="accountable_options" class="form-control" id="employeeName" placeholder="LAST NAME, First Name, MI" name="employeeName" autocomplete="off" value="<?php echo $row['employeeName']; ?>">
							        <datalist id="accountable_options">
							            <?php
							            // Query the database to fetch condition data from conditions table
							            $employees = $connect->query("SELECT employeeID, employeeName FROM employees ORDER BY employeeName");
							            
							            while ($employee_row = $employees->fetch_assoc()) {
							            	$selected = ($employee_row['employeeName'] === $row['employeeName']) ? 'selected' : '';
							            	echo '<option value="' . $employee_row['employeeName'] . '" ' . $selected . '>' . $employee_row['employeeName'] . '</option>';
							            }
							            ?>
							        </datalist>
							    </div>
							</div><!-- End Accountable Person -->

							<div class="col-md-3"><!-- Position -->
								<div class="form-group">
									<br><label for="Position"> Position:</label>
									<input type="text" class="form-control" id="position" placeholder="Position" name="position" value="<?php echo $row['position']; ?>">
								</div>
							</div><!-- End Position -->

							<div class="col-md-3"><!-- Clearance Classification -->
							    <div class="form-group">
							        <br><label for="classification"> Classification</label>
							        <select class="form-control" id="classification" name="classification" style="width:100%;" onchange="updateResponsibilityCenterOptions()">
					                    <option value="">---Select Classification---</option>
					                    <option value="Barangay" <?php if ($row['classification'] === 'Barangay') echo 'selected'; ?>>Barangay</option>
					                    <option value="DepEd" <?php if ($row['classification'] === 'DepEd') echo 'selected'; ?>>DepEd</option>
					                    <option value="DepEd Elementary School" <?php if ($row['classification'] === 'DepEd Elementary School') echo 'selected'; ?>>DepEd Elementary School</option>
					                    <option value="DepEd High School" <?php if ($row['classification'] === 'DepEd High School') echo 'selected'; ?>>DepEd High School</option>
					                    <option value="Alternative Learning System (ALS)" <?php if ($row['classification'] === 'Alternative Learning System (ALS)') echo 'selected'; ?>>Alternative Learning System (ALS)</option>
					                    <option value="Special Education (SPED)" <?php if ($row['classification'] === 'Special Education (SPED)') echo 'selected'; ?>>Special Education (SPED)</option>
					                    <option value="City Office" <?php if ($row['classification'] === 'City Office') echo 'selected'; ?>>City Office</option>
					                    <option value="National Office" <?php if ($row['classification'] === 'National Office') echo 'selected'; ?>>National Office</option>
					                </select>
							    </div>
							</div><!-- End Clearance Classification -->

							<div class="col-md-3"><!-- Responsibility Center -->
							    <div class="form-group">
							        <br><label for="officeName">Specific Location/Responsibility Center</label>
							        <input list="rescenter_options" class="form-control" id="officeName" placeholder="Responsibility Center" name="officeName" autocomplete="off" value="<?php echo $row['office']; ?>">
						                <datalist id="rescenter_options">
						                    <!-- Options will be dynamically updated using JavaScript -->
						                </datalist>
							    </div>
							</div><!-- End Responsibility Center -->

							<div class="col-md-3"><!-- Purpose -->
							    <div class="form-group">
							        <br><label for="purpose_input"> Purpose</label>
							        <input list="purpose_options" class="form-control" id="purpose_input" placeholder="Select Clearance Purpose" name="purpose_input" value="<?php echo $row['purposeName'] ?>" autocomplete="off">
							        <datalist id="purpose_options">
							            <?php
							            // Query the database to fetch purpose data from the database
							            $purpose_query = $connect->query("SELECT purposeID, purposeName FROM clearancepurpose");

							            while ($purpose_row = $purpose_query->fetch_assoc()) {
							                $selected = ($purpose_row['purposeName'] === $row['purposeName']) ? 'selected' : '';
							                echo '<option value="' . $purpose_row['purposeName'] . '" ' . $selected . '>' . $purpose_row['purposeName'] . '</option>';
							            }
							            ?>
							            <option value="Other"></option>
							        </datalist>
							    </div>
							</div><!-- End Purpose -->
							<!-- Other Purpose Input -->
							<div class="col-md-3" id="otherPurposeContainer" style="display: none;">
							    <div class="form-group">
							        <br><label for="otherPurpose"> Other Purpose</label>
							        <input type="text" class="form-control" id="otherPurpose_input" placeholder="Enter other purpose if not on the list" name="otherPurpose_input" autocomplete="off" disabled>
							    </div>
							</div><!-- End Other Purpose Input -->

							<div class="col-md-3"><!-- Effectivity Date -->
								<div class="form-group">
									<br><label for="effectivityDate"> Effectivity Date</label>
									<input type="text" class="form-control" id="effectivityDate" placeholder="Effectivity Date" name="effectivityDate" value="<?php echo $row['effectivityDate']; ?>">
								</div>
							</div><!-- End Effectivity Date -->
							<div class="col-md-3"><!-- Particulars -->
								<div class="form-group">
									<br><label for="remarks"> Remarks/Conditions</label>
									<input type="text" class="form-control" id="remarks" placeholder="remarks" name="remarks" autocomplete="off" value="<?php echo $row['remarks']; ?>">
								</div><!-- End remarks -->
							</div>
							
							<div class="col-md-3"><!-- enGAS Property Number  -->
								<div class="form-group">
									<br><label for="clearedBy"> Cleared By:</label>
									<input type="text" class="form-control" id="clearedBy" placeholder="Cleared By" name="clearedBy" value="<?php echo $row['clearedBy'] ?>">
								</div>
							</div><!-- End clearedby Property Number   -->
							<br><br><br>
							<div class="col-md-11"><!-- Save Button Clearance -->
								<div class="form-group">
									<button type="submit" class="btn btn-success" name="btn_updateClearance" onClick="">Update Clearance</button>
								</div>
								
							</div><!-- End of Save Button Clearance -->
							<div class="col-md-1"><!-- Save Button Clearance -->
								<div class="form-group">
									<a href="clearance.php" class="btn btn-danger">Cancel</a>
								</div>
							</div><!-- End of Save Button Clearance -->
						</form>

						
					</div>
					
				</div>
			
			</div><!-- Div box -->
		</section>
		</div>
	</div>


<!-- Scripts Required -->

<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="../dist/js/app.min.js"></script> -->
<script src="../plugins/slimScroll/jquery.slimscroll.js"></script>

<!-- Script for the dynamically changing responsibility center based on the user's selection in the classification -->
<script>
// Get references to the classification and responsibility center input
const classificationInput = document.getElementById("classification");
const responsibilityCenterInput = document.getElementById("officeName");

// Add an event listener to the classification input
classificationInput.addEventListener("change", function () {
    // Clear the responsibility center input
    responsibilityCenterInput.value = "";
    updateResponsibilityCenterOptions();
});

// Function to update the responsibility center options based on the selected classification
function updateResponsibilityCenterOptions() {
    const classification = classificationInput.value;
    const rescenterDatalist = document.getElementById("rescenter_options");

    // Clear the existing options
    rescenterDatalist.innerHTML = '';

    if (classification === 'Barangay') {
        // Fetch and update options for Barangay
        fetch('getBarangays.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not okay');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(barangayName => {
                    const optionElement = document.createElement('option');
                    optionElement.value = barangayName;
                    rescenterDatalist.appendChild(optionElement);
                });
            })
            .catch(error => {
                console.error('Error fetching barangays: ', error);
            });
    } else if (classification === 'DepEd Elementary School') {
        // Fetch and update options for DepEd ES
        fetch('getDepEdES.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not okay');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(elemName => {
                    const optionElement = document.createElement('option');
                    optionElement.value = elemName;
                    rescenterDatalist.appendChild(optionElement);
                });
            })
            .catch(error => {
                console.error('Error fetching elementary schools: ', error);
            });
    } else if (classification === 'DepEd High School') {
        // Fetch and update options for DepEd HS
        fetch('getDepEdHS.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not okay');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(highSchoolName => {
                    const optionElement = document.createElement('option');
                    optionElement.value = highSchoolName;
                    rescenterDatalist.appendChild(optionElement);
                });
            })
            .catch(error => {
                console.error('Error fetching high schools: ', error);
            });
    } else if (classification === 'City Office') {
        // Fetch and update options for City Office
        fetch('getCityOffices.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not okay');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(officeName => {
                    const optionElement = document.createElement('option');
                    optionElement.value = officeName.toUpperCase();
                    rescenterDatalist.appendChild(optionElement);
                });
            })
            .catch(error => {
                console.error('Error fetching city offices: ', error);
            });
    } else if (classification === 'National Office') {
        // Fetch and update options for National Office
        fetch('getNationalOffices.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not okay');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(nofficeName => {
                    const optionElement = document.createElement('option');
                    optionElement.value = nofficeName.toUpperCase();
                    rescenterDatalist.appendChild(optionElement);
                });
            })
            .catch(error => {
                console.error('Error fetching national offices: ', error);
            });
    } else if (classification === 'DepEd') {
    	responsibilityCenterInput.value = 'Division Office';
    } else if (classification === 'Special Education (SPED)') {
    	responsibilityCenterInput.value = 'Baguio City SPED Center';
    } else if (classification === 'Alternative Learning System (ALS)'){
    	responsibilityCenterInput.value = 'Alternative Learning System (ALS)';
    }
}

// Call the function to initialize the Responsibility Center options
updateResponsibilityCenterOptions();
</script>
<!-- Script for the other purpose input -->
<script>
// Get references to the purpose input, other purpose input, and its container
const purposeInput = document.getElementById("purpose_input");
const otherPurposeContainer = document.getElementById("otherPurposeContainer");
const otherPurposeInput = document.getElementById("otherPurpose_input");

// Add an event listener to the purpose input
purposeInput.addEventListener("change", function () {
    if (purposeInput.value.toLowerCase() === "other") {
        // If "Other" is selected, show the otherPurpose input
        otherPurposeContainer.style.display = "block";
        otherPurposeInput.disabled = false;
    } else {
        // If another option is selected, hide the otherPurpose input
        otherPurposeContainer.style.display = "none";
        otherPurposeInput.disabled = true;
        otherPurposeInput.value = ""; // Clear the input
    }
});
</script>
</body>
</html>