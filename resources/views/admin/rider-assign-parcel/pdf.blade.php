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
                    <p style="font-size: 18px;">Flycatcher Xpress Limited</p>
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
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style=" text-align: center;"><b>Name:</b> {{$riderInfo->name}} <b> Mobile:</b> {{$riderInfo->mobile}} <b> Area :</b>

                @foreach ($riderInfo->assign_areas as $row)
                <span style="background: #ddd;border-radius: 25px;">{{ $row->sub_area->name ?? ''}} ({{ $row->sub_area->code ?? ''}})</span>
                @endforeach
            </td>

        </tr>
    </table>
    <br>
    <table style="border: 2px solid #ddd;">
        <tr>
            <th style="width: 20px;">#</th>
            <th style="width: auto;">Customer Details</th>
            <th style="width: 180px;">Merchant Details</th>
            <th style="width: 90px;">Tracking ID</th>
            <th style="width: 80px;">Invoice ID</th>
            <th style="width: 100px;">Amount (TK)</th>
            <th style="width: 70px;">Date</th>
            <th style="width: 100px">Note</th>
        </tr>

        @foreach($parcels as $parcel)
        <tr>
            <td class="tc">{{$loop->iteration}}</td>
            <td>
                <p><b>Name: </b>{{$parcel->customer_name}}</p>
                <p><b>Mobile: </b>{{$parcel->customer_mobile}}</p>
                <p><b>Address: </b>{{$parcel->customer_address}}</p>
            </td>
            <td>
                <p>{{$parcel->merchant->name}}</p>
                <p>{{$parcel->merchant->mobile}}</p>
            </td>
            <td class="tc">
                {{$parcel->tracking_id}}
            </td>
            <td class="tc">
                {{$parcel->invoice_id}}
            </td>
            <td class="tc">{{number_format($parcel->collection_amount)}}</td>
            <td class="tc">
                {{$parcel->created_at->format('d-m-Y')}}<br>
                {{$parcel->created_at->format('h-i A')}}
            </td>
            <td>
                {{$parcel->note}}
            </td>
        </tr>
        @endforeach
    </table>
    <htmlpagefooter name="page-footer">
        @php
        $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        @endphp
        <br>
        <strong>
            Printing Time:- {{ $date->format('F j, Y, g:i a') }}
        </strong>
    </htmlpagefooter>

</body>

</html>
