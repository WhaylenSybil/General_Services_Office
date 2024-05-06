<div class="col-md-6 vertical-line">
<div class="horizontal-line"></div>
<h4 class="box-title" align="center"><b>ADDITIONAL DETAILS FOR RECONCILIATION PURPOSES</b></h4>
<div class="horizontal-line"></div>

<div class="row">
  <!-- Estimated Useful Life -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="estimatedLife">Estimated Useful Life</label>
      <input type="number" name="estimatedLife" class="form-control" id="estimatedLife" placeholder="Estimated Useful Life" name="estimatedLife" autocomplete="off" min="1" value="<?php echo $row['estimatedLife']; ?>">
    </div>
  </div>
  <!-- End of Estimated Useful Life -->

  <!-- Years of Service -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="yearsOfService">Years of Service</label>
      <input type="number" name="yearsOfService" class="form-control" id="yearsOfService" placeholder="Years of Service" name="yearsOfService" autocomplete="off" min="1" value="<?php echo $row['yearsOfService']; ?>">
    </div>
  </div>
  <!-- End Years of Service -->
</div><!-- row -->

<div class="row">
  <!-- Monthly Depreciation -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="monthlyDepreciation">Monthly Depreciation</label>
      <input type="text" name="monthlyDepreciation" class="form-control" id="monthlyDepreciation" placeholder="Monthly Depreciation" name="monthlyDepreciation" autocomplete="off" value="<?php echo $row['monthlyDepreciation']; ?>">
    </div>
  </div>
  <!-- End Monthly Depreciation -->

  <!-- Accumulated Depreciation -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="accumulatedDepreciation">Accumulated Depreciation</label>
      <input type="text" name="accumulatedDepreciation" class="form-control" id="accumulatedDepreciation" placeholder="Accumulated Depreciation" name="accumulatedDepreciation" autocomplete="off" value="<?php echo $row['accumulatedDepreciation']; ?>">
    </div>
  </div>
  <!-- End Accumulated Depreciation -->
</div><!-- row -->

<div class="row">
  <!-- Book Value -->
  <div class="col-md-6">
    <div class="form-group">
      <label for = "bookValue">Book Value</label>
      <input type="text" name="bookValue" class="form-control" id="bookValue" placeholder="Book Value" name="bookValue" autocomplete="off" value="<?php echo $row['bookValue']; ?>">
    </div>
  </div>
  <!-- End Book Value -->

  <!-- Supplier -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="supplier">Supplier</label>
      <input type="text" name="supplier" class="form-control" placeholder="Supplier" id="supplier" autocomplete="off" style="text-transform: uppercase;" value="<?php echo $row['supplier']; ?>">
    </div>
  </div>
  <!-- End Supplier -->
</div><!-- row -->

<div class="row">
  <!-- PO No -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="POno">PO No.</label>
      <input type="text" name="POno" class="form-control" placeholder="PO No." autocomplete="off"  id="POno" value="<?php echo $row['POnumber']; ?>">
    </div>
  </div>
  <!-- End PO No -->

  <!-- AIR/RIS No -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="AIRnumber">AIR/RIS No.</label>
      <input type="text" name="AIRnumber" class="form-control" placeholder="AIR/RIS No" autocomplete="off" id="AIRnumber" value="<?php echo $row['AIRnumber']; ?>">
    </div>
  </div>
  <!-- End AIR/RIS No -->
</div><!-- row -->

<div class="row">
  <!-- JEV Number -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="jevNo">jevNo Number(Registry)</label>
      <input type="text" name="jevNo" id="jevNo" class="form-control" placeholder="JEV Number" autocomplete="off" value="<?php echo $row['jevNo']; ?>">
    </div>
  </div>
  <!-- End JEV Number -->

  <!-- Notes -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="notes">Notes</label>
      <textarea type="text" name="notes" class="form-control" placeholder="Notes" id="notes" autocomplete="off" style="resize: vertical; height: 2.4em;"><?php echo $row['notes']; ?></textarea>
    </div>
  </div>
  <!-- End Notes -->
</div><!-- row -->
</div><!-- col-md-6 -->