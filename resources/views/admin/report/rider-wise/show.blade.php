@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Rider Wise Parcel')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel'=>route('admin.parcel.index'),
    'Rider Wise Parcel'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Rider Wise Parcel' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="head-label">
                                <h4 class="mb-0">Rider Wise Parcel</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" class="" target="_blank">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="rider_id">Select Rider</label>

                                        <select class="form-control select2" name="rider_id" id="rider_id" required>
                                            <option value="" disabled selected>Select one</option>
                                            @foreach($riders as $rider)
                                            <option value="{{$rider->id}}">{{$rider->name}} ({{$rider->rider_code}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('rider_id'))
                                        <small class="text-danger">{{$errors->first('rider_id')}}</small>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="status">Select Status</label>
                                        <select class="form-control select2" name="status" id="status">
                                            <option value="all" selected>All</option>
                                            <option value="pending" selected>Pending</option>
                                            <option value="transit">Transit</option>
                                            <option value="delivered">Delivered/Cash</option>
                                            <option value="partial">Partial</option>
                                            <option value="hold">Hold</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        @if($errors->has('status'))
                                        <small class="text-danger">{{$errors->first('status')}}</small>
                                        @endif

                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="daterange">Range</label>
                                        <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD" autocomplete="off">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label></label>
                                        <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="button" id="search_button">Search</button>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label></label>
                                        <button class="btn btn-warning waves-effect waves-float waves-light form-control" onclick="window.location.reload()" type="button" id="refresh_button">Refresh</button>
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
            var rider_id = $('#rider_id').val();
            var status = $('#status').val();
            var daterange = $('#daterange').val();
            if (rider_id == null) {
                alert('Please Select Rider Right Now');
            } else {

                $.ajax({

                    type: "GET",
                    url: "{{ route('admin.rider-wise-parcel-search') }}",
                    data: {
                        rider_id: rider_id,
                        status: status,
                        daterange: daterange,
                    },
                    success: function(response) {
                        console.log(response);
                        $("#searchResult").html(response);

                    }
                });
            }
        });


    });
</script>
@endpush