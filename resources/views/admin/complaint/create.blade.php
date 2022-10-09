@extends('layouts.master')
@section('title', 'Complaint add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Complaint list'=>route('admin.parcel-type.index'),
    'Complaint create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Complaint' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Complaint Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.complaints.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="merchant_id">Merchant<span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="merchant_id" id="merchant_id" class="form-control" required>
                                            <option value="">Select one</option>
                                            @foreach($merchants as $merchant)
                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="description">Complaint</label>
                                            <textarea class="form-control form-control-sm" name="description"></textarea>
                                            @if($errors->has('description'))
                                            <small class="text-danger">{{$errors->first('description')}}</small>
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
{{-- //  console.log('error');--}}
{{-- $(document).ready(function() {--}}
{{-- var vue = new Vue({--}}
{{-- el: '#vue_app',--}}
{{-- data: {--}}
{{-- config: {--}}
{{-- get_district_url: "{{ url('admin/fetch-district-by-division-id') }}",--}}
{{-- get_upazila_url: "{{ url('admin/fetch-upazila-by-district-id') }}",--}}
{{-- },--}}
{{-- division_id: '',--}}
{{-- district_id: '',--}}
{{-- upazila_id: '',--}}
{{-- districts: [],--}}
{{-- upazilas: [],--}}

{{-- },--}}
{{-- methods: {--}}
{{-- fetch_district() {--}}
{{-- var vm = this;--}}
{{-- var slug = vm.division_id;--}}
{{-- if (slug) {--}}
{{-- axios.get(this.config.get_district_url + '/' + slug).then(--}}
{{-- function(response) {--}}
{{-- details = response.data;--}}
{{-- console.log(details);--}}
{{-- vm.districts = details.districts;--}}

{{-- }).catch(function(error) {--}}
{{-- toastr.error('Something went to wrong', {--}}
{{-- closeButton: true,--}}
{{-- progressBar: true,--}}
{{-- });--}}
{{-- return false;--}}
{{-- });--}}
{{-- }--}}
{{-- },  fetch_upazila() {--}}
{{-- var vm = this;--}}
{{-- var slug = vm.district_id;--}}
{{-- if (slug) {--}}
{{-- axios.get(this.config.get_upazila_url + '/' + slug).then(--}}
{{-- function(response) {--}}
{{-- details = response.data;--}}
{{-- console.log(details);--}}
{{-- vm.upazilas = details.upazilas;--}}

{{-- }).catch(function(error) {--}}
{{-- toastr.error('Something went to wrong', {--}}
{{-- closeButton: true,--}}
{{-- progressBar: true,--}}
{{-- });--}}
{{-- return false;--}}
{{-- });--}}
{{-- }--}}
{{-- },--}}

{{-- },--}}
{{-- updated() {--}}
{{-- $('.bSelect').selectpicker('refresh');--}}
{{-- }--}}
{{-- });--}}
{{-- $('.bSelect').selectpicker({--}}
{{-- liveSearch: true,--}}
{{-- size: 5--}}
{{-- });--}}
{{-- });--}}
{{--</script>--}}
{{--@endpush--}}