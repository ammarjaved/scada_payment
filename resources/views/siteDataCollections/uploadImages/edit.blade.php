@extends('layouts.app', ['page_title' => 'Create'])

@section('content')
    <style>
        input,
        select,
        button {
            margin-bottom: 5%;
            border-radius: 0px !important;
            border: 1px solid #999999 !important;
        }

        img {
            margin-bottom: 3% !important;
            height: 100px;
            width: 100px;
        }
    </style>

    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Site Data</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">index</a></li>
                        <li class="breadcrumb-item active">upload images</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container bg-white shadow my-4 " style="border-radius: 10px">

        <h3 class="text-center mb-4">Update Site Data <span class="text-capitalize"> {{ $status }}</span> Images</h3>
        <form action="{{ route('update-site-data-images.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')


            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong> NAMA PE :</strong></label>
                </div>

                <div class="col-md-4 mb-4">
                    {{ $data->siteData ? $data->siteData->nama_pe : '-' }}
                    <input type="hidden" name="site_data_id" id="" value="{{ $data->site_data_id }}">
                </div>

            </div>

            <div class="row">
                <div class="col-md-3"><label for="">STATUS </label></div>
                <div class="col-md-4"><input type="hidden" name="status" value="{{ $status }}" id="status">
                    <input type="text" disabled class="form-control text-captaliz" value="{{ $status }}"
                        name="" id="">
                </div>
            </div>


            <div class="row">
                <div class="col-md-3">
                    <label for="depan_pe"><strong> DEPAN PE</strong></label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[depan_pe]" id="depan_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center mb-3">

                    @if (file_exists(public_path($data->depan_pe)) && $data->depan_pe != '')
                        <a href="{{ URL::asset($data->depan_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->depan_pe) }}" alt=""></a>
                    @endif



                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_switchgear"><strong> FULL SWITHCGEAR</strong></label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_switchgear]" id="full_switchgear" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->full_switchgear)) && $data->full_switchgear != '')
                        <a href="{{ URL::asset($data->full_switchgear) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_switchgear) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_tx1">FULL TX 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_tx1]" id="full_tx1" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->full_tx1)) && $data->full_tx1 != '')
                        <a href="{{ URL::asset($data->full_tx1) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_tx1) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_tx2">FULL TX 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_tx2]" id="full_tx2" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->full_tx2)) && $data->full_tx2 != '')
                        <a href="{{ URL::asset($data->full_tx2) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_tx2) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_lvdb">FULL LVDB</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_lvdb]" id="full_lvdb" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->full_lvdb)) && $data->full_lvdb != '')
                        <a href="{{ URL::asset($data->full_lvdb) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_lvdb) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="kiri_pe">KIRI PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[kiri_pe]" id="kiri_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->kiri_pe)) && $data->kiri_pe != '')
                        <a href="{{ URL::asset($data->kiri_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->kiri_pe) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate1">PLATE 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate1]" id="plate1" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->plate1)) && $data->plate1 != '')
                        <a href="{{ URL::asset($data->plate1) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->plate1) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate_2">PLATE 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate2]" id="plate2" class="form-control">
                </div>
                <div class="col-md-4 text-center ">

                    @if (file_exists(public_path($data->plate2)) && $data->plate2 != '')
                        <a href="{{ URL::asset($data->plate2) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->plate2) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate3">PLATE 3</label>
                </div>
                <div class="col-md-4 text-center ">
                    <input type="file" name="image[plate3]" id="plate3" class="form-control">
                </div>
                <div class="col-md-4 text-center">

                    @if (file_exists(public_path($data->plate3)) && $data->plate3 != '')
                        <a href="{{ URL::asset($data->plate3) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->plate3) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate_lvdb">PLATE LVDB</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate_lvdb]" id="plate_lvdb" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->plate_lvdb)) && $data->plate_lvdb != '')
                        <a href="{{ URL::asset($data->plate_lvdb) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->plate_lvdb) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="kanan_pe">KANAN PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[kanan_pe]" id="kanan_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->kanan_pe)) && $data->kanan_pe != '')
                        <a href="{{ URL::asset($data->kanan_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->kanan_pe) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_kiri">SISI KIRI</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_kiri]" id="sisi_kiri" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_kiri)) && $data->sisi_kiri != '')
                        <a href="{{ URL::asset($data->sisi_kiri) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_kiri) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kanan1">SISI CABLE KANAN 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kanan1]" id="sisi_cable_kanan1" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_cable_kanan1)) && $data->sisi_cable_kanan1 != '')
                        <a href="{{ URL::asset($data->sisi_cable_kanan1) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_cable_kanan1) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kanan2">SISI CABLE KANAN 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kanan2]" id="sisi_cable_kanan2" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_cable_kanan2)) && $data->sisi_cable_kanan2 != '')
                        <a href="{{ URL::asset($data->sisi_cable_kanan2) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_cable_kanan2) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_feeder">FULL FEEDER</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_feeder]" id="full_feeder" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->full_feeder)) && $data->full_feeder != '')
                        <a href="{{ URL::asset($data->full_feeder) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_feeder) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="pintu_pe">PINTU PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[pintu_pe]" id="pintu_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->pintu_pe)) && $data->pintu_pe != '')
                        <a href="{{ URL::asset($data->pintu_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->pintu_pe) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_kanan">SISI KANAN</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_kanan]" id="sisi_kanan" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_kanan)) && $data->sisi_kanan != '')
                        <a href="{{ URL::asset($data->sisi_kanan) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_kanan) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kiri1">SISI CABLE KIRI 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kiri1]" id="sisi_cable_kiri1" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_cable_kiri1)) && $data->sisi_cable_kiri1 != '')
                        <a href="{{ URL::asset($data->sisi_cable_kiri1) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_cable_kiri1) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kiri2">SISI CABLE KIRI 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kiri2]" id="sisi_cable_kiri2" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->sisi_cable_kiri2)) && $data->sisi_cable_kiri2 != '')
                        <a href="{{ URL::asset($data->sisi_cable_kiri2) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->sisi_cable_kiri2) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="tagging">TAGGING</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[tagging]" id="tagging" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->tagging)) && $data->tagging != '')
                        <a href="{{ URL::asset($data->tagging) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->tagging) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="board_pe">BOARD PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[board_pe]" id="board_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->board_pe)) && $data->board_pe != '')
                        <a href="{{ URL::asset($data->board_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->board_pe) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="bawah_nampak_cable">BAWAH (NAMPAK CABLE)</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[bawah_nampak_cable]" id="bawah_nampak_cable" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->bawah_nampak_cable)) && $data->bawah_nampak_cable != '')
                        <a href="{{ URL::asset($data->bawah_nampak_cable) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->bawah_nampak_cable) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="atas1">ATAS 1</label>
                </div>
                <div class="col-md-4 text-center ">
                    <input type="file" name="image[atas1]" id="atas1" class="form-control">
                </div>
                <div class="col-md-4">
                    @if (file_exists(public_path($data->atas1)) && $data->atas1 != '')
                        <a href="{{ URL::asset($data->atas1) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->atas1) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="atas2">ATAS 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[atas2]" id="atas2" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->atas2)) && $data->atas2 != '')
                        <a href="{{ URL::asset($data->atas2) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->atas2) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_depan_pe">FULL DEPAN PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_depan_pe]" id="full_depan_pe" class="form-control">
                </div>
                <div class="col-md-4 text-center ">
                    @if (file_exists(public_path($data->full_depan_pe)) && $data->full_depan_pe != '')
                        <a href="{{ URL::asset($data->full_depan_pe) }}" data-lightbox="roadtrip">
                            <img src="{{ URL::asset($data->full_depan_pe) }}" alt=""></a>
                    @endif
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-success mt-4" onclick="showLoading()" style="cursor: pointer !important"
                    type="submit">Submit</button>
            </div>

        </form>
    </div>

    </div>
@endsection

@section('script')
    <script>
        $("select").change(function() {
            var name = '';
            if (this.value == "other") {
                name = this.name
                this.name = ''
                $(this).parent().append(`<input class = "form-control"  name="${name}">`)

            } else {
                var inputElement = $(this).siblings('input');
                if (inputElement.length > 0) {
                    this.name = inputElement.attr('name');
                    inputElement.remove();
                }
            }
        });

        function showLoading() {
            const overlay = document.getElementById('overlay');
            overlay.style.display = 'block';

        }
    </script>
@endsection
