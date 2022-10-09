@if(count($parcels) > 0)
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcel List</h4>
    </div>
    
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th>#</th>
                        <th>Customer Details</th>
                        <th>Merchant Details</th>
                        <th>Tracking ID</th>
                        <th>Invoice ID</th>
                        <th>Amount (TK)</th>
                        <th>Date</th>
                        <th>Note</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parcels as $parcelData)
                    <tr>
                        <td scope="row">
                            <input class="checkSingle" style="width: 20px; height: 20px;" type="checkbox" value="{{  $parcelData->id }}" id="" name="parcelIds[]" checked>
                        </td>
                        <td class="tc">{{$loop->iteration}}.</td>
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
                            {{$parcelData->note}}
                        </td>
                        <td>
                            {{ucfirst($parcelData->status)}}
                        </td>
                    </tr>
                    @endforeach
                    <input type="hidden" name="rider_id" value="{{ $parcelData->assigning_by }}" id="search_rider_id">
                </tbody>

            </table>
            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Submit</button>
        </div>
   
</div>
@else
<div class="card">
    <div class="card-body">
        <h4 class="text-danger text-center">No data available</h4>
        <!-- <img class="mx-auto d-block" src="{{ asset('app-assets/images/404-not-found.png') }}" alt="Search Result Not Found"> -->
        <img class="mx-auto d-block" src="{{ asset('app-assets/images/no-data.svg') }}" alt="Search Result Not Found">
        <p class=" text-center"> Add new record or search with different criteria.</p>
    </div>
</div>
@endif