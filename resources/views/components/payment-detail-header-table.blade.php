<table class=" mb-3 table-borderless col-md-3">
    <tbody>
        <tr>
            <th>PE NAME : </th>
            <td>{{ $name }}</td>
        </tr>

        <tr>
            <th>BUDGET BY TNB : </th>

            <td>
                <span id="budget"> {{ $budget }} </span><strong>(RM)</strong>
            </td>
        </tr>
        <tr>
            <th>TOTAL SPENDING :</th>
            <td><span class="subTotal">{{ $spending }}</span> <strong>(RM) </strong></td>
        </tr>
       
        <tr>
            <th>TOTAL OUTSTANDING :</th>
            <td><span class="outstanding">{{ $outstanding }}</span> <strong>(RM) </strong></td>
        </tr>
        <tr>
            <th>TOTAL PROFIT :</th>
            <td><span class="total_profit">{{ $profit }} </span></td>
        </tr>
    </tbody>
</table>
