@extends('layouts.master')
@section('title','Pickup Request')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Pickup Request</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('merchant.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Pickup Request Create
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
                        <a class="dropdown-item" href="{{route('merchant.pickup-request.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pickup Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('merchant.pickup-request.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="parcel_type_id">Percel Type</label>
                                        <select class="form-control form-control-sm" name="parcel_type_id" id="parcel_type_id" class="form-control" v-model="parcel_type_id" @change="fetch_Pickup()">
                                            <option value="">Select one</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="weight_range_id">Weight Range</label>
                                        <select class="form-control form-control-sm" name="weight_range_id" id="weight_range_id" class="form-control" v-model="weight_range_id">
                                            <option value="">Select one</option>
                                            @foreach($weight_ranges as $list)
                                            <option value="{{$list->id}}">{{$list->min_weight}}-{{$list->max_weight}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <input type="text" class="form-control form-control-sm" id="note" name="note" placeholder="Enter Note">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection
@section('css')

@endsection
@section('js')

@endsection
@push('script')
<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script>
    //  console.log('error');
    $(document).ready(function() {
        var vue = new Vue({
            el: '#vue_app',
            data: {
                config: {
                    get_percel_type_url: "{{ url('merchant/fetch-percel_type-by-division-id') }}",
                },
                division_id: '',
                parcel_type_id: '',
                percel_types: [],

            },
            methods: {
                fetch_percel_type() {
                    var vm = this;
                    var slug = vm.division_id;
                    if (slug) {
                        axios.get(this.config.get_percel_type_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.percel_types = details.percel_types;

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
