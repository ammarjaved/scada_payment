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
                        <li class="breadcrumb-item active">show</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

                <h3 class="text-center mb-4"> Site Data Collections</h3>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for=""><strong> NAMA PE :</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->nama_pe }}" disabled class="form-control">
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-3">
                        <label for="sub_station_type"><strong> SUB-STATION TYPE :</strong></label>
                    </div>

                    <div class="col-md-4 ">

                        <input value="{{ $data->sub_station_type }}" class="form-control" disabled>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 align-middle">
                        <label for=""><strong>SWITCHGEAR :</strong></label>
                    </div>

                    <div class="col-md-4">
                        <input value="{{ $data->switchgear }} " class="form-control" disabled>
                    </div>


                    <div class="col-md-4">


                        <input value="{{ $data->switchgear_2 }} " class="form-control" disabled>
                    </div>




                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="type_feeder"><strong> TYPE FEEDER</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->type_feeder }} " class="form-control" disabled>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-3">
                        <label for="switchgear_brand"><strong>SWITCHGEAR BRAND </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->switchgear_brand }} " class="form-control" disabled>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-3 ">
                        <label for="switchgear_no"><strong>SWITCHGEAR NO </strong></label>
                    </div>

                    <div class="col-md-4">
                        <input value="{{ $data->switchgear_no }} " class="form-control" disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3">
                        <label for="label_switch"><strong>LABEL SWITCH </strong></label>
                    </div>

                    <div class="col-md-4">
                        <input value="{{ $data->label_switch }} " class="form-control" disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="type_cable"><strong> TYPE CABLE</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->type_cable }} " class="form-control" disabled>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="size_cable"><strong> SIZE CABLE </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->size_cable }} " class="form-control" disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for=""><strong>TX RATING </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <label for="tx_rating_1"><strong>TX 1</strong></label>
                        <input value="{{ $data->tx_rating_1 }} " class="form-control" disabled>

                    </div>

                    <div class="col-md-4">
                        <label for="tx_rating_2"><strong>TX 2</strong></label>
                        <input value="{{ $data->tx_rating_2 }} " class="form-control" disabled>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for=""><strong> TX SIZE CABLE</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <label for="tx_cable_1"><strong>TX 1</strong></label>
                        <input value="{{ $data->tx_cable_1 }} " class="form-control" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="tx_cable_2"><strong>TX 2</strong></label>
                        <input value="{{ $data->tx_cable_2 }} " class="form-control" disabled>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-3 ">
                        <label for="genset_place"><strong> GENSET PLACE</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->genset_place }} " class="form-control" disabled>

                    </div>



                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="ct_cable"><strong>CT CABLE</strong></label>
                    </div>
                    <div class="col-md-4">
                        <input value="{{ $data->ct_cable }} " class="form-control" disabled>

                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="lvdb"><strong> LVDB</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->lvdb }} " class="form-control" disabled>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-3 ">
                        <label for="type_lvdb"><strong> TYPE LVDB</strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->type_lvdb }} " class="form-control" disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for=""><strong>TYPE FUSE </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->type_fuse }} " class="form-control" disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="feeder"><strong>FEEDER </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->feeder }} " class="form-control"disabled>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 ">
                        <label for="rating"><strong>RATING </strong></label>
                    </div>

                    <div class="col-md-4 ">
                        <input value="{{ $data->rating }} " class="form-control" disabled>
                    </div>

                </div>


                @foreach ($data->siteImg as $data)
                    <h3 class="text-center my-3 text-capitalize">{{ $data->status }} Images</h3>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="depan_pe"><strong> DEPAN PE</strong></label>
                        </div>

                        <div class="col-md-4 text-center mb-3">

                            @if (file_exists(public_path($data->depan_pe)) && $data->depan_pe != '')
                                <a href="{{ URL::asset($data->depan_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->depan_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif



                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_switchgear"><strong> FULL SWITHCGEAR</strong></label>
                        </div>

                        <div class="col-md-4 text-center mb-3 ">

                            @if (file_exists(public_path($data->full_switchgear)) && $data->full_switchgear != '')
                                <a href="{{ URL::asset($data->full_switchgear) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_switchgear) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_tx1">FULL TX 1</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">

                            @if (file_exists(public_path($data->full_tx1)) && $data->full_tx1 != '')
                                <a href="{{ URL::asset($data->full_tx1) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_tx1) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_tx2">FULL TX 2</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">

                            @if (file_exists(public_path($data->full_tx2)) && $data->full_tx2 != '')
                                <a href="{{ URL::asset($data->full_tx2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_tx2) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_lvdb">FULL LVDB</label>
                        </div>

                        <div class="col-md-4 text-center mb-3 ">

                            @if (file_exists(public_path($data->full_lvdb)) && $data->full_lvdb != '')
                                <a href="{{ URL::asset($data->full_lvdb) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_lvdb) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="kiri_pe">KIRI PE</label>
                        </div>

                        <div class="col-md-4 text-center mb-3">

                            @if (file_exists(public_path($data->kiri_pe)) && $data->kiri_pe != '')
                                <a href="{{ URL::asset($data->kiri_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->kiri_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate1">PLATE 1</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">

                            @if (file_exists(public_path($data->plate1)) && $data->plate1 != '')
                                <a href="{{ URL::asset($data->plate1) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->plate1) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate_2">PLATE 2</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">

                            @if (file_exists(public_path($data->plate2)) && $data->plate2 != '')
                                <a href="{{ URL::asset($data->plate2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->plate2) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate3">PLATE 3</label>
                        </div>

                        <div class="col-md-4 text-center mb-3">

                            @if (file_exists(public_path($data->plate3)) && $data->plate3 != '')
                                <a href="{{ URL::asset($data->plate3) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->plate3) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <!-- Add the rest of the input:file elements in a similar manner -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="plate_lvdb">PLATE LVDB</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->plate_lvdb)) && $data->plate_lvdb != '')
                                <a href="{{ URL::asset($data->plate_lvdb) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->plate_lvdb) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="kanan_pe">KANAN PE</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->kanan_pe)) && $data->kanan_pe != '')
                                <a href="{{ URL::asset($data->kanan_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->kanan_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_kiri">SISI KIRI</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_kiri)) && $data->sisi_kiri != '')
                                <a href="{{ URL::asset($data->sisi_kiri) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_kiri) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kanan1">SISI CABLE KANAN 1</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_cable_kanan1)) && $data->sisi_cable_kanan1 != '')
                                <a href="{{ URL::asset($data->sisi_cable_kanan1) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_cable_kanan1) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kanan2">SISI CABLE KANAN 2</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_cable_kanan2)) && $data->sisi_cable_kanan2 != '')
                                <a href="{{ URL::asset($data->sisi_cable_kanan2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_cable_kanan2) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_feeder">FULL FEEDER</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->full_feeder)) && $data->full_feeder != '')
                                <a href="{{ URL::asset($data->full_feeder) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_feeder) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="pintu_pe">PINTU PE</label>
                        </div>

                        <div class="col-md-4 text-center mb-3 ">
                            @if (file_exists(public_path($data->pintu_pe)) && $data->pintu_pe != '')
                                <a href="{{ URL::asset($data->pintu_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->pintu_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_kanan">SISI KANAN</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_kanan)) && $data->sisi_kanan != '')
                                <a href="{{ URL::asset($data->sisi_kanan) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_kanan) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kiri1">SISI CABLE KIRI 1</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_cable_kiri1)) && $data->sisi_cable_kiri1 != '')
                                <a href="{{ URL::asset($data->sisi_cable_kiri1) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_cable_kiri1) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sisi_cable_kiri2">SISI CABLE KIRI 2</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->sisi_cable_kiri2)) && $data->sisi_cable_kiri2 != '')
                                <a href="{{ URL::asset($data->sisi_cable_kiri2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->sisi_cable_kiri2) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="tagging">TAGGING</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->tagging)) && $data->tagging != '')
                                <a href="{{ URL::asset($data->tagging) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->tagging) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="board_pe">BOARD PE</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->board_pe)) && $data->board_pe != '')
                                <a href="{{ URL::asset($data->board_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->board_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="bawah_nampak_cable">BAWAH (NAMPAK CABLE)</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->bawah_nampak_cable)) && $data->bawah_nampak_cable != '')
                                <a href="{{ URL::asset($data->bawah_nampak_cable) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->bawah_nampak_cable) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="atas1">ATAS 1</label>
                        </div>

                        <div class="col-md-4 text-center mb-3">
                            @if (file_exists(public_path($data->atas1)) && $data->atas1 != '')
                                <a href="{{ URL::asset($data->atas1) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->atas1) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="atas2">ATAS 2</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->atas2)) && $data->atas2 != '')
                                <a href="{{ URL::asset($data->atas2) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->atas2) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="full_depan_pe">FULL DEPAN PE</label>
                        </div>

                        <div class="col-md-4 text-center  mb-3">
                            @if (file_exists(public_path($data->full_depan_pe)) && $data->full_depan_pe != '')
                                <a href="{{ URL::asset($data->full_depan_pe) }}" data-lightbox="roadtrip">
                                    <img src="{{ URL::asset($data->full_depan_pe) }}" alt=""></a>
                            @else
                                No Image Found
                            @endif
                        </div>
                    </div>
                @endforeach
                                <div class="text-center">
                    @if ($data->estWork != '')
                        <a href="{{ route('estimation-work.show', $data->estWork->id) }}" class="btn btn-success">Goto
                            Estimation
                            Work</a>
                    @else
                        <a href="{{ route('estimation-work.create') }}" class="btn btn-success">Create Estimation
                            Work</a>
                    @endif
                </div>

            </div>

        </div>
    </section>
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
    </script>
@endsection
