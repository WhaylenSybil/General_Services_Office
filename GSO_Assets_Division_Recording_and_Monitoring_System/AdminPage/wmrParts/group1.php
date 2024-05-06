<div class="col-md-4"><!-- Group 1 -->
  <div class="form-group">
    <h4 class="box-title" align="center"><b>WASTE MATERIAL REPORT</b></h4><br>
    <div class="horizontal-line"></div>
  </div><!-- form-group -->

  <!-- Scanned Docs -->
  <div class="form-group">
    <label for="scannedDocs">Scanned Documents</label>
    <input type="file" name="scannedDocs" class="form-control" id="scannedDocs" accept=".pdf">
  </div>
  <!-- End of Scanned Docs -->

  <!-- Date Recorded -->
  <div class="form-group">
    <label for="dateReturned"> Date Returned</label>
    <input type="date" class="form-control" id="dateReturned" placeholder="Date Returned" name="dateReturned" autocomplete="off" required max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
  </div>
  <!-- End Date Recorded -->

  <!-- Item Number -->
  <div class="form-group">
    <label for="itemNo">Item No.</label>
    <input type="text" name="itemNo" class="form-control" id="itemNo" placeholder="Item No." autocomplete="off">
  </div>
  <!-- End Item Number -->

  <!-- PRS Number -->
  <div class="form-group">
    <label for="wmrNo"> WMR Number</label>
    <input type="text" name="wmrNo" class="form-control" id="wmrNo" placeholder="WMR Number" autocomplete="off">
  </div>
  <!-- End PRS Number -->

  <!-- Article -->
  <div class="form-group">
    <label for="article"> Article</label>
    <input type="text" class="form-control" id="article" placeholder="Article" name="article" autocomplete="off" style="text-transform: uppercase;" required>
  </div>
  <!-- End Article -->

  <!-- Brand -->
  <div class="form-group">
    <label for="brand"> Brand/Model</label>
    <input type="text" class="form-control" id="brand" placeholder="Brand/Model" name="brand" autocomplete="off" style="text-transform: uppercase;" required>
  </div>
  <!-- End Brand -->

  <!-- Particulars -->
  <div class="form-group">
    <label for="particulars"> Particulars</label>
    <textarea type="text" class="form-control" id="particulars" placeholder="Particulars" name="particulars" autocomplete="off"></textarea>
  </div>
  <!-- End Particulars -->

  <!-- Responsibility Center(Office/Department) -->
  <div class="form-group">
    <label for="officeName"> Responsibility Center (Offices and Departments)</label>
    <input list="rescenter_options" class="form-control" id="officeName" placeholder="Responsibility Center" name="officeName" autocomplete="off" onchange="fetchEmployeesByCenter()">
    <datalist id="rescenter_options">
        <?php
        $responsibilityCenter = $connect->query("SELECT co.officeID, co.officeName AS officeName, co.officeCodeNumber FROM cityoffices co UNION ALL SELECT no.officeID, no.officeName AS officeName, no.officeCodeNumber FROM nationaloffices no ORDER BY officeName");
        $rowCount = $responsibilityCenter->num_rows;
        if ($rowCount > 0) {
            while ($row = $responsibilityCenter->fetch_assoc()) {
                echo '<option value="'.$row['officeName'].'">'.$row['officeName'].'</option>';
            }
        } else {
            echo '<option value="">No Responsibility Center available</option>';
        }
        ?>
    </datalist>
  </div>
  <!-- End Responsibility Center(Office/Department) -->


  <!-- Property Account Code (Classification) -->
  <div class="form-group">
    <label for="accountNumber"> Account Code</label>
    <input list="classification_options" class="form-control" id="accountNumber" placeholder="Account Code" name="accountNumber" autocomplete="off" required>
    <datalist id="classification_options">
        <?php
        $query1 = $connect->query("SELECT * FROM account_codes");
        $rowCount = $query1->num_rows;
        if ($rowCount > 0) {
            while ($row = $query1->fetch_assoc()) {
                echo '<option value="' . $row['accountNumber'] . '">' . $row['accountNumber'] . '</option>';
            }
        } else {
            echo '<option value="">No Classifications available</option>';
        }
        ?>
    </datalist>
  </div>
  <!-- End Classification(Property Account Code) -->

  <!-- Acquisition Date -->
  <div class="form-group">
    <label for="acquisitionDate"> Acquisition Date</label>
    <input type="date" class="form-control" id="acquisitionDate" placeholder="Acquisition Date" name="acquisitionDate" autocomplete="off">
  </div>
  <!-- End Acquisition Date -->
  
</div><!-- col-md-3 -->
<!-- End of Group 1 -->