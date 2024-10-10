@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3> Budget TNB</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">site data</a></li>
                    @if (isset($item))
                    <li class="breadcrumb-item"><a href="{{ route('rmu-budget-tnb.index', $item->id) }}"> budgte index</a></li>

                    @endif
                    <li class="breadcrumb-item active">create</li>
                </ol>
            </div>
        </div>

        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


                <form action="{{ isset($item)? route('rmu-budget-tnb.update',$item->id) :route('rmu-budget-tnb.store') }}" id="myForm" method="post">
                    @csrf


                    <div class="row">
                        <div class="col-md-4">
                            <label for="pe_name">Pe Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pe_name" id="pe_name" class="form-control"
                                value="{{ old('pe_name', isset($item) ? $item->pe_name :  $name ) }}"

                                required readonly>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4">
                            <label for="rtu_status">RTU Status</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="rtu_status" id="rtu_status" class="form-control" required
                                value="{{ old('rtu_status', isset($item) ? $item->rtu_status :  '' ) }}"
                                {{ isset($disabled) ? 'readonly' : '' }} >
                        </div>
                    </div> -->

                    <input type="hidden" name="id" value="{{isset($item)? $item->id : ''}}">

                    <!-- <div class="row">
                        <div class="col-md-4">
                            <label for="amt_kkb_pk">AMT KKB PK</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="amt_kkb_pk" id="amt_kkb_pk" class="form-control" required value="{{ old('amt_kkb_pk', isset($item) ? $item->amt_kkb_pk : '') }}" {{ isset($disabled) ? 'readonly' : '' }} >
                        </div>
                    </div> -->



                    <div class="row" style="display:none;">
                        <div class="col-md-4">
                            <label for="switch">switch</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="switch" id="switch" class="form-control"  
                            value="{{ old('switch', isset($item) ? $item->switch :  $switch ) }}"

                            >
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <label for="scada">Total Budget by TNB</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="scada" id="scada" class="form-control" required value="{{ old('scada', isset($item) ? $item->scada : '') }}" {{ isset($disabled) ? 'readonly' : '' }} >
                        </div>
                    </div>

                    <div class="row" style="display:none;">
                        <div class="col-md-4">
                            <label for="total">Total Budget by TNB</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="total" id="total" class="form-control" readonly value="{{ old('total', isset($item) ? $item->total : '') }}" {{ isset($disabled) ? 'readonly' : '' }} >
                        </div>
                    </div>


                   
                    <div class="row">
                        <div class="col-md-4">
                            <label for="date_time">Date Time</label>
                        </div>
                        <div class="col-md-4">
                            <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ old('date_time', isset($item) ? $item->date_time : $date) }}" {{ isset($disabled) ? 'readonly' : '' }} readonly>
                        </div>
                    </div>



                    @if (!isset($disabled))
                    <div class="text-center">
                        <button class="btn btn-success mt-4" style="cursor: pointer !important"
                            type="submit">Submit</button>
                    </div>
                    @endif



                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        var total = 0;
        var pre = 0;
        $(document).ready(function() {

            $("#myForm").validate();
            $("input[type='number']").on('click', function() {
                if (this.value != "") {
                    pre = parseFloat(this.value);
                } else {
                    pre = 0;

                }

            })
            total = $('#total').val() == "" ? 0 : parseFloat($('#total').val());


            $("input[type='number']").on('change', function() {
                if (this.id != 'fix_profit') {
                    var kkb = parseFloat($('#amt_kkb_pk').val()) || 0;
                    var csf = parseFloat($('#cfs').val()) || 0;
                    var scada = parseFloat($('#scada').val()) || 0;

                    var total = kkb + csf + scada;
                    console.log(total);

                    $('#total').val(total.toFixed(2));
                }
            });



        })
    </script>
@endsection
