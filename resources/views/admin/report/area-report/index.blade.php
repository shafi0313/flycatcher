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
                'Area Wise Parcel'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Area Wise Parcel' :links="$links"/>
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Area Wise Parcel</h4>
                                <a href="{{route('admin.area-report.print')}}" class="btn btn-primary">Print Now</a>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Area Name</th>
                                        <th>Sub Area Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($areas as $area)
                                        <tr>
                                            <td>{{$area->area_name}}</td>

                                            <td>
                                                @foreach($area->sub_areas as $sub_area)
                                                    <p><b>{{$loop->iteration}}.</b> {{$sub_area->name}}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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




