@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Collection Report')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel'=>route('admin.parcel.index'),
    'Collection Report'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Collection Report' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Collection Report</h4>
                        </div>
                        <div class="card-body">
                            <form action="" class="">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="merchant_id">Select Merchant </label>
                                        <select class="form-control select2" name="merchant_id" id="merchant_id">
                                            <option value="">Select One</option>
                                            @foreach($merchants as $merchant)
                                            @if (old('merchant_id')==$merchant->id)
                                            <option value={{$merchant->id}} selected>{{$merchant->name}}</option>
                                            @else
                                            <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                            <div>
                                                <span class="text-danger" id="merchant_id"></span>
                                            </div>
{{--                                        @if($errors->has('merchant_id'))--}}
{{--                                        @endif--}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rider_id">Select Rider </label>
                                        <select class="form-control select2" name="rider_id" id="rider_id">
                                            <option value="">Select One</option>
                                            @foreach($riders as $rider)
                                            @if (old('rider_id')==$rider->id)
                                            <option value={{$rider->id}} selected>{{$rider->name}}</option>
                                            @else
                                            <option value="{{$rider->id}}">{{$rider->name}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                        <span class="text-danger" id="rider_id"></span>
{{--                                        @if($errors->has('rider_id'))--}}
{{--                                        <small class="text-danger">{{$errors->first('rider_id')}}</small>--}}
{{--                                        @endif--}}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="daterange">Range</label>
                                        <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD"  autocomplete="off">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="fp-range"></label>
                                        <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="button" id="search_button">Search</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div id="searchResult"></div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('script')
<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
        }, function(start, end, label) {
            $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#search_button').on('click', function() {
            let merchant_id = $('#merchant_id').val();
            let rider_id = $('#rider_id').val();
            let daterange = $('#daterange').val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.collection-search') }}",
                data: {
                    merchant_id: merchant_id,
                    rider_id: rider_id,
                    daterange: daterange,
                },
                error:function (response) {
                    $('#merchant_id').text(response.responseJSON.errors.merchant_id);
                },
                success: function(response) {
                    $("#searchResult").html(response);
                }

            });
            // if (merchant_id == '' || rider_id == '') {
            //     alert('Please Select Merchant Right Now');
            // } else {
            //
            // }
        });
    });
</script>
@endpush
