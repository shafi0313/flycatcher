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
                <p style="font-size: 15px;">Parcelsheba Limited</p>
            </td>
        </tr>
    </table>
</htmlpageheader>

<br>
<table class="table table-bordered table-secondary table-striped">
    <thead>
    <tr class="text-center">
        <th colspan="5" style="background-color:#a9611d;color:#fff">Advance Summary</th>
    </tr>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Advance (TK)</th>
        <th>Adjust (TK)</th>
        <th>Receivable (TK)</th>
    </tr>
    </thead>
    @php
        $totalAdvance = 0;
        $totalAdjust = 0;
        $totalReceivable = 0;
    @endphp
    <tbody>
    @foreach($advances as $advance)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$advance->guard_name === 'admin'? $advance->admin->name : $advance->rider->name}}</td>
            <td>
                {{number_format($advance->total_advance_for_specific_user)}}
                @php
                    $totalAdvance+=$advance->total_advance_for_specific_user
                @endphp
            </td>
            <td>
                {{number_format($advance->total_adjust_for_specific_user)}}
                @php
                    $totalAdjust+=$advance->total_adjust_for_specific_user
                @endphp
            </td>
            <td>
                {{number_format($advance->total_receivable_for_specific_user)}}
                @php
                    $totalReceivable+=$advance->total_receivable_for_specific_user
                @endphp
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2">Total</th>
        <th>{{number_format($totalAdvance)}}</th>
        <th>{{number_format($totalAdjust)}}</th>
        <th>{{number_format($totalReceivable)}}</th>
    </tr>
    </tfoot>
</table>

<br>

{{--<table class="table table-bordered table-secondary table-striped">--}}
{{--    <thead>--}}
{{--    <tr class="text-center">--}}
{{--        <th colspan="7" style="background-color:#a9611d;color:#fff">Rider Advance Summary</th>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Name</th>--}}
{{--        <th>Advance (TK)</th>--}}
{{--        <th>Adjust (TK)</th>--}}
{{--        <th>Receivable (TK)</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @php--}}
{{--        $totalAdvanceForRider = 0;--}}
{{--        $totalAdjustForRider = 0;--}}
{{--        $totalReceivableForRider = 0;--}}
{{--    @endphp--}}
{{--    @foreach($riderCollections as $riderCollection)--}}
{{--        <tr>--}}
{{--            <td>{{$loop->iteration}}</td>--}}
{{--            <td>{{$riderCollection->rider_name}}</td>--}}
{{--            <td>--}}
{{--                {{number_format($riderCollection->totalAdvance)}}--}}
{{--                @php--}}
{{--                    $totalAdvanceForRider+=$riderCollection->totalAdvance--}}
{{--                @endphp--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {{number_format($riderCollection->totalAdjust)}}--}}
{{--                @php--}}
{{--                    $totalAdjustForRider+=$riderCollection->totalAdjust--}}
{{--                @endphp--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {{number_format($riderCollection->totalReceivable)}}--}}
{{--                @php--}}
{{--                    $totalReceivableForRider+=$riderCollection->totalReceivable--}}
{{--                @endphp--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th colspan="2">Total</th>--}}
{{--        <th>{{number_format($totalAdvanceForRider)}}</th>--}}
{{--        <th>{{number_format($totalAdjustForRider)}}</th>--}}
{{--        <th>{{number_format($totalReceivableForRider)}}</th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
{{--</table>--}}
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

