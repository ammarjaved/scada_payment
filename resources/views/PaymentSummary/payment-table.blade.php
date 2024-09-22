<table id="example2" class="table table-bordered  ">


    <thead style="background-color: #E4E3E3 !important">
        <tr>
            <th>RECEIVER NAME</th>
            <th class="d-none">SEARCH</th>
            <th>PAYMENT TYPE</th>
            <th>AMOUNT</th>
            <th>DESCRIPTION</th>
            <th>DATE TIME</th>
            <th>ACTION</th>


        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
            <tr>
 <form action="{{ route('payment-summary-details.update', $data->id) }}"
                            class="payment-summary-form" method="post">
                            @csrf
                            @method('PATCH')
                    <td class="align-middle">

                            <input type="text" name="pmt_receiver_name"
                            required id="pmt_receiver_name_{{ $data->id }}"
                            value="{{ $data->pmt_receiver_name }}" disabled
                            class="border-0"> </td>
                    <td class="d-none" id="search-type-{{ $data->id }}">
                        {{ $data->pmt_receiver_name }}  {{ $data->pmt_type }}</td>
                    <td class="align-middle">

                        <select name="pmt_type" id="pmt_name_{{ $data->id }}"
                            class="border-0" required disabled>
                            <option value="{{ $data->pmt_type }}" hidden>
                                {{ $data->pmt_type }}
                            </option>
                            <option value="claim">Claim</option>
                            <option value="salary">Salary</option>
                            <option value="tools">Tools</option>
                            <option value="others">Others</option>
                        </select>
                    </td>
                    <td class="align-middle"> <input type="number" name="pmt_amount"
                            id="pmt_amount_{{ $data->id }}"
                            value="{{ $data->pmt_amount }}" class="border-0"
                            min="0" required disabled></td>

                    <td class="col-3">
                        <textarea name="description" id="description_{{ $data->id }}" cols="30" rows="5" class="border-0"
                            disabled>{{ $data->description }}</textarea>
                    </td>
                    <td class="align-middle"><input type="datetime-local"
                            name="date_time" disabled class="border-0"
                            id="date_time_{{ $data->id }}"
                            value="{{ $data->date_time }}"> </td>



                    <td class="text-center align-middle">

                        <div class="btn-group btn-group-sm">
                            <button type="submit" class="d-none btn btn-success btn-sm"
                                id="{{ $data->id }}-submit-button"  > <i
                                    class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-sm btn-primary"
                                id="{{ $data->id }}-edit-button"
                                onclick="editDetails({{ $data->id }})"><i
                                    class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"
                                data-toggle="modal" data-id="{{ $data->id }}"
                                data-target="#myModal"><i
                                    class="fas fa-trash"></i></button>
                        </div>

                    </td>
 </form>
            </tr>
        @endforeach
    </tbody>
</table>
