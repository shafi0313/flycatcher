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
        </td>
    </tr>
</table>

<br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-secondary table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>Total Advance</th>
                        <td>{{number_format($advanceData['totalAdvance'])}} TK</td>
                    </tr>
                    <tr>
                        <th>Total Adjust</th>
                        <td>{{number_format($advanceData['totalAdjust'])}} TK</td>
                    </tr>

                    <tr>
                        <th>Total Receivable</th>
                        <td>{{number_format($advanceData['totalAdvance'] - $advanceData['totalAdjust'])}} TK</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<table>
    <thead>
    <tr>
        <th colspan="5">Admin Advance</th>
    </tr>
    <tr>
        <th>SL no</th>
        <th>Name</th>
        <th>Total Advance</th>
        <th>Total Adjust</th>
        <th>Receivable</th>
    </tr>
    </thead>
    <tbody>
    @php
        $x=1
    @endphp
    @foreach($admins as $admin)
        @if($admin->TotalAdvance() == 0 && $admin->TotalAdjust() ==  0 && $admin->TotalAdvance() - $admin->TotalAdjust() <= 0)
            @continue
        @else
            <tr>
                <td>{{$x++}}</td>
                <td>{{$admin->name}}</td>
                <td>{{number_format($admin->TotalAdvance())}}</td>
                <td>{{number_format($admin->TotalAdjust())}}</td>
                <td>{{number_format($admin->TotalAdvance() - $admin->TotalAdjust())}}</td>
            </tr>
        @endif
    @endforeach
    <tr class="table-warning">
        <td></td>
        <td><b>Total</b></td>
        <td><b>{{number_format($advanceData['totalAdvanceForAdmin'])}}</b></td>
        <td><b>{{number_format($advanceData['totalAdjustForAdmin'])}}</b></td>
        <td><b>{{number_format($advanceData['totalAdvanceForAdmin'] - $advanceData['totalAdjustForAdmin'])}}</b></td>
    </tr>
    </tbody>
</table>
<br>
<table>
    <thead>
    <tr>
        <th colspan="5">Rider Advance</th>
    </tr>
    <tr>
        <th>SL no</th>
        <th>Name</th>
        <th>Total Advance</th>
        <th>Total Adjust</th>
        <th>Receivable</th>
    </tr>
    </thead>
    <tbody>
    @php
    $i=1
    @endphp
    @foreach($riders as $rider)
        @if($rider->TotalAdvance()==0 && $rider->TotalAdjust()==0 && $rider->TotalAdvance() - $rider->TotalAdjust() <= 0)
            @continue
        @else
        <tr>
            <td>{{$i++}}</td>
            <td>{{$rider->name}}</td>
            <td>{{number_format($rider->TotalAdvance())}}</td>
            <td>{{number_format($rider->TotalAdjust())}}</td>
            <td>{{number_format($rider->TotalAdvance() - $rider->TotalAdjust())}}</td>
        </tr>
        @endif
    @endforeach
    <tr class="table-warning">
        <td></td>
        <td><b>Total</b></td>
        <td><b>{{number_format($advanceData['totalAdvanceForRider'])}}</b></td>
        <td><b>{{number_format($advanceData['totalAdjustForRider'])}}</b></td>
        <td><b>{{number_format($advanceData['totalAdvanceForRider'] - $advanceData['totalAdjustForRider'])}}</b></td>
    </tr>
    </tbody>
</table>
</body>

</html>

