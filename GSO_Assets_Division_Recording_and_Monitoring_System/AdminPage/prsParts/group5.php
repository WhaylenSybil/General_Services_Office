<div class="col-md-4 vertical-line">
<!-- ========================================================================= -->
<!-- UPDATES OR CURRENT STATUS -->
<div class="form-group">
<h4 class="box-title" align="center"><b>UPDATES OR CURRENT STATUS</b></h4><br>
<div class="horizontal-line"></div>

<div id="updatesOrCurrentStatus">
    <select id="updatesCurrentStatus" onchange="ShowSelectedUpdate()" class="form-control" name="updatesCurrentStatus">
        <option value="">--- Select Updates/Current Status ---</option>
        <option value="Dropped In Both Records">Dropped In Both Records</option>
        <option value="Existing In Inventory Report">Existing In Inventory Report</option>
    </select>
    <br>
    
    <!-- ========================================================================= -->
    <!-- Form for Dropped In Both Records -->
    <div id="form-DroppedInBothRecords" class="updates-currentStatus">
        <div class="form-group">
            <label for="jevNoDropped">JEV Number (Upon Disposal)</label>
            <input type="text" name="jevNoDropped" id="jevNoDropped" class="form-control" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="dateDropped">Date</label>
            <input type="date" name="dateDropped" id="dateDropped" class="form-control" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="notesDropped">Notes</label>
            <input type="text" name="notesDropped" id="notesDropped" class="form-control" autocomplete="off">
        </div>
    </div><!-- form-DroppedInBothRecords -->

    <!-- Form for Existing In Inventory Report -->
    <div id="form-ExistingInInventoryReport" class="updates-currentStatus">
        <div class="form-group">
            <label for="remarksExisting">Remarks</label>
            <input type="text" name="remarksExisting" id="remarksExisting" class="form-control" autocomplete="off">
        </div>
    </div><!-- form-ExistingInInventoryReport -->
</div>
</div><!-- form-group -->
</div><!-- col-md-4 -->