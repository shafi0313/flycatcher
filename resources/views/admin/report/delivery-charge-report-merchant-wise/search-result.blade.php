<div class="card">
    <div class="card-header">
        <form action="{{route('admin.merchant-wise-delivery-charge-pdf')}}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="days" value="{{$days}}">
            <input type="hidden" name="year" value="{{$year}}">
            <input type="hidden" name="month" value="{{$month}}">
            <button class="btn btn-primary">Print now</button>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-secondary table-striped">
            <thead>
            <tr>
                <th>Merchant name / Date</th>
                @for($i= 1; $i<=$days; $i++)
                    <th>{{$i}} - {{$month}}</th>
                @endfor
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deliveryChargeData as $merchant)
                @if($merchant['day_to_day_total_delivery_charge'] > 0)
                    <tr>
                        <th>{{$merchant['merchant_name']}}</th>
                        @foreach($merchant['merchant_data'] as $merchantData)
                            <th>
                                {{number_format($merchantData['delivery_charge'])}}
                            </th>
                        @endforeach
                        <th class="bg-primary text-white">
                            {{$merchant['day_to_day_total_delivery_charge']}}
                        </th>
                    </tr>
{{--                    <tr>--}}
{{--                        <th class="table-success">DC</th>--}}
{{--                        @foreach($merchant['merchant_data'] as $merchantData)--}}
{{--                            <th class="table-success">--}}
{{--                                {{number_format($merchantData['delivery_charge'])}}--}}
{{--                            </th>--}}
{{--                        @endforeach--}}
{{--                        <th class="bg-primary text-white">--}}
{{--                            {{$merchant['day_to_day_total_delivery_charge']}}--}}
{{--                        </th>--}}
{{--                    </tr>--}}
                @endif
            @endforeach
            <tr>
                <th>TOTAL</th>
                @php
                $grandTotal = 0;
                @endphp
                @foreach($totalDeliveryCharges as $totalDeliveryCharge)
                    <th>{{number_format($totalDeliveryCharge['total_delivery_charge'])}}</th>
                    @php
                        $grandTotal +=$totalDeliveryCharge['total_delivery_charge']
                    @endphp
                @endforeach
                <th>
                    {{number_format($grandTotal)}}
                </th>
            </tr>
            </tbody>
        </table>
    </div>
</div>



{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        <h4 class="card-title">Search Delivery Charge of {{ '"month name"'}}</h4>--}}
{{--    </div>--}}
{{--    <form action="{{route('admin.print-parcel-date-wise')}}" method="POST" class="" target="_blank">--}}
{{--        @csrf--}}
{{--        <div class="card-body">--}}
{{--            @if(count($collections) > 0)--}}
{{--            <div class="table-responsive">--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col"></th>--}}
{{--                        <?php--}}
{{--                        $start_date = 1;--}}
{{--                        $end_date   = 31;--}}
{{--                        for ($j = $start_date; $j <= $end_date; $j++) {--}}
{{--                            echo '<th><p style="transform: rotate(220deg)">' . $j . '</p></th>';--}}
{{--                        }--}}
{{--                        ?>--}}
{{--                        <th>Total</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    @foreach($collections as $parcelData)--}}
{{--                    <tr>--}}
{{--                      --}}
{{--                        <td>{{ $parcelData->merchant->name??''}}</td>--}}
{{--                    </tr>--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}

{{--            </table>--}}
{{--            </div>--}}
{{--            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Print</button>--}}
{{--            @else--}}
{{--            <p>Not found</p>--}}
{{--            @endif--}}
{{--        </div>--}}

{{--    </form>--}}
{{--</div>--}}
