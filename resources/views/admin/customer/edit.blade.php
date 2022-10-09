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
                            <li class="breadcrumb-item active">Customer Edit
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
                            <h4 class="card-title">Customer Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.update',$user->id)}}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" value="{{$user->email}}" name="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password Confirmation">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="{{$user->mobile}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="vin_no">BIN Number</label>
                                            <input type="text" class="form-control" id="bin_no" name="bin_no" placeholder="Enter BIN Number" value="{{$user->bin_no}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-8">
                                        <div class="form-group">
                                            <label for="img_url">Image</label>
                                            <input type="file" class="form-control" id="img_url" name="img_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-2 col-4">
                                        <img style="height: 100px;padding: 5px;" src="{{asset('storage/customer/'.$user->img_url)}}" alt=" No File" class="img-fluid">
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-8">
                                        <div class="form-group">
                                            <label for="btrc_license_url"> BTRC License</label>
                                            <input type="file" class="form-control" id="btrc_license_url" name="btrc_license_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-2 col-4">

                                        @if($user->btrc_license_url)
                                        @php
                                        $ext =pathinfo($user->btrc_license_url, PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($ext == 'pdf')
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/btrc_license/'.$user->btrc_license_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $user->btrc_license_url }}" class="img-fluid"></a>

                                        @else
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/btrc_license/'.$user->btrc_license_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                        @endif
                                        @else
                                        <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-8">
                                        <div class="form-group">
                                            <label for="nid_url">NID </label>
                                            <input type="file" class="form-control" id="nid_url" name="nid_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-2 col-4">
                                        @if($user->nid_url)
                                        @php
                                        $ext =pathinfo($user->nid_url, PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($ext == 'pdf')
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/nid/'.$user->nid_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $user->nid_url }}" class="img-fluid"></a>
                                        @else
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/nid/'.$user->nid_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                        @endif
                                        @else
                                        <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-8">
                                        <div class="form-group">
                                            <label for="trade_license_url">Trade License</label>
                                            <input type="file" class="form-control" id="trade_license_url" name="trade_license_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-2 col-4">
                                        @if($user->trade_license_url)
                                        @php
                                        $ext =pathinfo($user->trade_license_url, PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($ext == 'pdf')
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/trade_license/'.$user->trade_license_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $user->trade_license_url }}" class="img-fluid"></a>

                                        @else
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/trade_license/'.$user->trade_license_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                        @endif
                                        @else
                                        <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-8">
                                        <div class="form-group">
                                            <label for="contact_authorization_url">Contact Authorization</label>
                                            <input type="file" class="form-control" id="contact_authorization_url" name="contact_authorization_url">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-2 col-4">
                                        @if($user->contact_authorization_url)
                                        @php
                                        $ext =pathinfo($user->contact_authorization_url, PATHINFO_EXTENSION);
                                        @endphp
                                        @if ($ext == 'pdf')
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/contact_authorization/'.$user->contact_authorization_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $user->contact_authorization_url }}" class="img-fluid"></a>

                                        @else
                                        <a target="_blank" class="iframe-popup" href="{{asset('storage/contact_authorization/'.$user->contact_authorization_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                        @endif
                                        @else
                                        <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="billing_address">Billing Address</label>
                                            <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{$user->billing_address}}">
                                        </div>
                                    </div>
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
<script>
    $(document).ready(function() {
        $('.iframe-popup').magnificPopup({
            type: 'iframe'
        });
    });
</script>
@endpush
