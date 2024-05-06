<!-- NEW ARE REGISTRY -->
<div class="col-md-12"><!-- Group 1 -->
  <div class="form-group">
    <h4 class="box-title" align="center"><b>REGISTRY OF NEW ARE-ISSUED PPE</b></h4>
    <div class="horizontal-line"></div>
  </div>
</div>
<!-- End of NEW ARE REGISTRY -->

<!-- Scanned Documents -->
<div class="col-md-3">
  <div class="form-group">
    <label for="scannedDocs">Scanned Documents</label>
    <input type="file" name="scannedDocs" class="form-control" id="scannedDocs" accept=".pdf">
  </div>
</div>
<!-- End Scanned Documents -->

<!-- Date Recorded -->
<div class="col-md-3">
  <div class="form-group">
    <label for="dateReceived"> Date Received</label>
    <input type="date" class="form-control" id="dateReceived" placeholder="Date Recorded" name="dateReceived" autocomplete="off" required max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
  </div>
</div>
<!-- End Date Recorded -->

<!-- Article -->
<div class="col-md-3">
  <div class="form-group">
    <label for="article"> Article</label>
    <input type="text" class="form-control" id="article" placeholder="Article" name="article" autocomplete="off" style="text-transform: uppercase;" required>
  </div>
</div>
<!-- End Article -->

<!-- Brand -->
<div class="col-md-3">
  <div class="form-group">
    <label for="brand"> Brand/Model</label>
    <input type="text" class="form-control" id="brand" placeholder="Brand/Model" name="brand" autocomplete="off" style="text-transform: uppercase;" required>
  </div>
</div>
<!-- End Brand -->

<!-- Particulars -->
<div class="col-md-3">
  <div class="form-group">
    <label for="particulars"> Particulars</label>
    <textarea type="text" class="form-control" id="particulars" placeholder="Particulars" name="particulars" autocomplete="off" style="resize: vertical; height: 2.4em;"></textarea>
  </div>
</div>
<!-- End Particulars -->

<!-- Responsibility Center(Office/Department) -->
<div class="col-md-3">
  <div class="form-group">
    <label for="officeName"> Responsibility Center</label>
    <input list="rescenter_options" class="form-control" id="officeName" placeholder="Responsibility Center" name="officeName" autocomplete="off">
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
</div>
<!-- End Responsibility Center(Office/Department) -->

<!-- Property Account Code (Classification) -->
<div class="col-md-3">
  <div class="form-group">
    <label for="accountNumber"> Account Code</label>
    <input list="classification_options" class="form-control" id="accountNumber" placeholder="Account Code" name="accountNumber" autocomplete="off" required>
    <datalist id="classification_options">
        <?php
        $classification = $connect->query("SELECT * FROM account_codes");
        $rowCount = $classification->num_rows;
        if ($rowCount > 0) {
            while ($row = $classification->fetch_assoc()) {
                echo '<option value="' . $row['accountNumber'] . '">' . $row['accountNumber'] . '</option>';
            }
        } else {
            echo '<option value="">No Classifications available</option>';
        }
        ?>
    </datalist>
  </div>
</div>
<!-- End Classification(Property Account Code) -->

<!-- Acquisition Date -->
<div class=" col-md-3">
  <div class="form-group">
    <label for="acquisitionDate"> Acquisition Date</label>
    <input type="date" class="form-control" id="acquisitionDate" placeholder="Acquisition Date" name="acquisitionDate" autocomplete="off">
  </div>
</div>
<!-- End Acquisition Date -->

<!-- Acquisition Cost/Unit Value -->
<div class="col-md-3">
  <div class="form-group">
      <label for="unitValue"> Unit Value</label>
      <input type="text" class="form-control" id="unitValue" placeholder="Unit Value" name="unitValue" autocomplete="off"onblur="validateUnitValue(this)">
      <p id="errorMessage" style="color: red;"></p>
  </div>
</div>

<!-- End Acquisition Cost/Unit Value -->

<!-- Quantity -->
<div class="col-md-3">
  <div class="form-group">
      <label for="balancePerCard"> Quantity</label>
      <input type="number" class="form-control" id="balancePerCard" placeholder="Quantity" name="balancePerCard" autocomplete="off" oninput="updateBalancePerCard()">
  </div>
</div>
<!-- End Quantity -->

<!-- Total Cost/Total Value -->
<div class="col-md-3">
  <div class="form-group">
      <label for="acquisitionCost">Total Value</label>
      <input type="text" class="form-control" id="acquisitionCost" placeholder="Total Value" name="acquisitionCost" readonly>
  </div>
</div>
<!-- End Total Cost/Total Value -->
      
<!-- Unit of Measure -->
<div class="col-md-3">
  <div class="form-group">
    <label for="unitOfMeasure"> Unit of Measure</label>
    <input type="text" class="form-control" id="unitOfMeasure" placeholder="Unit of Measure" name="unitOfMeasure" list="unitOfMeasure_options" autocomplete="off">
    <datalist id="unitOfMeasure_options">
      <option value="pc">
      <option value="unit">
      <option value="set">
      <option value="lot">
      <!-- Add more options as needed -->
    </datalist>
  </div>
</div>

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
          <th>Unit Value</th>
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
  // Get the modal element
  var modal = document.getElementById('accessoryModal');

  // Get the close button inside the modal
  var closeButton = modal.querySelector('.close');

  // Get the form element
  var form = document.getElementById('yourFormId');

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
    var tableBody = document.getElementById('accessoryTableBody');
    var newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td><input type="text" class="accessoryName" name="accessoryName[]"></td>
      <td><input type="text" class="accessoryBrand" name="accessoryBrand[]"></td>
      <td><input type="text" class="accessorySerialNo" name="accessorySerialNo[]"></td>
      <td><input type="text" class="accessoryParticulars" name="accessoryParticulars[]"></td>
      <td><input type="text" class="accessoryValue" name="accessoryValue[]"></td>
      <td><button type="button" class="remove-row">x</button></td>
    `;
    tableBody.appendChild(newRow);
  });

  // Event listener to remove a row from the accessory table
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-row')) {
      event.target.closest('tr').remove();
    }
  });

  // Prevent form submission
  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // Additional logic to handle form submission can be added here if needed
  });
</script>
<!-- Accessories modal -->


<div class="col-md-12">
  <table class="table table-bordered" id="dynamicFields">
    <thead>
      <tr>
        <th scope="col">Accountable Employee</th>
        <th scope="col">ARE/MR Number</ th>
        <th scope="col">Serial Number</th>
        <th scope="col">Property Number</th>
        <th scope="col">Location</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <input type="text" class="form-control" name="accountablePerson[]" list="accountable_options" autocomplete="off">
          <datalist id="accountable_options">
            <!-- Options will be dynamically populated via JavaScript -->
          </datalist>
        </td>
        <td><input type="text" class="form-control" name="AREno[]" autocomplete="off"></td>
        <td><textarea type="text" class="form-control" name="serialNo[]" autocomplete="off" style="resize: vertical; height: 2.4em;"></textarea></td>
        <td><input type="text" class="form-control" name="propertyNo[]" autocomplete="off"></td>
        <td><input type="text" class="form-control" name="location[]" autocomplete="off"></td>
        <td><button type="button" class="btn btn-primary add-row">＋</button></td>
      </tr>
    </tbody>
  </table>
</div>
<div class="col-md-12">
  <div class="horizontal-line"></div>
</div>


