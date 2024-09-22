@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>Estimation Work</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('estimation-work.index') }}">index</a></li>
                    <li class="breadcrumb-item active">deatil</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

        <h3 class="text-center mb-4"> Estimation Work</h3>
        <form action="{{ route('estimation-work.update', $data->id) }}" onsubmit="return submitFoam()" method="post">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <label for="site_data_id">NAMA PE :</label>
                </div>
                <div class="col-md-4">
                    <input disabled id="site_data_id" value="{{ $data->siteData->nama_pe }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="rtu_cable_type">RTU Cable Type</label>
                </div>
                <div class="col-md-4">

                    <input disabled value="{{ $data->rtu_cable_type }}" class="form-control">
                </div>
            </div>
            @if ($data->rtu_cable_type === 'Single Core')
                <div class="row" id="rtu_color">
                    <div class="col-md-3">
                        <label for="rtu_cable_color">RTU Cable Color</label>
                    </div>
                    <div class="col-md-4">
                        <input disabled value="{{ $data->rtu_cable_color }}" class="form-control">

                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <label for="rtu_size_cable">RTU Size Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled class="form-control" value="{{ $data->rtu_size_cable }}">
                </div>
            </div>



            <div class="row">
                <div class="col-md-3">
                    <label for="rtu_cable_length">RTU Cable Length</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->rtu_cable_length }}" class="form-control">

                </div>
            </div>



            <div class="row">
                <div class="col-md-3">
                    <label for="rcb_cable_type">RCB Cable Type</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->rcb_cable_type }}" class="form-control">

                </div>
            </div>
            @if ($data->rcb_cable_type === 'Single Core')
                <div class="row" id="rcb_color">
                    <div class="col-md-3">
                        <label for="rcb_cable_color">RCB Cable Color</label>
                    </div>
                    <div class="col-md-4">
                        <input disabled value="{{ $data->rcb_cable_color }}" class="form-control">

                    </div>
                </div>
            @endif


            <div class="row">
                <div class="col-md-3">
                    <label for="rcb_size_cable">RCB Size Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->rcb_size_cable }}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="rcb_cable_length">RCB Cable Length</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->rcb_cable_length }}" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-3">
                    <label for="bc_cable_type">BC Cable Type</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->bc_cable_type }}" class="form-control">

                </div>
            </div>
            @if ($data->bc_cable_type === 'Single Core')
                <div class="row" id="bc_color">
                    <div class="col-md-3">
                        <label for="bc_cable_color">BC Cable Color</label>
                    </div>
                    <div class="col-md-4">
                        <input disabled value="{{ $data->bc_cable_color }}" class="form-control">

                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <label for="bc_size_cable">BC Size Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->bc_size_cable }}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="bc_cable_length">BC Cable Length</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->bc_cable_length }}" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-3">
                    <label for="efi_cable_type">EFI Cable Type</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->efi_cable_type }}" class="form-control">

                </div>
            </div>

            @if ($data->efi_cable_type === 'Single Core')
                <div class="row" id="efi_color">
                    <div class="col-md-3">
                        <label for="efi_cable_color">EFI Cable Color</label>
                    </div>
                    <div class="col-md-4">
                        <input disabled value="{{ $data->efi_cable_color }}" class="form-control">

                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <label for="efi_size_cable">EFI Size Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->efi_size_cable }}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="efi_cable_length">EFI Cable Length</label>

                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->efi_cable_length }}" class="form-control">

                </div>
            </div>



            <div class="row">
                <div class="col-md-3">
                    <label for="tranches_work">Tranches Work</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->tranches_work }}" class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="switchgear_changes">Switchgear Changes</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->switchgear_changes }}" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="cable_changes">Cable Changes</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->cable_changes }}" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="genset_need">Genset Need</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->genset_need }}" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="cable_tracer_work">Cable Tracer Work</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->cable_tracer_work }}" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="special_tools_work">Special Tools/Work</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{ $data->special_tools_work }}" id="special_tools_work"
                        class="form-control">

                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('site-data-collection.show', $data->site_data_id) }}" class="btn btn-success mt-4"
                    style="cursor: pointer !important" type="submit">Goto Site Data</a>
            </div>

    </div>
        </div></section>
@endsection
