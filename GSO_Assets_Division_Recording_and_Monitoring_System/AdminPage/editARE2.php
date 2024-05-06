<!-- NEW ARE REGISTRY -->

<div class="col-md-6">
<div class="horizontal-line"></div>
<div class="form-group">
  <h4 class="box-title" align="center"><b>ADDITIONAL DETAILS FOR PHYSICAL INVENTORY</b></h4>
  <div class="horizontal-line"></div>
</div>

<div class="row">
  <!-- eNGAS -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="eNGAS">eNGAS Property Number</label>
      <input type="text" name="eNGAS" id="eNGAS" class="form-control" placeholder="eNGAS Property Number" autocomplete="off" value="<?php echo $row['eNGAS']; ?>">
    </div>
  </div>


  <!-- Balance Per card -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="quantity"> Balance Per Card Qty</label>
      <input type="number" class="form-control" id="quantity" placeholder="Balance Per Card Quantity" name="quantity" autocomplete="off" value="<?php echo $row['quantity']; ?>">
    </div>
    <script>
        function updateBalancePerCard() {
            // Get the value from the Quantity input
            var quantityValue = document.getElementById('balancePerCard').value;

            // Update the Balance Per Card input with the Quantity value
            document.getElementById('quantity').value = quantityValue;
        }
    </script>
  </div>
</div><!-- row -->


<div class="row">
  <!-- Onhand Per Count -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="onhandPerCount"> On-hand per Count Qty</label>
      <input type="number" class="form-control" id="onhandPerCount" placeholder="On-hand per Count Quantity" name="onhandPerCount" autocomplete="off" value="<?php echo $row['onhandPerCount']; ?>">
    </div>
  </div>

  <!-- SO Qty -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="soQty"> Shortage/Overage Qty</label>
      <input type="text" class="form-control" id="soQty" placeholder="Shortage/Overage Qty" name="soQty" value="<?php echo $row['soQty']; ?>" readonly>
    </div>
  </div>
</div><!-- row -->

<div class="row">
  <!-- SO Value -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="soValue"> Shortage/Overage Value</label>
      <input type="text" class="form-control" id="soValue" placeholder="Shortage/Overage Value" name="soValue" value="<?php echo $row['soValue']; ?>" readonly>
    </div>
  </div>

  <!-- Previous Condition -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="previousCondition"> Previous Condition</label>
      <input type="text" class="form-control" id="previousCondition" placeholder="Previous Condition" autocomplete="off"  name="previousCondition" value="<?php echo $row['previousCondition']; ?>">
    </div>
  </div>
</div><!-- row -->

<!-- Location -->
<!-- <div class="col-md-6">
  <div class="form-group">
    <label for="location"> Location</label>
    <input type="text" class="form-control" id="location" placeholder="Location/Whereabouts" autocomplete="off"  name="location">
  </div>
</div> -->

<div class="row">
  <!-- Current COndition -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="currentCondition">Current Condition</label>
      <input list="current_condition_options" class="form-control" id="currentCondition" placeholder="Enter or select Current Condition" name="currentCondition" autocomplete="off" value="<?php echo htmlspecialchars($row['currentCondition']); ?>">
      <datalist id="current_condition_options">
          <?php
          // Query the database to fetch condition data from conditions table
          $conditions_query = $connect->query("SELECT conditionID, conditionName FROM conditions");
          while ($condition_row = $conditions_query->fetch_assoc()) {
              $selected = ($condition_row['conditionName'] === $row['currentCondition']) ? 'selected' : '';
              echo '<option value="' . htmlspecialchars($condition_row['conditionName']) . '" ' . $selected . '>' . htmlspecialchars($condition_row['conditionName']) . '</option>';
          }
          ?>
          <option value="Other"></option>
      </datalist>
    </div>
  </div>

  <!-- Other Condition -->
  <div class="col-md-6" id="other_condition_group" style="display: none;">
    <div class="form-group" >
      <label for="other_condition">Other Condition</label>
      <input type="text" class="form-control" id="other_condition" placeholder="Enter Other Condition" name="other_condition" autocomplete="off" disabled>
    </div>
  </div>

  <!-- Date of Physical Inventory -->
  <div class="col-md-6">
    <div class="form-group">
      <label for="dateOfPhysicalInventory">Date of Physical Inventory</label>
      <input type="date" name="dateOfPhysicalInventory" id="dateOfPhysicalInventory" class="form-control" placeholder="Date of Physical Inventory" autocomplete="off" value="<?php echo $row['dateOfPhysicalInventory']; ?>">
    </div>
  </div>
</div><!-- row -->

<!-- Remarks -->
<div class="col-md-6">
  <div class="form-group">
    <label for="airemarks"> Remarks</label>
    <textarea type="text" class="form-control" id="airemarks" placeholder="Remarks" autocomplete="off"  name="airemarks" style="resize: vertical; height: 2.4em;"><?php echo $row['airemarks']; ?></textarea>
  </div>
</div>

</div><!-- col-md-6 -->
<!-- End of NEW ARE REGISTRY -->