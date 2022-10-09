@extends('layouts.master')
@section('title', 'Customer Export')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Customer Export'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Customer Export' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customer Export</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.customer-export.download')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Select Merchants</label>
                                        {!! Form::select('merchant_id[]', $merchants, $select_merchants, array('class' => 'select2 form-control form-control-sm','multiple' => 'multiple')) !!}
                                    </div>
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="type">Select Area</label>
                                            <select name="area_id" id="area_id" class="form-control select2">
                                                <option value="">All</option>
                                                @forelse ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            @if($errors->has('area_id'))
                                            <small class="text-danger">{{$errors->first('area_id')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="form-group">
                                            <label for="daterange">Range</label>
                                            <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Export Here</button>
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
@push('script')
<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
@endpush