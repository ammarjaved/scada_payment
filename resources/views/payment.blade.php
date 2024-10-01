@extends('layouts.app', ['page_title' => 'Payment'])

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

<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($data->isEmpty())
                        <p class="p-4">No payment records found.</p>
                    @else
                        <div class="mb-3">
                            <label for="payment-type-filter" class="mr-2">Payment Type:</label>
                            <select id="payment-type-filter" class="form-control d-inline-block w-auto mr-3">
                                <option value="">All</option>
                                <option value="amt_bo">BO</option>
                                <option value="amt_piw">PIW</option>
                                <option value="amt_outage">OUTAGE</option>
                                <option value="amt_rtu">RTU</option>
                                <option value="amt_kkb">KKB</option>
                                <option value="amt_pk">Jointer</option>
                                <option value="amt_ir">Tester</option>
                                <option value="amt_transport">Transport</option>
                            </select>

                            <label for="vendor-filter" class="mr-2">Vendor:</label>
                            <select id="vendor-filter" class="form-control d-inline-block w-auto">
                                <option value="">All Vendors</option>
                                @foreach($data->pluck('vendor_name')->unique() as $vendor)
                                    <option value="{{ $vendor }}">{{ $vendor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="payment-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Project</th>
                                        <th>Payment Name</th>
                                        <th>Amount</th>
                                        <th>Work Done Date</th>
                                        <th>Vendor Name</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $payment)
                                        <tr id='{{ $payment->id }}' data-payment-type="{{ $payment->pmt_name }}" data-vendor="{{ $payment->vendor_name }}">
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->project }}</td>
                                            <td>{{ $payment->pmt_name }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->pmt_date }}</td>
                                            <td>{{ $payment->vendor_name }}</td>
                                            <td>
                                                <input type="checkbox" style="min-width:0px !important;" id="{{ $payment->id }},{{ $payment->rmu_id }},'{{ $payment->pmt_name }}'">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <input type="button" onclick="togglePayment()" class="btn btn-success" value="Pay"/>
                        </div>
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
    $(document).ready(function() {
        $('#payment-type-filter, #vendor-filter').on('change', function() {
            filterTable();
        });

        function filterTable() {
            var paymentType = $('#payment-type-filter').val();
            var vendor = $('#vendor-filter').val();

            $('#payment-table tbody tr').each(function() {
                var row = $(this);
                var rowPaymentType = row.data('payment-type');
                var rowVendor = row.data('vendor');

                if ((!paymentType || rowPaymentType === paymentType) && (!vendor || rowVendor === vendor)) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }
    });

    function togglePayment() {
        var checkedIds = $('input[type="checkbox"]:checked').map(function() {
            return this.id;
        }).get();

        addData(checkedIds, 0);
    }

    function addData(checkedIds, index) {
        var len = checkedIds.length;
        if (len == 0) {
            alert('Please select record first!');
            return;
        }
        var values = '';
        if (index < len) {
            values = checkedIds[index].split(',');
        } else {
            alert('Payment update successfully!');
            return;
        }

        $.ajax({
            url: '/updatepayment/' + values[0] + '/' + values[1] + '/' + values[2],
            type: 'GET',
            success: function(response) {
                const row = document.getElementById(values[0]);
                if (row) {
                    row.remove();
                }
                addData(checkedIds, index + 1);
            },
            error: function(xhr) {
                // Handle error
            }
        });
    }
</script>
@endsection