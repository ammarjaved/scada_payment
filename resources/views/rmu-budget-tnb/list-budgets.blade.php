@extends('layouts.app', ['page_title' => 'Budgets'])

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- <section class="content-header">
        <div class="container">
            <h3>Budgets</h3>
        </div>
    </section> -->

    <section class="content">
        <div class="container-fluid">
            @if (Session::has('failed'))
                <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
                    {{ Session::get('failed') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>NAMA PE</th>
                                            <th>SWITCHGEAR</th>
                                            <th>TOTAL BUDGET</th>
                                            <th>TOTAL COST</th>
                                            <th>TOTAL PROFIT</th>
                                            <th>TOTAL PROFIT(%)</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->nama_pe ?? '-' }}</td>
                                                <td class="align-middle">{{ $data->jenis_perkakasuis ?? '-' }}</td>
                                                <td class="align-middle">{{ number_format($data->budget,2) ?? '-' }}</td>
                                                <td class="align-middle">{{ number_format($data->aero_spend,2) ?? '-' }}</td>
                                                <td class="align-middle">{{ number_format($data->profit_total,2) ?? '-' }}</td>
                                                <td class="align-middle">{{ number_format($data->profit_percent,2) ?? '-' }}</td>
                                                <td class="align-middle text-center">
                                                    @if (isset($data->budget) && $data->budget !== '0')
                                                        @php
                                                            // Find the corresponding RMU to get its ID
                                                            $matchingRmu = $rmus->firstWhere('pe_name', $data->nama_pe);
                                                        @endphp
                                                        @if ($matchingRmu)
                                                            <a class="btn btn-primary btn-sm" href="{{ route('rmu-budget-tnb.index', $matchingRmu->id) }}">Add Spending</a>
                                                        @endif
                                                    @endif
                                                </td>
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
    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
