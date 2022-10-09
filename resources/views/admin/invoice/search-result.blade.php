<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <h6 class="mb-2">Invoice To:</h6>
                            <p class="card-text mb-25">House# 181/182, Block C, Section C,</p>
                            <p class="card-text mb-25">Mirpur Dhaka, Bangladesh</p>
                            <p class="card-text mb-0">+8801777873960</p>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>
                <hr>
                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search Parcel List</h4>
                        </div>
                        <form action="{{route('admin.invoice.store')}}" method="POST" class="">
                            @csrf
                            <div class="card-body">
                                @if(count($unpaid_parcel) > 0)

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="py-1"></th>
                                            <th class="py-1">Tracking Id</th>
                                            <th class="py-1">Date</th>
                                            <th class="py-1">Area</th>
                                            <th class="py-1">Status</th>
                                            <th class="py-1">Mobile</th>
                                            <th class="py-1">Payment Status</th>
                                            <th class="py-1">Invoice Id</th>
                                            <th class="py-1">Parcel Price</th>
                                            <th class="py-1">collection amount</th>
                                            <th class="py-1">Delivery Charge</th>
                                            <th class="py-1">Cod</th>
                                            <th class="py-1">Payable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($unpaid_parcel as $parcelData)
                                        <tr>
                                            <td scope="row">
                                                <input class="checkSingle" style="width: 20px; height: 20px;" type="checkbox" value="{{  $parcelData->parcel->id }}" id="" name="items[]" checked>
                                            </td>
                                            <td>
                                                <p><b>Name: </b>{{$parcelData->customer_name}}</p>
                                                <p><b>Mobile: </b>{{$parcelData->customer_mobile}}</p>
                                                <p><b>Address: </b>{{$parcelData->customer_address}}</p>
                                            </td>
                                            <td>
                                                <p><b>Name: </b>{{$parcelData->merchant->name}}</p>
                                                <p><b>Mobile: </b>{{$parcelData->merchant->mobile}}</p>
                                            </td>
                                            <td class="text-center">{{ $parcelData->tracking_id }}</td>
                                            <td class="text-center">{{ $parcelData->invoice_id }}</td>

                                            <td class="text-center">{{ number_format($parcelData->collection_amount) }}</td>
                                            <td>
                                                <b>Date: </b>{{$parcelData->created_at->format('d:M Y')}}<br>
                                                <b>Time: </b>{{$parcelData->created_at->format('H:i:s A')}}<br>
                                            </td>
                                            <td>
                                                {{$parcelData->note}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            <p class="card-text mb-0">
                                                <span class="font-weight-bold">Invoiced By:</span> <span class="ml-75"></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Subtotal:</p>
                                                    <p class="invoice-total-amount"></p>
                                                    <input type="hidden" class="form-control input-sm" name="total_collection_amount" v-bind:value="total" readonly>
                                                </div>
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Cod:</p>
                                                    <p class="invoice-total-amount"></p>
                                                    <input type="hidden" class="form-control input-sm" name="total_cod" v-bind:value="totalCod" readonly>
                                                </div>
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Delivery Charge:</p>
                                                    <p class="invoice-total-amount"></p>
                                                    <input type="hidden" class="form-control input-sm" name="total_delivery_charge" v-bind:value="totalDc" readonly>
                                                </div>
                                                <hr class="my-50">
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Total:</p>
                                                    <p class="invoice-total-amount"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Submit</button>
                                @else
                                <p>Not found</p>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>


                <hr class="invoice-spacing">

                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                projects. Thank You!</span>
                        </div>
                    </div>
                </div>
                <!-- Invoice Note ends -->
            </div>
        </div>

    </div>
</section>