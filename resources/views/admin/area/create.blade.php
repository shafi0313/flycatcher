@extends('layouts.master')
@section('title', 'Area add')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Area list'=>route('admin.area.index'),
                'Area create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Area create' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Area Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.area.store')}}" method="POST" class="">
                                    @csrf
                                    <div class="row" >
                                        <div class="form-group col-md-6">
                                            <label for="city_type_id">City Type</label>

                                            <select class="form-control select2" name="city_type_id" id="city_type_id">
                                                <option value="">Select one</option>
                                                @foreach($cityTypes as $cityType)
                                                    <option value="{{$cityType->id}}" >{{$cityType->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('city_type_id'))
                                                <small class="text-danger">{{$errors->first('city_type_id')}}</small>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="district_id">District</label>

                                            <select class="form-control select2" name="district_id" id="district">
                                                <option value="">Select one</option>
                                                @foreach($districts as $district)
                                                    <option value="{{$district->id}}" >{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('district_id'))
                                                <small class="text-danger">{{$errors->first('district_id')}}</small>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Area name</label>
                                                <input type="text" class="form-control" id="name" name="area_name" placeholder="Enter Area Name" value="{{old('area_name')}}">
                                                @if($errors->has('area_name'))
                                                    <small class="text-danger">{{$errors->first('area_name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="area_code">Area code</label>
                                                <input type="text" class="form-control" id="area_code" name="area_code" placeholder="Enter area code" value="{{old('area_code')}}">
                                                @if($errors->has('area_code'))
                                                    <small class="text-danger">{{$errors->first('area_code')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Submit</button>
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

@push('script')
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#district').on('change', function () {
                let id = $(this).val();
                $('#upazila').empty();
                $('#upazila').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url:  "{{ route('getAjaxUpazillaData') }}?district_id=" + id,
                    success: function(data) {
                        $('#upazila').html(data.html);
                    }
                    // success: function (response) {
                    //     var response = JSON.parse(response);
                    //     console.log(response);
                    //     $('#upazila').empty();
                    //     $('#upazila').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
                    //     response.forEach(data => {
                    //         $('#upazila').append(`<option value="${data['id']}">${data['name']}</option>`);
                    //     });
                    // }
                });
            });
        });
    </script> -->
@endpush
{{--<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>--}}
{{--<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>--}}
{{--<script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>--}}
{{--<script>--}}
{{--    //  console.log('error');--}}
{{--    $(document).ready(function() {--}}
{{--        var vue = new Vue({--}}
{{--            el: '#vue_app',--}}
{{--            data: {--}}
{{--                config: {--}}
{{--                    get_district_url: "{{ url('admin/fetch-district-by-division-id') }}",--}}
{{--                    get_upazila_url: "{{ url('admin/fetch-upazila-by-district-id') }}",--}}
{{--                },--}}
{{--                division_id: '',--}}
{{--                district_id: '',--}}
{{--                upazila_id: '',--}}
{{--                districts: [],--}}
{{--                upazilas: [],--}}

{{--            },--}}
{{--            methods: {--}}
{{--                fetch_district() {--}}
{{--                    var vm = this;--}}
{{--                    var slug = vm.division_id;--}}
{{--                    if (slug) {--}}
{{--                        axios.get(this.config.get_district_url + '/' + slug).then(--}}
{{--                            function(response) {--}}
{{--                                details = response.data;--}}
{{--                                console.log(details);--}}
{{--                                vm.districts = details.districts;--}}

{{--                            }).catch(function(error) {--}}
{{--                            toastr.error('Something went to wrong', {--}}
{{--                                closeButton: true,--}}
{{--                                progressBar: true,--}}
{{--                            });--}}
{{--                            return false;--}}
{{--                        });--}}
{{--                    }--}}
{{--                },  fetch_upazila() {--}}
{{--                    var vm = this;--}}
{{--                    var slug = vm.district_id;--}}
{{--                    if (slug) {--}}
{{--                        axios.get(this.config.get_upazila_url + '/' + slug).then(--}}
{{--                            function(response) {--}}
{{--                                details = response.data;--}}
{{--                                console.log(details);--}}
{{--                                vm.upazilas = details.upazilas;--}}

{{--                            }).catch(function(error) {--}}
{{--                            toastr.error('Something went to wrong', {--}}
{{--                                closeButton: true,--}}
{{--                                progressBar: true,--}}
{{--                            });--}}
{{--                            return false;--}}
{{--                        });--}}
{{--                    }--}}
{{--                },--}}

{{--            },--}}
{{--            updated() {--}}
{{--                $('.bSelect').selectpicker('refresh');--}}
{{--            }--}}
{{--        });--}}
{{--        $('.bSelect').selectpicker({--}}
{{--            liveSearch: true,--}}
{{--            size: 5--}}
{{--        });--}}
{{--    });--}}
