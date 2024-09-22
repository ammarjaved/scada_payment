@if (Session::has('failed'))
<script>
    $(function() {

       toastr.error('Request failed.')

    })
</script>
@endif
@if (Session::has('success'))
<script>
     $(function() {


        toastr.success('Spending update successfully!')
     })
</script>
@endif
