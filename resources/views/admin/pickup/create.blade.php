@extends('layouts.master')

@section('content')
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Parcel Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.parcel.store')}}" method="POST" class="">
                                @csrf
                                <div class="row" id="vue_app">
                                    <div class="form-group col-md-4">
                                        <label for="division_id">Location</label>
                                        <select class="form-control form-control-sm" id="division_id" name="division_id" v-model="division_id" @change="fetch_district()">
                                            <option value="">Select One</option>
                                            @foreach($divisions as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}({{ $list->bn_name }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district_id">Percel Type</label>

                                        <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_Parcel()">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in districts" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district_id">Paid Option</label>

                                        <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_Parcel()">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in districts" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district_id">Merchant</label>

                                        <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_Parcel()">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in districts" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="division_id">Division</label>
                                        <select class="form-control form-control-sm" id="division_id" name="division_id" v-model="division_id" @change="fetch_district()">
                                            <option value="">Select One</option>
                                            @foreach($divisions as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}({{ $list->bn_name }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district_id">District</label>

                                        <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_upazila()">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in districts" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="district_id">Area</label>

                                        <select class="form-control form-control-sm" name="district_id" id="district_id" class="form-control" v-model="district_id" @change="fetch_Parcel()">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in districts" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">COD Amount</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Weight</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Phone Number</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Address (maximum 500 characters)</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Note (maximum 300 characters)</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name">
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
                    get_district_url: "{{ url('admin/fetch-district-by-division-id') }}",
                },
                division_id: '',
                district_id: '',
                districts: [],

            },
            methods: {
                fetch_district() {
                    var vm = this;
                    var slug = vm.division_id;
                    if (slug) {
                        axios.get(this.config.get_district_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.districts = details.districts;

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
