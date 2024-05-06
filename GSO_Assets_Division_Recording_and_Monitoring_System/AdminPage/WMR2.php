<?php
require('../loginPage/login_session.php');
if (!isset($_SESSION['employeeID'])) {
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

    <!-- Editable table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">

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
        <h1><i class="fa fa archive"></i>Waste Material Report (WMR)</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard">Waste Material Report</i></a></li>
        </ol>
      </section>

      <!-- Main Content -->
      <section class="content container-fluid">
        <div class="btn-group">
            <a href="addWMR.php" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>&nbsp Add WMR</a>
            <form enctype="multipart/form-data" method="POST" action="importWMRdata.php" style="display: inline-block; margin-left: 90px;">
                <input type="file" name="file" id="file" accept=".xlsx, .xls" style="display: inline-block;">
                <button type="submit" name="importWMR" class="btn btn-primary" id="importWMR" style="display: inline-block;">IMPORT</button>
            </form>
        </div><br>

      <!-- import button -->
            <br>
            <div class="box">
              <!-- <div class="box-header bg-blue" align="center">
                <h4 class="box-title">Waste Material Report (WMR) MASTER LIST
              </div> --><!-- box header -->
              <br>
              <div class="table-responsive">
                <table id="WMR" class="table table-hover responsive" cellpadding="0" width="100%">
                  <thead>
                    <tr>
                      <th rowspan="2" style="text-align: center;">SCANNED DOCUMENTS</th>
                      <th rowspan="2" style="text-align: center;">DATE RETURNED</th>
                      <th rowspan="2" style="text-align: center;">ITEM NUMBER</th>
                      <th rowspan="2" style="text-align: center;">WMR NUMBER</th>
                      <th rowspan="2" style="text-align: center;">ARTICLE</th>
                      <th colspan="4" style="text-align: center;">DESCRIPTION</th>
                      <th rowspan="2" style="text-align: center;">eNGAS PROPERTY NUMBER</th>
                      <th rowspan="2" style="text-align: center;">ACQUISITION DATE</th>
                      <th rowspan="2" style="text-align: center;">ACQUISITION COST/TOTAL COST</th>
                      <th rowspan="2" style="text-align: center;">PROPERTY NO.</th>
                      <th rowspan="2" style="text-align: center;">CLASSIFICATION</th>
                      <th rowspan="2" style="text-align: center;">EST. USEFUL LIFE</th>
                      <th rowspan="2" style="text-align: center;">UNIT OF MEASURE</th>
                      <th rowspan="2" style="text-align: center;">UNIT VALUE</th>
                      <!-- <th colspan="1" style="text-align: center;">BALANCE PER CARD</th> -->
                      <th rowspan="2" style="text-align: center;">ON HAND PER COUNT</th>
                      <!-- <th colspan="2" style="text-align: center;">SHORTAGE/OVERAGE</th> -->
                      <th rowspan="2" style="text-align: center; white-space: nowrap;">RESPONSIBILITY CENTER</th>
                      <th rowspan="2" style="text-align: center; white-space: nowrap;">ACCOUNTABLE PERSON</th>
                      <!-- <th rowspan="2" style="text-align: center;">PREVIOUS CONDITION</th> -->
                      <th rowspan="2" style="text-align: center;">REMARKS</th>
                      <th rowspan="2" style="text-align: center;">WITH ATTACHMENT</th>
                      <th rowspan="2" style="text-align: center;">WITH COVER PAGE</th>
                      <th rowspan="2" style="text-align: center;">WITH IIRUP</th>
                      <th rowspan="2" style="text-align: center;">IIRUP DATE</th>
                      <th colspan="7" style="text-align: center;">MODE OF DISPOSAL</th>
                      <th colspan="2" style="text-align: center;">UPDATES/CURRENT STATUS</th>
                      <th rowspan="2" style="text-align: center;">Action</th>
                    </tr>
                    <tr>
                      <th class="subcolumn" style="text-align: center;">BRAND</th>
                      <th class="subcolumn" style="text-align: center;">SERIAL NUMBER</th>
                      <th class="subcolumn" style="text-align: center;">PARTICULARS</th>
                      <th class="subcolumn" style="white-space: nowrap; text-align: center;">ICS NUMBER</th>
                      <!-- <th class="subcolumn" style="text-align: center;">(Qty)</th> -->
                      <!-- <th class="subcolumn" style="text-align: center;">(Qty)</th> -->
                      <!-- <th class="subcolumn" style="text-align: center;">(Qty)</th>
                      <th class="subcolumn" style="text-align: center;">Value</th> -->
                      <th class="subcolumn" style="white-space: nowrap; text-align: center;">DISPOSAL TYPE</th>
                      <th class="subcolumn" style="text-align: center;">DATE OF AUCTION/SALE</th>
                      <th class="subcolumn" style="text-align: center;">DATE OF OR</th>
                      <th class="subcolumn" style="text-align: center;">OR NUMBER</th>
                      <th class="subcolumn" style="text-align: center;">AMOUNT</th>
                      <th class="subcolumn" style="text-align: center;">PART DESTROYED & THROWN ITEM</th>
                      <th class="subcolumn" style="text-align: center;">REMARKS</th> 
                      <th class="subcolumn" style="text-align: center;">DROPPED IN BOTH RECORDS/EXISTING IN INVENTORY REPORT</th>
                      <th class="subcolumn" style="text-align: center;">ACTION TO BE TAKEN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        require('./../database/connection.php');

                        $sql = "SELECT ip.*, gp.*, agp.*,wmr.*, pwgp.*, disposal.*, us.*, ac.accountNumber AS classification,
                                    COALESCE(co.officeName, no.officeName) AS office
                                    FROM ics_properties ip
                                    LEFT JOIN generalproperties gp ON ip.propertyID = gp.propertyID
                                    LEFT JOIN are_ics_gen_properties agp ON ip.ARE_ICS_id = agp.ARE_ICS_id
                                    LEFT JOIN wmr_properties wmr ON gp.propertyID = wmr.propertyID
                                    LEFT JOIN prs_wmr_gen_properties pwgp ON gp.propertyID = pwgp.propertyID
                                    LEFT JOIN account_codes ac ON gp.accountNumber = ac.accountNumber
                                    LEFT JOIN cityoffices co ON gp.officeName = co.officeName
                                    LEFT JOIN nationaloffices no ON gp.officeName = no.officeName
                                    LEFT JOIN conditions c ON agp.currentCondition = c.conditionName
                                    LEFT JOIN mode_of_disposal disposal ON wmr.wmrID = disposal.wmrID
                                    LEFT JOIN updates_or_status us ON wmr.wmrID = us.wmrID
                                    WHERE 
                                        ((agp.airemarks LIKE '%with wmr%')
                                            OR (agp.currentCondition = 'Returned'))
                                        OR (wmr.propertyID IN (SELECT propertyID FROM generalproperties))
                                        ORDER BY
                                            CAST(SUBSTRING_INDEX(wmr.wmrNo, '-', 1) AS UNSIGNED), 
                                            CAST(SUBSTRING_INDEX(wmr.wmrNo, '-', -1) AS UNSIGNED)";



                        $pre_stmt = $connect->prepare($sql) or die(mysqli_error($connect));
                        $pre_stmt->execute();
                        $result = $pre_stmt->get_result();

                        while ($rows = mysqli_fetch_array($result)) {

                            
                            $formattedDateReceived = (!empty($rows["dateReceived"]) && $rows["dateReceived"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateReceived"])) : "";
                            $formattedDateReturned = (!empty($rows["dateReturned"]) && $rows["dateReturned"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateReturned"])) : "";
                            $formattedAcquisitionDate = (!empty($rows["acquisitionDate"]) && $rows["acquisitionDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["acquisitionDate"])) : "";
                            $formattediirupDate = (!empty($rows["iirupDate"]) && $rows["iirupDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["iirupDate"])) : "";
                            $formattedDateOfSale = (!empty($rows["dateOfSale"]) && $rows["dateOfSale"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateOfSale"])) : "";
                            $formattedDateOfAuction = (!empty($rows["dateOfAuction"]) && $rows["dateOfAuction"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["dateOfAuction"])) : "";
                            $formattedORdate = (!empty($rows["ORdate"]) && $rows["ORdate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["ORdate"])) : "";
                            $formattedTransferDate = (!empty($rows["transferDate"]) && $rows["transferDate"] != "0000-00-00") ? date("m/d/Y", strtotime($rows["transferDate"])) : "";


                            $scannedPRSPath = $rows["scannedDocs"];

                            // Conditionally create the "View Scanned Supporting document" link
                            if (!empty($scannedPRSPath)) {
                                // Extract the property number
                                $propertyNo = $rows["propertyNo"];

                                // Create the new filename
                                $newFilename = "WMR_" . $rows["wmrNo"] . "(" . $propertyNo . ")";

                                // Get the file extension
                                $fileExtension = pathinfo($scannedPRSPath, PATHINFO_EXTENSION);

                                // Create the new link with the renamed file
                                $scannedPRSLink = '<a href="' . $scannedPRSPath . '" target="_blank">' . $newFilename . '</a>';
                            } else {
                                $scannedPRSLink = ''; // Empty link if scannedARE is null
                            }

                     ?>

                     <tr>
                        <td><?php echo isset($scannedPRSLink) ? $scannedPRSLink : ''; ?></td>
                        <td>
                            <?php 
                                if (!empty($formattedDateReturned)) {
                                    echo $formattedDateReturned;
                                } else {
                                    echo $formattedDateReceived;
                                }
                            ?>
                        </td>
                        <td><?php echo isset($rows['itemNo']) ? $rows['itemNo'] : ''; ?></td>
                        <td><?php echo isset($rows['wmrNo']) ? $rows['wmrNo'] : ''; ?></td>
                        <td><?php echo isset($rows['article']) ? $rows['article'] : ''; ?></td>
                        <td><?php echo isset($rows["brand"]) ? $rows["brand"] : ''; ?></td>
                        <td><?php echo isset($rows["serialNo"]) ? $rows["serialNo"] : ''; ?></td>
                        <td><?php echo isset($rows["particulars"]) ? $rows["particulars"] : ''; ?></td>
                        <td style="white-space: nowrap;"><?php echo isset($rows["ICSno"]) ? $rows["ICSno"] : ''; ?></td>
                        <td><?php echo isset($rows["eNGAS"]) ? $rows["eNGAS"] : ''; ?></td>
                        <td><?php echo isset($formattedAcquisitionDate) ? $formattedAcquisitionDate : ''; ?></td>
                        <td><?php echo isset($rows["acquisitionCost"]) ? $rows["acquisitionCost"] : ''; ?></td>
                        <td><?php echo isset($rows["propertyNo"]) ? $rows["propertyNo"] : ''; ?></td>
                        <td><?php echo isset($rows["accountNumber"]) ? $rows["accountNumber"] : ''; ?></td>
                        <td><?php echo isset($rows["estimatedLife"]) ? $rows["estimatedLife"] : null; ?></td>
                        <td><?php echo isset($rows["unitOfMeasure"]) ? $rows["unitOfMeasure"] : ''; ?></td>
                        <td><?php echo isset($rows["unitValue"]) ? $rows["unitValue"] : ''; ?></td>
                        <td><?php echo isset($rows["onhandPerCount"]) ? $rows["onhandPerCount"] : ''; ?></td>
                        <td style="white-space: nowrap;"><?php echo isset($rows["office"]) ? $rows["office"] : ''; ?></td>
                        <td style="white-space: nowrap;"><?php echo isset($rows["accountablePerson"]) ? $rows["accountablePerson"] : ''; ?></td>
                        <td>
                            <?php 
                                // Initialize the display variable
                                $display = '';

                                // Check if "currentCondition" is not empty, concatenate it to the display variable
                                if (!empty($rows["currentCondition"])) {
                                    $display .= $rows["currentCondition"];
                                }

                                // Check if "airemarks" is not empty, concatenate it to the display variable
                                if (!empty($rows["airemarks"])) {
                                    // If display already contains data, append a separator before adding this field
                                    $display .= !empty($display) ? ' ; ' . $rows["airemarks"] : $rows["airemarks"];
                                }

                                // Check if "prsWmrRemarks" is not empty, concatenate it to the display variable
                                if (!empty($rows["prsWmrRemarks"])) {
                                    // If display already contains data, append a separator before adding this field
                                    $display .= !empty($display) ? ' ; ' . $rows["prsWmrRemarks"] : $rows["prsWmrRemarks"];
                                }

                                // Output the concatenated result
                                echo $display;
                            ?>
                        </td>
                        <td><?php echo isset($rows["withAttachment"]) ? $rows["withAttachment"] : ''; ?></td>
                        <td><?php echo isset($rows["withCoverPage"]) ? $rows["withCoverPage"] : ''; ?></td>
                        <td><?php echo isset($rows["iirup"]) ? $rows["iirup"] : ''; ?></td>
                        <td><?php echo isset($formattediirupDate) ? $formattediirupDate : ''; ?></td>


                        <td><?php echo isset($rows["modeOfDisposal"]) ? $rows["modeOfDisposal"] : ''; ?></td>
                        <td>
                            <?php 
                                if ($rows["modeOfDisposal"] == "Sold Through Negotiation") {
                                    echo $formattedDateOfSale;
                                } elseif ($rows["modeOfDisposal"] == "Sold Through Public Auction") {
                                    echo $formattedDateOfAuction;
                                }
                            ?>
                        </td>
                        <td><?php echo isset($formattedORdate) ? $formattedORdate : ''; ?></td>
                        <td style="white-space: nowrap;"><?php echo isset($rows["ORnumber"]) ? $rows["ORnumber"] : ''; ?></td>
                        <td><?php echo isset($rows["amount"]) ? $rows["amount"] : ''; ?></td>
                        <td><?php echo isset($rows["partDestroyed"]) ? $rows["partDestroyed"] : ''; ?></td>
                        <td style="white-space: nowrap;">
                            <?php 
                                // Initialize the display variable
                                $modeOfDisposalRemarks = '';

                                // Additional information based on modeOfDisposal
                                if ($rows["modeOfDisposal"] == "Continued In Service" || $rows["modeOfDisposal"] == "Transferred Without Cost") {
                                    // Construct additional information
                                    $RemarksForModeOfDisposal = "Date of Transfer: " . $formattedTransferDate . " ; Recipient: " . $rows["recipient"] . " ; Notes: " . $rows["modeRemarks"];
                                    
                                    // Split the additional information by semicolons
                                    $parts = explode(';', $RemarksForModeOfDisposal);

                                    // Join the parts with semicolon and line breaks
                                    $modeOfDisposalRemarks = implode(';<br>', $parts);
                                }
                                else {
                                   $modeOfDisposalRemarks = $rows["modeRemarks"]; 
                                }

                                // Output the result
                                echo $modeOfDisposalRemarks;
                            ?>
                        </td>
                        <td><?php echo isset($rows["currentStatus"]) ? $rows["currentStatus"] : ''; ?></td>
                        <td style="white-space: nowrap;">
                            <?php 
                                // Initialize the display variable
                                $currentStatusRemarks = '';

                                // Additional information based on currentStatus
                                if ($rows["currentStatus"] == "Dropped In Both Records") {
                                    // Construct additional information
                                    $actionsToBeTaken = "JEV #: " . $rows["jevNoDropped"] . " ; Date Dropped: " . $rows["dateDropped"];
                                    
                                    // Split the additional information by semicolons
                                    $parts = explode(';', $actionsToBeTaken);

                                    // Join the parts with semicolon and line breaks
                                    $currentStatusRemarks = implode(';<br>', $parts);
                                }
                                elseif ($rows["currentStatus"] == "Existing In Inventory Report") {
                                    $currentStatusRemarks = $rows["actionsToBeTaken"]; 
                                }

                                // Output the result
                                echo $currentStatusRemarks;
                            ?>
                        </td>

                        <td>
                          <a href="managePRSEditTable.php?propertyID=<?php echo $rows['propertyID']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                     </tr>

                     <?php 
                        } // End of while loop
                     ?>
                  </tbody>
                </table>
              </div>
            </div>
            
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

    <!-- Editable table -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#WMR').DataTable({
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
                }],
                "dom": 'Blfrtip',
                "buttons": [{
                    extend: 'colvis',
                    text: 'Hide/Show Columns'
                }],
                "select": true, // enable row selection
                "ajax": {
                    "url": "", // use your server-side script
                    "type": "POST"
                }
            });

            // Initialize Editor
            var editor = new $.fn.dataTable.Editor({
                ajax: "../AdminPage/manageWMR.php", // URL to your server-side script for handling CRUD operations
                table: "#WMR",
                fields: [
                    // Define your editor fields here
                    // For example:
                    { label: 'Date Returned', name: 'dateReturned'},
                    { label: 'Item Number', name: 'itemNo'},
                    { label: 'WMR Number', name: 'wmrNo'},
                    { label: 'Article', name: 'article' },
                    { label: 'Brand', name: 'brand' },
                    { label: 'Serial Number', name: 'serialNo' },
                    { label: 'Particulars', name: 'particulars' },
                    { label: 'ICSno', name: 'ICSno'},
                    { label: 'eNGAS', name: 'eNGAS'},
                    { label: 'Acquisition Date', name: 'acquisitionDate'},
                    { label: 'Acquisition Cost', name: 'acquisitionCost'},
                    { label: 'Property Number', name: 'propertyNo'},
                    { label: 'Account Code', name: 'accountNumber'},
                    { label: 'Estimated Useful Life', name: 'estimatedLife'},
                    { label: 'Unit of Measure', name: 'unitOfMeasure'},
                    { label: 'Unit Value', name: 'unitValue'},
                    { label: 'On Hand Per Count', name: 'onhanPerCount'},
                    { label: 'Responsibility Center', name: 'officeName'},
                    { label: 'Accountable Employee', name: 'accountablePerson'},
                    { label: 'Remarks', name: 'airemarks'},
                    { label: 'With Attachment', name: 'withAttachment'},
                    { label: 'With Cover Page', name: 'withCoverPage'},
                    { label: 'IIRUP', name: 'iirup'},
                    { label: 'IIRUP Date', name: 'iirupDate'},
                    { label: 'Mode Of Disposal', name: 'modeOfDisposal'},
                    // Dynamically set label and name for Date of Sale or Auction based on modeOfDisposal
                    { 
                        label: getLabelForDateOfSaleOrAuction(modeOfDisposal), 
                        name: getNameForDateOfSaleOrAuction(modeOfDisposal)
                    },
                    // Dynamically set label and name for other fields based on modeOfDisposal
                    { 
                        label: getLabelForOtherFields(modeOfDisposal, 'OR'), 
                        name: getNameForOtherFields(modeOfDisposal, 'ORdate')
                    },
                    { 
                        label: getLabelForOtherFields(modeOfDisposal, 'OR Number'), 
                        name: getNameForOtherFields(modeOfDisposal, 'ORnumber')
                    },
                    { 
                        label: getLabelForOtherFields(modeOfDisposal, 'Amount'), 
                        name: getNameForOtherFields(modeOfDisposal, 'amount')
                    },
                    { 
                        label: getLabelForOtherFields(modeOfDisposal, 'Part Destroyed'), 
                        name: getNameForOtherFields(modeOfDisposal, 'partDestroyed')
                    },
                    { 
                        label: getLabelForOtherFields(modeOfDisposal, 'Remarks'), 
                        name: getNameForOtherFields(modeOfDisposal, 'modeRemarks')
                    },
                    

                ]
            });

            //Function to get the label for Date of Sale or Auction based on the mode of disposal
            function getLabelForDateOfSaleOrAuction(modeOfDisposal) {
              if (modeOfDisposal === "Sold Through Public Auction") {
                return 'Date of Auction';
              } else if (modeOfDisposal === "Sold Through Negotiation") {
                return 'Date of Sale';
              } else {
                return '';
              }
            }

            // Function to get the name for Date field based on modeOfDisposal
            function getNameForDateOfSaleOrAuction(modeOfDisposal) {
                if (modeOfDisposal === "Sold Through Public Auction") {
                    return 'dateOfAuction';
                } else if (modeOfDisposal === "Sold Through Negotiation") {
                    return 'dateOfSale';
                } else {
                    return '';
                }
            }

            // Function to get the label for other fields based on modeOfDisposal
            function getLabelForOtherFields(modeOfDisposal, fieldName) {
                switch(fieldName) {
                    case 'OR':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'Date of OR' : 'Date of OR';
                    case 'OR Number':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'OR Number' : 'OR Number';
                    case 'Amount':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'Amount' : 'Amount';
                    case 'Part Destroyed':
                        return modeOfDisposal === "By Destruction Or Condemnation" ? 'Part Destroyed' : '';
                    case 'Remarks':
                        return 'Remarks';
                    default:
                        return '';
                }
            }

            // Function to get the name for other fields based on modeOfDisposal
            function getNameForOtherFields(modeOfDisposal, fieldName) {
                switch(fieldName) {
                    case 'OR':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'dateOfORNego' : 'dateOfORAuction';
                    case 'OR Number':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'ORnumberNego' : 'ORnumberAuction';
                    case 'Amount':
                        return modeOfDisposal === "Sold Through Negotiation" ? 'amountNego' : 'amountAuction';
                    case 'Part Destroyed':
                        return modeOfDisposal === "By Destruction Or Condemnation" ? 'partDestroyedThrown' : '';
                    case 'Remarks':
                        return 'modeRemarks'; // Update with the actual name for the remarks field
                    default:
                        return '';
                }
            }

            // Enable bubble editing
            table.MakeCellsEditable({
                "onUpdate": function(updatedCell, updatedRow, oldValue) {
                    // Handle cell updates here
                    var column = table.cell(updatedCell).index().column;
                    editor.edit(table.cell(updatedCell).index().row, column);
                },
                "inputCss": 'my-input-class',
                "columns": [1, 2, 3, 4], // Indexes of columns that should be editable
                "editor": editor
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