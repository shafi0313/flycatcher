@extends('layouts.master')
@section('title', 'Parcel type add')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Parcel type list'=>route('admin.parcel-type.index'),
            'Parcel type create'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Parcel type create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Parcel type Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.parcel-type.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Parcel type name</label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter parcel type" value="{{old('name')}}">
                                            @if($errors->has('name'))
                                                <small class="text-danger">{{$errors->first('name')}}</small>
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
@section('css')

@endsection
@section('js')

@endsection
{{--@push('script')--}}
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
{{--</script>--}}
{{--@endpush--}}
