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
        .error{color: red}
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
                    <h3>Budget TNB</h3>
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
            
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

@include('components.messages')



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                 Budget TNB
                                {{-- <a href="{{ route('rmu-budget-tnb.create') }}" class="btn  btn-sm"
                                    style="background-color: #367FA9; border-radius:0px; color:white">Add new</a> --}}
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-end mb-4">

                            </div>

                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>

                                            <th>PE NAME</th>
                                            <!-- <th>VENDOR NAME</th> -->

                                            <!-- <th>RTU STATUS</th> -->
                                            <!-- <th>COAST KKB PK</th>
                                            <th>CFS</th>
                                            <th>SCADA</th> -->
                                            <th>TOTAL BUDGET</th>
                                            <th>TOTAL SPENDING</th>
                                            <th>PROFIT</th>
                                            <th>PROFIT(%)</th>


                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {{-- @foreach ($datas as $data) --}}
                                            <tr>
                                                <td class="align-middle"> <button class="btn" onclick="showSpendDetails({{$data->id}})">{{ $data->pe_name}} </button> </td>

                                                <td class="align-middle">{{ number_format($data->total,2) }}</td>
                                                <td class="align-middle">{{ $data->spending_total }}</td>
                                                <td class="align-middle">{{ $data->profit_total }}</td>
                                                <td class="align-middle">{{ $data->profit_percent }}</td>


                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg')  }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('rmu-budget-tnb.edit', $data->id) }}">Edit
                                                            Foam</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('rmu-budget-tnb.show', $data->id) }}">Detail</a>

                                                        <!-- <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-toggle="modal" data-url="rmu-budget-tnb"
                                                            data-target="#myModal">
                                                            Remove
                                                        </button> -->
                                                    </div>

                                                </td>
                                            </tr>
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>


            </div>

            <div id="tnb-spends" class="mt-4">

            </div>
        </div>
    </section>


     {{-- remove modal --}}
     <x-confirm-remove />

     {{-- spending modal --}}
    <x-add-spending-modal :url="route('rmu-payment-details.store')" />



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
    <script src="{{ asset('assets/js/add-spending-amount.js') }}"></script>

    <script>
 // <option value="amt_rtu_cable">RTU CABLE</option>
                                    // <option value="amt_tools">TOOLS</option>
                                    // <option value="amt_store_rental">STORE RENTAL</option>
                                    // <option value="amt_transport">TRANSPORT</option>`;
                                    // <option value="amt_cable">CABLE</option>

         const amtName = `  <option value="" hidden>select</option>
                                    <option value="amt_bo">BO</option>
                                    <option value="amt_piw">PIW</option>
                                    <option value="amt_outage">OUTAGE</option>
                                    <option value="amt_rtu">RTU</option>
                                    <option value="amt_kkb">KKB</option>
                                    <option value="amt_pk">Jointer</option>
                                    <option value="amt_ir">Tester</option>
                                    <option value="amt_transport">Transport</option>`;
                                    
                                   
        $(document).ready(function() {

            showSpendDetails({{$data->id}});
            $('#pmt_name').append(amtName);

        })

        function showSpendDetails(id){
            $.ajax({
                url: `/rmu-aero-spend/index/${id}`,
                method: 'GET',
                dataType: 'html',
                success: function(data) {

                    $('#tnb-spends').html(data);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                    $('#responseData').html('Error occurred');
                }
            });
        }

        function displayBo(val){
            if(val=='amt_bo'){
             $("#type_bo").show()
            }else{
                $("#type_bo").hide()
            }
      }
    </script>
@endsection
