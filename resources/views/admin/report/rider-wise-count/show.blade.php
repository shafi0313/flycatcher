@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Area Wise Parcel')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Rider Wise Total Parcel'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Rider Wise Total Parcel' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rider Wise Total Parcel</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="rider_id">Select Rider</label>

                                            <select class="form-control select2" name="rider_id" id="rider_id" required>
                                                <option value="all"  selected>All</option>
                                                @foreach($riders as $rider)
                                                    <option value="{{$rider->id}}">{{$rider->name}} ({{$rider->rider_code}})</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('rider_id'))
                                                <small class="text-danger">{{$errors->first('rider_id')}}</small>
                                            @endif

                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="date_range">Range</label>
                                            <input type="text" id="date_range" class="form-control flatpickr-range" name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                        </div>
                                        <div class="col-md-4 form-group">
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
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#search_button').on('click', function() {
                let rider_id = $('#rider_id').val();
                let date_range = $('#date_range').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.rider-wise-parcel-count-search') }}",
                    data: {
                        rider_id: rider_id,
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

