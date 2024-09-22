@extends('layouts.app', ['page_title' => 'Create'])

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Site Data</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">index</a></li>
                        <li class="breadcrumb-item active">create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

                <h3 class="text-center mb-4"> Site Data Collections</h3>
                <form action="{{ route('site-data-collection.store') }}"  method="post"
                    enctype="multipart/form-data">
                    @csrf



                    <div class="row">

                        <div class="col-md-3 ">
                            <label for=""><strong> NAMA PE :</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <input type="text" name="nama_pe" id="nama_pe" class="form-control" required>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <label for="sub_station_type"><strong> SUB-STATION TYPE :</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="sub_station_type" id="sub_station_type" class="form-control">
                                <option value="" hidden>Select Type</option>
                                <option value="OUTDOOR">OUTDOOR</option>
                                <option value="ATTACHED">ATTACHED</option>
                                <option value="COMPACT">COMPACT</option>
                                <option value="UNDERGROUND">UNDERGROUND</option>
                                <option value="POLE MOUNT">POLE MOUNT</option>
                                <option value="STANDALONE">STANDALONE</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 align-middle">
                            <label for=""><strong>SWITCHGEAR :</strong></label>
                        </div>

                        <div class="col-md-4">
                            <select name="switchgear" id="switchgear" class="form-control" required>
                                <option value="" hidden> Select</option>
                                <option value="RMU">RMU</option>
                                <option value="VCB">VCB</option>
                                <option value="COMPACT">COMPACT</option>
                            </select>
                        </div>


                        <div class="col-md-4">

                            <select name="switchgear_2" id="switchgear_2" class="form-control">
                                <option value="" hidden> Select</option>
                                <option value="MOTORIZED">MOTORIZED</option>
                                <option value="NON MOTORIZED">NON MOTORIZED</option>
                            </select>
                        </div>




                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="type_feeder"><strong> TYPE FEEDER</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="type_feeder" id="type_feeder" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="2+1">2+1</option>
                                <option value="2+2">2+2</option>
                                <option value="3+1">3+1</option>
                                <option value="3+2">3+2</option>
                                <option value="3s">3s</option>
                                <option value="4s">4s</option>
                                <option value="5s">5s</option>
                                <option value="6s">6s</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <label for="switchgear_brand"><strong>SWITCHGEAR BRAND </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <input type="text" name="switchgear_brand" id="switchgear_brand" class="form-control">
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="switchgear_no"><strong>SWITCHGEAR NO </strong></label>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="switchgear_no" id="switchgear_no" class="form-control">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <label for="label_switch"><strong>LABEL SWITCH </strong></label>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="label_switch" id="label_switch" class="form-control">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="type_cable"><strong> TYPE CABLE</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="type_cable" id="type_cable" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="XLPE">XLPE</option>
                                <option value="PILC">PILC</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="size_cable"><strong> SIZE CABLE </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="size_cable" id="size_cable" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="240">240</option>
                                <option value="500">500</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for=""><strong>TX RATING </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <label for="tx_rating_1"><strong>TX 1</strong></label>
                            <select name="tx_rating_1" id="tx_rating_1" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="300">300</option>
                                <option value="500">500</option>
                                <option value="750">750</option>
                                <option value="1000">1000</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="tx_rating_2"><strong>TX 2</strong></label>
                            <select name="tx_rating_2" id="tx_rating_2" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="300">300</option>
                                <option value="500">500</option>
                                <option value="750">750</option>
                                <option value="1000">1000</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for=""><strong> TX SIZE CABLE</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <label for="tx_cable_1"><strong>TX 1</strong></label>
                            <select name="tx_cable_1" id="tx_cable_1" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="300">70</option>
                                <option value="500">300</option>
                                <option value="750">500</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="tx_cable_2"><strong>TX 2</strong></label>
                            <select name="tx_cable_2" id="tx_cable_2" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="70">70</option>
                                <option value="300">300</option>
                                <option value="500">500</option>
                                <option value="other">other</option>
                            </select>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="genset_place"><strong> GENSET PLACE</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="genset_place" id="genset_place" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                                <option value="other">Remarks:</option>
                            </select>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="ct_cable"><strong>CT CABLE</strong></label>
                        </div>
                        <div class="col-md-4">
                            <select name="ct_cable" id="ct_cable" class="form-control">
                                <option value="" hidden> Select </option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                                <option value="other">Remarks:</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="depan_pe"><strong> Before Images</strong></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="depan_pe"><strong> DEPAN PE</strong></label>
                        </div>
                        <div class="col-md-4">
                            {{-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image[depan_pe]" id="depan_pe" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>

                        </div>
                      </div> --}}

                            <input type="file" name="image[depan_pe]" id="depan_pe" class="form-control">

                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_switchgear"><strong> FULL SWITHCGEAR</strong></label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_switchgear]" id="full_switchgear"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_tx1">FULL TX 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_tx1]" id="full_tx1" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_tx2">FULL TX 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_tx2]" id="full_tx2" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_lvdb">FULL LVDB</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_lvdb]" id="full_lvdb" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="kiri_pe">KIRI PE</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[kiri_pe]" id="kiri_pe" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate1">PLATE 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[plate1]" id="plate1" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate_2">PLATE 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[plate2]" id="plate2" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate3">PLATE 3</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[plate3]" id="plate3" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <!-- Add the rest of the input:file elements in a similar manner -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate_lvdb">PLATE LVDB</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[plate_lvdb]" id="plate_lvdb" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="kanan_pe">KANAN PE</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[kanan_pe]" id="kanan_pe" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_kiri">SISI KIRI</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_kiri]" id="sisi_kiri" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kanan1">SISI CABLE KANAN 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_cable_kanan1]" id="sisi_cable_kanan1"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kanan2">SISI CABLE KANAN 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_cable_kanan2]" id="sisi_cable_kanan2"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_feeder">FULL FEEDER</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_feeder]" id="full_feeder" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="pintu_pe">PINTU PE</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[pintu_pe]" id="pintu_pe" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_kanan">SISI KANAN</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_kanan]" id="sisi_kanan" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kiri1">SISI CABLE KIRI 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_cable_kiri1]" id="sisi_cable_kiri1"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kiri2">SISI CABLE KIRI 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[sisi_cable_kiri2]" id="sisi_cable_kiri2"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="tagging">TAGGING</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[tagging]" id="tagging" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="board_pe">BOARD PE</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[board_pe]" id="board_pe" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="bawah_nampak_cable">BAWAH (NAMPAK CABLE)</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[bawah_nampak_cable]" id="bawah_nampak_cable"
                                class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="atas1">ATAS 1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[atas1]" id="atas1" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="atas2">ATAS 2</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[atas2]" id="atas2" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_depan_pe">FULL DEPAN PE</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image[full_depan_pe]" id="full_depan_pe" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="lvdb"><strong> LVDB</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <input type="text" name="lvdb" id="lvdb" class="form-control">
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="type_lvdb"><strong> TYPE LVDB</strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="type_lvdb" id="type_lvdb" class="form-control">
                                <option value="" hidden> Select</option>
                                <option value="SUBSTATION">SUBSTATION</option>
                                <option value="CS">CS</option>
                                <option value="SSU">SSU</option>
                                <option value="PAT">PAT</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for=""><strong>TYPE FUSE </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="type_fuse" id="type_fuse" class="form-control">
                                <option value="" hidden> Select</option>
                                <option value="DIN-TYPE">DIN-TYPE</option>
                                <option value="J-TYPE">J-TYPE</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="feeder"><strong>FEEDER </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="feeder" id="feeder" class="form-control">
                                <option value="" hidden> Select</option>
                                <option value="2 IN 8 OUT">2 IN 8 OUT</option>
                                <option value="2 IN 10 OUT">2 IN 10 OUT</option>
                                <option value="2 IN 6 OUT">2 IN 6 OUT</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 ">
                            <label for="rating"><strong>RATING </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <select name="rating" id="rating" class="form-control">
                                <option value="" hidden> Select</option>
                                <option value="1600">1600</option>
                                <option value="800">800</option>
                                <option value="400">400</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 ">
                            <label for="location"><strong>Location </strong></label>
                        </div>

                        <div class="col-md-4 ">
                            <br>
                            <button onclick="getLocation()" class="btn-sm btn-secondary" type="button">Get
                                Location</button><br>
                            <label for="lat">lat</label>
                            <input type="text" name="lat" id="lat" value="0" class="form-control">
                            <label for="log">log</label>
                            <input type="text" name="log" id="log" value="0" class="form-control">
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    {{-- <script src="{{asset('dist/js/adminlte.min.js')}}"></script> --}}
    <script>
        $("select").change(function() {
            var name = '';
            if (this.value == "other") {
                name = this.name
                this.name = ''
                $(this).parent().append(
                    `<div><input class = "form-control"  name="${name}" id="${name}_other"></div>`)

            } else {
                var inputElement = $(this).siblings('div');
                if (inputElement.length > 0) {
                    this.name = inputElement.attr('name');
                    inputElement.remove();
                }
            }
        });

        function showLoading() {
            const overlay = document.getElementById('overlay');
            // overlay.style.display = 'block';

        }
        $(document).ready(function() {
            $(".form-control").on('change', function() {
                if ($(this).parent().find('span').length > 0) {
                    $(this).parent().find('span').remove().end();
                }

            });

            // bsCustomFileInput.init();
        });



        function submitFoam() {

            var class_error = document.querySelectorAll('input[type="text"]');
            var selectInputs = document.querySelectorAll('select');
            // var fileInputs = document.querySelectorAll('input[type="file"]');
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
            // fileInputs.forEach(function(input) {
            //     id = input.id

            //     if (input.files.length > 0) {
            //         if ($(`#${id}`).parent().find('span').length > 1) {
            //             $(`#${id}`).parent().find('span').remove().end();
            //         }
            //     } else {
            //         if ($(`#${id}`).parent().find('span').length < 1) {
            //             $(`#${id}`).parent().prepend('<span class="text-danger">This field is required</span>');

            //         }
            //         isValid = false
            //     }
            // });

            selectInputs.forEach(function(input) {
                id = input.id

                if ($(`#${id}`).val() === '') {
                    if ($(`#${id}`).parent().find('span').length < 1) {
                        $(`#${id}`).parent().prepend('<span class="text-danger">This field is required</span>');
                    }
                    isValid = false
                } else {
                    if ($(`#${id}`).parent().find('span').length > 0) {
                        $(`#${id}`).parent().find('span').remove().end();
                    }
                }
            });


            if (isValid) {
                const overlay = document.getElementById('overlay');
                overlay.style.display = 'block';
            }
            return isValid;

        }
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {

            $('#lat').val(position.coords.latitude)
            $('#log').val(position.coords.longitude)

        }
    </script>
@endsection
