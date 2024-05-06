<div id="add_employee_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <!-- Form for adding an employee -->
                <form method="post" id="insert_form_employee" autocomplete="off">
                    <!-- Employee Name -->
                    <div class="form-group">
                        <label for="employeeName">Employee Name</label>
                        <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="LAST NAME, First Name MI." required>
                    </div>
                    <!-- Employee TIN Number -->
                    <div class="form-group">
                        <label for="tinNo">Employee TIN Number</label>
                        <input type="text" class="form-control" id="tinNo" name="tinNo" placeholder="Employee TIN Number" autocomplete="off">
                    </div>
                    <!-- Employee ID Number -->
                    <div class="form-group">
                        <label for="employeeID">Employee ID Number</label>
                        <input type="text" class="form-control" id="employeeID" name="employeeID" placeholder="Employee ID" autocomplete="off">
                    </div>
                    <!-- Responsibility Center -->
                    <div class="form-group">
                        <label for="rescenter">Responsibility Center (Offices and Departments)</label>
                        <input list="rescenter_options" class="form-control" id="rescenter" placeholder="Responsibility Center" name="rescenter" autocomplete="off">
                        <datalist id="rescenter_options">
                            <!-- Options for responsibility center -->
                            <!-- These options can be populated dynamically using PHP -->
                        </datalist>
                    </div>
                    <!-- Remarks -->
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks" autocomplete="off"></textarea>
                    </div>
                    <!-- Submit Button -->
                    <input type="submit" name="insert_employee" id="insert_employee" value="Add Employee" class="btn btn-success">
                </form>
            </div>
            <div class="modal-footer">
                <!-- Close Button -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>