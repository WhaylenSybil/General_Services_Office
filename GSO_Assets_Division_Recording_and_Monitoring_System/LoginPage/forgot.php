<!-- forgot.php -->

<!-- Modal HTML -->
<div id="forgotModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <!-- Forgot password form goes here -->
        <form id="forgotForm" action="forgotProcess.php" method="post">
          <div class="form-group">
            <label for="employeeID">Employee ID</label>
            <input type="text" class="form-control" id="employeeID" name="employeeID" placeholder="Please enter your employeeID" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to handle modal -->
<script>
  // Wait for the document to be fully loaded
  $(document).ready(function() {
    // When the "Forgot Password" link is clicked, show the modal
    $('a[href="#forgot"]').click(function() {
      $('#forgotModal').modal('show');
    });
  });
</script>