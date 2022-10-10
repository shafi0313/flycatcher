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
            <br>
            <br>
            <p style="font-size: 14px;"><b>Date Range:</b>  {{$start_date}} - {{$end_date}}</p>
        </td>
    </tr>
</table>

<br>
<table style="border: 2px solid #ddd;">

    <thead>
    <tr>
        <td><b>Status</b></td>
        <td><b>Number</b></td>
        <td><b>Percent %</b></td>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>Pending</td>
        <td>{{$pending}}</td>
        <td>{{$pendingPercent}}</td>
    </tr>
    <tr>
        <td>Transit</td>
        <td>{{$transit}}</td>
        <td>{{$transitPercent}}</td>
    </tr>
    <tr>
        <td>Delivered</td>
        <td>{{$delivered}}</td>
        <td>{{$deliveredPercent}}</td>
    </tr>
    <tr>
        <td>Partial</td>
        <td>{{$partial}}</td>
        <td>{{$partialPercent}}</td>
    </tr>
    <tr>
        <td>Hold</td>
        <td>{{$hold}}</td>
        <td>{{$holdPercent}}</td>
    </tr>
    <tr>
        <td>Cancel</td>
        <td>{{$cancelled}}</td>
        <td>{{$cancelledPercent}}</td>
    </tr>

    <tr>
        <th>Total</th>
        <td>{{$total}}</td>
        <td>100</td>
    </tr>
    </tbody>

</table>

</body>

</html>

