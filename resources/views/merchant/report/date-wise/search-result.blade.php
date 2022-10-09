<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Parcel Summery</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-secondary">
                    <tbody>
                    <tr>
                        <th>No of parcels</th>
                        <td>{{$numberOfParcel}}</td>
                    </tr>
                    <tr>
                        <th>Parcel Price</th>
                        <td>{{$totalParcelPrice}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td>{{$totalDeliveryCharge}}</td>
                    </tr>
                    <tr>
                        <th>COD charge</th>
                        <td>{{$totalCodCharge}}</td>
                    </tr>
                    <tr>
                        <th>Expected Receivable Amount</th>
                        <td>{{$totalReceivable}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Collection Summery</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-secondary">
                    <tbody>
                    <tr>
                        <th>No of parcels</th>
                        <td>{{$numberOfCollection}}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{$totalCollectedAmount}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td>{{$totalCollectedDeliveryCharge}}</td>
                    </tr>
                    <tr>
                        <th>COD charge</th>
                        <td>{{$totalCollectedCodCharge}}</td>
                    </tr>
                    <tr>
                        <th>Net Balance</th>
                        <td>{{$totalReceivedAmount}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Receivable Amount</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-secondary">
                    <tbody>
                    <tr>
                        <th>No of parcels</th>
                        <td>{{$numberOfReceivableParcel}}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{$totalReceivableAmount}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td>{{$totalReceivableDeliveryCharge}}</td>
                    </tr>
                    <tr>
                        <th>COD charge</th>
                        <td>{{$totalReceivableCodCharge}}</td>
                    </tr>
                    <tr>
                        <th>Net Balance</th>
                        <td>{{$totalReceivableAmount}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Received Summery</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-secondary">
                    <tbody>
                    <tr>
                        <th>No of parcels</th>
                        <td>{{$numberOfReceivedParcel}}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{$totalReceivedAmount}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td>{{$totalReceivedDeliveryCharge}}</td>
                    </tr>
                    <tr>
                        <th>COD charge</th>
                        <td>{{$totalReceivedCodCharge}}</td>
                    </tr>
                    <tr>
                        <th>Net Balance</th>
                        <td>{{$totalReceivedAmount}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
