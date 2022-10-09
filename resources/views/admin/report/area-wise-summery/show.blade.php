@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Area Wise Parcel Summery')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Area Wise Parcel Summery'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Area Wise Parcel Summery' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Area Wise Parcel Summery</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="">
                                    @csrf
                                    <div class="row" >
                                        <div class="form-group col-md-3">
                                            <label for="rider_id">Select Area </label>
                                            <select class="form-control select2" name="area_id" id="area_id">
                                                <option value="" disabled selected>Select one</option>
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->area_name}} ({{$area->area_code}})</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-md-3 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="course_id">Sub Area Name</label>
                                                <select class="form-control select2" name="sub_area_id" id="sub_area_id">
                                                    <option value="" selected disabled>Select One</option>
                                                </select>
                                                @if($errors->has('sub_area_id'))
                                                    <small class="text-danger">{{$errors->first('sub_area_id')}}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="date_range">Date Range</label>
                                            <input type="text" id="date_range" class="form-control flatpickr-range" name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD"  autocomplete="off">
                                        </div>

                                        <div class="col-md-3 form-group">
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

    <script type="text/javascript">
        $(document).ready(function () {
            // get phase data by course id
            $("select#area_id").change(function () {
                let area_id = $(this).children("option:selected").val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.get-sub-area-data-by-area-id') }}",
                    data: {
                        area_id: area_id,
                    },
                    success: function (response) {
                        console.log(response);
                        $('select[name="sub_area_id"]').empty();
                        $("#sub_area_id").html(response.html);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#search_button').on('click', function() {
                let area_id = $('#area_id').val();
                let sub_area_id = $('#sub_area_id').val();
                let date_range = $('#date_range').val();
                if (area_id == null) {
                    alert('Please Select Area Right Now');
                } else {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.area-wise-parcel-summery-search') }}",
                        data: {
                            area_id: area_id,
                            sub_area_id: sub_area_id,
                            date_range: date_range,
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
@endpush


