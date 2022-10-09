<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Parcel info (Tracking ID:{{$parcel->tracking_id}})</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Invoice No</td>
                            <td class="text-white">{{$parcel->invoice_id}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">City Type</td>
                            <td class="text-white">{{$parcel->cityType->name}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Area</td>
                            <td class="text-white">{{$parcel->area->area_name??''}} ({{$parcel->area->area_code??''}})</td>
                        </tr>

                        <tr>
                            <td class="text-white">Sub Area</td>
                            <td class="text-white">{{$parcel->sub_area->name??''}} ({{$parcel->sub_area->code??''}})</td>
                        </tr>

                        <tr>
                            <td class="text-white">Weight Range</td>
                            <td class="text-white">({{$parcel->weightRange->min_weight}} to {{$parcel->weightRange->max_weight}}) KG</td>
                        </tr>

                        <tr>
                            <td class="text-white">Parcel Type</td>
                            <td class="text-white">{{ucfirst($parcel->parcelType->name ?? '')}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Additional Note</td>
                            <td class="text-white">{{$parcel->note}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Status</td>
                            <td class="text-white">{{str_replace('_', ' ', ucfirst($parcel->status))}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Return Product</td>
                            <td class="text-white">{{$parcel->return_product}}</td>
                        </tr>

                        @if($parcel->status === 'hold')
                        <tr>
                            <td class="text-white">Hold Reason</td>
                            <td class="text-white">
                                @isset($parcel->reason->reason_type)
                                {{$parcel->reason->reason_type->name}}
                                @endisset
                            </td>
                        </tr>
                        @endisset

                        @if($parcel->status === 'cancelled')
                        <tr>
                            <td class="text-white">Cancel Reason</td>
                            <td class="text-white">
                                @isset($parcel->reason->reason_type)
                                {{$parcel->reason->reason_type->name}}
                                @endisset
                            </td>
                        </tr>
                        @endisset

                        @if($parcel->created_by_admin)
                        <tr>
                            <td class="text-white">Created By ({{ucfirst($parcel->guard_name)}})</td>
                            <td class="text-white"><strong>Name: </strong>{{$parcel->created_by_admin->name}} <br>
                                <strong>Mobile: </strong>{{$parcel->created_by_admin->mobile}}
                            </td>
                        </tr>
                        @endif
                        @if($parcel->created_by_merchant)
                        <tr>
                            <td class="text-white">Created By ({{ucfirst($parcel->guard_name)}})</td>
                            <td class="text-white"><strong>Name: </strong>{{$parcel->created_by_merchant->name}} <br>
                                <strong>Mobile: </strong>{{$parcel->created_by_merchant->mobile}}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Parcel History</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Created Date & Time</td>
                            <td class="text-white">{{$parcel->created_at->format('d:M Y')}}</td>
                            <td class="text-white">{{$parcel->created_at->format('h:i A')}}</td>
                        </tr>
                        @isset($parcel->times)
                        @foreach($parcel->times as $time)
                        <tr>
                            <td class="text-white">{{str_replace('_', ' ', ucfirst($time->time_type))}}</td>
                            <td class="text-white">{{date('d:M Y', strtotime($time->time))}}</td>
                            <td class="text-white">{{date('h:i A', strtotime($time->time))}}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        @if(auth()->guard('admin')->check() || auth()->guard('rider')->check())

        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Merchant Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Name</td>
                            <td class="text-white">{{$parcel->merchant->name}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Mobile</td>
                            <td class="text-white">{{$parcel->merchant->mobile}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Email</td>
                            <td class="text-white">{{$parcel->merchant->email}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Company Name</td>
                            <td class="text-white">{{$parcel->merchant->company_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @endif
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Customer Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Customer Name</td>
                            <td class="text-white">{{$parcel->customer_name}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Customer Mobile</td>
                            <td class="text-white">{{$parcel->customer_mobile}}</td>
                        </tr>
                        <tr>
                            <td class="text-white">Customer Alternative Mobile</td>
                            <td class="text-white">{{$parcel->customer_another_mobile ?? ''}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Customer Address</td>
                            <td class="text-white">{{$parcel->customer_address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-4">

        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Payment Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Collection Amount</td>
                            <td class="text-white">{{number_format($parcel->collection_amount)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Delivery charge</td>
                            <td class="text-white">{{number_format($parcel->delivery_charge)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">COD charge</td>
                            <td class="text-white">{{number_format($parcel->cod)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Payable</td>
                            <td class="text-white">{{number_format($parcel->payable)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Payment Status</td>
                            <td class="text-white">{{ucfirst($parcel->payment_status)}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Payment Type</td>
                            <td class="text-white">{{str_replace('_', ' ',ucfirst($parcel->payment_type))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if(auth()->guard('admin')->check() || auth()->guard('merchant')->check())

        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Rider Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Name</td>
                            <td class="text-white">{{$parcel->rider->name}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Code</td>
                            <td class="text-white">{{$parcel->rider->rider_code}}</td>
                        </tr>

                        <!-- <tr>
                            <td class="text-white">Mobile</td>
                            <td class="text-white">{{$parcel->rider->mobile}}</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>

        @endif
    </div>

    @isset($parcel->mobile_banking_collection)
    <div class="col-md-6 col-xl-4">
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Mobile Banking Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Amount</td>
                            <td class="text-white">{{number_format($parcel->mobile_banking_collection->amount)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Mobile Banking Type</td>
                            <td class="text-white">{{$parcel->mobile_banking_collection->mobile_banking->name}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Merchant Mobile No</td>
                            @isset($parcel->mobile_banking_collection->merchant_mobile_banking)
                            <td class="text-white">{{$parcel->mobile_banking_collection->merchant_mobile_banking->mobile_number}}</td>
                            @endisset
                        </tr>

                        <tr>
                            <td class="text-white">Customer Mobile No</td>
                            <td class="text-white">{{$parcel->mobile_banking_collection->customer_mobile_number}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Payment Status</td>
                            <td class="text-white">{{ucfirst($parcel->payment_status)}}</td>
                        </tr>

                        <tr>
                            <td class="text-white">Payment Type</td>
                            <td class="text-white">{{str_replace('_', ' ',ucfirst($parcel->payment_type))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endisset

    @isset($parcel->collection)
    <div class="col-md-6 col-xl-4">
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Collection Info</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-white">Amount</td>
                            <td class="text-white">{{number_format($parcel->collection->amount)}} TK</td>
                        </tr>
                        @if(auth()->guard('admin')->check() || auth()->guard('merchant')->check())
                        <tr>
                            <td class="text-white">Cod Charge</td>
                            <td class="text-white">{{number_format($parcel->collection->cod_charge)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Delivery Charge</td>
                            <td class="text-white">{{number_format($parcel->collection->delivery_charge)}} TK</td>
                        </tr>

                        <tr>
                            <td class="text-white">Net Payable</td>
                            <td class="text-white">{{number_format($parcel->collection->net_payable)}} TK</td>
                        </tr>
                        <tr>
                            <td class="text-white">Currently Payment Stay</td>
                            <td class="text-white">
                                @if(is_null($parcel->collection->incharge_collected_by))
                                <div class="badge badge-danger">Rider</div>
                                @elseif(is_null($parcel->collection->accounts_collected_by))
                                <div class="badge badge-warning">Incharge</div>
                                @elseif($parcel->collection->merchant_paid === 'unpaid')
                                <div class="badge badge-primary">Accounts</div>
                                @else
                                <div class="badge badge-success">Merchant</div>
                                @endif
                            </td>

                        </tr>
                        @if($parcel->collection->rider_collected_by)
                        <tr>
                            <td class="text-white">Collection (Rider)</td>
                            <td class="text-white"> {{$parcel->collection->rider->name??''}} </td>
                        </tr>
                        @endif
                        @if($parcel->collection->incharge_collected_by)
                        <tr>
                            <td class="text-white">Collection (Incharge)</td>
                            <td class="text-white"> {{$parcel->collection->incharge->name??''}} </td>
                        </tr>
                        @endif
                        @if($parcel->collection->accounts_collected_by)
                        <tr>
                            <td class="text-white">Collection (Accounts)</td>
                            <td class="text-white"> {{$parcel->collection->accountant->name??''}} </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-white">Additional Note</td>
                            <td class="text-white">{{$parcel->collection->note}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endisset

    @if(auth()->guard('admin')->check() && $parcel->is_transfer === 'yes')
    <div class="col-6">
        <div class="card bg-secondary">
            <div class="card-body">
                <h4 class="card-title text-white">Transfer info</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-white">SL</td>
                            <td class="text-white">Present Rider</td>
                            <td class="text-white">Request Rider</td>
                            <td class="text-white">Accept of decline by</td>
                            <td class="text-white">Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parcel->parcel_transfers as $transfer)
                        <tr>
                            <td class="text-white">{{$loop->iteration}}</td>
                            <td class="text-white">{{$transfer->present_rider->name?? ''}} ({{$transfer->present_rider->mobile?? ''}})</td>
                            <td class="text-white">{{$transfer->rider->name}} ({{$parcel->rider->mobile}})</td>
                            <td class="text-white">{{$transfer->accept_reject->name?? ''}}</td>
                            <td class="text-white">{{ucfirst($transfer->status)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>