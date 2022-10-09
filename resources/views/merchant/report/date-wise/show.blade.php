@extends('merchant.layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Date Wise Parcel')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('merchant.dashboard'),
            'Date Wise Parcel'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Date Wise Parcel' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Date Wise Parcel</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="date_range">Date Range</label>
                                            <input type="text" id="date_range" class="form-control flatpickr-range"
                                                   name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                   autocomplete="off">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="search_button"></label>
                                            <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="button">Search</button>
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
                opens: 'left',
                autoUpdateInput: false,
            }, function(start, end, label) {
                $('input[name="date_range"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#search_button').on('click', function() {
                let date_range = $('#date_range').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('merchant.date-wise-parcel-search') }}",
                    data: {
                        date_range: date_range,
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

