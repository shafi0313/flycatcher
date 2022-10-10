<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parcels List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
        }

        .bb-none {
            border-bottom: 2px solid transparent;
        }

        .br-none {
            border-right: 2px solid #fff;
        }

        .bt-none {
            border-top: 2px solid #fff;
        }

        .bl-none {
            border-left: 2px solid #fff;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        body {
            font-family: bangla;
            font-size: 13px;
            background-color: red;
        }

        .fs {
            font-size: 12px;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .gtc {
            text-align: center;
            border-radius: 15px;
        }

        .sgtc {
            background-color: green;
            color: white;
            font-size: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

<htmlpageheader name="page-header">
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc bb-none">
                <p style="font-size: 15px;">Flycatcher Xpress Limited</p>
            </td>
        </tr>
    </table>
</htmlpageheader>
<table style="border: 2px solid #fff;">
    <tr>
        <td class="tc" style="font-size: 10px;">
            <p class="card-text mb-25"><b>Address :</b> House#181/182,Block C, Section 6,Mirpur Dhaka, Bangladesh</p>
            <p style="font-size: 12px;"><b>Emergency Contact:</b> +880198-997711</p>
        </td>
    </tr>
</table>

<br>

<table class="table table-bordered table-secondary table-striped">
    <thead>
    <tr>
        <th>Merchant name / Date</th>
        @for($i= 1; $i<=$days; $i++)
            <th>{{$i}} - {{$month}}</th>
        @endfor
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deliveryChargeData as $merchant)
        @if($merchant['day_to_day_total_delivery_charge'] > 0)
            <tr>
                <th>{{$merchant['merchant_name']}}</th>
                @foreach($merchant['merchant_data'] as $merchantData)
                    <td>
                        {{number_format($merchantData['delivery_charge'])}}
                    </td>
                @endforeach
                <th class="bg-primary text-white">
                    {{number_format($merchant['day_to_day_total_delivery_charge'])}}
                </th>
            </tr>
        @endif
    @endforeach
    <tr>
        <th>TOTAL</th>
        @php
            $grandTotal = 0;
        @endphp
        @foreach($totalDeliveryCharges as $totalDeliveryCharge)
            <th>{{number_format($totalDeliveryCharge['total_delivery_charge'])}}</th>
            @php
                $grandTotal +=$totalDeliveryCharge['total_delivery_charge']
            @endphp
        @endforeach
        <th>
            {{number_format($grandTotal)}}
        </th>
    </tr>
    </tbody>
</table>
</body>
</html>



