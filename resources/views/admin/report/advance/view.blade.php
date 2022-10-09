@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Advance Report')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Advance Report'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Advance Report' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="POST" class="">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="date_range">Hub Name</label>
                                                <select name="hub_id" id="hub_id" class="form-control">
                                                    @foreach($hubs as $hub)
                                                        <option value="0" selected>All</option>
                                                        <option value="{{$hub->id}}">{{$hub->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="date_range">Date Range</label>
                                                <input type="text" id="date_range" class="form-control flatpickr-range"
                                                       name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                       autocomplete="off">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="search_button"></label>
                                                <button
                                                    class="btn btn-primary waves-effect waves-float waves-light form-control"
                                                    id="search_button" type="button">Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div id="searchResult"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
    <script>
        $(function () {
            $('input[name="date_range"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
            }, function (start, end, label) {
                $('input[name="date_range"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('#search_button').on('click', function () {
                let date_range = $('#date_range').val();
                let hub_id = $('#hub_id').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.advance-report-search') }}",
                    data: {
                        hub_id: hub_id,
                        date_range: date_range,
                    },
                    success: function (response) {
                        console.log(response)
                        $("#searchResult").html(response);
                    }
                });
            });
        });
    </script>
@endpush

