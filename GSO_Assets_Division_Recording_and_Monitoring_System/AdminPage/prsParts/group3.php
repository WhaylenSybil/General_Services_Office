  <!-- ===============================Group 2=============================== -->
  <div class="col-md-4 vertical-line">
    <div class="form-group">
      <h4 class="box-title" align="center"><b>PROPERTY RETURN SLIP</b></h4><br>
      <div class="horizontal-line"></div>
    </div>

  <!-- Onhand Per Count -->
  <div class="form-group">
    <label for="onhandPerCount"> On-hand per Count Quantity</label>
    <input type="number" class="form-control" id="onhandPerCount" placeholder="On-hand per Count Quantity" name="onhandPerCount" autocomplete="off">
  </div>
  <!-- End Onhand Per Count -->

  <!-- Shortage/Overage Quantity -->
  <div class="form-group">
    <label for="soQty"> Shortage/Overage Qty</label>
    <input type="text" class="form-control" id="soQty" placeholder="Shortage/Overage Qty" name="soQty" readonly>
  </div>
  <!-- End Shortage/Overage Quantity -->

  <!-- Shortage/Overage value -->
  <div class="form-group">
    <label for="soValue"> Shortage/Overage Value</label>
    <input type="text" class="form-control" id="soValue" placeholder="Shortage/Overage Value" name="soValue" readonly>
  </div>
  <!-- End Shortage/Overage value -->

  <div class="col-md-6">
  <div class="form-group">
    <label for="currentCondition">Current Condition</label>
    <input list="current_condition_options" class="form-control" id="currentCondition" placeholder="Enter or select Current Condition" name="currentCondition" autocomplete="off">
    <datalist id="current_condition_options">
        <?php
        // Query the database to fetch condition data from conditions table
        $conditions_query = $connect->query("SELECT conditionID, conditionName FROM conditions");
        
        while ($conditions_row = $conditions_query->fetch_assoc()) {
            echo '<option value="' . $conditions_row['conditionName'] . '">' . $conditions_row['conditionName'] . '</option>';
        }
        ?>
    </datalist>
  </div>
</div>

  <!-- Remarks -->
  <div class="form-group">
    <label for="remarks"> Remarks</label>
    <textarea type="text" class="form-control" id="remarks" placeholder="Remarks" autocomplete="off"  name="remarks"></textarea>
  </div>
  <!-- Remarks -->

  <!-- IIRUP -->
  <div class="form-group">
    <label for="iirup">IIRUP</label>
    <input type="text" class="form-control" id="iirup" placeholder="IIRUP #" name="iirup" autocomplete="off">
  </div>
  <!-- End IIRUP -->

  <!-- IIRUP Date -->
  <div class="form-group">
    <label for="iirupDate"> Date of IIRUP</label>
    <input type="date" class="form-control" id="iirupDate" placeholder="IIRUP Date" name="iirupDate" autocomplete="off">
  </div>
  <!-- End IIRUP Date -->

  <!-- With Attachment -->
  <div class="form-group">
    <label for="withAttachment"> Attachment</label>
    <textarea type="text" class="form-control" id="withAttachment" placeholder="Attachment" name="withAttachment" autocomplete="off"></textarea>
  </div>
  <!-- End With Attachment -->

  <!-- With Cover Page -->
  <div class="form-group">
    <label for="withCoverPage"> Cover Page</label>
    <input type="text" class="form-control" id="withCoverPage" placeholder="Cover Page" name="withCoverPage" autocomplete="off">
  </div>



</div><!-- col-md-3 -->
<!-- End of Group 2 -->