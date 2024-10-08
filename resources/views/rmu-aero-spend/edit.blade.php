@extends('layouts.app')
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
        var $jq = $.noConflict(true);
    </script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        input,
        textarea,
        select {
            font-size: 15px !important;
            padding: 0px 6px !important;

        }
    </style>
@endsection

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">site data</a></li>

                    <li class="breadcrumb-item"><a
                            href="{{ route('rmu-budget-tnb.index', $data->RmuBudget->id) }}">budget index</a></li>
                    <li class="breadcrumb-item active">payment detail</li>
                </ol>
            </div>
        </div>

    </section>
    @include('components.script-messages')

    <section class="content">
        <div class="container-fluid" style="padding:0 0 0 0;!important">
            <div class="container- p-5 m-4 bg-white  shadow my-4 " style="border-radius: 10px;margin:0 0 0 0 !important;">
                <x-payment-detail-header-table
                :name="$data->RmuBudget->pe_name"
                :budget="$data->RmuBudget->total"
                :spending="$data->total"
                :outstanding="$data->outstanding_balance"
                :profit="$data->profit"
            />
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered ">
                        <thead style="background-color: #E4E3E3 !important">
                            <th>NAME</th>
                            <th class="text-center">DETAIL</th>
                        </thead>
                        <tbody>

                            @foreach ($spendDetails as $paymentType => $details)
                            @include('components.detail-table', [
                                'arr' => $details,
                                'arr_name' => "amt_{$paymentType}",
                                'name' => strtoupper(str_replace('_' , ' ',$paymentType)),
                                'url' => 'rmu',
                                'action' => $action,
                            ])
                        @endforeach

                        </tbody>
                        <tfoot style="background-color: #E4E3E3 !important">
                        {{-- <!-- 
                           <td colspan="2" class="text-end"><strong>Total : <span
                                        class="subTotal">{{ $data->total }}</span></strong></td> -->--}}
                        </tfoot>
                    </table>
                </div>



            </div>
        </div>
    </section>
    <x-confirm-remove />
@endsection

@section('script')
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        var budget = 0;
        var fixProfit = 0;
        $(document).ready(function() {


            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            // $("#myForm").validate();
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                var url = button.data('url');
                $('#remove-foam').attr('action', '/rmu-payment-details/' + id)
            });

            $jq('.submit-form').ajaxForm({
                success: function(responseText, status, xhr, $form) {
                    if (status) {
                        toastr.success('Spending update successfully!')
                        var data = responseText.data;
                        console.log(responseText);
                        formSubmitted(data.name, data.sub_total, data.total, data.pending_payment , data.outstanding)
                    } else {
                        toastr.error('Request failed. Please try again.')
                    }

                },
                error: function(xhr, status, error, $form) {
                    toastr.error('Request failed. Please try again.')
                }
            })

            budget = {{ $data->RmuBudget->total != '' ? $data->RmuBudget->total : 0 }};
            fixProfit = {{ $data->RmuBudget->fix_profit != '' ? $data->RmuBudget->fix_profit : 0 }};


        })

        function editDetails(id) {
            $(`#${id}-amount`).removeAttr('disabled');
            $(`#${id}-amount`).removeClass('border-0');
            $(`#${id}-status`).removeAttr('disabled');
            $(`#${id}-status`).removeClass('border-0');
            $(`#${id}-description`).removeAttr('disabled');
            $(`#${id}-description`).removeClass('border-0');
            $(`#${id}-pmt_date`).removeClass('border-0').removeAttr('disabled');
            $(`#${id}-vendor_name`).removeClass('border-0').removeAttr('disabled');




            $(`#${id}-submit-button`).removeClass('d-none');
            $(`#${id}-edit-button`).addClass('d-none');


        }

        function formSubmitted(param, subTotal, total, pending , outstanding) {
            $(`#${param}-amount`).attr('disabled', true);
            $(`#${param}-amount`).addClass('border-0');
            $(`#${param}-status`).attr('disabled', true);
            $(`#${param}-status`).addClass('border-0');
            $(`#${param}-description`).attr('disabled', true);
            $(`#${param}-description`).addClass('border-0');
            $(`#${param}-pmt_date`).addClass('border-0').attr('disabled', true);
            $(`#${param}-vendor_name`).addClass('border-0').attr('disabled', true);


            $(`#${param}-submit-button`).addClass('d-none');
            $(`#${param}-edit-button`).removeClass('d-none');

            $(`.subTotal`).html(subTotal)
            $(`#${param}-total`).html(total)

            $(`.pending`).html(pending)
            $('.outstanding').html(outstanding)
            var profit =budget-total;//(((budget - total) / fixProfit) * 100).toFixed(2);

            $(`.total_profit`).html(profit)

        }
    </script>
@endsection
