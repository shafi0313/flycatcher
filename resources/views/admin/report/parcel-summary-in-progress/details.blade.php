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
    <table style="border: 2px solid #ddd;">

        <thead>
            <tr>
                <td><b># </b></td>
                <td><b>Tracking Id</b></td>
                <td><b>Invoice Id</b></td>
                <td><b>Merchant</b></td>
                <td><b>Booking Date</b></td>
                <td><b>Price (TK)</b></td>
                <td><b>Collection Amount (TK)</b></td>
                <td><b>DC(TK)</b></td>
                <td><b>Status</b></td>
                <td><b>Delivery Status</b></td>
                <td><b>Rider</b></td>
                <td><b>Rider Number</b></td>
                <td><b>Last Modify</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($parcels as $parcel)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $parcel->tracking_id }}</td>
                <td>{{ $parcel->invoice_id }}</td>
                <td>{{ $parcel->merchant->name }}</td>
                <td>{{ $parcel->added_date }}</td>
                <td>{{ $parcel->collection_amount }}</td>
                <td>{{ $parcel->collection->amount ?? '-' }}</td>
                <td>{{ $parcel->delivery_charge }}</td>
                <td>{{ $parcel->status }}</td>
                <td>{{ $parcel->delivery_status }}</td>
                <td>{{ $parcel->rider->name }}</td>
                <td>{{ $parcel->rider->mobile }}</td>
                <td>{{\Carbon\Carbon::parse($parcel->updated_at)->format('F j, Y, g:i a')}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>
