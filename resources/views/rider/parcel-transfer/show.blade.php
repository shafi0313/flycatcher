@extends('layouts.rider')
@section('title', 'Parcel transfer request')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('rider.dashboard'),
    'Parcel list'=>route('rider.parcel.index'),
    'Parcel Transfer'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel Transfer' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>
                                        <p><strong>Tracking ID:</strong> {{$parcel->tracking_id}}</p>
                                        <p><strong>Tracking ID:</strong> {{$parcel->invoice_id}}</p>
                                    </td>
                                    <td>
                                        <p><strong>Customer info:</strong> {{$parcel->customer_name}} ({{$parcel->customer_mobile}})</p>
                                        <p><strong>Area:</strong> {{$parcel->sub_area->name}}</p>
                                    </td>
                                    <td>
                                        <p><strong>Merchant info:</strong> {{$parcel->merchant->name}} ({{$parcel->merchant->mobile}})</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('rider.parcel.transfer.request.process')}}" method="post">
                        @method('post')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Parcel Transfer</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name="parcel_id" value="{{$parcel->id}}" id="parcel_id">
                                        <label for="transfer_for">Select Rider</label>
                                        <select class="form-control select2" name="transfer_for" id="transfer_for">
                                            <option value="">Select one</option>
                                            @foreach($riders as $rider)
                                            @if($rider->id === auth('rider')->user()->id )
                                            @continue
                                            @else
                                            <option value="{{$rider->id}}">{{$rider->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('transfer_for'))
                                        <small class="text-danger">{{$errors->first('transfer_for')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <div id="searchResult"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#transfer_for').on('change', function() {
            let transfer_for = $('#transfer_for').find(":selected").val();
            let parcel_id = $('#parcel_id').val();
            if (transfer_for == null) {
                alert('Please Select Area Right Now');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('rider.parcel.transfer.sub.area.search') }}",
                    data: {
                        transfer_for: transfer_for,
                        parcel_id: parcel_id,
                    },
                    success: function(response) {
                        console.log(response)
                        $("#searchResult").html(response);
                    }

                });
            }
        });
    });
</script>
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
