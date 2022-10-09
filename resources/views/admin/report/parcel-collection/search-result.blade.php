<table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Tracking Id</th>
        <th>Invoice ID</th>
        <th>Date</th>
        <th>Price (TK)</th>
        <th>Collection Amount (TK)</th>
        <th>Delivery Charge (TK)</th>
        <th>Parcel Status</th>
        <th>Collection Stays</th>
    </tr>
    </thead>
    <tbody>
    @foreach($parcels as $parcel)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$parcel->tracking_id}}</td>
            <td>{{$parcel->invoice_id}}</td>
            <td>{{$parcel->added_date}}</td>
            <td>{{$parcel->collection_amount}}</td>
            <td>
                @isset($parcel->collection->amount)
                    {{number_format($parcel->collection->amount)}}
                @else
                    <i class="fas fa-times"></i>
                @endisset
            </td>
            <td>
                @isset($parcel->collection->delivery_charge)
                    {{number_format($parcel->collection->delivery_charge)}}
                @else
                    <i class="fas fa-times"></i>
                @endisset
            </td>

            <td>
               {{$parcel->status}}
            </td>

            <td>
               @isset($parcel->collection)
                    @if(is_null($parcel->collection->incharge_collected_by))
                        <div class="badge badge-danger">Rider</div>
                    @elseif(is_null($parcel->collection->accounts_collected_by))
                        <div class="badge badge-warning">Incharge</div>
                    @elseif($parcel->collection->merchant_paid === 'unpaid')
                        <div class="badge badge-primary">Accounts</div>
                    @else
                        <div class="badge badge-success">Merchant</div>
                    @endif
                @else
                    <i class="fas fa-times"></i>
                @endisset

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

