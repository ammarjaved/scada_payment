$(document).ready(function() {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
      });

    $("#spendingForm").validate();
    $jq('#spendingForm').ajaxForm({
        success: function(responseText, status, xhr, $form) {

            toastr.success('Spending update successfully!')
            $('#spendingModal').modal('hide');
            showSpendDetails(responseText.id)
        },
        error: function(xhr, status, error, $form) {
        toastr.error('Request failed. Please try again.')

    }
    })


    $("#example2").DataTable({
        "lengthChange": false,
        "autoWidth": false,
    })



    $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var url = button.data('url');
        $('#remove-foam').attr('action', '/'+url + '/' + id)
    });

    $('#spendingModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var peName = button.data('name')
        var modal = $(this);
        $('#spending-modal-id').val(id);
        $('#spending-modal-pe-name').val(peName);
     });




    // clear feilds when add paymetns table hide
    $('#spendingModal').on('hide.bs.modal', function(event) {

        $('#spending-modal-id').val('');
        $('#spending-modal-pe-name').val('');
        $('#description').val('');
        $('#amount').val('');
        $('#pmt_date').val('');
        $('#vendor_name').val('');
        $('#status option:eq(0)').prop('selected', true)
        $('#pmt_name option:eq(0)').prop('selected', true)
        if (!$('#pmt_date').attr('required')) {
            $('#pmt_date').attr('required', true)
        }
        $('.modal-body label.error').remove();
        $('.modal-body input , .modal-body select').removeClass('error')

     });

     $('#status').on('change',function(){
        if(this.value.includes('not payed')){
            $('#pmt_date').removeAttr('required', true)
        }else{
           $('#pmt_date').attr('required', true);
        }
     })
}
)



