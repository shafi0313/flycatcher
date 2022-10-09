@extends('layouts.master')

@section('title', 'Date Adjust')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Date Adjust'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Delivery Charge' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Date Adjust')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                               
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <a href="{{route('admin.parcel.date.adjust.apply')}}" class="btn btn-primary" onclick="return confirm('Are you sure?')">{{__('Date Adjust')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection

@push('script')

@endpush
