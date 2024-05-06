  <!-- ===============================Group 2=============================== -->
  <div class="col-md-4 vertical-line">
    <div class="form-group">
      <h4 class="box-title" align="center"><b>WASTE MATERIAL REPORT</b></h4><br>
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

  <!-- Remarks -->
  <div class="form-group">
    <label for="remarks"> Remarks</label>
    <textarea type="text" class="form-control" id="remarks" placeholder="Remarks" autocomplete="off"  name="remarks"></textarea>
  </div>
  <!-- Remarks -->

  <!-- IIRUP -->
  <div class="form-group">
    <label for="iirup">IIRUP</label>
    <select class="form-control" name="iirup" id="iirup">
        <option value="">--- SELECT IIRUP ---</option>
        <option value="YES">YES</option>
        <option value="NO">NO</option>
    </select>
  </div>
  <!-- End IIRUP -->

  <!-- IIRUP Date -->
  <div class="form-group">
    <label for="iirupDate"> Date of IIRUP</label>
    <input type="date" class="form-control" id="iirupDate" placeholder="Date Returned" name="iirupDate" autocomplete="off" autocomplete="off">
  </div>
  <!-- End IIRUP Date -->

  <!-- Container for checkboxes -->
  <div class="form-group">
      <!-- With Attachment -->
      <div class="checkbox-container">
          <input type="checkbox" name="withAttachment" class="form-check-input" id="withAttachment">
          <label class="form-check-label" for="withAttachment">With Attachment</label>
      </div>
      
      <!-- With Cover Page -->
      <div class="checkbox-container">
          <input type="checkbox" name="withCoverPage" class="form-check-input" id="withCoverPage">
          <label class="form-check-label" for="withCoverPage">With Cover Page</label>
      </div>
  </div>
  <!-- End Container for checkboxes -->



</div><!-- col-md-3 -->
<!-- End of Group 2 -->