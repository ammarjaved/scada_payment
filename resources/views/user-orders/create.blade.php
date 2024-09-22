@extends('layouts.app', ['page_title' => 'Index'])


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Place Order</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">create</li>
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
                        <div class="card-header text-right">

                            <button type="button" class="btn btn-sm" style="background-color: #367FA9 ; color:white"
                                data-toggle="modal" onclick="addRow()" data-target="#addData">
                                Add Row
                            </button>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('order.store') }}" onsubmit="return submitFoam()" method="post">
                                @csrf
                                <div class="table-responsive">


                                    <table id="order-table" class="table table-bordered table-hover">


                                        <thead style="background-color: #E4E3E3 !important">

                                            <th>#</th>
                                            <th>ITEM</th>
                                            <th>DESCRIPTION</th>
                                            <th>UNIT (m)</th>
                                            <th>REMOVE</th>

                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                </div>

                                <div class="text-center">
                                    <button class="btn btn-sm btn-success">
                                        Plcae Order
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        var orderCount = 1;
        $(document).ready(function() {
            addRow()
            $(".form-control").on('change', function() {
                if ($(this).parent().find('span').length > 0) {
                    $(this).parent().find('span').remove().end();
                }

            });
        })

        function selectItem(event) {
            var typeValue = [];
            $(event).parent().next().children().find('option').remove().end();
            $.ajax({
                url: '/get-type/' + event.value,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $(event).parent().next().find('select').append(
                        `<option value="" hidden>select type</option>`)

                    data.map((opt) => {
                        $(event).parent().next().find('select').append(
                            `<option value="${opt.id}">${opt.type}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


        function addRow() {

            var selectOptions = `<select name="item[]" class="form-control change required" id="item${orderCount}" onchange="selectItem(this)">
                            <option hidden value="">Select item</option>
                           @foreach ($items as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach

                        </select>`;

            $('#order-table').append(`
            <tr>
                <td class="text-center align-middle"><strong>${orderCount}</strong></td>
                <td class="align-middle"> ${selectOptions}</td>
                <td class="align-middle"><select name='type[]' id='type${orderCount}' class='form-control required'><option hidden value=''>select type</option></select></td>
                <td class="align-middle"><input type="number" name="unit[]" id="unit${orderCount}" class='form-control required'></td>
                <td class="align-middle"><button class="btn btn-danger " onclick="remove(this)">remove<button></td>
                </tr>
            `)
            orderCount++;
        }

        function remove(event) {
            $(event).closest('tr').remove();
        }

        function submitFoam() {

            var class_error = document.querySelectorAll('.required');
            if (class_error.length < 1) {
                return false
            }


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
