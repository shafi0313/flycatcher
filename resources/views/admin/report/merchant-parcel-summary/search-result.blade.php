<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Merchant With Parcel List</h4>
    </div>
    <form action="{{route('admin.merchant.parcel.summary.print')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body">
            <input type="hidden" name="start_date" value="{{$start_date}}">
            <input type="hidden" name="end_date" value="{{$end_date}}">
            @if(count($merchants) > 0)
            <table class="table table-bordered">
                <tbody>
                    @foreach($merchants as $merchant)
                    @php
                    $parcels = \App\Models\Parcel::with('sub_area')->where(['merchant_id'=>$merchant->id])->whereBetween('added_date', [$start_date, $end_date])->get();
                    @endphp
                    @if(count($parcels)>0)
                    <tr>
                        <td>
                            <p class="text-center"><b>{{$loop->iteration}}. Name: </b>{{$merchant->name}}</p>
                            <p class="text-center"><b>Mobile: </b>{{$merchant->mobile}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3><b>Total Parcel= </b>{{count($parcels)}}</h3>
                            <table class="table table-bordered table-secondary table-striped">
                                <theead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Tracking Id</th>
                                        <th>Invoice Id</th>
                                        <th>Amount (TK)</th>
                                        <th>Area</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </theead>
                                <tbody>
                                    @php
                                    $sub_total=0;
                                    @endphp
                                    @foreach($parcels as $parcel)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{route('admin.parcel.show', $parcel->id)}}" target="_blank">{{$parcel->tracking_id}}</a></td>
                                        <td>{{$parcel->invoice_id}}</td>
                                        <td class="text-right">{{number_format($parcel->collection_amount)}}</td>
                                        <td>{{$parcel->sub_area->name ??''}}</td>
                                        <td>{{ Carbon\Carbon::parse($parcel->added_date)->format('d-M-Y') }}</td>
                                        <td>{{str_replace('_', ' ', ucfirst($parcel->status))}}</td>
                                    </tr>
                                    @php
                                    $sub_total+=$parcel->collection_amount;
                                    @endphp
                                    @endforeach()
                                    <tr class="bg-success">
                                        <td colspan="3" class="text-right">Total Amount (TK)</td>
                                        <td class="text-right">{{number_format($sub_total) }}</td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endif
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