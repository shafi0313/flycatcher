@extends('merchant.layouts.master')
@section('title', 'Bank Info')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Bank Info'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Bank Info' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> {{__('Bank Info')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#merchantBankInfoModal"><i class="fas fa-arrows-alt"></i>
                                            Add new
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="merchantBankInfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Add New Bank Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('merchant.settings.bank-info.store')}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="rider_id">Select A Type <span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-sm select2" name="bank_id" id="bank_id">
                                                            <option value="" disabled>Select one</option>
                                                            @foreach($banks as $bank)
                                                                <option value="{{$bank->id}}" >{{$bank->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('bank_id'))
                                                            <small class="text-danger">{{$errors->first('bank_id')}}</small>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="account_name">Branch Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="account_name" name="branch_name" class="form-control" placeholder="Branch Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="account_name">Account Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="account_name" name="account_name" class="form-control" placeholder="Account Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="account_number">Account Number <span class="text-danger">*</span></label>
                                                        <input type="text" id="account_number" name="account_number" class="form-control" placeholder="Your Account Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="routing_number">Routing Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="routing_number" id="routing_number" class="form-control" placeholder="Your Routing Number">
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
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Routing Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($merchantBankAccounts as $merchantBankAccount)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$merchantBankAccount->bank->name?? ''}}</td>
                                        <td>{{$merchantBankAccount->branch_name}}</td>
                                        <td>{{$merchantBankAccount->account_name}}</td>
                                        <td>{{$merchantBankAccount->account_number}}</td>
                                        <td>{{$merchantBankAccount->routing_number}}</td>
                                        <td>
                                            @if($merchantBankAccount->status === 'active')
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>
                                            @include('merchant.settings.bank-info.edit')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <h6 class="text-danger text-center">Sorry You dont add a bank info yet. Please add a bank account</h6>
                                        </td>
                                    </tr>
                                @endforelse
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




