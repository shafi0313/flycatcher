@if(count($parcels) > 0)
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcel List({{ count($parcels) }})</h4>
        <h4>Total Collected Amount {{number_format($totalParcelPrice)}}</h4>
    </div>
    <form action="{{route('admin.parcel.request.accept')}}" method="POST">
        @csrf
        <div class="card-body">
            <table id="dataTable" class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th>#</th>
                        <th>Customer Info</th>
                        <th>Merchant Info</th>
                        <th>Tracking ID</th>
                        <th>Invoice ID</th>
                        <th>Rider Info</th>
                        <th>Payment Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parcels as $parcel)
                    <tr>
                        <td scope="row">
                            <input class="checkSingle" style="width: 20px; height: 20px;" type="checkbox" value="{{  $parcel->id }}" id="" name="parcelIds[]" checked>
                        </td>
                        <td class="tc">{{$loop->iteration}}.</td>
                        <td>
                            <p><b>Name:</b> {{$parcel->customer_name}}</p>
                            <p><b>Mobile:</b> {{$parcel->customer_mobile}}</p>
                            <p><b>Sub Area:</b> {{$parcel->sub_area->name ?? ''}} ({{$parcel->sub_area->code ?? ''}})
                            </p>
                            <p><b>Address:</b> {{$parcel->customer_address}}</p>
                        </td>
                        <td>
                            <p><b>Name:</b> {{$parcel->merchant->name ?? ''}}</p>
                            <p><b>Mobile:</b> {{$parcel->merchant->mobile ?? ''}}</p>
                            <p><b>Area:</b> {{$parcel->merchant->area->area_name ?? ''}}
                                ({{$parcel->merchant->area->area_code ?? ''}})</p>
                            <p><b>Address:</b> {{$parcel->merchant->address ?? ''}}</p>
                        </td>
                        <td>{{$parcel->tracking_id}}</td>
                        <td>{{$parcel->invoice_id}}</td>
                        <td>
                            <p><b>Name:</b> {{$parcel->rider->name}}</p>
                            <p><b>Mobile:</b> {{$parcel->rider->mobile}}</p>
                        </td>
                        <td>
                            <p><b>Collection Amount:</b> {{$parcel->collection_amount}}</p>
                            <p><b>Delivery Charge:</b> {{$parcel->delivery_charge}}</p>
                            <p><b>COD:</b> {{$parcel->cod}}</p>
                            <p><b>Payable:</b> {{$parcel->payable}}</p>
                        </td>
                    </tr>
                    @empty
                    No data available
                    @endforelse
                </tbody>
            </table>
            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Accept Now</button>
        </div>
    </form>
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