@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>VCB Budget TNB</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index' ) }}">site data</a></li>
                       @isset($item)
                       <li class="breadcrumb-item"><a href="{{ route('vcb-budget-tnb.index',$item->id) }}">vcb budget index</a></li>

                    @endisset


                    <li class="breadcrumb-item active">create</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


        <form action="{{ route('vcb-budget-tnb.store') }}" id="myForm" method="post">
            @csrf


            <div class="row">
                <div class="col-md-4">
                    <label for="pe_name">Pe Name</label>
                </div>
                <div class="col-md-4">
                   <input type="text" name="pe_name" id="pe_name"   class="form-control" required readonly value="{{ old('pe_name', isset($item) ? $item->pe_name : $name ) }}" >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="rtu_status">RTU Status</label>
                </div>
                <div class="col-md-4">
                   <input type="text" name="rtu_status" id="rtu_status" class="form-control" required  value="{{ old('rtu_status', isset($item) ? $item->rtu_status :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}>
                </div>
            </div>

            <input type="hidden" name="id" id="id" @isset($item)    value="{{$item->id}}"

            @endisset>



            <div class="row">
                <div class="col-md-4">
                    <label for="cfs">CFS</label>
                </div>
                <div class="col-md-4">
                   <input type="number" name="cfs" id="cfs" class="form-control" required value="{{ old('cfs', isset($item) ? $item->cfs :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="scada">Scada</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="scada" id="scada" class="form-control" required value="{{ old('scada', isset($item) ? $item->scada :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total Budget by TNB</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="total" id="total" class="form-control" readonly value="{{ old('total', isset($item) ? $item->total :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="pe name">Fix Profit Aerosynergy</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="fix_profit" id="fix_profit" value="{{ old('fix_profit', isset($item) ? $item->fix_profit :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}
                        class="form-control" required>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="date_time">Date Time</label>
                </div>
                <div class="col-md-4">
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ old('date_time', isset($item) ? $item->date_time :'' ) }}" {{ isset($disabled) ? 'readonly' : '' }}>
                </div>
            </div>


            @if (!isset($disabled))
            <div class="text-center">
                <button class="btn btn-success mt-4" style="cursor: pointer !important" type="submit">Submit</button>
            </div>
            @endif


        </form>
    </div>
        </div></section>
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

                    var csf = parseFloat($('#cfs').val()) || 0;
                    var scada = parseFloat($('#scada').val()) || 0;

                    var total =  csf + scada;
                    console.log(total);

                    $('#total').val(total.toFixed(2));
                }
            });


        })



    </script>
@endsection
