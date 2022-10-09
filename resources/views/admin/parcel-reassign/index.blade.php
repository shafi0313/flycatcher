@extends('layouts.master')
@section('title', 'Parcel Re-Assign')
@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel Re-Assign'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel Re-Assign' :links="$links" />
    <div class="content-body" id="">
        <div class="row" id="vue_app">
            <div class="col-md-12">
                <div class="content-body">
                    <form action="{{route('admin.parcel-reassigns.store')}}" method="POST" class="">
                        @csrf
                        <section class="invoice-preview-wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header ">
                                            <div class="head-label">
                                                <h4 class="mb-0">Parcel Re-Assign</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="from_rider_id">From Rider</label>
                                                    <select class="form-control bSelect" name="from_rider_id" id="from_rider_id" v-model="from_rider_id" required>
                                                        <option value="" disabled selected>Select one</option>
                                                        @foreach($riders as $rider)
                                                        <option value="{{$rider->id}}">{{$rider->name}} ({{$rider->rider_code}})</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('rider_id'))
                                                    <small class="text-danger">{{$errors->first('rider_id')}}</small>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="status">Status</label>
                                                    <select class="form-control bSelect" name="status" id="status" v-model="status">
                                                        <option value="" disabled selected>Select one</option>
                                                        <option value="received_at_office" selected>Received At Office</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
                                                    @if($errors->has('status'))
                                                    <small class="text-danger">{{$errors->first('status')}}</small>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="to_rider_id">To Rider</label>
                                                    <select class="form-control bSelect" name="to_rider_id" id="to_rider_id" v-model="to_rider_id" required>
                                                        <option value="" disabled selected>Select one</option>
                                                        @foreach($riders as $rider)
                                                        <option value="{{$rider->id}}">{{$rider->name}} ({{$rider->rider_code}})</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('to_rider_id'))
                                                    <small class="text-danger">{{$errors->first('to_rider_id')}}</small>
                                                    @endif
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label></label>
                                                    <button class="btn btn-primary waves-effect waves-float waves-light form-control" @click="fetch_parcel()" type="button" id="search_button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12 col-12" v-if="parcels.length > 0">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Total Search Parcel= @{{ parcels.length }}
                                            </h4>
                                        </div>
                                        <!-- Invoice Note starts -->
                                        <div class="card-body">
                                            <!-- Invoice Description starts -->
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="py-1"></th>
                                                            <th class="py-1">Invoice Id</th>
                                                            <th class="py-1">Tracking Id</th>
                                                            <th class="py-1">Date</th>
                                                            <th class="py-1">Area</th>
                                                            <th class="py-1">Status</th>
                                                            <th class="py-1">Mobile</th>
                                                            <th class="py-1">Parcel Price</th>
                                                            <th class="py-1">Delivery Charge</th>
                                                            <th class="py-1">Payable</th>
                                                            <th class="py-1">Rider</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom" v-for="(parcel,index) in parcels">
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" @click="delete_row(parcel)"><i class="fa fa-times"></i></button>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.invoice_id }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.tracking_id }}</p>
                                                                <input type="hidden" :name="'items['+index+'][parcel_id]'" class="form-control input-sm" v-bind:value="parcel.id">
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.added_date }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.sub_area.name }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="badge badge-warning">@{{ parcel.status }}</span>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.customer_mobile }}</p>
                                                            </td>

                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.collection_amount}}</span>
                                                                <input type="hidden" :name="'items['+index+'][collection_amount]'" class="form-control input-sm" v-bind:value="parcel.collection_amount">
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{ parcel.delivery_charge }}</span>
                                                                <input type="hidden" :name="'items['+index+'][delivery_charge]'" class="form-control input-sm" v-bind:value="parcel.delivery_charge">
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.payable}}</span>
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold badge badge-success">@{{parcel.rider.name}}</span>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-8"></div>
                                                <div class="col-4">
                                                    <button class="btn btn-success btn-block waves-effect waves-float waves-light float-right" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Invoice Note ends -->
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12 col-12" v-else>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="text-danger text-center">No data available</h4>
                                            <!-- <img class="mx-auto d-block" src="{{ asset('app-assets/images/404-not-found.png') }}" alt="Search Result Not Found"> -->
                                            <img class="mx-auto d-block" src="{{ asset('app-assets/images/no-data.svg') }}" alt="Search Result Not Found">
                                            <p class=" text-center"> Add new record or search with different criteria.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script>
    //  console.log('error');
    $(document).ready(function() {
        let vue = new Vue({
            el: '#vue_app',
            data: {
                config: {
                    get_parcel_url: "{{ url('fetch-rider-wise-parcel') }}",
                },
                to_rider_id: '',
                from_rider_id: '',
                parcels: [],
                status: '',

            },
            methods: {
                delete_row: function(row) {
                    this.parcels.splice(this.parcels.indexOf(row), 1);
                },
                fetch_parcel() {

                    let vm = this;
                    let from_rider_id = vm.from_rider_id;
                    let status = vm.status;
                    let to_rider_id = vm.to_rider_id;
                    if (from_rider_id == "") {
                        alert('Please Select From Rider');
                        return false;
                    }
                    if (status == "") {
                        alert('Please Select status');
                        return false;
                    }
                    if (to_rider_id == "") {
                        alert('Please Select To Rider');
                        return false;
                    }
                    if (from_rider_id === to_rider_id) {
                        alert('You selected same Rider');
                        return false;
                    }

                    if (from_rider_id !== "" && to_rider_id !== "" && status !== "" && from_rider_id !== to_rider_id) {
                        axios.get(this.config.get_parcel_url + '/' + from_rider_id + '/' + status).then(
                            function(response) {
                                details = response.data;
                                vm.parcels = details.parcels;
                                console.log(details);
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
            },
            updated() {
                $('.bSelect').selectpicker('refresh');
            }
        });
        $('.bSelect').selectpicker({
            liveSearch: true,
            size: 5
        });
    });
</script>
@endpush