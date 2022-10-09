<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcel List</h4>
    </div>
    <form action="{{route('admin.print-parcel-date-wise')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body">
            @if(count($parcels) > 0)

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th>Customer Details</th>
                        <th>Merchant Details</th>
                        <th>Tracking ID</th>
                        <th>Invoice Number</th>
                        <th>Collection Amount (TK)</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parcels as $parcelData)
                        <tr>
                            <td scope="row">
                                <input class="checkSingle" style="width: 20px; height: 20px;" type="checkbox" value="{{  $parcelData->id }}" id="" name="parcelIds[]" checked>
                            </td>
                            <td>
                                <p><b>Name: </b>{{$parcelData->customer_name}}</p>
                                <p><b>Mobile: </b>{{$parcelData->customer_mobile}}</p>
                                <p><b>Address: </b>{{$parcelData->customer_address}}</p>
                            </td>
                            <td>
                                <p><b>Name: </b>{{$parcelData->merchant->name}}</p>
                                <p><b>Mobile: </b>{{$parcelData->merchant->mobile}}</p>
                            </td>
                            <td class="text-center">{{ $parcelData->tracking_id }}</td>
                            <td class="text-center">{{ $parcelData->invoice_id }}</td>

                            <td class="text-center">{{ number_format($parcelData->collection_amount) }}</td>
                            <td>
                                <b>Date: </b>{{$parcelData->created_at->format('d:M Y')}}<br>
                                <b>Time: </b>{{$parcelData->created_at->format('H:i:s A')}}<br>
                            </td>
                            <td>
                                {{ str_replace('_', ' ', ucfirst($parcelData->status)) }}
                            </td>
                            <td>
                                {{$parcelData->note}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Print</button>
            @else
                <p>Not found</p>
            @endif
        </div>

    </form>
</div>


