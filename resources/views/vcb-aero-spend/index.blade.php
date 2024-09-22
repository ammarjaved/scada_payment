

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="  d-flex  ">
                                <div class="col-md-6"><h4>VCB SPENDINGS</h4></div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-sm text-white"
                                        data-id="{{$data->id}}" data-name="{{$data->VcbBudget->pe_name}}"
                                      data-target="#spendingModal" data-toggle="modal" style="background  : #367FA9">Add Spending</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class=" mb-4">
                                <strong>PE NAME :</strong>   {{ $data  ? $data->VcbBudget->pe_name : ""}}
                            </div>

                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>BO</th>
                                            <th>PIW</th>
                                            <th>CABLE</th>
                                            <th>TRANSDUCER</th>
                                            <th>RTU</th>
                                            <th>RTU CABLE</th>
                                            <th>TOOLS</th>
                                            <th>STORE RENTAL</th>
                                            <th>TRANSPORT</th>
                                            <th>TOTAL PENDING</th>
                                            <th>TOTAL OUTSTANDING</th>

                                            <th>TOTAL SPENDINGS</th>
                                            <th>PROFIT</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                @if ($data != "" && $data != [])

                                                <td class="text-center {{str_replace(' ','_',$data->amt_bo_status)}}" >{{$data->amt_bo == "" ? 0 : $data->amt_bo }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_piw_status)}}">{{$data->amt_piw == "" ? 0 : $data->amt_piw }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_cable_status)}}">{{$data->amt_cable == "" ? 0 : $data->amt_cable }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_transducer_status)}}">{{$data->amt_transducer == "" ? 0 : $data->amt_transducer }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_rtu_status)}}">{{$data->amt_rtu == "" ? 0 : $data->amt_rtu }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_rtu_cable_status)}}">{{$data->amt_rtu_cable == "" ? 0 : $data->amt_rtu_cable }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_tools_status)}}">{{$data->amt_tools == "" ? 0 : $data->amt_tools }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_store_rental_status)}}">{{$data->amt_store_rental == "" ? 0 : $data->amt_store_rental }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_transport_status)}}">{{$data->amt_transport == "" ? 0 : $data->amt_transport }}</td>
                                                <td class="text-center  ">{{ $data->pending_payment == "" ? 0 : $data->pending_payment }}</td>
                                                <td class="text-center">{{ $data->outstanding_balance == "" ? 0 : $data->outstanding_balance }}</td>

                                                <td class="text-center {{str_replace(' ','_',$data->amt_total_status)}}">{{ $data->total == "" ? 0 : $data->total }}</td>
                                                <td class="text-center {{str_replace(' ','_',$data->amt_profit_status)}}">{{ $data->profit == "" ? "-" : $data->profit }} %</td>

                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('vcb-aero-spend.edit', $data->id) }}">Edit
                                                            Foam</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('vcb-aero-spend.show', $data->id) }}">Detail</a>

                                                        {{-- <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-toggle="modal" data-url="vcb-aero-spend"
                                                            data-target="#myModal">
                                                            Remove
                                                        </button> --}}
                                                    </div>

                                                </td>
                                            @else
                                            <td colspan="12" class="text-center"><strong>no recored found</strong></td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

