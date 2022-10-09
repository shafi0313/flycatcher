@php
    $totalPayableForMerchant = 0;
@endphp
<div class="card">
    <div class="card-header"><h4 class="text-center">Still Not Collected Summary</h4></div>
    <div class="card-body">
{{--        <table class="table table-bordered">--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <th>Total Parcel Price</th>--}}
{{--                <td>{{number_format($totalParcelPrice)}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Delivery Charge</th>--}}
{{--                <td>{{number_format($totalDeliveryCharge)}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total COD Charge</th>--}}
{{--                <td>{{number_format($totalCodCharge)}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Collected Amount</th>--}}
{{--                <td>{{$totalCollectedAmount}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Collected Delivery Charge</th>--}}
{{--                <td>{{$totalCollectedDeliveryCharge}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total COD Charge</th>--}}
{{--                <td>{{$totalCollectedCODCharge}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Net Payable</th>--}}
{{--                <td>{{$totalNetPayable}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Not Collected Amount</th>--}}
{{--                <td>{{$totalNotCollectedAmount}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Total Not Collected Delivery Charge</th>--}}
{{--                <td>{{$totalNotCollectedDeliveryCharge}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th>Already Paid</th>--}}
{{--                <td>{{$totalPaidForMerchant}}</td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th></th>
                <th>Number of Records</th>
                <th>Parcel Price</th>
                <th>Delivery Charge</th>
                <th>Parcel COD</th>
            </tr>
            <tr>
                <th>
                    <a href="{{route('admin.merchant-wise-due.status.show', ['status'=>'pending', 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">Pending</a>
                </th>
                <td>{{$countPendingParcel}}</td>
                <td>{{number_format($totalPendingAmount)}}</td>
                <td>{{number_format($totalPendingDeliveryCharge)}}</td>
                <td>{{number_format($totalPendingCodCharge)}}</td>
            </tr>

            <tr>
                <th>
                    <a href="{{route('admin.merchant-wise-due.status.show', ['status'=>'transit', 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">Transit</a>
                </th>
                <td>{{$countTransitParcel}}</td>
                <td>{{number_format($totalTransitAmount)}}</td>
                <td>{{number_format($totalTransitDeliveryCharge)}}</td>
                <td>{{number_format($totalTransitCodCharge)}}</td>
            </tr>

            <tr>
                <th>
                    <a href="{{route('admin.merchant-wise-due.status.show', ['status'=>'hold', 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">Hold
                        In Rider</a></th>
                <td>{{$countHoldInRiderParcel}}</td>
                <td>{{number_format($totalHoldInRiderAmount)}}</td>
                <td>{{number_format($totalHoldInRiderDeliveryCharge)}}</td>
                <td>{{number_format($totalHoldInRiderCodCharge)}}</td>
            </tr>

            <tr>
                <th>
                    <a href="{{route('admin.merchant-wise-due.status.show', ['status'=>'hold_accept_by_incharge', 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">Hold
                        In Office</a></th>
                <td>{{$countHoldInOfficeParcel}}</td>
                <td>{{number_format($totalHoldInOfficeAmount)}}</td>
                <td>{{number_format($totalHoldInOfficeDeliveryCharge)}}</td>
                <td>{{number_format($totalHoldInOfficeCodCharge)}}</td>
            </tr>

            <tr>
                <th>
                    <a href="{{route('admin.merchant-wise-due.status.show', ['status'=>'transfer', 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">Transfer</a>
                </th>
                <td>{{$countTransferParcel}}</td>
                <td>{{number_format($totalTransferAmount)}}</td>
                <td>{{number_format($totalTransferDeliveryCharge)}}</td>
                <td>{{number_format($totalTransferCodCharge)}}</td>
            </tr>
            <tr>
                <th>Total</th>
                <th>{{$countPendingParcel+$countTransitParcel+$countHoldInRiderParcel+$countHoldInOfficeParcel+$countTransferParcel}}</th>
                <th>{{number_format($totalNotCollectedAmount)}}</th>
                <th>{{number_format($totalNotCollectedDeliveryCharge)}}</th>
                <th>{{number_format($totalNotCollectedCod)}}</th>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header"><h4 class="text-center">Collection Summery</h4></div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>Incharge or Rider</th>
                <th>Name</th>
                <th>Collected Amount</th>
                <th>Collected Delivery Charge</th>
                <th>Collected COD</th>

                <th>Paid Amount</th>
                <th>Paid Delivery Charge</th>
                <th>PaidParcel COD</th>

                <th>Unpaid Amount</th>
                <th>Unpaid Delivery Charge</th>
                <th>UnpaidParcel COD</th>
            </tr>
            @foreach($riders as $key=>$rider)
                <tr>
                    @if ($key == 0 || $key % count($riders) == 0)
                        <td rowspan="{{count($riders)}}">Rider</td>
                    @endif
                    <td>
                        <a href="{{route('admin.merchant-wise-due.rider.show', ['rider_id'=>$rider->id, 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">{{$rider->name}}</a>
                    </td>
                    <td>{{number_format($rider->totalCollectedAmount)}}</td>
                    <td>{{number_format($rider->totalCollectedDeliveryCharge)}}</td>
                    <td>{{number_format($rider->TotalCollectedCodCharge)}}</td>

                    <td>{{number_format($rider->totalPaidAmount)}}</td>
                    <td>{{number_format($rider->totalPaidDeliveryCharge)}}</td>
                    <td>{{number_format($rider->TotalPaidCodCharge)}}</td>

                    <td>{{number_format($rider->totalUnpaidAmount)}}</td>
                    <td>{{number_format($rider->totalUnpaidDeliveryCharge)}}</td>
                    <td>{{number_format($rider->TotalUnpaidCodCharge)}}</td>
                </tr>
            @endforeach

            @foreach($incharges as $key=>$admin)
                <tr>
                    @if ($key == 0 || $key % count($incharges) == 0)
                        <td rowspan="{{count($incharges)}}">Incharge</td>
                    @endif
                    <td>
                        <a href="{{route('admin.merchant-wise-due.admin.show', ['admin_id'=>$admin->id, 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">{{$admin->name}}</a>
                    </td>
                    <td>{{number_format($admin->totalCollectedAmountForIncharge)}}</td>
                    <td>{{number_format($admin->totalCollectedDeliveryChargeForIncharge)}}</td>
                    <td>{{number_format($admin->TotalCollectedCodChargeForIncharge)}}</td>

                    <td>{{number_format($admin->totalPaidAmountForIncharge)}}</td>
                    <td>{{number_format($admin->totalPaidDeliveryChargeForIncharge)}}</td>
                    <td>{{number_format($admin->TotalPaidCodChargeForIncharge)}}</td>

                    <td>{{number_format($admin->totalUnpaidAmountForIncharge)}}</td>
                    <td>{{number_format($admin->totalUnpaidDeliveryChargeForIncharge)}}</td>
                    <td>{{number_format($admin->TotalUnpaidCodChargeForIncharge)}}</td>
                </tr>
            @endforeach

            @foreach($accountants as $key=>$account)
                <tr>
                    @if ($key == 0 || $key % count($accountants) == 0)
                        <td rowspan="{{count($accountants)}}">Accounts</td>
                    @endif
                    <td>
                        <a href="{{route('admin.merchant-wise-due.account.show', ['accountant_id'=>$account->id, 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}" target="_blank">{{$account->name}}</a>
                    </td>
                        <td>{{number_format($account->totalCollectedAmountForAccountant)}}</td>
                        <td>{{number_format($account->totalCollectedDeliveryChargeForAccountant)}}</td>
                        <td>{{number_format($account->TotalCollectedCodChargeForAccountant)}}</td>

                        <td>{{number_format($account->totalPaidAmountForAccountant)}}</td>
                        <td>{{number_format($account->totalPaidDeliveryChargeForAccountant)}}</td>
                        <td>{{number_format($account->TotalPaidCodChargeForAccountant)}}</td>

                        <td>{{number_format($account->totalUnpaidAmountForAccountant)}}</td>
                        <td>{{number_format($account->totalUnpaidDeliveryChargeForAccountant)}}</td>
                        <td>{{number_format($account->TotalUnpaidCodChargeForAccountant)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        <h4 class="card-title">Search Parcel List</h4>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        @if(count($parcels) > 0)--}}
{{--            <table class="table table-bordered">--}}
{{--                <theead>--}}
{{--                    <tr>--}}
{{--                        <th>SL No</th>--}}
{{--                        <th>Tracking Id</th>--}}
{{--                        <th>Invoice Id</th>--}}
{{--                        <th>Parcel amount</th>--}}
{{--                        <th>Delivery Charge</th>--}}
{{--                        <th>Cod</th>--}}

{{--                        <th>Collected Amount</th>--}}
{{--                        <th>Collected Delivery Charge</th>--}}
{{--                        <th>Collected Cod</th>--}}

{{--                        <th>Collected ?</th>--}}

{{--                        <th>Payable to merchant</th>--}}

{{--                        <th>Status</th>--}}
{{--                    </tr>--}}
{{--                </theead>--}}
{{--                <tbody>--}}

{{--                @foreach($parcels as $parcel)--}}
{{--                    <tr>--}}
{{--                        <td>{{$loop->iteration}}</td>--}}
{{--                        <td>{{$parcel->tracking_id}}</td>--}}
{{--                        <td>{{$parcel->invoice_id}}</td>--}}
{{--                        <td>--}}
{{--                            {{number_format($parcel->collection_amount)}}--}}
{{--                        </td>--}}
{{--                        <td>{{number_format($parcel->delivery_charge)}}</td>--}}
{{--                        <td>{{number_format($parcel->cod)}}</td>--}}


{{--                        <td>--}}
{{--                            @empty($parcel->collection)--}}
{{--                                <i class="fas fa-times text-danger"></i>--}}
{{--                            @else--}}
{{--                                @php--}}
{{--                                    $totalCollectedAmount +=$parcel->collection->amount;--}}
{{--                                @endphp--}}
{{--                                {{number_format($parcel->collection->amount)}}--}}
{{--                            @endempty--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            @empty($parcel->collection)--}}
{{--                                <i class="fas fa-times text-danger"></i>--}}
{{--                            @else--}}
{{--                                {{number_format($parcel->collection->delivery_charge)}}--}}
{{--                            @endempty--}}
{{--                        </td>--}}

{{--                        <td>--}}
{{--                            @empty($parcel->collection)--}}
{{--                                <i class="fas fa-times text-danger"></i>--}}
{{--                            @else--}}
{{--                                {{number_format($parcel->collection->cod_charge)}}--}}
{{--                            @endempty--}}
{{--                        </td>--}}

{{--                        <td>--}}
{{--                            @empty($parcel->collection)--}}
{{--                                <i class="fas fa-times text-danger"></i>--}}
{{--                            @else--}}
{{--                                @if($parcel->collection->rider_collected_status === 'collected')--}}
{{--                                    Rider--}}
{{--                                @elseif($parcel->collection->incharge_collected_status === 'collected')--}}
{{--                                    Incharge--}}
{{--                                @elseif($parcel->collection->merchant_paid === 'unpaid')--}}
{{--                                    Accountant--}}
{{--                                @elseif($parcel->collection->merchant_paid === 'paid' || $parcel->collection->merchant_paid === 'received')--}}
{{--                                    Merchant--}}
{{--                                @endif--}}
{{--                            @endempty--}}
{{--                        </td>--}}

{{--                        <td>--}}
{{--                            @empty($parcel->collection)--}}
{{--                                <i class="fas fa-times text-danger"></i>--}}
{{--                            @else--}}
{{--                                @if($parcel->collection->merchant_paid === 'paid' || $parcel->collection->merchant_paid === 'received')--}}
{{--                                    <i class="fas fa-check text-primary"></i>--}}
{{--                                @else--}}
{{--                                    @php--}}
{{--                                        $payable = $parcel->collection->amount - ($parcel->collection->cod_charge + $parcel->collection->delivery_charge);--}}
{{--                                            $totalPayableForMerchant += ($parcel->collection->amount - ($parcel->collection->cod_charge + $parcel->collection->delivery_charge));--}}
{{--                                    @endphp--}}
{{--                                    {{$payable}}--}}
{{--                                @endif--}}
{{--                            @endempty--}}
{{--                        </td>--}}

{{--                        <td>{{str_replace('_', ' ', ucfirst($parcel->status))}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                <tr>--}}
{{--                    <th colspan="2">--}}
{{--                        Total:--}}
{{--                    </th>--}}
{{--                    <th colspan="2">--}}
{{--                        <p class="text-right">{{number_format($totalParcelPrice)}}</p>--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        <p>{{number_format($totalDeliveryCharge)}}</p>--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        <p>{{number_format($totalCodCharge)}}</p>--}}
{{--                    </th>--}}

{{--                    <th>--}}
{{--                        <p>{{number_format($totalCollectedAmount)}}</p>--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$totalPayableForMerchant}}--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        @else--}}
{{--            <p>Not found</p>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}
