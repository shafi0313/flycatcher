<div class="card">
    <div class="card-body statistics-body">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href="" class="btn btn-block p-0 border border-primary">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-6 border-right-primary py-1">
                                <h5 class="font-weight-bolder mb-0">All</h5>
                            </div>
                            <div class="col-6 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$total}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-warning disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-6 border-right-warning py-1">
                                <h5 class="font-weight-bolder mb-0">Pending</h5>
                            </div>
                            <div class="col-6 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$pending??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-info disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-6 border-right-info py-1">
                                <h5 class="font-weight-bolder mb-0">Transit</h5>
                            </div>
                            <div class="col-6 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$transit??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-warning disabled">
                    <div class="card-body p-0">
                        <div class="row  text-center mx-0">
                            <div class="col-8 border-right-warning py-1">
                                <h5 class="font-weight-bolder mb-0">Partial</h5>
                            </div>
                            <div class="col-4 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$partial??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href="" class="btn btn-block p-0 border border-success disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-6 border-right-success py-1">
                                <h5 class="font-weight-bolder mb-0">Delivered</h5>
                            </div>
                            <div class="col-6 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$delivered??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-warning disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-6 border-right-warning py-1">
                                <h5 class="font-weight-bolder mb-0">Hold</h5>
                            </div>
                            <div class="col-6 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$hold??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-lg-1">
            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-danger transfer">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-8 border-right-danger py-1">
                                <h5 class="font-weight-bolder mb-0">Transfer</h5>
                            </div>
                            <div class="col-4 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$transfer??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-danger disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-8 border-right-danger py-1">
                                <h5 class="font-weight-bolder mb-0">Cancelled</h5>
                            </div>
                            <div class="col-4 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$cancelled??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-info disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-8 border-right-info py-1">
                                <h5 class="font-weight-bolder mb-0">Cancel Accept By Incharge</h5>
                            </div>
                            <div class="col-4 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$cancel_accept_by_incharge??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                <a href=""
                   class="btn btn-block p-0 border border-success disabled">
                    <div class="card-body p-0">
                        <div class="row text-center mx-0">
                            <div class="col-8 border-right-success py-1">
                                <h5 class="font-weight-bolder mb-0">Cancel Accept By Merchant</h5>
                            </div>
                            <div class="col-4 py-1">
                                <h5 class="font-weight-bolder mb-0">{{$cancel_accept_by_merchant??0}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SL no</th>
                <th>Customer Info</th>
                <th>Merchant Info</th>
                <th>Rider Info</th>
                <th>Tracking ID</th>
                <th>Invoice ID</th>
                <th>Payment Details</th>
                <th>Date & Time</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parcels as $parcel)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <p><b>Name: </b>{{$parcel->customer_name}}</p>
                        <p><b>Mobile: </b>{{$parcel->mobile}}</p>
                        <p><b>Area: </b>{{$parcel->sub_area->name?? ''}}</p>
                    </td>
                    <td>
                        <p><b>Name: </b>{{$parcel->merchant->name}}</p>
                        <p><b>Mobile: </b>{{$parcel->merchant->mobile}}</p>
                    </td>
                    <td>
                        <p><b>Name: </b>{{$parcel->rider->name?? ''}}</p>
                        <p><b>Mobile: </b>{{$parcel->rider->mobile?? ''}}</p>
                    </td>
                    <td>
                        {{$parcel->tracking_id}}
                    </td>
                    <td>
                        {{$parcel->invoice_id}}
                    </td>
                    <td>
                        <p><b>Collection Amount: </b>{{number_format($parcel->collection_amount)}} tk</p>
                        <p><b>Delivery Charge: </b> {{number_format($parcel->delivery_charge)}} tk</p>
                        <p><b>COD: </b> {{number_format($parcel->cod)}} tk</p>
                        <p><b>Payable: </b> {{number_format($parcel->payable)}} tk</p>
                    </td>
                    <td>
                        <p><b>Date: </b>{{$parcel->created_at->format('d:M Y')}}</p>
                        <p><b>Time: </b>{{$parcel->created_at->format('h:i A')}}</p>
                        <p><b>Created: </b>{{$parcel->created_at->diffForHumans()}}</p>
                    </td>
                    <td>
                        @switch ($parcel->status)
                            @case ('wait_for_pickup')
                            <div class="badge badge-warning">{{ucfirst(str_replace('_', ' ', $parcel->status))}}</div>
                            @break

                            @case ('transfer')
                            @case ('pending')
                            <div class="badge badge-warning">{{ucfirst($parcel->status)}}</div>
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
                            @case ('hold')
                            <div class="badge badge-light-warning">{{ucfirst($parcel->status)}}</div>
                            @break
                            @case ('cancelled')
                            <div class="badge badge-glow badge-danger">{{ ucfirst($parcel->status)}}</div>
                            @break
                            @case ('cancel_accept_by_incharge')
                            <div class="badge badge-glow badge-info">Cancel Accept By Incharge</div>
                            @break
                            @case ('cancel_accept_by_merchant')
                            <div class="badge badge-glow badge-info">Cancel Accept By Merchant</div>
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>




