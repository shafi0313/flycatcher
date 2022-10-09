<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expenses List</title>
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

<br>
<table style="border: 2px solid #ddd;">
    <tr>
        <th style="width: 20;">#</th>
        <th style="width: 200;">Title</th>
        <th style="width: 200;">Amount</th>
        <th style="width: 200;">Created and Updated By</th>
        <th style="width: 100;">Created and Updated Time</th>
        <th style="width: 100;">Note</th>
    </tr>

    @foreach($expenses as $expense)
        <tr>
            <td class="tc">{{$loop->iteration}}</td>
            <td class="tc">{{$expense->expense_head->title}}</td>
            <td class="tc">{{$expense->amount}}</td>
            <td class="">
                @isset($expense->updated_admin)
                 <p><b>Created By: </b>{{$expense->created_admin->name}}</p>
                    <P><b>Updated By</b>: {{$expense->updated_admin->name}}</P>
                @else
                <p><b>Created By: </b> {{$expense->created_admin->name}}</p>
                <p><b>Updated By</b>:</p>
                @endisset
            </td>
            <td class="tc">
                <p><b>Created Time: </b>  {{$expense->created_at}}</p>
                <p><br><b>Updated Time</b>: {{$expense->updated_at}}</p>
            </td>
            <td class="tc">{{$expense->note}}</td>
        </tr>
    @endforeach
</table>
</body>

</html>

