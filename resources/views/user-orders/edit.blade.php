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
                    <h3>Order Detail</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('admin-order.index') }}">orders</a> </li>
                        <li class="breadcrumb-item active">detail</li>

                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">





            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Order Detail
                            </div>
                            @if ($order->status == 'Pending')
                                <div class="text-right">
                                    @if ($isValid)
                                        <a href="/order/{{ $order->id }}/Complete"><button type="button"
                                                class="btn-sm btn-success">Complete Order</button></a>
                                    @else
                                        <span class="text-danger">{{ $isValid }} Low Stocks</span>
                                    @endif

                                </div>
                            @endif

                        </div>

                        <div class="card-body">
                            <div class="my-3">
                                <table>
                                    <tr>
                                        <th>Order no : </th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username : </th>
                                        <td>{{ $order->userData->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email : </th>
                                        <td>{{ $order->userData->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Staus : </th>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                </table>



                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Type</th>
                                            <th>Units (m)</th>
                                            <th>Current Units (m)</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td class="align-middle">{{ $data->itemDetail->item }}</td>
                                                <td>{{ $data->itemDetail->type }}</td>
                                                <td>{{ $data->unit }}</td>
                                                <td>{{ $data->itemDetail->units }}</td>



                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($order->status == 'Pending')
                                <div class="text-center my-4">
                                    <a href="/order/{{ $order->id }}/Cancel"class=""><button type="button"
                                            class="btn-sm btn-danger"> Cancel Order</button></a>
                                    @if ($isValid)
                                        <a href="/order/{{ $order->id }}/Complete"><button type="button"
                                                class="btn-sm btn-success">Complete Order</button></a>
                                    @else
                                        <span class="text-danger">{{ $isValid }} Low Stocks</span>
                                    @endif

                                </div>
                            @endif
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
            $('a').on('click', function() {
                const overlay = document.getElementById('overlay');
                overlay.style.display = 'block';
            })
        })
    </script>
@endsection
