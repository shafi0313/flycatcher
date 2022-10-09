@extends('merchant.layouts.master')
@section('title', 'Mobile Banking')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Mobile Banking'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Mobile Banking' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> {{__('Mobile Banking')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mobileBankingModal"><i class="fas fa-arrows-alt"></i>
                                            Add new
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="mobileBankingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Add Mobile Banking</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('merchant.settings.mobile-banking.store')}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="rider_id">Select A Type <span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-sm" name="mobile_banking_id" id="mobile_banking_id">
                                                            <option value="" disabled>Select one</option>
                                                            @foreach($bankings as $banking)
                                                                <option value="{{$banking->id}}" >{{$banking->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('mobile_banking_id'))
                                                            <small class="text-danger">{{$errors->first('mobile_banking_id')}}</small>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rider_id">Mobile Number <span class="text-danger">*</span></label>
                                                        <input type="number" name="mobile_number" class="form-control" placeholder="Your Mobile Number">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($merchantBankings as $merchantBanking)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$merchantBanking->mobile_banking->name}}</td>
                                        <td>{{$merchantBanking->mobile_number}}</td>
                                        <td>
                                            @if($merchantBanking->status === 'active')
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>
                                            @include('merchant.settings.mobile-banking.edit')
                                        </td>
                                    </tr>
                                @endforeach
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



