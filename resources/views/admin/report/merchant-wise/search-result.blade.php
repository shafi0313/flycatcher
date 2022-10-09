<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcels ({{ count($parcels) }})</h4>
    </div>
    <form action="{{route('admin.merchant-wise-parcel-print')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body">
            @if(count($parcels) > 0)

            <table class="table table-border">
                <thead>
                    <tr class="text-center">
                        <th colspan="7" style="background-color:#a9611d;color:#fff">Parcel Details</th>
                        <th colspan="2" style="background-color:#28c76f;color:#fff">Collection Details</th>
                    </tr>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>Merchant</th>
                        <th>ID / Number</th>
                        <th>Price(TK)</th>
                        <th>Merchant Pay</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Merchant Payment Status</th>
                        <th>collection Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parcels as $parcelData)
                    <tr>
                        <td class="tc">
                            <input class="checkSingle" style="width: 20px; height: 20px;" type="hidden" value="{{  $parcelData->id }}" id="" name="parcelIds[]" checked>
                            {{$loop->iteration}}

                        </td>
                        <td>
                            <p>{{$parcelData->merchant->name}}</p>
                        </td>
                        <td>
                            <p><b>Tracking ID: </b> {{ $parcelData->tracking_id }}</p>
                            <p><b>Invoice Number: </b> {{ $parcelData->invoice_id }}</p>
                        </td>

                        <td>
                            <p><b>Parcel Price(TK): </b>{{ number_format($parcelData->collection_amount) }}</p>
                            <p><b>Delivery Charge(TK): </b>{{ number_format($parcelData->delivery_charge) }}</p>
                            <p><b>Cod(TK): </b> {{ number_format($parcelData->cod) }}</p>
                        </td>
                        <td class="text-right">{{ number_format($parcelData->collection_amount - $parcelData->delivery_charge - $parcelData->cod) }}</td>
                        <td class="">{{ $parcelData->status}}</td>
                        <td>
                            {{ Carbon\Carbon::parse($parcelData->added_date)->format('d M Y') }}
                        </td>
                        <td>
                            @if(isset($parcelData->collection))
                            <p><b>{{ucfirst($parcelData->collection->merchant_paid) ??'' }} </b></p>
                            @if(isset($parcelData->collection->merchant_paid_time))
                            <p>({{ \Carbon\Carbon::parse($parcelData->collection->merchant_paid_time)->format('l jS \\of F Y')}})</p>
                            @endif
                            @else
                            <p>No Collection </p>
                            @endif
                        </td>
                        <td>
                            {{$parcelData->collection->note ??''}}
                        </td>
                    </tr>
                    @endforeach
                    <input type="hidden" name="merchant_id" value="{{ $parcelData->merchant_id }}" id="merchant_id">
                </tbody>
            </table>
            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Print</button>
            @else
            <p>Not found</p>
            @endif
        </div>

    </form>
</div>