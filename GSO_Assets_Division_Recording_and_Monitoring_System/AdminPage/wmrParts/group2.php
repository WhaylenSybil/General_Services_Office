  <!-- ===============================Group 2=============================== -->
  <div class="col-md-4 vertical-line">
    <div class="form-group">
      <h4 class="box-title" align="center"><b>WASTE MATERIAL REPORT</b></h4><br>
      <div class="horizontal-line"></div>
    </div>

    <!-- Acquisition Cost/Unit Value -->
    <div class="form-group">
        <label for="unitValue"> Unit Value</label>
        <input type="text" class="form-control" id="unitValue" placeholder="Unit Value" name="unitValue" autocomplete="off"onblur="validateUnitValue(this)">
        <p id="errorMessage" style="color: red;"></p>
    </div>

    <!-- End Acquisition Cost/Unit Value -->

    <!-- Quantity -->
    <div class="form-group">
        <label for="balancePerCard"> Balance Per Card</label>
        <input type="number" class="form-control" id="balancePerCard" placeholder="Balance Per Card" name="balancePerCard" autocomplete="off" oninput="updateBalancePerCard()">
    </div>
    <!-- End Quantity -->

    <!-- Total Cost/Total Value -->
    <div class="form-group">
        <label for="acquisitionCost">Total Value</label>
        <input type="text" class="form-control" id="acquisitionCost" placeholder="Total Value" name="acquisitionCost" readonly>
    </div>
    <!-- End Total Cost/Total Value -->

    <!-- Estimated Useful Life -->
    <div class="form-group">
      <label for="estimatedLife">Estimated Useful Life</label>
      <input type="number" name="estimatedLife" class="form-control" id="estimatedLife" placeholder="Years of Service" name="estimatedLife" autocomplete="off" min="1">
    </div>
    <!-- end Estimated Useful Life -->

    <!-- Unit of Measure -->
    <div class="form-group">
      <label for="unitOfMeasure"> Unit of Measure</label>
      <input type="text" class="form-control" id="unitOfMeasure" placeholder="Unit of Measure" name="unitOfMeasure" autocomplete="off">
    </div>
    <!-- End Unit of Measure -->

    <!-- Accountable Employee -->
    <div class="form-group">
      <label for="accountablePerson"> Accountable Employee</label>
      <input type="text" list="accountable_options" class="form-control" id="accountablePerson" placeholder="Accountable Employee" name="accountablePerson" autocomplete="off">
      <datalist id="accountable_options">
        <!-- Populate this datalist with options -->
      </datalist>
    </div>
    <!-- End Accountable Employee -->

    <!-- ARE/MR Number -->
    <!-- <div class="form-group">
      <label for="ICSno"> ARE/MR Number</label>
      <div id="ICSno_inputs">
          <input type="text" class="form-control" id="ICSno" placeholder="ARE/MR Number" name="ICSno" autocomplete="off">
      </div>
    </div> -->
    <!-- End ARE/MR Number -->

    <div class="form-group">
        <label for="ICSno">ICS Number</label>
        <div id="ICSno_inputs">
            <input type="text" class="form-control" id="ICSno" placeholder="ARE/MR Number" name="ICSno" autocomplete="off">
        </div>
    </div>

    <!-- Serial Number -->
    <div class="form-group">
      <label for="serialNo"> Serial Number</label>
      <div id="serialNo_inputs">
        <textarea type="text" class="form-control" id="serialNo" placeholder="Serial Number" name="serialNo" autocomplete="off"></textarea>
      </div>
    </div>
    <!-- End Serial Number -->

  <!-- eNGAS -->
  <div class="form-group">
    <label for="eNGAS"> eNGAS Property Number</label>
    <input type="text" class="form-control" id="eNGAS" placeholder="enGAS Property Number" name="eNGAS" autocomplete="off">
  </div>
  <!-- end eNGAS -->

  <!-- Property Number -->
  <div class="form-group">
    <label for="propertyNo"> Property Number</label>
    <div id="propertyNo_inputs">
      <input type="text" class="form-control" id="propertyNo" placeholder="Property Number" name="propertyNo" autocomplete="off">
    </div>
  </div>
  <!-- End Property Number -->
</div><!-- col-md-3 -->
<!-- End of Group 2 -->