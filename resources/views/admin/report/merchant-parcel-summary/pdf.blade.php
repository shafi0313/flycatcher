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
            padding-left: 5px;
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
                <br>
                <br>
                <p style="font-size: 14px;"><b>Date Range:</b> {{$start_date}} - {{$end_date}}</p>
            </td>
        </tr>
    </table>

    <br>
    @foreach($merchants as $merchant)
    @php
    $parcels = \App\Models\Parcel::with('sub_area')->where('merchant_id',$merchant->id)->whereBetween('added_date', [$start_date, $end_date])->get();
    @endphp
    @if(count($parcels)>0)
    <table style="border: 2px solid #fff;">
        <tbody>

            <tr>
                <td>
                    <p class="text-center"><b>{{$loop->iteration}}. Name: </b>{{$merchant->name}}</p>
                    <p class="text-center"><b>Mobile: </b>{{$merchant->mobile}}</p>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="border: 2px solid #ddd;">
        <tr>
            <th style="width: 20;">#</th>
            <th style="width: 200;">Tracking Id</th>
            <th style="width: 200;">Merchant</th>
            <th style="width: 100;">Invoice ID</th>
            <th style="width: 100;">Amount (TK)</th>
            <th style="width: 100;">Status</th>
            <th style="width: 100;">Date</th>
            <th>Note</th>
        </tr>

        @foreach($parcels as $parcel)
        <tr>
            <td class="tc">{{$loop->iteration}}</td>


            <td class="tc">
                {{$parcel->tracking_id}}
            </td>
            <td>
                <p>{{$parcel->merchant->name ??''}}</p>

            </td>
            <td class="tc">
                {{$parcel->invoice_id}}
            </td>
            <td class="tc">{{number_format($parcel->collection_amount)}}</td>
            <td class="tc">
                {{$parcel->status}}
            </td>
            <td class="tc">{{ Carbon\Carbon::parse($parcel->added_date)->format('d-M-Y') }}</td>
            <td>
                {{$parcel->note}}
            </td>
        </tr>
        @endforeach
    </table>
    @endif
    @endforeach
</body>

</html>
