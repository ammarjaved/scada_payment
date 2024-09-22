@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        div#myTable_length {
        display: none !important;
    }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Scrap</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">



            @if (Session::has('failed'))
                <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
                    {{ Session::get('failed') }}

                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" class="btn btn-sm" style="background-color: #367FA9 ; color:white"
                                    data-toggle="modal" data-target="#addData">
                                    Add new
                                </button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>

                                <div class="table-responsive">
                                    <caption>Scrap Detail</caption>
                                    <table id="myTable" class="table table-bordered table-hover">


                                        <thead style="background-color: #E4E3E3 !important">
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>

                                                <th>Unit (m)</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($datas as $dat)
                                                <tr>
                                                    <td>{{ $dat->itemDetail->item ? $dat->itemDetail->item : '-' }}</td>
                                                    <td class="align-middle">
                                                        {{ $dat->itemDetail->type ? $dat->itemDetail->type : '-' }}</td>


                                                    <td class="align-middle text-center">
                                                        {{ $dat->unit ? $dat->unit : '-' }}
                                                    </td>
                                                    <td>{{ $dat->updated_at }}</td>
                                                    <td align="center"><button type="button" class="btn btn-danger btn-sm "
                                                        data-id="{{ $dat->id }}" data-toggle="modal"
                                                        data-target="#myModal">
                                                        Remove
                                                    </button></td>
                                                </tr>

                                        </tbody>
                                    </table>

                                </div>
                            @endforeach

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
                <form action="" id="remove-foam" method="POST">
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



    <div class="modal fade" id="addData">
        <div class="modal-dialog">
            <div class="modal-content ">


                <div class="modal-header">
                    <h4 class="modal-title">Add Scrap</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('scrap.store') }}" id="edit-foam" method="POST"
                    onsubmit="return submitFoam()">
                    @csrf

                    <div class="modal-body">
                        <div class="">
                            <label for="item">Select Item</label>
                            <select name="item" class="form-control required" id="item">
                                <option hidden value="">Select item</option>

                                @foreach ($items as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="">
                            <label for="type">Select Type</label>
                            <select name="type" id="type" class="form-control required">
                                <option value="" hidden>select type</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="unit">Unit</label>
                            <input type="number" name="unit" id="unit" class="form-control required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', 'scrap/' + id)
            });

            $('#imagesModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                $('#edit-modal-id').val(id);
                var modal = $(this);
                $('#edit-foam').attr('action', 'update-site-data-images')
            });

            $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })

            $('#item').on('change', function() {

                $.ajax({
                    url: '/get-type/' + this.value, // Replace with the actual URL of your route
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#type').append(`<option value="" hidden>select type</option>`)


                        data.map((opt) => {
                            $('#type').append(
                                `<option value="${opt.id}">${opt.type}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        // Handle errors, if any
                        console.error(error);
                    }
                });
                return false;



            })

        })


        function submitFoam() {

            var class_error = document.querySelectorAll('.required');


            var id = '';


            var isValid = true;

            for (var i = 0; i < class_error.length; i++) {
                console.log(class_error);
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
