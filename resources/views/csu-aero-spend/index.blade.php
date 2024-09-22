
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="  d-flex  ">
                                <div class="col-md-6"><h4>CSU SPENDINGS</h4></div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-sm text-white"
                                        data-id="{{$data->id}}" data-name="{{$data->CsuBudget->pe_name}}"
                                      data-target="#spendingModal" data-toggle="modal" style="background  : #367FA9">Add Spending</button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-end mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>KKB</th>
                                            <th>CSF</th>
                                            <th>BO</th>
                                            <th>RTU</th>
                                            <th>TOOLS</th>
                                            <th>STORE RENTAL</th>
                                            <th>TRANSPORT</th>
                                            <th>SALARY</th>
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

                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_kkb_status )}}">{{$data->amt_kkb == "" ? 0 : $data->amt_kkb }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_cfs_status )}}">{{$data->amt_cfs == "" ? 0 : $data->amt_cfs }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_bo_status )}}">{{$data->amt_bo == "" ? 0 : $data->amt_bo }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_rtu_status )}}">{{$data->amt_rtu == "" ? 0 : $data->amt_rtu }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_tools_status )}}">{{$data->tools == "" ? 0 : $data->tools }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_store_rental_status )}}">{{$data->amt_store_rental == "" ? 0 : $data->amt_store_rental }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_transport_status )}}">{{$data->amt_transport == "" ? 0 : $data->amt_transport }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->amt_salary_status )}}">{{$data->amt_salary == "" ? 0 : $data->amt_salary }}</td>
                                                <td class="text-center  ">{{ $data->pending_payment == "" ? 0 : $data->pending_payment }}</td>
                                            <td class="text-center">{{ $data->outstanding_balance == "" ? 0 : $data->outstanding_balance }}</td>

                                                <td class="text-center {{str_replace(' ', '_' , $data->total_status )}}">{{ $data->total == "" ? 0 : $data->total }}</td>
                                                <td class="text-center {{str_replace(' ', '_' , $data->profit_status )}}">{{ $data->profit == "" ? "-" : $data->profit }} %</td>

                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('csu-aero-spend.edit', $data->id) }}">Edit
                                                            Foam</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('csu-aero-spend.show', $data->id) }}">Detail</a>

                                                        {{-- <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-toggle="modal" data-url="csu-aero-spend"
                                                            data-target="#myModal">
                                                            Remove
                                                        </button> --}}
                                                    </div>

                                                </td>
                                                @else
                                                <td colspan="10" class="text-center"><strong>no recored found</strong></td>
                                            @endif
                                            </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


