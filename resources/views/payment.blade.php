@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="row mb-2" style="flex-wrap:nowrap">
        <div class="col-sm-6">
            <h3>Payment Details</h3>
        </div>
        <div class="col-sm-6 text-right">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Payment Details</li>
            </ol>
        </div>
    </div>
</section>
@include('components.script-messages')

<section>
    <div class="container-fluid">
    <div class="col-12">
    
    <div class="card">
    <div class="card-body">
            @if($data->isEmpty())
                <p class="p-4">No payment records found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PE Name</th>
                            <th>Payment Name</th>
                            <th>Amount</th>
                            <th>Work Done Date</th>
                            <th>Vendor Name</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $payment)
                            <tr id='{{ $payment->id }}'>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->pe_name}}</td>
                                <td>{{ $payment->pmt_name }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->pmt_date }}</td>
                                <td>{{ $payment->vendor_name }}</td>
                                <td>
                                <input type="checkbox" style="min-width:0px !important;" id="{{ $payment->id }},{{ $payment->rmu_id }},'{{ $payment->pmt_name }}'">
                                </td>
                               
                            </tr>
                        @endforeach
                        <tr>
                        <td colspan="6"></td>

                        <td><input type="button" onclick="togglePayment()" class="btn btn-success" value="Pay"/></td>
                        </tr>

                    </tbody>
                </table>
            @endif
            </div>  
            </div>   
 
    </div>
    </div>

</section>

@endsection

@section('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script>

   

    function togglePayment() {

        var checkedIds = $('input[type="checkbox"]:checked').map(function() {
            return this.id;
        }).get();
  

        addData(checkedIds,0)
      //  console.log("Checked IDs:", checkedIds);
       
        // var Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         showConfirmButton: false,
        //         timer: 2000
        //     });
        
        
        
    }

    function addData(checkedIds,index){
       var len=checkedIds.length;
       if(len==0){
        alert('please select record first!')
        return;
       }
       var  values='';
       if(index<len){
          values=checkedIds[index].split(',');
       }else{
        alert('Payment update successfully!')
        return;
       }

        $.ajax({
            url: '/updatepayment/' + values[0]+'/'+values[1]+'/'+values[2], // Adjust the URL as necessary
            type: 'GET',
           
            success: function(response) {
             //   toastr.success('Payment update successfully!');
                const row = document.getElementById(values[0]);
                if (row) {
                    row.remove();
                }
                addData(checkedIds,index+1);
            },
            error: function(xhr) {
                // Handle error
            }
        });
    }
</script>


@endsection
