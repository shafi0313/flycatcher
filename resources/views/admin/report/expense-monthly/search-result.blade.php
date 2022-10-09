<div class="card">
    <div class="card-header">
        <form action="{{route('admin.monthly-expense-report-print')}}" method="POST" target="_blank">
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
                <th>Expense Head / Date</th>
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
                @endif
            @endforeach
            <tr>
                <th>TOTAL</th>
                @php
                $grandTotal = 0;
                @endphp
                @foreach($totalAmounts as $totalAmount)
                    <th>{{number_format($totalAmount['total_amount'])}}</th>
                    @php
                        $grandTotal +=$totalAmount['total_amount']
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