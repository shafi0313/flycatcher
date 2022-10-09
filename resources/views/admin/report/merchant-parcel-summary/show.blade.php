@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Merchant Parcel Summary')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Merchant Parcel Summary'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Merchant Parcel Summary' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Merchant Parcel Summary</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="date_range">Range</label>
                                        <input type="text" id="date_range" class="form-control flatpickr-range" name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="merchant_id">Select Merchant </label>
                                        <select class="form-control select2" name="merchant_id" id="merchant_id">
                                            <option value="">Select One</option>
                                            @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="search_button"></label>
                                        <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="button">Search
                                        </button>
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
        $('input[name="date_range"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            let date_range = $('#date_range').val();
            let merchant_id = $('#merchant_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.merchant.parcel.summary.search') }}",
                data: {
                    date_range: date_range,
                    merchant_id: merchant_id,
                },
                success: function(response) {
                    console.log(response)
                    $("#searchResult").html(response);
                }
            });
        });
    });
</script>
@endpush