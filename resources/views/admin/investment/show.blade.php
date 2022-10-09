@extends('layouts.master')

@section('title', 'Investment Details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Investment List'=>route('admin.investments.index'),
    'Investment Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Investment Details' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Investment Details')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.investments.index')}}" class="btn btn-primary">{{__('View Investment List')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Title:</b> {{$investment->title}}</td>
                                    <td><b>Amount:</b> {{$investment->amount}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Additional Note:</b> {{$investment->note}}</td>
                                </tr>
                                <tr>
                                    <td><b>Created Date:</b> {{date('d M Y, i H A', strtotime($investment->created_at))}}</td>
                                    <td><b>Updated Date:</b> {{date('d M Y, i H A', strtotime($investment->updated_at))}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Created By:</b>
                                        {{$investment->added_by->name ?? ''}}
                                    </td>
                                    <td>
                                        <b>Updated By:</b>
                                        {{$investment->modified_by->name ?? ''}}
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