@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Customer</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Customer Create
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('user.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customer Create</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}"  autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="{{ old('mobile') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bin_no">BIN Number</label>
                                            <input type="text" class="form-control" id="bin_no" name="bin_no" placeholder="Enter BIN Number" value="{{ old('bin_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="img_url">Image</label>
                                            <input type="file" class="form-control" id="img_url" name="img_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="btrc_license_url"> BTRC License</label>
                                            <input type="file" class="form-control" id="btrc_license_url" name="btrc_license_url" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nid_url">NID </label>
                                            <input type="file" class="form-control" id="nid_url" name="nid_url" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="trade_license_url">Trade License</label>
                                            <input type="file" class="form-control" id="trade_license_url" name="trade_license_url" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="contact_authorization_url">Contact Authorization</label>
                                            <input type="file" class="form-control" id="contact_authorization_url" name="contact_authorization_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="billing_address">Billing Address</label>
                                            <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ old('billing_address') }}">
                                        </div>
                                    </div>
                                    @if (Auth::guard('admin')->user()->hasRole('Super Admin|Admin'))

                                    <div class="col-xl-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="marketing_user_id">Assign Marketing</label>
                                            <select class="form-control" id="marketing_user_id" name="marketing_user_id" required>
                                                <option value="">Select One</option>
                                                @foreach($marketing_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if (Auth::guard('admin')->user()->hasRole('Super Admin|Admin'))

                                    <div class="col-xl-3 col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="accounts_user_id">Assign Accounts</label>
                                            <select class="form-control" id="accounts_user_id" name="accounts_user_id" required>
                                                <option value="">Select One</option>
                                                @foreach($accounts_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
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

@endpush
