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
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc" style="font-size: 10px;">
                <p class="card-text mb-25"><b>Address :</b> House#181/182,Block C, Section 6,Mirpur Dhaka, Bangladesh</p>
                <p style="font-size: 12px;"><b>Emergency Contact:</b> +880198-997711</p>
            </td>
        </tr>
    </table>
    <?php
    $totalInRider = $pendingInRider + $transitInRider + $transferInRider + $holdInRider + $partialInRider + $exchangeInRider + $cancelledInRider;
    ?>
    <br>
    <table style="border: 2px solid #ddd;">

        <thead>
            <tr>
                <td><b>Status</b></td>
                <td><b>Number</b></td>
                <td><b>Remark</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Pending
                </td>
                <td>{{ $pendingInRider }}</td>
            </tr>

            <tr>
                <td>
                    Transit
                </td>
                <td>{{ $transitInRider }}</td>
            </tr>

            <tr>
                <td>
                    Transfer
                </td>
                <td>{{ $transferInRider }}</td>
            </tr>
            <tr>
                <td>
                    Hold In Rider

                </td>
                <td>{{ $holdInRider }}</td>
            </tr>
            <tr>
                <td>

                    Partial In Rider

                </td>
                <td>{{ $partialInRider }}</td>
            </tr>
            <tr>
                <td>

                    Exchange In Rider

                </td>
                <td>{{ $exchangeInRider }}</td>
            </tr>
            <tr>
                <td>

                    Cancelled In Rider

                </td>
                <td>{{ $cancelledInRider }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{ $totalInRider }}</td>
            </tr>
        </tbody>

    </table>

</body>

</html>