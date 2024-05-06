$(function() {
    // Datatables initialization
    $('#engasRecordTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [10, 25, 50, 100, 200, 300, 400, 500],
        "searching": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "order": [],
        "columnDefs": [{
            "targets": 'no-filter',
            "searchable": false,
        }]
    });

    // Add new row
    $('#add_eNGAS').click(function() {
        if ($('tr[data-id=""]').length > 0) {
            $('tr[data-id=""]').find('[name="name"]').focus();
            return false;
        }
        var tr = $('<tr>');
        $('input[name="engasID"]').val('');
        tr.addClass('py-1 px-2');
        tr.attr('data-id', '');
        tr.append('<td contenteditable name="oldPropertyNo"></td>');
        tr.append('<td contenteditable name="newPropertyNo"></td>');
        tr.append('<td contenteditable name="description"></td>');
        tr.append('<td contenteditable name="acquisitionDate" class="datepicker"></td>');
        tr.append('<td contenteditable name="estimatedLife"></td>');
        tr.append('<td contenteditable name="responsibilityCenter"></td>');
        tr.append('<td contenteditable name="acquisitionCost"></td>');
        tr.append('<td class="text-center"><button class="btn btn-sm btn-primary btn-flat rounded-0 px-2 py-0">Save</button><button class="btn btn-sm btn-dark btn-flat rounded-0 px-2 py-0" onclick="cancel_button($(this))" type="button">Cancel</button></td>');
        $('#engasRecordTable').prepend(tr);
        tr.find('[name="oldPropertyNo"]').focus();
        attachDatePicker(); // Attach datepicker to newly added row
    });

    // Edit Row
    $('.editRow').click(function() {
        var tr = $(this).closest('tr');
        var id = tr.attr('data-id');
        $('input[name="id"]').val(id);
        var countColumn = tr.find('td').length;
        tr.find('td').each(function() {
            if ($(this).index() != (countColumn - 1)) {
                $(this).attr('contenteditable', true);
            }
        });
        tr.find('[name="oldPropertyNo"]').focus();
        tr.find('.editable').show('fast');
        tr.find('.noneditable').hide('fast');
    });

    // Delete Row
    $('.deleteRow').click(function() {
        var id = $(this).closest('tr').attr('data-id');
        var name = $(this).closest('tr').find("[name='oldPropertyNo']").text();
        var _conf = confirm("Are you sure to delete \"" + name + "\" from the list?");
        if (_conf == true) {
            $.ajax({
                url: 'saveEngasRecords.php?action=delete',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                error: function(err) {
                    alert("An error occurred while saving the data");
                    console.log(err);
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        alert(name + ' is successfully deleted from the list.');
                        location.reload();
                    } else {
                        alert(resp.msg);
                        console.log(err);
                    }
                }
            });
        }
    });

}); // End of main function