@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
        var $jq = $.noConflict(true);
    </script>
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .error {
            color: red
        }

        #site-data td{
            text-align: center!important;
            vertical-align: middle!important;
            font-size: 14px !important;
        }
        #site-data th{

            font-size: 15px !important;
        }
        #site-data th::after , #site-data th::before{
            right: 0 !important;
            content: "" !important;
        }
        tr {}

        #payment-table td {
            border: 0px !important
        }

        input,
        textarea,
        select {
            font-size: 15px !important;
            padding: 0px 6px !important;

        }
        .work_done_and_payed{
         background-color:green;
         color:white;
     }

     .work_done_but_not_payed{
         background-color:red;
         color:white;
     }
     .work_not_done_but_payed{
         background-color:black;
         color:white;
     }
     .not_work_done_and_not_payed{
         background-color:white;
     }
     .work_done_partial_payment{
         background-color:yellow;

     }
     .partial_work_done_partial_payment{
         background-color:#DAA520;
         color:white;
     }

    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Project Summary</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">site data</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">


            @include('components.messages')



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" d-flex justify-content-between">
                                <h5> Project Summary </h5>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <div class="text-end mb-4">

                            </div>

                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered  ">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>TOTAL BUDGET</th>
                                            <th>TOTAL COST PE</th>
                                            <th>TOTAL COST OTHER</th>
                                            <th>TOTAL COST</th>
                                            <th>TOTAL PROFIT( IF ANY)</th>
                                            <th>TOTAL LOSS( IF ANY)</th>
                                            <th>PROFIT/LOSS</th>



                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>

                                            <td class="align-middle">{{ $summary['amt_received'] }}</td>
                                            <td class="align-middle">{{ $summary['amt_spend'] }}</td>
                                            <td class="align-middle">{{ $summary['other_spend'] }}</td>
                                            <td class="align-middle">{{ $summary['other_spend'] + $summary['amt_spend'] }}
                                            </td>
                                            @if ($summary['other_spend'] + $summary['amt_spend'] < $summary['amt_received'])
                                                <td class="align-middle text-success text-center">
                                                    {{ $summary['amt_received'] - ($summary['other_spend'] + $summary['amt_spend']) }}
                                                </td>
                                            @else
                                                <td class="align-middle text-center">0</td>
                                            @endif

                                            @if ($summary['other_spend'] + $summary['amt_spend'] > $summary['amt_received'])
                                                <td class="align-middle text-danger text-center">

                                                    {{ $summary['other_spend'] + $summary['amt_spend'] - $summary['amt_received'] }}
                                                </td>
                                            @else
                                                <td class="align-middle text-center">
                                                    0
                                                </td>
                                            @endif

                                                @php
                                                    try {

                                                        $spend = $summary['amt_spend']  + $summary['other_spend'];
                                                       $total = (($summary['amt_received']- $spend )/$summary['amt_received'])*100;                     
                                                    } catch (\Throwable $th) {
                                                        //throw $th;
                                                    }
                                                @endphp
                                            <td  class="text-center {{$total && $total < 0 ? 'text-dange' : 'text-success'}}">
        {{number_format($total , 2 )}} %                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" d-flex justify-content-between">
                                <h5> Project Payment </h5>
                                <button type="button" class="btn  btn-sm" data-toggle="modal" data-target="#addPayments"
                                    style="background-color: #367FA9; border-radius:0px; color:white">Add new</button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('payment-summary-search') }}" id="payment-filter" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-2">
                                        <label for="search_type">Type : </label><br>
                                        <select name="search_type" id="search_type">
                                            <option value="">all</option>
                                            <option value="claim">Claim</option>
                                            <option value="salary">Salary</option>
                                            <option value="tools">Tools</option>
                                            <option value="cable">Cable</option>
                                            <option value="rtu_cable">RTU Cable</option>
                                            <option value="store_rental">Store Rental</option>
                                            <option value="ARAZ">ARAZ</option>
                                            <option value="TRANDUCER">TRANDUCER</option>
                                            <option value="consultation_fee">consultation_fee</option>
                                         <option value="others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="from_search">From : </label><br>
                                        <input type="date" name="from_search" id="from_search">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="to_search">To : </label><br>
                                        <input type="date" name="to_search" id="to_search">
                                    </div>
                                    <div class="col-md-1"><br>
                                        <button class="btn btn-sm btn-secondary" type="submit">FILTER</button>
                                    </div>

                                </div>
                            </form>
                            <div class="text-end mb-4">

                            </div>

                            <div class="table-responsive" id="payment-table">

                                    @include('PaymentSummary.payment-table')
                            </div>

                        </div>
                    </div>



                </div>


            </div>

            <div id="tnb-spends" class="mt-4">

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h5> SITE DATA SUMMARY </h5>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <div class="text-end mb-4">

                        </div>

                        <div class="table-responsive">
                            <table id="site-data" class="table table-bordered  ">


                                <thead style="background-color: #E4E3E3 !important">
                                    <tr>
                                        <th>PE NAME</th>
                                        <th>VENDOR NAME</th>
                                        <th>SWITCHGEAR</th>
                                        <!-- <th>KKB</th>
                                        <th>CFS</th>
                                        <th>BO</th>
                                        <th>PIW</th>
                                        <th>CABLE</th>
                                        <th>RTU</th>
                                        <th>RTU CABLE</th>
                                        <th>TOOLS</th>
                                        <th>TRANSDUCER</th>
                                        <th>STORE RENTAL</th>
                                        <th>TRANSPORT</th>
                                        <th>SALARY</th>
                                        <th>BUDGET</th>
                                        <th>FIX PROFIT</th>
                                        <th>TOTAL SPEND</th>
                                        <th>TOTAL PENDING</th>
                                        <th>TOTAL OUTSTANDING</th>
                                        <th>TOTAL PROFIT  </th>
                                        <th>TOTAL LOSS </th> -->
                                        <th>BO</th>
                                        <th>PIW</th>
                                        <th>OUTAGE</th>
                                        <th>RTU</th>
                                        <th>KKB</th>
                                        <th>JOINTER</th>
                                        <th>TESTER</th>
                                        <th>TRANSPORT</th>
                                        <th>TOTAL OUTSTANDING</th>
                                        <th>TOTAL SPENDINGS</th>



                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($site_data['pe_rmu'] as $rmu)
                                    <tr>
                                        <td class="align-middle">{{ $rmu->pe_name }}</td>
                                        <td>{{$rmu->vendor_name}}</td>

                                        <td class="align-middle">{{$rmu->switch}}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_bo_status )}}">{{ $rmu->RmuSpends->amt_bo }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_piw_status )}}">{{ $rmu->RmuSpends->amt_piw }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_kkb_status )}}">{{ $rmu->RmuSpends->amt_outage }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_rtu_status )}}">{{ $rmu->RmuSpends->amt_rtu }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_kkb_status )}}">{{ $rmu->RmuSpends->amt_kkb }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_kkb_status )}}">{{ $rmu->RmuSpends->amt_pk }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_kkb_status )}}">{{ $rmu->RmuSpends->amt_ir }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_transport_status )}}">{{ $rmu->RmuSpends->amt_transport }}</td>
                                        <td>{{$rmu->RmuSpends->outstanding_balance}}</td>
                                        <td class="align-middle">{{ $rmu->RmuSpends->total }}</td>

                                        {{-- <!-- <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_cfs_status )}}">{{ $rmu->RmuSpends->amt_cfs }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_cable_status )}}">{{ $rmu->RmuSpends->amt_cable }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_rtu_cable_status )}}">{{ $rmu->RmuSpends->amt_rtu_cable }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_tools_status )}}">{{ $rmu->RmuSpends->amt_tools }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_transducer_status )}}">{{ $rmu->RmuSpends->amt_transducer }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_store_rental_status )}}">{{ $rmu->RmuSpends->amt_store_rental }}</td>
                                        <td class="{{str_replace(' ', '_' , $rmu->RmuSpends->amt_salary_status )}}">{{ $rmu->RmuSpends->amt_salary }}</td>
                                        <td class="align-middle">{{ $rmu->total }}</td>
                                        <td>{{$rmu->fix_profit}}</td>
                                        <td class="align-middle">{{ $rmu->RmuSpends->total }}</td>
                                        <td>{{ $rmu->RmuSpends->pending_payment }}</td> -->
                                       <!-- @php
                                            try {
                                                $rmu->fix_profit = $rmu->fix_profit == '' ? 1 : $rmu->fix_profit;
                                             $profit  =  (($rmu->total - $rmu->RmuSpends->total) / $rmu->fix_profit) * 100;
                                            } catch (\Throwable $th) {
                                                //throw $th;
                                            }
                                              @endphp
                                        <td class="align-middle text-center text-success"> {{ $profit > 0 ? number_format($profit,2) .' % ' : '' }} </td>
                                        <td class="align-middle text-center text-danger"> {{ $profit < 0 ? number_format($profit,2) .' % ' : '' }} </td>
                                     -->--}}
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>


        </div>




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h5> PROJECT SUMMARY </h5>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <div class="text-end mb-4">

                        </div>

                        <div class="table-responsive">
                            <table id="site-data" class="table table-bordered  ">


                                <thead style="background-color: #E4E3E3 !important">
                                    <tr>
                                            <th>Claim</th>
                                            <th>Salary</th>
                                            <th>Tools</th>
                                            <th>Cable</th>
                                            <th>RTU </th>
                                            <th>Store Rental</th>
                                            <th>ARAZ</th>
                                            <th>TRANDUCER</th>
                                            <th>consultation_fee</th>
                                            <th>Others</th>

                                    </tr>
                                </thead>
                                <tbody>

                                <tr>
                @php
                $paymentTypes = ['claim', 'salary', 'tools', 'cable', 'rtu_cable', 'store_rental', 'ARAZ', 'TRANDUCER', 'consultation_fee', 'others'];
                $totals = collect($others)->pluck('total_amount', 'pmt_type')->toArray();
                @endphp

                @foreach ($paymentTypes as $type)
                    <td class="align-middle">
                        {{ $totals[$type] ?? '0' }}
                    </td>
                @endforeach
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>


        </div>


    </section>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Remove Recored</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" id="remove-foam" class="payment-remove-form" method="POST">
                    @method('DELETE')
                    @csrf

                    <div class="modal-body">
                        Are You Sure ?
                        <input type="hidden" name="id" id="modal-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="addPayments">
        <div class="modal-dialog">
            <div class="modal-content " style="border-radius: 0px !important">


                <div class="modal-header" style="background-color: #343A40 ; border-radius:0px ; ">
                    <h6 class="modal-title text-white">Add Payments</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('payment-summary-details.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">



                        <div class="row">
                            <div class="col-md-4"><label for="total">Receiver Name</label></div>
                            <div class="col-md-8">
                                <input type="text" name="pmt_receiver_name" id="pmt_receiver_name" required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="total">Payment Type</label></div>
                            <div class="col-md-8">
                                <select name="pmt_type" id="pmt_name" class="form-control" required>
                                    <option value="" hidden>select</option>
                                    <option value="claim">Claim</option>
                                            <option value="salary">Salary</option>
                                            <option value="tools">Tools</option>
                                            <option value="cable">Cable</option>
                                            <option value="rtu_cable">RTU Cable</option>
                                            <option value="store_rental">Store Rental</option>
                                            <option value="ARAZ">ARAZ</option>
                                            <option value="TRANDUCER">TRANDUCER</option>
                                            <option value="consultation_fee">consultation_fee</option>
                                         <option value="others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="amount">Amount</label></div>
                            <div class="col-md-8">
                                <input type="number" name="pmt_amount" id="amount" class="form-control"
                                    min="0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="status">Date Time</label></div>
                            <div class="col-md-8">
                                <input type="datetime-local" name="date_time" id="date_time" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="description">Description</label></div>
                            <div class="col-md-8">
                                <textarea name="description" id="description" cols="30" rows="8" class="form-control"></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#site-data').DataTable();


            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            $("form").validate();

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $('#remove-foam').attr('action', '/payment-summary-details/' + id)
            });

            $('#spendingModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var peName = button.data('name')
                var modal = $(this);
                $('#spending-modal-id').val(id);
                $('#spending-modal-pe-name').val(peName);
            });



            $('#addPayments').on('hide.bs.modal', function(event) {

                $('#pmt_receiver_name').val('');
                $('#amount').val('');
                $('#description').val('');
                $('#date_time').val('');

            });



            $jq('.payment-summary-form').ajaxForm({
                success: function(responseText, status, xhr, $form) {
                    toastr.success('Spending update successfully!')
                    // $('#spendingModal').modal('hide');
                    formSubmitted(responseText.id);
                },
                error: function(xhr, status, error, $form) {
                    toastr.error('Request failed. Please try again.')

                }

            });


            $jq('#payment-filter').ajaxForm({
                success: function(responseText, status, xhr, $form) {

                    $('#payment-table').html(responseText);
                    $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })
                },
                error: function(xhr, status, error, $form) {
                    toastr.error('Request failed. Please try again.')

                }
            });





            $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })

        })

        function filterTable(type) {

            var table = $('#example2').DataTable();


            table.columns(1).search(type); // Filter Column 1



            table.draw();

        }



        function editDetails(param) {

            $(`#pmt_receiver_name_${param}`).removeAttr('disabled').removeClass('border-0');
            $(`#pmt_name_${param}`).removeAttr('disabled').removeClass('border-0');
            $(`#pmt_amount_${param}`).removeAttr('disabled').removeClass('border-0');
            $(`#description_${param}`).removeAttr('disabled').removeClass('border-0');
            $(`#date_time_${param}`).removeAttr('disabled').removeClass('border-0');

            $(`#${param}-submit-button`).removeClass('d-none');
            $(`#${param}-edit-button`).addClass('d-none');


        }

        function formSubmitted(param) {

            $(`#pmt_receiver_name_${param}`).addClass('border-0').attr('disabled', true);
            $(`#pmt_name_${param}`).addClass('border-0').attr('disabled', true);
            $(`#pmt_amount_${param}`).addClass('border-0').attr('disabled', true);
            $(`#description_${param}`).addClass('border-0').attr('disabled', true);
            $(`#date_time_${param}`).addClass('border-0').attr('disabled', true);



            $(`#${param}-submit-button`).addClass('d-none');
            $(`#${param}-edit-button`).removeClass('d-none');

            var pmtTyype = $(`#pmt_name_${param}`).val();
            $(`#search-type-${param}`).html(pmtTyype);

        }
    </script>
@endsection
