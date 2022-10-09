@extends('layouts.master')
@section('title','Parcel')
@section('content')
@php
$parcelWeights=App\Models\WeightRange::all();
$areaList=App\Models\Area::all();
$subAreas=App\Models\SubArea::all();
$cityTypes=App\Models\CityType::all();
$parcelTypes=App\Models\ParcelType::all();
$merchants=App\Models\Merchant::all();

@endphp

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Parcel</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Parcel Create From Excel
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('admin.parcel.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row justify-content-center" id="vue_app">
                <form action="{{route('admin.parcel.excelStore')}}" method="POST" class="">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Parcel Create</h4>
                            </div>
                            <div class="card-body">
                                <p style="font-style: italic;font-size:12px">It is obligatory to fill in the fields marked with ( <span style="color: red;">*</span> ). </p>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Merchant <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="merchant_id" required>
                                            <option value="">Select One</option>
                                            @foreach($merchants as $merchant)
                                            <option value="{{ $merchant->id }}" {{ ($merchant->id==$merchant_id) ? 'selected':'' }}>{{ $merchant->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="added_date">Date</label>
                                        <input type="date" id="added_date" name="added_date" class="form-control" placeholder="YYYY-MM-DD" value="{{ date('Y-m-d') }}">

                                    </div>
                                </div>
                            </div>
                        </div>

                        @csrf
                        @foreach ($datas as $index=>$data1 )
                        @if(!is_null($data1['area_code']) && !is_null($data1['weight']))
                        @php($sub_area_excel=App\Models\SubArea::where('code',$data1['area_code'])->first())
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $index+1 }}. New Parcel</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Delivery Location <span style="color: red;">*</span></label>
                                            <select class="form-control bSelect" name="parcels[{{$index}}][city_type_id]" required>
                                                <option value="">Select One</option>
                                                @if(!is_null($sub_area_excel))
                                                @foreach($cityTypes as $key=>$cityType)
                                                <option value="{{ $cityType->id }}" {{ ($cityType->id==$sub_area_excel->area->city_type_id) ? 'selected':'' }}>{{ $cityType->name}}</option>
                                                @endforeach
                                                @else
                                                @foreach($cityTypes as $key=>$cityType)
                                                <option value="{{ $cityType->id }}">{{ $cityType->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="area_id">Delivery Area <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="parcels[{{$index}}][area_id]" required>
                                            <option value="">Select one</option>
                                            @if(!is_null($sub_area_excel))
                                            @foreach($areaList as $key=>$row)
                                            <option value="{{ $row->id }}" {{ ($row->id==$sub_area_excel->area->id) ? 'selected':'' }}>{{ $row->area_name}}</option>
                                            @endforeach
                                            @else
                                            @foreach($areaList as $key=>$row)
                                            <option value="{{ $row->id }}">{{ $row->area_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="sub_area_id">Delivery Sub Area <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="parcels[{{$index}}][sub_area_id]" required>
                                            <option value="">Select one</option>
                                            @if(!is_null($sub_area_excel))
                                            @foreach($subAreas as $key=>$row)
                                            <option value="{{ $row->id }}" {{ ($row->id==$sub_area_excel->id) ? 'selected':'' }}>{{ $row->name.'('.$row->code .')'}}</option>
                                            @endforeach
                                            @else
                                            @foreach($subAreas as $key=>$subArea)
                                            <option value="{{ $subArea->id }}">{{ $subArea->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="parcel_type_id">Percel Type <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" v-model="parcel_type_id" name="parcels[{{$index}}][parcel_type_id]" class="form-control" required>
                                            <option value="">Select one</option>
                                            @foreach($parcelTypes as $key=>$parcelType)
                                            <option value="{{ $parcelType->id }}">{{ $parcelType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="weight_range_id">Weight <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="parcels[{{$index}}][weight_range_id]" required>
                                            <option value="">Select one</option>
                                            @foreach($parcelWeights as $key=>$parcelWeight)
                                            <option value="{{ $parcelWeight->id }}" {{ ($parcelWeight->min_weight<=$data1['weight'] && $parcelWeight->max_weight>=$data1['weight']) ? 'selected':'' }}>({{ $parcelWeight->min_weight.'-'.$parcelWeight->max_weight }}) Kg</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label for="collection_amount">Collection Amount <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="parcels[{{$index}}][collection_amount]" value="{{$data1['collection_amount']}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-1">
                                        <div class="form-group">
                                            <label for="invoice_id">Invoice Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="invoice_id" name="parcels[{{$index}}][invoice_id]" value="{{$data1['invoice_number']}}" placeholder="Enter Invoice Number" required>
                                            <input type="hidden" class="form-control" id="rider_id" name="parcels[{{$index}}][assigning_by]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="parcels[{{$index}}][customer_name]" value="{{$data1['customer_name']}}" placeholder="Enter Customer Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="customer_mobile">Customer Mobile Number <span style="color: red;">*</span></label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                </div>
                                                <input type="text" class="form-control" value="0{{$data1['customer_mobile']}}" name="parcels[{{$index}}][customer_mobile]" placeholder="Enter Customer Mobile" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="form-group">
                                            <label for="customer_alt_mobile">Customer Other Mobile Number</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                </div>
                                                <input type="text" class="form-control" name="parcels[{{$index}}][customer_alt_mobile]" placeholder="Enter Other Customer Mobile" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="form-group required">
                                            <label for="customer_address" class="control-label">Customer Address <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="parcels[{{$index}}][customer_address]" placeholder="Enter Address" rows="3" required>{{$data1['customer_address']}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" name="parcels[{{$index}}][note]" placeholder="Enter Note" rows="3">{{$data1['note']}}</textarea>
                                            <input type="hidden" class="form-control" name="parcels[{{$index}}][cod]" v-model="cod">
                                            <input type="hidden" class="form-control" name="parcels[{{$index}}][delivery_charge]" v-model="deliverycharge">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @endforeach

                        <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Submit</button>
                    </div>
            </div>
            </form>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush
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
                    get_sub_area_url: "{{ url('fetch-sub-area-by-city-type-id') }}",
                    get_area_url: "{{ url('fetch-area-by-city-type-id') }}",
                    get_delivery_cod_url: "{{ url('fetch-delivery-cod-charge') }}",
                },
                merchant_id: '',
                city_type_id: '',
                parcel_type_id: '',
                payment_status: '',
                weight_range_id: '',
                collection_amount: 0,
                deliverycharge: 0,
                cod: 0,
                isReadOnly: false,
                rider_id: '',
                area_id: '',
                areas: [],
                sub_area_id: '',
                sub_areas: [],
                parcels: "{{ $datas }}",

            },
            methods: {
                fetch_sub_area() {
                    let vm = this;
                    let slug = vm.area_id;
                    if (slug) {
                        axios.get(this.config.get_sub_area_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.sub_areas = details.sub_areas;
                                vm.rider_id = details.rider_id;
                                vm.weight_range_id = '';
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_area() {
                    let vm = this;
                    let slug = vm.city_type_id;
                    if (slug) {
                        axios.get(this.config.get_area_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                // console.log(details);
                                vm.areas = details.areas;
                                vm.weight_range_id = '';
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_delivey_cod() {
                    let vm = this;
                    let slug = vm.city_type_id;
                    let slug1 = vm.weight_range_id;
                    let merchant_id = vm.merchant_id;
                    let payment_status = vm.payment_status;
                    if (slug) {
                        axios.get(this.config.get_delivery_cod_url + '/' + slug + '/' + slug1 + '/' + merchant_id).then(
                            function(response) {
                                details = response.data;
                                vm.deliverycharge = details.delivery_cod.delivery_charge;
                                if (payment_status == 'paid') {
                                    vm.collection_amount = 0;
                                    vm.isReadOnly = true;
                                    vm.cod = 0;
                                } else {
                                    vm.cod = details.delivery_cod.cod;
                                    vm.collection_amount = 0;
                                    vm.isReadOnly = false;
                                }

                                //  console.log(details.delivery_cod.cod);

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