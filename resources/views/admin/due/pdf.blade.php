<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merchant Due List</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
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

        .row_title {
            font-size: 14px;
            font-weight: bold;
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
                <p class="card-text mb-25">Address : Block C, Section C, House 181/182</p>
                <p class="card-text mb-25">Mirpur Dhaka, Bangladesh</p>
                <p class="card-text mb-0">+8801777873960</p>
            </td>
        </tr>
    </table>
    <h4>Due Information</h4>
    @php
    $gdt=0;
    $dct=0;
    $tc=0;
    @endphp
    <table style="border: 2px solid #000;">
        <tr class="bb">
            <th class="tl bb">#</th>
            <th class="tl bb">Merchant Info</th>
            <th class="tl bb">Collection (TK)</th>
            <th class="tl bb">Delivery Charge (TK)</th>
            <th class="tl bb">Due Amount (TK)</th>
        </tr>
        @foreach($dueList as $list)
        <tr>
            <td class="tl bb">{{$loop->iteration }}</td>
            <td class="tl bb">
                <p><b>Name:</b> {{$list->merchant->name}}</p>
                <p><b>Mobile:</b> {{$list->merchant->mobile}}</p>
            </td>
            <td class="tr bb" style="padding: 5px">{{number_format($list->total_collection)}}</td>
            <td class="tr bb" style="padding: 5px">{{number_format($list->total_delivery_charge)}}</td>
            <td class="tr bb" style="padding: 5px">{{number_format($list->total_due)}}</td>


        </tr>
        @php
        $dct=$dct+$list->total_delivery_charge;
        $gdt=$gdt+$list->total_due;
        $tc=$tc+$list->total_collection;
        @endphp
        @endforeach
        <tr>
            <td class="tl bb row_title" colspan="2">
                Total
            </td>
            <td class="tr bb row_title" style="padding: 5px">{{number_format($tc)}}</td>
            <td class="tr bb row_title" style="padding: 5px">{{number_format($dct)}}</td>
            <td class="tr bb row_title" style="padding: 5px">{{number_format($gdt)}}</td>
        </tr>
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
