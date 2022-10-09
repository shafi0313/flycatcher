@extends('layouts.master')
@section('title', 'Weight range add')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Weight list'=>route('admin.weight-range.index'),
                'Weight create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Weight range' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Weight Range Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.weight-range.store')}}" method="POST" class="">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-4 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="min_weight">Min weight in kg</label>
                                                <input type="text" class="form-control form-control-sm" id="min_weight" name="min_weight" placeholder="Enter min weight" value="{{old('min_weight')}}">
                                                @if($errors->has('min_weight'))
                                                    <small class="text-danger">{{$errors->first('min_weight')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="max_weight">Max weight in kg</label>
                                                <input type="text" class="form-control form-control-sm" id="max_weight" name="max_weight" placeholder="Enter max weight" value="{{old('max_weight')}}">
                                                @if($errors->has('max_weight'))
                                                    <small class="text-danger">{{$errors->first('max_weight')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Enter Code" value="{{old('code')}}">
                                                @if($errors->has('code'))
                                                    <small class="text-danger">{{$errors->first('code')}}</small>
                                                @endif
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

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>
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
