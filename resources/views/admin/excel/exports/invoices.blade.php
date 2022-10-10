<table>
    <tr>
        <td colspan="11" style="font-size: 10px;text-align:center;">
            <p>Flycatcher Xpress Limited</p>
        </td>
    </tr>
    <tr>
        <td colspan="11" style="font-size: 10px;text-align:center;">
            <p>Address : Block C, Section C, House 181/182,Mirpur Dhaka, Bangladesh</p>
        </td>
    </tr>
    <tr>
        <td colspan="11" style="font-size: 10px;text-align:center;">
            <p>Hotline: +8801777873960</p>
        </td>
    </tr>
    <tr>
    <td colspan="11" style="font-size: 8px;text-align: center;">
            <p ><b>INVOICE NO#</b> {{$invoice->invoice_number}}</p>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td colspan="4"><b>Merchant Name:</b> {{$invoice->prepare_for->name}}</td>
        <td colspan="4"><b>Merchant Mobile:</b> {{$invoice->prepare_for->mobile}}</td>
        <td colspan="3"><b>Date:</b> {{date('d M Y', strtotime($invoice->created_at))}}</td>
    </tr>
</table>
<h4 style="margin: 2px;"></h4>
<table class="table">
    <tr class="bb">
        <th  width="20">#</th>
        <th  width="20">tracking id</th>
        <th  width="20">Area</th>
        <th  width="20">Status</th>
        <th  width="20">Customer mobile</th>
        <th  width="20">Invoice id</th>
        <th  width="20">Parcel Price (TK)</th>
        <th  width="20">Collection Amount (TK)</th>
        <th  width="20">Cod Charge (TK)</th>
        <th  width="20">Delivery Charge (TK)</th>
        <th  width="20">Net Payable (TK)</th>
    </tr>
    @foreach($invoice->invoiceItems as $item)
    <tr>
        <td>{{$loop->iteration }}</td>
        <td>{{$item->parcel->tracking_id}}</td>
        <td>{{$item->parcel->sub_area->name ??''}}({{$item->parcel->sub_area->code ??''}})</td>
        <td>{{ucfirst($item->parcel->status)}}</td>
        <td>{{$item->parcel->customer_mobile}}</td>
        <td>{{$item->parcel->invoice_id}}</td>
        <td style="text-align: right;">{{number_format($item->parcel->collection_amount)}}</td>
        <td style="text-align: right;">{{number_format($item->collection_amount)}}</td>
        <td style="text-align: right;">{{number_format($item->cod_charge)}}</td>
        <td style="text-align: right;">{{number_format($item->delivery_charge)}}</td>
        <td style="text-align: right;">{{number_format($item->net_payable)}}</td>
    </tr>
    @endforeach
    <tr style="border: 2px solid green;">
        <td class="pr-1" colspan="7">Total</td>
        <td style="text-align: right;">
            ={{number_format($invoice->total_collection_amount)}}
        </td>
        <td style="text-align: right;">
            = {{number_format($invoice->total_cod)}}
        </td>
        <td style="text-align: right;">
            ={{number_format($invoice->total_delivery_charge)}}
        </td>
        <td style="text-align: right;">
            ={{number_format($invoice->total_collection_amount - $invoice->total_delivery_charge -$invoice->total_cod)}}
        </td>
    </tr>
</table>
