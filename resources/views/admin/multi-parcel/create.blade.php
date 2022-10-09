@extends('layouts.master')
@section('title','Parcel')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Multiple Parcel</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Parcel Create
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
            <div class="row" id="vue_app">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Parcel Create</h4>
                        </div>
                        <form action="{{route('admin.parcel.multiple.store')}}" method="POST" class="">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="merchant_id">Merchant <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" id="merchant_id" name="merchant_id">
                                            <option value="">Select One</option>
                                            @foreach($merchants as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card" v-for="(input,k) in inputs" :key="k">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <div>
                                                            <h4>Parcel #<span>@{{ k+1 }} </span></h4>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <button type="button" class="btn btn-sm btn-danger float-right" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"><i class="fa fa-trash"></i></button>
                                                        <p style="font-style: italic;font-size:12px">It is obligatory to fill in the fields marked with ( <span style="color: red;">*</span> ). </p>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="city_type_id">Delivery Location <span style="color: red;">*</span></label>
                                                        <select class="form-control bSelect" :name="'parcels['+k+'][city_type_id]'" v-model="input.city_type_id" @change="fetch_area(input.city_type_id)" required>
                                                            <option value="">Select One</option>
                                                            @foreach($city_types as $list)
                                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="area_id">Delivery Area <span style="color: red;">*</span></label>

                                                        <select class="form-control bSelect" :name="'parcels['+k+'][area_id]'" v-model="input.area_id" @change="fetch_sub_area()" class="form-control" required>
                                                            <option value="">Select one</option>
                                                            <option :value="row.id" v-for="row in areas" v-html="row.area_name">
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="collection_amount">Collection Amount <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="collection_amount" :name="'parcels['+k+'][collection_amount]'" v-model="input.name" placeholder="Collection Amount" autocomplete="off" v-bind:readonly="isReadOnly">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="delivery_charge">Collection Amount <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="delivery_charge" :name="'parcels['+k+'][delivery_charge]'" v-model="input.delivery_charge" placeholder="delivery_charge" autocomplete="off" v-bind:readonly="isReadOnly">
                                                        </div>
                                                    </div>


                                                    <!-- <span>
                                                <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">Remove</i>
                                                <i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1">Add fields</i>
                                            </span> -->



                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-success btn-sm  float-right" @click="add(k)" v-show="k == inputs.length-1">
                                                <i class="fas fa-plus"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit" v-if="inputs.length > 0">Submit</button>
                            </div>
                        </form>
                        <div class="card-footer">
                            <button class="btn btn-success btn-sm  float-right" @click="addMore()">
                                <i class="fas fa-plus"></i>Add
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    --------------
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
<style>
    .activeClass {
        border: 3px solid green !important;
    }

    .errorClass {
        border: 3px solid red !important;
    }
</style>
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
                    get_sub_area_url: "{{ url('fetch-sub-area-by-area-id') }}",
                    get_area_url: "{{ url('fetch-area-by-city-type-id') }}",
                    get_delivery_cod_url: "{{ url('fetch-delivery-cod-charge') }}",
                    get_merchant_info_url: "{{ url('fetch-merchant-info') }}",
                },
                isReadOnly: false,
                areas: [],
                inputs: [{
                    name: '',
                    delivery_charge: '',
                    city_type_id: '',
                    area_id: ''
                }]

            },
            methods: {
                add() {
                    this.inputs.push({
                        name: '',
                        delivery_charge: '',
                        city_type_id: '',
                        area_id: ''
                    })
                    console.log(this.inputs)
                },

                remove(index) {
                    this.inputs.splice(index, 1)
                },
                fetch_area(city_type_id) {
                    let vm = this;
                    let slug = city_type_id;
                    alert(slug);
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