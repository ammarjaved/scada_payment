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
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

                <h3 class="text-center mb-4"> Estimation Work</h3>
                <form action="{{ route('estimation-work.update', $data->id) }}" onsubmit="return submitFoam()"
                    method="post">
                    @method('PATCH')
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
                            <select name="rtu_cable_type" id="rtu_cable_type" class="form-control cable_type">
                                <option value="{{ $data->rtu_cable_type }}" hidden>{{ $data->rtu_cable_type }}</option>
                                <option value="Multicore">Multicore</option>
                                <option value="Single Core">Single Core</option>
                            </select>
                        </div>
                    </div>
                    @if ($data->rtu_cable_type === 'Single Core')
                        <div class="row" id="rtu_color">
                            <div class="col-md-3">
                                <label for="rtu_cable_color">RTU Cable Color</label>
                            </div>
                            <div class="col-md-4">
                                <select name="rtu_cable_color" id="rtu_cable_color" class="form-control"
                                    onchange="addFeild(this)">
                                    <option value="{{ $data->rtu_cable_color }}">{{ $data->rtu_cable_color }}</option>
                                    <option value="RED">RED</option>
                                    <option value="YELLOW">YELLOW</option>
                                    <option value="BLUE">BLUE</option>
                                    <option value="GRAY">GRAY</option>
                                    <option value="BLACK">BLACK</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <label for="rtu_size_cable">RTU Size Cable</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="rtu_size_cable" id="rtu_size_cable" class="form-control"
                                value="{{ $data->rtu_size_cable }}">
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <label for="rtu_cable_length">RTU Cable Length</label>
                        </div>
                        <div class="col-md-4">
                            <select name="rtu_cable_length" id="rtu_cable_length" class="form-control">
                                <option value="{{ $data->rtu_cable_length }}" hidden>{{ $data->rtu_cable_length }}</option>
                                <option value="5">5m</option>
                                <option value="10">10m</option>
                                <option value="15">15m</option>
                                <option value="20">20m</option>
                                <option value="25">25m</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <label for="rcb_cable_type">RCB Cable Type</label>
                        </div>
                        <div class="col-md-4">
                            <select name="rcb_cable_type" id="rcb_cable_type" class="form-control cable_type">
                                <option value="{{ $data->rcb_cable_type }}" hidden>{{ $data->rcb_cable_type }}</option>
                                <option value="Multicore">Multicore</option>
                                <option value="Single Core">Single Core</option>
                            </select>
                        </div>
                    </div>
                    @if ($data->rcb_cable_type === 'Single Core')
                        <div class="row" id="rcb_color">
                            <div class="col-md-3">
                                <label for="rcb_cable_color">RCB Cable Color</label>
                            </div>
                            <div class="col-md-4">
                                <select name="rcb_cable_color" id="rcb_cable_color" class="form-control"
                                    onchange="addFeild(this)">
                                    <option value="{{ $data->rcb_cable_color }}">{{ $data->rcb_cable_color }}</option>
                                    <option value="RED">RED</option>
                                    <option value="YELLOW">YELLOW</option>
                                    <option value="BLUE">BLUE</option>
                                    <option value="GRAY">GRAY</option>
                                    <option value="BLACK">BLACK</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-md-3">
                            <label for="rcb_size_cable">RCB Size Cable</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="rcb_size_cable" id="rcb_size_cable"
                                value="{{ $data->rcb_size_cable }}" class="form-control">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="rcb_cable_length">RCB Cable Length</label>
                        </div>
                        <div class="col-md-4">
                            <select name="rcb_cable_length" id="rcb_cable_length" class="form-control">
                                <option value="{{ $data->rcb_cable_length }}" hidden>{{ $data->rcb_cable_length }}
                                </option>
                                <option value="5">5m</option>
                                <option value="10">10m</option>
                                <option value="15">15m</option>
                                <option value="20">20m</option>
                                <option value="25">25m</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-3">
                            <label for="bc_cable_type">BC Cable Type</label>
                        </div>
                        <div class="col-md-4">
                            <select name="bc_cable_type" id="bc_cable_type" class="form-control cable_type">
                                <option value="{{ $data->bc_cable_type }}" hidden>{{ $data->bc_cable_type }}</option>
                                <option value="Multicore">Multicore</option>
                                <option value="Single Core">Single Core</option>
                            </select>
                        </div>
                    </div>
                    @if ($data->bc_cable_type === 'Single Core')
                        <div class="row" id="bc_color">
                            <div class="col-md-3">
                                <label for="bc_cable_color">BC Cable Color</label>
                            </div>
                            <div class="col-md-4">
                                <select name="bc_cable_color" id="bc_cable_color" class="form-control"
                                    onchange="addFeild(this)">
                                    <option value="{{ $data->bc_cable_color }}">{{ $data->bc_cable_color }}</option>
                                    <option value="RED">RED</option>
                                    <option value="YELLOW">YELLOW</option>
                                    <option value="BLUE">BLUE</option>
                                    <option value="GRAY">GRAY</option>
                                    <option value="BLACK">BLACK</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <label for="bc_size_cable">BC Size Cable</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="bc_size_cable" id="bc_size_cable"
                                value="{{ $data->bc_size_cable }}" class="form-control">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="bc_cable_length">BC Cable Length</label>
                        </div>
                        <div class="col-md-4">
                            <select name="bc_cable_length" id="bc_cable_length" class="form-control">
                                <option value="{{ $data->bc_cable_length }}" hidden>{{ $data->bc_cable_length }}</option>
                                <option value="5">5m</option>
                                <option value="10">10m</option>
                                <option value="15">15m</option>
                                <option value="20">20m</option>
                                <option value="25">25m</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-3">
                            <label for="efi_cable_type">EFI Cable Type</label>
                        </div>
                        <div class="col-md-4">
                            <select name="efi_cable_type" id="efi_cable_type" class="form-control cable_type">
                                <option value="{{ $data->efi_cable_type }}" hidden>{{ $data->efi_cable_type }}</option>
                                <option value="Multicore">Multicore</option>
                                <option value="Single Core">Single Core</option>
                            </select>
                        </div>
                    </div>

                    @if ($data->efi_cable_type === 'Single Core')
                        <div class="row" id="efi_color">
                            <div class="col-md-3">
                                <label for="efi_cable_color">EFI Cable Color</label>
                            </div>
                            <div class="col-md-4">
                                <select name="efi_cable_color" id="efi_cable_color" class="form-control">
                                    <option value="{{ $data->efi_cable_type }}">{{ $data->efi_cable_color }}</option>
                                    <option value="RED">RED</option>
                                    <option value="YELLOW">YELLOW</option>
                                    <option value="BLUE">BLUE</option>
                                    <option value="GRAY">GRAY</option>
                                    <option value="BLACK">BLACK</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <label for="efi_size_cable">EFI Size Cable</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="efi_size_cable" id="efi_size_cable"
                                value="{{ $data->efi_size_cable }}" class="form-control">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="efi_cable_length">EFI Cable Length</label>

                        </div>
                        <div class="col-md-4">
                            <select name="efi_cable_length" id="efi_cable_length" class="form-control">
                                <option value="{{ $data->efi_cable_length }}" hidden>{{ $data->efi_cable_length }}
                                </option>
                                <option value="5">5m</option>
                                <option value="10">10m</option>
                                <option value="15">15m</option>
                                <option value="20">20m</option>
                                <option value="25">25m</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <label for="tranches_work">Tranches Work</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tranches_work" id="tranches_work" class="form-control">
                                <option value="{{ $data->tranches_work }}" hidden>{{ $data->tranches_work }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="switchgear_changes">Switchgear Changes</label>
                        </div>
                        <div class="col-md-4">
                            <select name="switchgear_changes" id="switchgear_changes" class="form-control">
                                <option value="{{ $data->switchgear_changes }}" hidden>{{ $data->switchgear_changes }}
                                </option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="cable_changes">Cable Changes</label>
                        </div>
                        <div class="col-md-4">
                            <select name="cable_changes" id="cable_changes" class="form-control">
                                <option value="{{ $data->cable_changes }}" hidden>{{ $data->cable_changes }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="genset_need">Genset Need</label>
                        </div>
                        <div class="col-md-4">
                            <select name="genset_need" id="genset_need" class="form-control">
                                <option value="{{ $data->genset_need }}" hidden>{{ $data->genset_need }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="cable_tracer_work">Cable Tracer Work</label>
                        </div>
                        <div class="col-md-4">
                            <select name="cable_tracer_work" id="cable_tracer_work" class="form-control">
                                <option value="{{ $data->cable_tracer_work }}" hidden>{{ $data->cable_tracer_work }}
                                </option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label for="special_tools_work">Special Tools/Work</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="special_tools_work" value="{{ $data->special_tools_work }}"
                                id="special_tools_work" class="form-control">

                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-4" style="cursor: pointer !important"
                            type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


            $('.cable_type').on('change', function() {
                let idd = this.id
                var id = idd.split("_")
                if (this.value === "Single Core") {

                    $(this).parent().parent().after(`

                <div class="row" id="${id[0]}_color">
                    <div class="col-md-3">
                        <label for="${id[0]}_cable_color">${id[0].toUpperCase()} Cable Color</label>
                    </div>
                    <div class="col-md-4">
                        <select name="${id[0]}_cable_color" id="${id[0]}_cable_color" class="form-control" onchange="addFeild(this)">
                            <option value="" hidden>Select</option>

                            <option value="RED">RED</option>
                            <option value="YELLOW">YELLOW</option>
                            <option value="BLUE">BLUE</option>
                            <option value="GRAY">GRAY</option>
                            <option value="BLACK">BLACK</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                </div>

                `)
                } else {
                    if ($(this).parent().parent().next().attr('id') === id[0] + '_color') {
                        $(this).parent().parent().next().remove()
                    }
                }



            })

            $('select').on('change', function() {
                addFeild(this)
            })
        })

        function addFeild(element) {
            if (element.value == "other") {
                name = element.name
                element.name = ''
                $(element).parent().append(`<div><input class = "form-control"  name="${name}" id="${name}_other"></div>`)

            } else {
                var inputElement = $(element).siblings('div');
                if (inputElement.length > 0) {
                    element.name = inputElement.attr('name');
                    inputElement.remove();
                }
            }
        }

        function submitFoam() {

            var class_error = document.querySelectorAll('.form-control');


            var id = '';


            var isValid = true;

            for (var i = 0; i < class_error.length; i++) {
                var id = class_error[i].id;
                if ($(`#${id}`).val() === '' && id != "other") {
                    if ($(`#${id}`).parent().find('span').length < 1) {
                        $(`#${id}`).parent().prepend('<span class="text-danger">This field is required</span>');

                    }
                    isValid = false
                } else {
                    if ($(`#${id}`).parent().find('span').length > 0) {
                        $(`#${id}`).parent().find('span').remove().end();
                    }
                }
            }




            if (isValid) {
                const overlay = document.getElementById('overlay');
                overlay.style.display = 'block';
            }
            return isValid;

        }
    </script>
@endsection
