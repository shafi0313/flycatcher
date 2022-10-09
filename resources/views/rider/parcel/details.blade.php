<section class="app-ecommerce-details">
    <div class="card mb-0 bg-transparent">
        <!-- Product Details starts -->
        <div class="card-body p-0">
            <div class="row">
                <div class="col-12 pr-0 mr-0">
                    <h4>{{$parcel->customer_name}}</h4>
                    <span class="card-text item-company">Amount: <a href="javascript:void(0)" class="company-name">{{number_format($parcel->collection_amount)}} TK</a></span>
                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                        <h4 class="item-price mr-1">{{$parcel->customer_mobile}}</h4>
                    </div>
                    <p class="card-text"><span class="text-success">{{$parcel->sub_area->name}}</span></p>
                    <p class="card-text">
                        {{$parcel->customer_address}}
                    </p>
                    <hr/>
                    <div class="product-color-options">
                        <h6 class="card-text">Tracking ID - <span class="text-success">{{$parcel->tracking_id}}</span></h6>
                        <h6 class="card-text">Invoice ID - <span class="text-success">{{$parcel->invoice_id}}</span></h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block selected">
                                @switch ($parcel->status)
                                    @case ('wait_for_pickup')
                                    <div class="badge badge-warning">Wait For Pickup</div>
                                    @break
                                    @case ('received_at_office')
                                    <div class="badge badge-glow badge-success">Received At Office</div>
                                    @break
                                    @case ('pending')
                                    <div class="badge badge-warning">Pending</div>
                                    @break
                                    @case ('transfer')
                                    <div class="badge badge-warning">Transfer</div>
                                    @break
                                    @case ('transit')
                                    <div class="badge badge-glow badge-info">Transit</div>
                                    @break
                                    @case ('partial')
                                    <div class="badge badge-pill badge-glow badge-primary">Partial</div>
                                    @break
                                    @case ('delivered')
                                    <div class="badge badge-success">{{ucfirst($parcel->status)}}</div>
                                    @break
                                    @case ('exchange')
                                    <div class="badge badge-success">{{ucfirst($parcel->status)}}</div>
                                    @break
                                    @case ('hold')
                                    <div class="badge badge-light-warning">Rider Hold</div>
                                    @break
                                    @case ('cancelled')
                                    <div class="badge badge-glow badge-danger">{{ucfirst($parcel->status)}}</div>
                                    @break
                                    @case ('cancel_accept_by_incharge')
                                    <div class="badge badge-glow badge-info">Cancel Accept By Incharge</div>
                                    @break
                                    @case ('cancel_accept_by_merchant')
                                    <div class="badge badge-glow badge-info">Cancel Accept By Merchant</div>
                                    @case ('hold_accept_by_incharge')
                                    <div class="badge badge-glow badge-info">Hold Parcel In Office</div>
                                @endswitch
                            </li>
                        </ul>
                    </div>
                    <hr/>
                    <div class="product-color-options">
                        <h6 class="card-text">{{$parcel->created_at->format('d:M Y')}} - <span
                                class="text-success">{{$parcel->created_at->format('h:i A')}}</span></h6>
                    </div>
                    <div class="d-flex flex-column flex-sm-row pt-1">
                        <div class="mr-1">
                            <a href="{{route('rider.parcel.show', $parcel->id)}}"
                               class="btn btn-outline-secondary btn-wishlist mr-0 mr-sm-1 mb-1 mb-sm-0 btn-sm">
                                View Details
                            </a>
                        </div>
                        <div>
                            @if($parcel->status === 'pending')
                                <div>
                                    <form action="{{route('rider.parcel.accept', $parcel->id)}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-primary btn-sm" type="submit" title="Accept Now">
                                            Accept Now
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if($parcel->status === 'transit')
                                <div class="d-md-flex">
                                    <div class="mr-1 mb-1">
                                        <a href="{{route('rider.parcel.status.change', $parcel->id)}}"
                                           class="btn btn-primary btn-sm">Change
                                            Status</a>
                                    </div>

                                    <div>
                                        <a href="{{route('rider.parcel.transfer.request', $parcel->id)}}"
                                           class="btn btn-outline-warning btn-sm">Transfer Request</a>
                                    </div>
                                </div>
                            @endif

                            @if($parcel->status === 'delivered' ||  $parcel->status === 'partial' || $parcel->status === 'cancelled')
                                @isset($collection)
                                    @if($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request')
                                        <div class="mr-1">
                                            <form action="{{route('rider.parcel.undo', $parcel->id)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-warning btn-sm" type="submit" title="Undo Now">
                                                   Undo now
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @else
                                @endisset
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
