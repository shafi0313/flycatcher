@extends('layouts.master')

@section('title', 'Rider details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Rider list'=>route('admin.rider.index'),
                'Rider details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Rider details' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0">{{__('Rider details')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('admin.rider.edit', $rider->id)}}" class="btn btn-warning mr-1">{{__('Edit this info')}}</a>
                                    <a href="{{route('admin.rider.index')}}" class="btn btn-primary">{{__('View riders list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Rider name: </strong>{{$rider->name}} ({{$rider->rider_code}})</td>
                                        <td><strong>Rider mobile: </strong>{{$rider->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rider email: </strong>{{$rider->email}}</td>
                                        <td><strong>Rider NID no: </strong>{{$rider->nid}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Salary type: </strong>{{ucfirst($rider->salary_type)}}</td>
                                        <td><strong>Commission rate: </strong>{{$rider->commission_rate}} ({{ucfirst($rider->commission_type)}})</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Present address: </strong>{{ucfirst($rider->present_address)}}</td>
                                        <td><strong>Permanent address: </strong>{{$rider->permanent_address}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Status: </strong>
                                            @if($rider->status == 'active')
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
@endsection

