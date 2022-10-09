<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$invoice->invoice_number ?? 'Invoice' }} </title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table,
        .table td,
        .table th {
            border: 1px solid #08010C;
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
                    <p style="font-size: 20px;">Parcelsheba Limited</p>
                </td>
            </tr>
            <tr>
                <td class="tc" style="font-size: 10px;">
                    <p class="card-text mb-25">Address : Block C, Section C, House 181/182,Mirpur Dhaka, Bangladesh</p>
                    <p class="card-text mb-0">Hotline: +8801777873960</p>
                </td>
            </tr>
        </table>
    </htmlpageheader>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc bb-none">
                <p style="font-size: 12px;" class="tc"><b>INVOICE NO#</b> {{$invoice->invoice_number}}</p>
            </td>
            <td class="tr bb-none">
                @php
                $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                @endphp
                <strong>
                    Printing Time:- {{ $date->format('F j, Y, g:i a') }}
                </strong>
            </td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td><b>Merchant Name:</b> {{$invoice->merchant->name}}</td>
            <td><b>Merchant Mobile:</b> {{$invoice->merchant->mobile}}</td>
            <td><b>Date:</b> {{date('d M Y', strtotime($invoice->created_at))}}</td>
        </tr>
    </table>
    <h4 style="margin: 2px;"></h4>
    <table class="table">
        <tr class="bb">
            <th class="tc bb">#</th>
            <th class="tc bb">Tracking id</th>
            <th class="tc bb">Area</th>
            <th class="tc bb">Status</th>
            <th class="tc bb">Customer mobile</th>
            <th class="tc bb">Date</th>
            <th class="tc bb">Invoice id</th>
            <th class="tc bb">Parcel Price (TK)</th>
            <th class="tc bb">Collection Amount (TK)</th>
            <th class="tc bb">Cod(TK)</th>
            <th class="tc bb">Delivery Charge (TK)</th>
            <th class="tc bb">Payable (TK)</th>
            <th class="tc bb">Note</th>
        </tr>
        @foreach($invoice->invoiceItems as $item)
        <tr>
            <td class="tc bb">{{$loop->iteration }}</td>
            <td class="tc bb">{{$item->parcel->tracking_id}}</td>
            <td class="tc bb">{{$item->parcel->sub_area->name ??''}}({{$item->parcel->sub_area->code ??''}})</td>
            <td class="tc bb">{{ucfirst($item->parcel->status)}}</td>
            <td class="tc bb">{{$item->parcel->customer_mobile}}</td>
            <td class="tc bb">{{date('d-M-Y',strtotime($item->parcel->created_at))}}</td>
            <td class="tc bb">{{$item->parcel->invoice_id}}</td>
            <td class="tr bb">{{$item->parcel->collection_amount}}</td>
            <td class="tr bb">{{$item->collection->amount}}</td>
            <td class="tr bb">{{number_format($item->parcel->cod_charge)}}</td>
            <td class="tr bb">{{number_format($item->parcel->delivery_charge)}}</td>
            <td class="tr bb">{{number_format($item->collection->net_payable)}}</td>
            <td class="bb">{{$item->parcel->collection->note ??''}}</td>

        </tr>
        @endforeach
        <tr style="border: 2px solid green;">
            <td class="pr-1" colspan="7">Total</td>
            <td style="text-align: right;">
                ={{number_format($invoice->total_parcel_price)}}
            </td>
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
        <!-- <tr>

            <td class="pr-1" colspan="2">Total Cod</td>

            <td style="text-align: right;">{{$invoice->total_cod?? 0}}</td>
        </tr>
        <tr>

            <td class="pr-1" colspan="2">Total Delivery Charge</td>

            <td style="text-align: right;">{{$invoice->total_delivery_charge?? 0}}</td>
        </tr>
        <tr>

            <td class="pr-1" colspan="2">Invoice Total</td>

            <td style="text-align: right;">{{$invoice->total_collection_amount - $invoice->total_delivery_charge -$invoice->total_cod }}</td>
        </tr> -->
    </table>

    <br>
    <br>

    <htmlpagefooter name="page-footer">
        <table style="border: none;">
            <tr>
                <td class="tc"><b>Merchant Signature</b><br>(Signature & Date)</td>
                <td class="tc"><b>Manager (Accounts)</b><br>(Signature & Date)</td>
            </tr>
        </table>
    </htmlpagefooter>
</body>

</html>