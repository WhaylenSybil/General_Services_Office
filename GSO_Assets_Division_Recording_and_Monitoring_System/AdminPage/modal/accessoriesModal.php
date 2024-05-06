<!-- Modal -->
<div id="accessoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accessories</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Accessory Name</th>
                <th>Brand</th>
                <th>Serial Number</th>
                <th>Particulars</th>
                <th>Cost</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($accessories as $accessory): ?>
                <tr>
                  <td><?php echo $accessory['accessoryName']; ?></td>
                  <td><?php echo $accessory['accessoryBrand']; ?></td>
                  <td><?php echo $accessory['accessorySerialNo']; ?></td>
                  <td><?php echo $accessory['accessoryParticulars']; ?></td>
                  <td><?php echo $accessory['accessoryCost']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div><!-- table-responsive -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- accessoryModal -->
        