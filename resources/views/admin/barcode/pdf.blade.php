<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
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
    </style>
</head>

<body>
    <table border="1">
        <tr>
            <td>
                <div style="margin: 10px;padding: 10px;">
                    {!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}
                </div>
            </td>
        </tr>

    </table>
</body>

</html>