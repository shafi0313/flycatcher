@extends('merchant.layouts.master')

@section('title','Settings')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('merchant.dashboard'),
            'Merchant settings'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Merchant settings' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <section id="basic-and-outline-pills">
            <div class="row match-height">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Settings</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="pill" href="#profile" aria-expanded="true">Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" aria-expanded="true">Password Reset</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="pill" href="#company" aria-expanded="false">Company Information</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="pickup-method-tab" data-toggle="pill" href="#pickup-method" aria-expanded="false">Pickup Methods</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="payment-methods-tab" data-toggle="pill" href="#payment_methods" aria-expanded="false">--}}
{{--                                        Payment Methods--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="bank-account-tab" data-toggle="pill" href="#bank_account" aria-expanded="false">--}}
{{--                                        Account Information--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="profile" aria-labelledby="home-tab" aria-expanded="true">
                                    <div class="card-body">
                                        <form action="{{route('merchant.settings.personal')}}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="name">Full name</label>
                                                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Full Name" value="{{$merchant->name}}">
                                                    <input type="hidden" name="id"  value="{{$merchant->id}}">
                                                    @if($errors->has('name'))
                                                        <small class="text-danger">{{$errors->first('name')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile number</label>
                                                    <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Full Name" value="{{$merchant->mobile}}">
                                                    @if($errors->has('mobile'))
                                                        <small class="text-danger">{{$errors->first('mobile')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Full Name" value="{{$merchant->email}}">
                                                    @if($errors->has('email'))
                                                        <small class="text-danger">{{$errors->first('email')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="password" aria-labelledby="password-tab" aria-expanded="false">
                                    <div class="card-body">
                                        <form action="{{route('merchant.settings.password.reset')}}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="old_password">Old Password</label>
                                                    <input type="password" class="form-control form-control-sm" id="old_password" name="old_password" placeholder="Enter Old Password">
                                                    <input type="hidden" name="id"  value="{{$merchant->id}}">
                                                    @if($errors->has('old_password'))
                                                        <small class="text-danger">{{$errors->first('old_password')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="password">New Password</label>
                                                    <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Type New Password">
                                                    @if($errors->has('password'))
                                                        <small class="text-danger">{{$errors->first('password')}}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="password_confirmation">Password Confirmation</label>
                                                    <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Retype Password">
                                                    @if($errors->has('password_confirmation'))
                                                        <small class="text-danger">{{$errors->first('password_confirmation')}}</small>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12 mb-1">
                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="company" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                    <div class="card-body">
                                        <form action="{{route('merchant.settings.company')}}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="company_name">Company name</label>
                                                    <input type="text" class="form-control form-control-sm" id="company_name" name="company_name" placeholder="Enter Company name" value="{{$merchant->company_name}}">
                                                    <input type="hidden" name="id"  value="{{$merchant->id}}">
                                                    @if($errors->has('company_name'))
                                                        <small class="text-danger">{{$errors->first('company_name')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="website_url">Company website</label>
                                                    <input type="text" class="form-control form-control-sm" id="website_url" name="website_url" placeholder="Enter Website URL" value="{{$merchant->website_url}}">
                                                    @if($errors->has('website_url'))
                                                        <small class="text-danger">{{$errors->first('website_url')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="company_name">Facebook page</label>
                                                    <input type="text" class="form-control form-control-sm" id="facebook_page" name="facebook_page" placeholder="Enter Facebook Page Link" value="{{$merchant->facebook_page}}">
                                                    @if($errors->has('facebook_page'))
                                                        <small class="text-danger">{{$errors->first('facebook_page')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="area_id">Select Area</label>
                                                <select class="select2 form-control form-control-sm" name="area_id" id="area_id">
                                                    <option value="" disabled>Select one</option>
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}" {{$area->id === $merchant->area_id ? 'selected': ''}}>{{$area->area_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('area_id'))
                                                    <small class="text-danger">{{$errors->first('area_id')}}</small>
                                                @endif

                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="address">Company Address</label>
                                                    <textarea class="form-control form-control-sm" name="address">{{$merchant->address}}</textarea>
                                                    @if($errors->has('address'))
                                                        <small class="text-danger">{{$errors->first('address')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-1">
                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

{{--                                <div class="tab-pane" id="pickup-method" role="tabpanel" aria-labelledby="pickup-method-tab" aria-expanded="false">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <form action="{{route('merchant.settings.pickup.method')}}" method="post">--}}
{{--                                            @csrf--}}

{{--                                            <div class="form-group col-md-6">--}}
{{--                                                <label for="hub_id">Select Nearest Hub</label>--}}
{{--                                                <select class="form-control form-control-sm" name="hub_id" id="hub_id">--}}
{{--                                                    <option value="" disabled>Select one</option>--}}
{{--                                                    @foreach($hubs as $hub)--}}
{{--                                                        @isset($pickupMethod->hub_id)--}}
{{--                                                            <option value="{{$hub->id}}" {{$pickupMethod->hub_id === $hub->id ? 'selected' : ''}}>{{$hub->name}}</option>--}}
{{--                                                        @else--}}
{{--                                                            <option value="{{$hub->id}}">{{$hub->name}}</option>--}}
{{--                                                        @endisset--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                @if($errors->has('hub_id'))--}}
{{--                                                    <small class="text-danger">{{$errors->first('hub_id')}}</small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-6">--}}
{{--                                                <label for="pickup_type">Pickup Reference</label>--}}
{{--                                                <select class="form-control form-control-sm" name="pickup_type" id="pickup_type">--}}
{{--                                                    <option value="" disabled>Select one</option>--}}
{{--                                                    @isset($pickupMethod->pickup_type)--}}
{{--                                                        <option value="daily" {{$pickupMethod->pickup_type === 'daily' ?'selected' : ''}}>Daily</option>--}}
{{--                                                        <option value="as_per_request" {{$pickupMethod->pickup_type === 'as_per_request' ?'selected' : ''}}>As per request</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="daily">Daily</option>--}}
{{--                                                        <option value="as_per_request">As per request</option>--}}
{{--                                                    @endisset--}}
{{--                                                </select>--}}
{{--                                                @if($errors->has('pickup_type'))--}}
{{--                                                    <small class="text-danger">{{$errors->first('pickup_type')}}</small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-12 mb-1">--}}
{{--                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="tab-pane" id="payment_methods" role="tabpanel" aria-labelledby="payment-methods-tab" aria-expanded="false">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <form action="{{route('merchant.settings.payment.method')}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            @method('put')--}}
{{--                                            <div class="form-group col-md-6">--}}
{{--                                                <label for="payment_method_id">Payment Method</label>--}}
{{--                                                <select class="form-control form-control-sm" name="payment_method_id" id="payment_method_id">--}}
{{--                                                    @foreach($paymentMethods as $payment)--}}
{{--                                                        <option value="{{$payment->id}}" {{$payment->id === $merchantPaymentMethod->payment_method_id ? 'selected' : ''}}>{{$payment->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                @if($errors->has('payment_method_id'))--}}
{{--                                                    <small class="text-danger">{{$errors->first('payment_method_id')}}</small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-6">--}}
{{--                                                <label for="withdraw_type">Withdrawal</label>--}}
{{--                                                <select class="form-control form-control-sm" name="withdraw_type" id="withdraw_type">--}}
{{--                                                    <option value="daily" {{$merchantPaymentMethod->withdraw_type === 'daily'?'selected': ''}}>Daily</option>--}}
{{--                                                    <option value="as_per_request" {{$merchantPaymentMethod->withdraw_type === 'as_per_request'? 'selected':''}}>As per request</option>--}}
{{--                                                </select>--}}
{{--                                                @if($errors->has('withdraw_type'))--}}
{{--                                                    <small class="text-danger">{{$errors->first('withdraw_type')}}</small>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-12 mb-1">--}}
{{--                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="tab-pane" id="bank_account" role="tabpanel" aria-labelledby="bank-account-tab" aria-expanded="false">--}}
{{--                                    <div class="card collapse-icon">--}}
{{--                                        <div class="card-body">--}}
{{--                                                <div class="collapse-margin" id="accordionExample">--}}
{{--                                                    <div class="card">--}}
{{--                                                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">--}}
{{--                                                            <span class="lead collapse-title"> Bank </span>--}}
{{--                                                        </div>--}}
{{--                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">--}}
{{--                                                            <div class="card-body">--}}
{{--                                                                <form action="{{route('merchant.settings.bank.account')}}" method="POST">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('put')--}}
{{--                                                                    <div class="form-group col-md-6">--}}
{{--                                                                        <label for="bank_id">Select A Bank <small class="text-danger">*</small></label>--}}
{{--                                                                        <select class="form-control form-control-sm" name="bank_id" id="bank_id">--}}
{{--                                                                            @foreach($banks as $bank)--}}
{{--                                                                                <option value="{{$bank->id}}" {{$bank->id === $bankAccount->bank_id ? 'selected' : ''}}>{{$bank->name}}</option>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </select>--}}
{{--                                                                        @if($errors->has('bank_id'))--}}
{{--                                                                            <small class="text-danger">{{$errors->first('bank_id')}}</small>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="form-group col-md-6">--}}
{{--                                                                        <label for="branch_name">Branch Name <small class="text-danger">*</small></label>--}}
{{--                                                                        <input type="text" class="form-control form-control-sm" id="branch_name" name="branch_name" placeholder="Enter Branch Name" value="{{$bankAccount->branch_name}}">--}}
{{--                                                                        <input type="hidden" name="id"  value="{{$bankAccount->id}}">--}}
{{--                                                                        @if($errors->has('branch_name'))--}}
{{--                                                                            <small class="text-danger">{{$errors->first('branch_name')}}</small>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="form-group col-md-6">--}}
{{--                                                                        <label for="routing_number">Routing Number</label>--}}
{{--                                                                        <input type="text" class="form-control form-control-sm" id="routing_number" name="routing_number" placeholder="Enter Routing Number" value="{{$bankAccount->routing_number}}">--}}
{{--                                                                        @if($errors->has('routing_number'))--}}
{{--                                                                            <small class="text-danger">{{$errors->first('routing_number')}}</small>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="form-group col-md-6">--}}
{{--                                                                        <label for="account_name">A/C Name <small class="text-danger">*</small></label>--}}
{{--                                                                        <input type="text" class="form-control form-control-sm" id="account_name" name="account_name" placeholder="Enter A/C Name" value="{{$bankAccount->account_name}}">--}}
{{--                                                                        @if($errors->has('account_name'))--}}
{{--                                                                            <small class="text-danger">{{$errors->first('account_name')}}</small>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="form-group col-md-6">--}}
{{--                                                                        <label for="account_name">A/C No <small class="text-danger">*</small></label>--}}
{{--                                                                        <input type="text" class="form-control form-control-sm" id="account_number" name="account_number" placeholder="Enter A/C NO" value="{{$bankAccount->account_number}}">--}}
{{--                                                                        @if($errors->has('account_number'))--}}
{{--                                                                            <small class="text-danger">{{$errors->first('account_number')}}</small>--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}

{{--                                                                    <div class="col-md-6 col-12 mb-1">--}}
{{--                                                                        <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>--}}
{{--                                                                    </div>--}}
{{--                                                                </form>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="card">--}}
{{--                                                        <div class="card-header" id="headingTwo" data-toggle="collapse" role="button" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
{{--                                                            <span class="lead collapse-title"> Mobile Banking </span>--}}
{{--                                                        </div>--}}
{{--                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">--}}
{{--                                                            <div class="card-body">--}}
{{--                                                                <div class="form-group col-md-6">--}}
{{--                                                                    <div class="table-responsive">--}}
{{--                                                                        <form method="POST" action="{{route('merchant.settings.mobile.banking')}}">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('put')--}}
{{--                                                                            <div class="form-group col-md-6">--}}
{{--                                                                                <label for="routing_number">Bkhash Number</label>--}}
{{--                                                                                <input type="text" class="form-control form-control-sm" id="bkash" name="bkash" placeholder="Enter Bkash Number" value="{{$mobileBanking->bkash}}">--}}
{{--                                                                                @if($errors->has('bkash'))--}}
{{--                                                                                    <small class="text-danger">{{$errors->first('bkash')}}</small>--}}
{{--                                                                                @endif--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="form-group col-md-6">--}}
{{--                                                                                <label for="routing_number">Rocket Number</label>--}}
{{--                                                                                <input type="text" class="form-control form-control-sm" id="rocket" name="rocket" placeholder="Enter rocket Number" value="{{$mobileBanking->rocket}}">--}}
{{--                                                                                @if($errors->has('rocket'))--}}
{{--                                                                                    <small class="text-danger">{{$errors->first('rocket')}}</small>--}}
{{--                                                                                @endif--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="form-group col-md-6">--}}
{{--                                                                                <label for="routing_number">Nogod Number</label>--}}
{{--                                                                                <input type="text" class="form-control form-control-sm" id="nogod" name="nogod" placeholder="Enter nogod Number" value="{{$mobileBanking->nogod}}">--}}
{{--                                                                                @if($errors->has('nogod'))--}}
{{--                                                                                    <small class="text-danger">{{$errors->first('nogod')}}</small>--}}
{{--                                                                                @endif--}}
{{--                                                                            </div>--}}

{{--                                                                            <div class="col-md-6 col-12 mb-1">--}}
{{--                                                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </form>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic pills ends -->
            </div>
        </section>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('/') }}app-assets/js/scripts/components/components-collapse.js"></script>
@endpush

