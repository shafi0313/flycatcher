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
<table style="border: 2px solid #fff;">

</table>
<br>
<table class="table">
    <thead>
    <tr>
        <th scope="col"></th>
        <th>Merchant</th>
        <th>Rider</th>
        <th>Tracking ID</th>
        <th>Invoice Number</th>
        <th>Parcel Price</th>
        <th>Collection</th>
        <th>Delivery Charge</th>
        <th>Cod</th>
        <th>Payable</th>
        <th>Status</th>
        <th>Currently payment stay</th>
    </tr>
    </thead>
    <tbody>
    @foreach($collections as $collection)
        <tr>
            <td scope="row">
                {{$loop->iteration}}
            </td>
            <td>
                {{$collection->merchant->name}}
            </td>
            <td>
                {{$collection->rider->name}}
            </td>
            <td class="text-center">{{ $collection->parcel->tracking_id }}</td>
            <td class="text-center">{{ $collection->parcel->invoice_id }}</td>

            <td class="text-center">
                {{ number_format($collection->parcel->collection_amount) }}
            </td>
            <td>
                {{number_format($collection->amount) }}
            </td>
            <td>
                {{number_format($collection->delivery_charge) }}
            </td>
            <td>
                {{number_format($collection->cod_charge) }}
            </td>

            <td>
                {{number_format($collection->net_payable) }}
            </td>

            <td>
                {{str_replace('_', ' ', ucfirst($collection->parcel->status))}}
            </td>

            <td>
                @if(is_null($collection->incharge_collected_by))
                    Rider
                @elseif(is_null($collection->accounts_collected_by))
                    Incharge
                @elseif($collection->merchant_paid === 'unpaid')
                    Accounts
                @else
                    Merchant
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

</body>

</html>
