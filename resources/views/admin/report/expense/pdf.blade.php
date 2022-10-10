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
    <table class="table table-bordered table-secondary table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Amount TK</th>
                <th>Note</th>
                <th>Created By</th>
                <th>Date & Time</th>

            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$expense->expense_head->title}}</td>
                <td class="tr">{{number_format($expense->amount)}}</td>
                <td class="tc">{{$expense->note}}</td>
                <td>{{$expense->created_admin->name}}</td>
                <td>{{$expense->created_at->format('d-m-Y')}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>

                <th colspan="2">Total</th>
                <th class="tr">{{number_format($expense_total)}}</th>
                <th colspan="3"></th>
            </tr>
        </tfoot>
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
