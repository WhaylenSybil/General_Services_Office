<!-- ===============================Group 3=============================== -->
<div class="col-md-4 vertical-line">
<h4 class="box-title" align="center"><b>MODE OF DISPOSITION</b></h4><br>
<div class="horizontal-line"></div>

<div class="form-group">
    <select id="modeOfDisposalOptions" onchange="ShowSelectedForm()" class="form-control" name="modeOfDisposalOptions">
      <option value="">--- Select Mode of Disposition ---</option>
      <option value="By Destruction Or Condemnation">By Destruction or Condemnation</option>
      <option value="Sold Through Negotiation">Sold Through Negotiation</option>
      <option value="Sold Through Public Auction">Sold Through Public Auction</option>
      <option value="Transferred Without Cost"> Transferred Without Cost to Other Offices/Departments, and to Other Agencies</option>
      <option value="Continued In Service">Continued In Service</option>
    </select>
    <br>
    <!-- =================================================================================== -->
    <!-- Form for Destroyed Or Thrown -->
    <div id="form-ByDestructionOrCondemnation" class="additional-info">
      <div class="form-group">
        <label for="partDestroyedThrown">Parts Destroyed or Thrown</label>
        <textarea class="form-control" type="text" name="partDestroyedThrown" id="partDestroyedThrown" placeholder="Part Destroyed Or Thrown" autocomplete="off"></textarea>
      </div>
      <div class="form-group">
        <label for="remarksDestroyed">Remarks</label>
        <textarea class="form-control" type="text" name="remarksDestroyed" id="remarksDestroyed" placeholder="Remarks" autocomplete="off"></textarea>
      </div>
    </div><!-- form-DestroyedOrCondemned -->
    <!-- =================================================================================== -->
    <!-- Form for Sold Through Negotiation -->
    <div id="form-SoldThroughNegotiation" class="additional-info">
      <div class="form-group">
        <label for="dateOfSale">Date of Sale</label>
        <input type="date" name="dateOfSale" id="dateOfSale" placeholder="Date of Sale" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="dateOfORNego">Date of OR</label>
        <input type="date" name="dateOfORNego" id="dateOfORNego" placeholder="Date of OR" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="ORnumberNego">OR Number</label>
        <input type="text" name="ORnumberNego" id="ORnumberNego" placeholder="OR Number" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="amountNego">Amount</label>
        <input type="text" name="amountNego" id="amountNego" placeholder="Amount" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="notesNego">Notes</label>
        <input type="text" name="notesNego" id="notesNego" class="form-control" autocomplete="off" placeholder="Notes">
      </div>
    </div><!-- form-SoldThroughNegotiation -->
    <!-- =================================================================================== -->
    <div id="form-SoldThroughPublicAuction" class="additional-info">
      <div class="form-group">
        <label for="dateOfAuction">Date of Auction</label>
        <input type="date" name="dateOfAuction" id="dateOfAuction" placeholder="Date of Auction" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="dateOfORAuction">Date of OR</label>
        <input type="date" name="dateOfORAuction" id="dateOfORAuction" placeholder="Date of OR" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="ORnumberAuction">OR Number</label>
        <input type="text" name="ORnumberAuction" id="ORnumberAuction" placeholder="OR Number" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="amountAuction">Amount</label>
        <input type="text" name="amountAuction" id="amountAuction" placeholder="Amount" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="notesAuction">Notes</label>
        <input type="text" name="notesAuction" id="notesAuction" class="form-control" autocomplete="off" placeholder="Notes">
      </div>
    </div><!-- form-SoldThroughPublicAuction -->
    <!-- =================================================================================== -->
    <!-- Form for Transferred Without Cost -->
    <div id="form-TransferredWithoutCost" class="additional-info">
      <div class="form-group">
        <label for="transferDateWithoutCost">Date of Transfer (Without Cost)</label>
        <input type="date" name="transferDateWithoutCost" id="transferDateWithoutCost" placeholder="Date of Transfer (Without Cost)" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="recipientTransfer">Recipient (Name of Office/Agency/Institution)</label>
        <input type="text" name="recipientTransfer" id="recipientTransfer" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="notesTransfer">Notes</label>
        <input type="text" name="notesTransfer" id="notesTransfer" class="form-control" autocomplete="off">
      </div>
    </div><!-- form-TransferredWithoutCost -->
    <!-- =================================================================================== -->
    <!-- Form for Continued In Service -->
    <div id="form-ContinuedInService" class="additional-info">
      <div class="form-group">
        <label for="transferDateContinued">Date of Transfer (Continued In Service)</label>
        <input type="date" name="transferDateContinued" id="transferDateContinued" placeholder="Date of Transfer (Continued In Service)" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="recipientContinued">Recipient (Name of Office/Agency/Institution)</label>
        <input type="text" name="recipientContinued" id="recipientContinued" class="form-control" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="notesContinued">Notes</label>
        <input type="text" name="notesContinued" id="notesContinued" class="form-control" autocomplete="off">
      </div>
    </div><!-- form-ContinuedInService -->

</div><!-- form group -->
</div><!-- col-md-4 -->
<!-- End of Group 3 -->
