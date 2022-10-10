<table border="1">
    <tr>
        <td colspan="7" style="font-weight:bold;font-size:14px;text-align:center;color:darkcyan;">
            <p>Flycatcher Xpress Limited</p>
        </td>
    </tr>
    <tr>
        <td colspan="7" style="font-size: 12px;text-align:center;">
            <p>Address : Block C, Section C, House 181/182,Mirpur Dhaka, Bangladesh</p>
        </td>
    </tr>
    <tr>
        <td colspan="7" style="font-size: 12px;text-align:center;">
            <p>Hotline: +8801777873960</p>
        </td>
    </tr>
</table>

<h4 style="margin: 2px;"></h4>
<table class="table">
    <tr class="bb">
        <th width="10" style="font-weight:bold;font-size:12px;">#</th>
        <th width="20" style="font-weight:bold;font-size:12px;">Date</th>
        <th width="30" style="font-weight:bold;font-size:12px;">Merchant Name</th>
        <th width="20" style="font-weight:bold;font-size:12px;">Customer Area</th>
        <th width="30" style="font-weight:bold;font-size:12px;">Customer Name</th>
        <th width="30" style="font-weight:bold;font-size:12px;">Customer Mobile</th>
        <th width="100" style="font-weight:bold;font-size:12px;">Customer Address</th>
    </tr>
    @foreach($parcels as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->added_date)->format('d M Y') }}</td>
        <td>{{ $item->merchant->name ??'' }}</td>
        <td>{{ $item->sub_area->name ??'' }}({{ $item->sub_area->code ??'' }})</td>
        <td>{{ ucfirst($item->customer_name) }}</td>
        <td>{{ $item->customer_mobile }}</td>
        <td style="overflow-wrap: break-word; word-wrap: break-word;">{{ $item->customer_address }}</td>

    </tr>
    @endforeach
</table>
