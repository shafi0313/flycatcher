<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cash Summary</title>

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
                    <p style="font-size: 15px;">Parcelsheba Limited</p>
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

    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc bb-none br-none">
                <h4>Cash Summary</h4>
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
    <table class="table table-bordered table-secondary table-striped">
        <tbody>
            <tr class="table-warning">
                <td>Total Collection</td>
                <th class="tr">{{ number_format($totalCollection) }} TK</th>
            </tr>
            <tr class="table-warning">
                <td class="text-success">Merchant Paid</td>
                <th class="text-success tr">{{ number_format($merchant_paid) }} TK</th>
            </tr>

            <tr class="table-warning">
                <td>Delivery Charge <span class="text-primary font-weight-bolder">(+)</span></td>
                <th class="tr">{{ number_format($totalDeliveryCharge) }} TK</th>
            </tr>

            <tr>
                <td>Loan <span class="text-primary font-weight-bolder">(+)</span></td>
                <td class="tr">{{ number_format($loan) }} TK</td>
            </tr>
            <tr>
                <td>Advance <span class="text-danger font-weight-bolder">(-)</span></td>
                <td class="tr">{{ number_format($advance) }} TK</td>
            </tr>
            <tr>
                <td>Expense <span class="text-danger font-weight-bolder">(-)</span></td>
                <td class="tr">{{ number_format($expense) }} TK</td>
            </tr>
            <tr>
                <td>Bad Debt <span class="text-danger font-weight-bolder">(-)</span></td>
                <td class="tr">{{ number_format($badDebt) }} TK</td>
            </tr>
            <tr>
                <td>Cancle Collection Amount <span class="text-primary font-weight-bolder">(+)</span></td>
                <td class="tr">{{ number_format($totalcancleAmount) }} TK</td>
            </tr>
            <tr class="table-success">
                <td><b>Cash in Hand Without Merchant Payable</b> </td>
                <td class="tr">
                    <b>{{number_format($totalDeliveryCharge - ($advance + $expense + $badDebt) + $loan)}}</b> TK
                </td>
            </tr>
            <tr class="table-warning">
                <td class="text-danger">Merchant Payable <span class="text-primary font-weight-bolder">(+)</span></td>
                <th class="text-danger tr">{{ number_format($merchant_payable) }} TK</th>
            </tr>

            <tr class="table-primary">
                <td><b>Cash in Hand</b> </td>
                <td class="tr">
                    <b>{{number_format($totalDeliveryCharge - ($advance + $expense + $badDebt) + $merchant_payable + $loan + $totalcancleAmount)}}</b> TK
                </td>
            </tr>
        </tbody>
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