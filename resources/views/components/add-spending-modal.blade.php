<div class="modal fade" id="spendingModal">
    <div class="modal-dialog">
        <div class="modal-content " style="border-radius: 0px !important">


            <div class="modal-header" style="background-color: #343A40 ; border-radius:0px ; ">
                <h6 class="modal-title text-white">Add Spending</h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{$url}}" id="spendingForm" method="POST">

                @csrf

                <div class="modal-body">

                    <input type="hidden" name="p_id" id="spending-modal-id">

                    <div class="row">
                        <div class="col-md-4"><label for="total">PE Name</label></div>
                        <div class="col-md-8">
                            <input type="text"  readonly  name="" id="spending-modal-pe-name" disabled class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="total">Type</label></div>
                        <div class="col-md-8">
                            <select name="pmt_name" id="pmt_name" class="form-control" onchange="displayBo(this.value)" required>

                            </select>
                        </div>
                    </div>

                    <div id='type_bo' class="row" style="display:none">
                        <div class="col-md-4"><label for="total">BO Type</label></div>
                        <div class="col-md-8">
                            <select name="bo_type" id="typ_bo" class="form-control" required>
                             <option value="PIW">PIW</option>
                             <option value="OUTAGE">OUTAGE</option>
                             <option value="RTU">RTU</option>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><label for="total">Vendor Name</label></div>
                        <div class="col-md-8">
                            <input name="vendor_name" type="text" id="vendor_name" class="form-control" required>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><label for="amount">Amount</label></div>
                        <div class="col-md-8">
                          <input type="number" name="amount" id="amount" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><label for="status">Status</label></div>
                        <div class="col-md-8">
                            <select name="status" id="status" class="form-control" required>
                                <option value="" hidden>select status</option>
                                <!-- <option value="work done and payed">work done and payed</option> -->
                                <option value="work done but not payed">work done</option>
                                <!-- <option value="work not done but payed">work not done but payed</option> -->
                                <!-- <option value="not work done and  not payed">not work done and not payed</option> -->
                                <!-- <option value="work done partial payment">work done partial payment</option> -->
                            <!-- <option value="partial work done partial payment">partial work done partial payment</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="amount">Payment Date</label></div>
                        <div class="col-md-8">
                          <input type="date" name="pmt_date" id="pmt_date" class="form-control"   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><label for="description">Description</label></div>
                        <div class="col-md-8">
                            <textarea name="description" id="description" cols="30" rows="8" class="form-control"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
