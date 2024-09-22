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
                    <h3>Stock updates</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('requisition.index') }}">stock</a> </li>
                        <li class="breadcrumb-item active">detail</li>

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
                                Requisition
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="my-3">
                                <table>
                                    <tr>
                                        <th>Item Name </th>
                                        <td> : {{ $data->item }}</td>
                                    </tr>
                                    <tr>
                                        <th>Item Type </th>
                                        <td> : {{ $data->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Units  </th>
                                        <td> : {{ $data->units }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Update </th>
                                        <td> : {{ $data->updated_at }}</td>
                                    </tr>
                                </table>



                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>#</th>
                                            <th>LAST UNITS</th>
                                            <th>UNITS (m)</th>
                                            <th>DATE</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data->allRecords as $data)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                <td class="align-middle">{{ $data->last_unit }}</td>
                                                <td>{{ $data->unit }}</td>
                                                <td>{{ $data->updated_at }}</td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
