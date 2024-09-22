<tr>
    @if($name=='AMT IR')
    <th class="align-middle">TESTER</th>
    @elseif($name=='AMT PK')
     <th class="align-middle">JOINTER</th>
    @else 
    <th class="align-middle">{{str_replace("AMT","",$name)}}</th>
    @endif
    <td  >

        <table class="table table-borderless" style="border: 0">
            <tbody>
            @foreach ($arr  as  $item)

                <tr>
                    <form action="{{route("$url-payment-details.update",$item->id)}}" class="submit-form" method="post">
                        @csrf
                        @method('PATCH')
                                {{-- detail first column amount --}}
                        <td><input type="number" step="any" name="amount" id="{{$arr_name}}-{{$item->id}}-amount" class="border-0" value="{{ $item->amount }}" disabled> </td>
                            {{-- 2 column vendor name --}}
                        <td><input type="text" name="vendor_name" id="{{$arr_name}}-{{$item->id}}-vendor_name" class="border-0" value="{{$item->vendor_name}}" disabled></td>
                            {{-- 3 amount status --}}
                        <td>
                            <select name="status" id="{{$arr_name}}-{{$item->id}}-status"  class="border-0" disabled required>
                                <option value="{{ $item->status }}" hidden>{{ $item->status }}</option>
                                <option value="work done and payed">work done and payed</option>
                                <option value="work done but not payed">work done</option>
                                <!-- <option value="work not done but payed">work not done but payed</option>
                                <option value="not work done and  not payed">not work done and not payed</option>
                                <option value="work done partial payment">work done partial payment</option>
                                <option value="partial work done partial payment">partial work done partial payment</option> -->
                            </select>
                            <input type="hidden" name="inp_name" value="{{$arr_name}}-{{$item->id}}" >
                        </td>

                            {{-- 4 description --}}
                        <td><textarea name="description" id="{{$arr_name}}-{{$item->id}}-description" placeholder="description ..." class="border-0" cols="20" rows="3"  disabled>{{ $item->description  }}</textarea> </td>
                            {{-- 5 date column --}}
                        <td><input type="date"   name="pmt_date" id="{{$arr_name}}-{{$item->id}}-pmt_date" class="border-0" value="{{ $item->pmt_date }}" disabled>  </td>


                            {{-- 6 action button --}}
                        @if ($action)
                        <td>

                              <div class="btn-group btn-group-sm">
                            <button type="submit" class="d-none btn btn-success btn-sm" id="{{$arr_name}}-{{$item->id}}-submit-button"  > <i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-sm btn-primary" id="{{$arr_name}}-{{$item->id}}-edit-button"  onclick="editDetails('{{$arr_name}}-{{$item->id}}')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-id="{{$item->id}}" data-name="{{$arr_name}}-{{$item->id}}"
                            data-target="#myModal"><i class="fas fa-trash"></i></button>
                              </div>
                        </td>
                        @endif

                    </form>
                </tr>
            @endforeach
            {{-- totoal of array     --}}
            @if (  $arr != [])
                <tr>
                    <td colspan="{{$action ? '5' : '4'}}" class="text-end"><strong>Total </strong></td>
                    <td class="text-center"><strong id="{{$arr_name}}-{{$item->id}}-total">{{ number_format($data->$arr_name, 2, '.', ',')}} </strong></td>

                </tr>
            @endif
        </tbody>
        </table>
    </td>
</tr>
