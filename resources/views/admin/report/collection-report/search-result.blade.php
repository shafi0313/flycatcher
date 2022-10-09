<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Result</h4>
    </div>
    <form action="{{route('admin.collection.summary.print')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body table-responsive">
            @if(count($collections) > 0)

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th>Merchant</th>
                        <th>Rider</th>
                        <th>Tracking ID</th>
                        <th>Invoice Number</th>
                        <th>Parcel Price</th>
                        <th>Collection</th>
                        <th>Delivery Charge</th>
                        <th>Cod</th>
                        <th>Payable</th>
                        <th>Status</th>
                        <th>Currently Payment Stay</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($collections as $collection)
                        <tr>
                            <td scope="row">
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$collection->merchant->name}}
                            </td>
                            <td>
                                {{$collection->rider->name}}
                            </td>
                            <td class="text-center">{{ $collection->parcel->tracking_id??'Null' }}</td>
                            <td class="text-center">{{ $collection->parcel->invoice_id??'Null' }}</td>

                            <td class="text-center">
                                {{ number_format($collection->parcel->collection_amount?? 0) }}
                            </td>
                            <td>
                                {{number_format($collection->amount) }}
                            </td>
                            <td>
                                {{number_format($collection->delivery_charge) }}
                            </td>
                            <td>
                              {{number_format($collection->cod_charge) }}
                            </td>

                            <td>
                                {{number_format($collection->net_payable) }}
                            </td>

                            <td>
                                {{$collection->parcel->status??'Null'}}
{{--                                {{str_replace('_', ' ', ucfirst($collection->parcel->status))}}--}}
                            </td>

                            <td>
                                @if(is_null($collection->incharge_collected_by))
                                    <div class="badge badge-danger">Rider</div>
                                @elseif(is_null($collection->accounts_collected_by))
                                    <div class="badge badge-warning">Incharge</div>
                                @elseif($collection->merchant_paid === 'unpaid')
                                    <div class="badge badge-primary">Accounts</div>
                                @else
                                    <div class="badge badge-success">Merchant</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @isset($merchant_id)
                        <input type="hidden" name="merchant_id" value="{{ $merchant_id }}" id="search_rider_id">
                    @else
                        <input type="hidden" name="merchant_id" value="" id="search_rider_id">
                    @endisset

                    @isset($rider_id)
                        <input type="hidden" name="rider_id" value="{{ $rider_id }}" id="search_rider_id">
                    @else
                        <input type="hidden" name="rider_id" value="" id="search_rider_id">
                    @endisset
                    @isset($startDate)
                        <input type="hidden" name="startDate" value="{{ $startDate }}" id="search_rider_id">
                    @else
                        <input type="hidden" name="startDate" value="" id="search_rider_id">
                    @endisset
                    @isset($endDate)
                        <input type="hidden" name="endDate" value="{{ $endDate }}" id="search_rider_id">
                    @else
                        <input type="hidden" name="endDate" value="" id="search_rider_id">
                    @endisset
                    </tbody>

                </table>
                <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Print</button>
            @else
                <p>Not found</p>
            @endif
        </div>

    </form>
</div>
