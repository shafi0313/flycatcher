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
            <td><b>Receiver Name:</b> {{$invoice->prepare_for->name}}</td>
            <td><b>Receiver Mobile:</b> {{$invoice->prepare_for->mobile}}</td>
            <td><b>Date:</b> {{date('d M Y', strtotime($invoice->created_at))}}</td>
        </tr>
    </table>
    <h4 style="margin: 2px;"></h4>
    <table class="table">
        <tr>
            <th class="tc bb" colspan="5">Parcel</th>
            <th class="tc bb align-middle" rowspan="2">Amount (TK)</th>
        </tr>
        <tr>
            <th class="bb">Delivered Parcel</th>
            <th class="bb">Partial Delivered Parcel</th>
            <th class="bb">Exchange Delivered Parcel</th>
            <th class="bb">Cancle Parcel</th>
            <th class="bb">Total Parcel</th>

        </tr>

        <tr>
            <td class="tr">
                <?php
                $delivered = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'delivered') {
                        $delivered = $delivered + 1;
                    }
                }
                ?>
                {{ $delivered }}
            </td>
            <td class="tr">
                <?php
                $partial = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'partial') {
                        $partial = $partial + 1;
                    }
                }
                ?>
                {{ $partial }}
            </td>
            <td class="tr">
                <?php
                $exchange = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'exchange') {
                        $exchange = $exchange + 1;
                    }
                }
                ?>
                {{ $exchange }}
            </td>
            <td class="tr">
                <?php
                $cancelled = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'cancelled') {
                        $cancelled = $cancelled + 1;
                    }
                }
                ?>
                {{ $cancelled }}
            </td>
            <td class="tr">
                {{ $invoice->invoiceItems->count() }}
            </td>
            <td class="tr">
                {{$invoice->total_collection_amount}}/=
            </td>

        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="border: none;">
        <tr>
            <td class="tc"><b>MD Sir(Managing Director)</b><br>(Signature & Date)</td>
            <td class="tc"><b>Accountant(Accounts)</b><br>(Signature & Date)</td>
            <td class="tc"><b>Incharge (Operation)</b><br>(Signature & Date)</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

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
            <td><b>Receiver Name:</b> {{$invoice->prepare_for->name}}</td>
            <td><b>Receiver Mobile:</b> {{$invoice->prepare_for->mobile}}</td>
            <td><b>Date:</b> {{date('d M Y', strtotime($invoice->created_at))}}</td>
        </tr>
    </table>
    <h4 style="margin: 2px;"></h4>
    <table class="table">
        <tr>
            <th class="tc bb" colspan="5">Parcel</th>
            <th class="tc bb align-middle" rowspan="2">Amount (TK)</th>
        </tr>
        <tr>
            <th class="bb">Delivered Parcel</th>
            <th class="bb">Partial Delivered Parcel</th>
            <th class="bb">Exchange Delivered Parcel</th>
            <th class="bb">Cancle Parcel</th>
            <th class="bb">Total Parcel</th>

        </tr>

        <tr>
            <td class="tr">
                <?php
                $delivered = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'delivered') {
                        $delivered = $delivered + 1;
                    }
                }
                ?>
                {{ $delivered }}
            </td>
            <td class="tr">
                <?php
                $partial = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'partial') {
                        $partial = $partial + 1;
                    }
                }
                ?>
                {{ $partial }}
            </td>
            <td class="tr">
                <?php
                $exchange = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'exchange') {
                        $exchange = $exchange + 1;
                    }
                }
                ?>
                {{ $exchange }}
            </td>
            <td class="tr">
                <?php
                $cancelled = 0;
                foreach ($invoice->invoiceItems as $item) {
                    if ($item->parcel->status === 'cancelled') {
                        $cancelled = $cancelled + 1;
                    }
                }
                ?>
                {{ $cancelled }}
            </td>
            <td class="tr">
                {{ $invoice->invoiceItems->count() }}
            </td>
            <td class="tr">
                {{$invoice->total_collection_amount}}/=
            </td>

        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="border: none;">
        <tr>
            <td class="tc"><b>MD Sir(Managing Director)</b><br>(Signature & Date)</td>
            <td class="tc"><b>Accountant(Accounts)</b><br>(Signature & Date)</td>
            <td class="tc"><b>Incharge (Operation)</b><br>(Signature & Date)</td>
        </tr>
    </table>
</body>

</html>