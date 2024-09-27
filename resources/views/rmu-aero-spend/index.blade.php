

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="  d-flex  ">
                                <div class="col-md-6"><h4>SPENDINGS</h4></div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-sm text-white"
                                        data-id="{{$data->id}}" data-name="{{$data->RmuBudget->pe_name}}"
                                      data-target="#spendingModal" data-toggle="modal" style="background  : #367FA9">Add Spending</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class=" mb-4">
                                <strong>PE NAME :</strong>   {{ $data  ? $data->RmuBudget->pe_name : ""}}
                            </div>
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>BO</th>
                                            <th>PIW</th>
                                            <th>OUTAGE</th>
                                            <th>RTU</th>
                                            <th>KKB</th>
                                            <th>JOINTER</th>
                                            <th>TESTER</th>
                                            <th>TRANSPORT</th>
                                            <th>TOTAL OUTSTANDING</th>
                                            <th>TOTAL SPENDINGS</th>
                                            <!-- <th>PROFIT</th> -->
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>

                                            @if ($data != "" && $data != [])

                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_bo_status )}}">{{$data->amt_bo ?? 0}}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_piw_status )}}">{{$data->amt_piw ?? 0  }}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_outage_status )}}">{{$data->amt_outage ?? 0  }}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_rtu_status )}}">{{$data->amt_rtu ?? 0  }}</td>

                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_kkb_status )}}">{{$data->amt_kkb ?? 0  }}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_pk_status )}}">{{$data->amt_pk ?? 0  }}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_ir_status )}}">{{$data->amt_ir   ?? 0 }}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->amt_transport_status )}}">{{$data->amt_transport ?? 0 }}</td>
                                            <td class="text-center">{{ $data->outstanding_balance ?? 0}}</td>
                                            <td class="text-center {{str_replace(' ', '_' , $data->total_status )}}">{{ $data->total ?? 0 }}</td>
                                            {{--<!-- <td class="text-center">{{ $data->profit}}</td> -->--}}



                                            <td class="text-center">
                                                <button type="button" class="btn  " data-toggle="dropdown">
                                                    <img
                                                        src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('rmu-aero-spend.edit', $data->id) }}">Edit
                                                        Foam</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('rmu-aero-spend.show', $data->id) }}">Detail</a>

                                                    {{-- <button type="button" class="btn btn-primary dropdown-item"
                                                        data-id="{{ $data->id }}" data-url={{"rmu-aero-spend"}} data-toggle="modal"
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
        </div>
    </section>
