@extends('layouts.master')

@section('title', 'Expense Details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Expense List'=>route('admin.expense.index'),
                'Expense Details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Expense details' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0">{{__('Expense Details')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('admin.expense.index')}}" class="btn btn-primary">{{__('View Expnese List')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><b>Title:</b> {{$expense->expense_head->title}}</td>
                                        <td><b>Amount:</b> {{$expense->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>Additional Note:</b> {{$expense->note}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Created Date:</b> {{date('d M Y, i H A', strtotime($expense->created_at))}}</td>
                                        <td><b>Updated Date:</b> {{date('d M Y, i H A', strtotime($expense->updated_at))}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Created By:</b> {{$expense->created_admin->name}}</td>
                                        @isset($expense->updated_admin)
                                            <td><b>Updated By:</b> {{$expense->updated_admin->name}}</td>
                                        @else
                                            <td><b>Updated By:</b> </td>
                                        @endisset
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


