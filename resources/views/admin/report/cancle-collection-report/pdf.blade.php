<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
                <p style="font-size: 15px;">Parcelsheba Limited</p>
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
<table>
    <thead>
    <tr>
    <th colspan="2"></th>
        @for($i= 1; $i<=$days; $i++)
            <th><div style="transform: rotate(20deg);">{{$i}}-{{date('M', mktime(0, 0, 0,$month))}}</div></th>
        @endfor
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deliveryData as  $key=>$rider)
        @php
            $total = 0;
        @endphp
        <tr>
            <th>{{ ++$key }}. </th>
            <th style="width: 150px; text-align: left; padding-left: 5px">{{$rider['rider_name']}}</th>
            @foreach($rider['rider_data'] as $riderData)
                <td>
                    {{$riderData['delivery']}}
                    @php
                        $total +=$riderData['delivery'];
                    @endphp
                </td>
            @endforeach
            <th class="bg-primary text-white">
                {{$total}}
            </th>
        </tr>
    @endforeach
    <tr>
        <th style="width: 150px; text-align: left; padding-left: 5px" colspan="2">Total</th>
        @php
            $i = 0;
        @endphp
        @foreach($total_daily_delivery as $totalDelivery)
            <td>{{number_format($totalDelivery['totalDelivery'])}}</td>
            @php
                $i = $i+$totalDelivery['totalDelivery'];
            @endphp
        @endforeach
        <th>{{number_format($i)}}</th>
    </tr>
    </tbody>
</table>
</body>

</html>


