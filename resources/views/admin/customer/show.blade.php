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
                            <li class="breadcrumb-item active">Customer Show
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
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a class="dropdown-item" href="{{route('user.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Customer List</span></a>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Show</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tr>
                                <th rowspan="2">Image</th>
                                <td rowspan="2">
                                    <img src="{{asset('storage/customer/'.$model->img_url)}}" alt=" No File" class="img-fluid">
                                </td>
                                <th>Name</th>
                                <td>{{$model->name}}</td>
                                <th>Email</th>
                                <td>{{$model->email}}</td>
                                <th>Mobile</th>
                                <td>{{$model->mobile}}</td>
                            </tr>
                            <tr>

                                <th>VIN Number</th>
                                <td>{{$model->bin_no}}</td>
                                <th>Billing Address</th>
                                <td>{{$model->billing_address}}</td>
                            </tr>
                            <tr>
                                <th>Btrc License</th>
                                <td>

                                    @if($model->btrc_license_url)
                                    @php
                                    $ext =pathinfo($model->btrc_license_url, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($ext == 'pdf')
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/btrc_license/'.$model->btrc_license_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $model->btrc_license_url }}" class="img-fluid"></a>

                                    @else
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/btrc_license/'.$model->btrc_license_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                    @endif
                                    @else
                                    <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                    @endif
                                </td>
                                <th>Trade License</th>
                                <td>

                                    @if($model->trade_license_url)
                                    @php
                                    $ext =pathinfo($model->trade_license_url, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($ext == 'pdf')
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/trade_license/'.$model->trade_license_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $model->trade_license_url }}" class="img-fluid"></a>

                                    @else
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/trade_license/'.$model->trade_license_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                    @endif
                                    @else
                                    <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                    @endif
                                </td>
                                <th>NID</th>
                                <td>

                                    @if($model->nid_url)
                                    @php
                                    $ext =pathinfo($model->nid_url, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($ext == 'pdf')
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/nid/'.$model->nid_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $model->nid_url }}" class="img-fluid"></a>
                                    @else
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/nid/'.$model->nid_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                    @endif
                                    @else
                                    <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                    @endif
                                </td>
                                <th>Contact Authorization</th>
                                <td>

                                    @if($model->contact_authorization_url)
                                    @php
                                    $ext =pathinfo($model->contact_authorization_url, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($ext == 'pdf')
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/contact_authorization/'.$model->contact_authorization_url)}}"> <img src="{{asset('app-assets/images/icons/pdfs-icon.png')}}" alt=" {{ $model->contact_authorization_url }}" class="img-fluid"></a>
                                    @else
                                    <a target="_blank" class="iframe-popup" href="{{asset('storage/contact_authorization/'.$model->contact_authorization_url)}}"> <img src="{{asset('app-assets/images/icons/pictures-icon.png')}}" alt="" class="img-fluid"></a>
                                    @endif
                                    @else
                                    <img src="{{asset('app-assets/images/icons/no-file.png')}}" alt=" No File" class="img-fluid">
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
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
