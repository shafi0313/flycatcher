 @extends('layouts.master')

 @section('title', 'Merchant Details')
 @section('content')
 <div class="content-wrapper">
     @php
     $links = [
     'Home'=>route('admin.dashboard'),
     'Merchant list'=>route('admin.merchant.index'),
     'Merchant details'=>''
     ]
     @endphp
     <x-bread-crumb-component title='Merchant details' :links="$links" />
     <div class="content-body">
         <!-- Responsive tables start -->
         <div class="row" id="table-responsive">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header ">
                         <div class="head-label">
                             <h4 class="mb-0">{{__('Merchant Details')}}</h4>
                         </div>
                         <div class="dt-action-buttons text-right">
                             <div class="dt-buttons d-inline-flex">
                                 <a href="{{route('admin.merchant.edit', $merchant->id)}}" class="btn btn-warning mr-1">{{__('Edit this info')}}</a>
                                 <a href="{{route('admin.merchant.index')}}" class="btn btn-primary">{{__('View merchant list')}}</a>
                             </div>
                         </div>
                     </div>
                     <div class="card-body table-responsive">
                         <table class="table">
                             <tbody>
                                 <tr>
                                     <td><strong>Merchant name: </strong>{{$merchant->name}} ({{$merchant->prefix}})</td>
                                     <td><strong>Company name: </strong>{{$merchant->company_name}}</td>
                                 </tr>
                                 <tr>
                                     <td><strong>Merchant email: </strong>{{$merchant->email}}</td>
                                     <td><strong>Merchant mobile: </strong>{{$merchant->mobile}}</td>
                                 </tr>
                                 <tr>
                                     <td><strong>Merchant area: </strong>{{$merchant->area->area_name }} ({{$merchant->area->area_code}})</td>
                                     <td><strong>Merchant address: </strong>{{$merchant->address}}</td>
                                 </tr>
                                 <tr>

                                     <td><strong>Status: </strong>
                                         @if($merchant->status == 'active')
                                         <div class="badge badge-success">Active</div>
                                         @else
                                         <div class="badge badge-danger">Inactive</div>
                                         @endif
                                     </td>
                                     <td>
                                         <strong>Enable or disable: </strong>
                                         @if($merchant->isActive == 1)
                                         <div class="badge badge-glow badge-success">Enable</div>
                                         @else
                                         <div class="badge badge-glow badge-warning">Disable</div>
                                         @endif
                                     </td>
                                 </tr>
                                 <tr>
                                     <td><strong>Created By: </strong>{{$merchant->admin->name ?? ''}}</td>
                                     <td><strong>Created Date: </strong>{{$merchant->created_at->format('F j, Y, g:i a')}}</td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>

             <div class="col-6">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between">
                         <h4 class="card-title">Pickup Method</h4>
                         <div class="dropdown chart-dropdown">
                             @isset($merchant->pickup_method)
                             {{ucfirst($merchant->pickup_method->pickup_type)}}
                             @endisset
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-header d-flex justify-content-between">
                         <h4 class="card-title">Payment Method</h4>
                         <div class="dropdown chart-dropdown">
                             {{ucfirst($merchant->payment_method->withdraw_type ?? '')}}
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-6">
                 <div class="card">
                     <div class="card-body">
                         <div class="head-label">
                             <h4 class="mb-1 text-center">{{__('Mobile Banking Info')}}</h4>
                         </div>
                         <div class="row">
                             <div class="col-md-12">
                                 @isset($merchant->merchant_active_mobile_bankings)
                                 <table class="table table-bordered">
                                     <thead>
                                         <tr>
                                             <th>Name</th>
                                             <th>Number</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach($merchant->merchant_active_mobile_bankings as $merchant_mobile_banking)
                                         <tr>
                                             <th>{{$merchant_mobile_banking->mobile_banking->name}}</th>
                                             <td>{{$merchant_mobile_banking->mobile_number}}</td>
                                         </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                                 @else
                                 <div class="text-danger text-center">This merchant dont set his mobile banking</div>
                                 @endisset
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-12">
                 <div class="card">
                     <div class="card-header ">
                         <div class="head-label">
                             <h4 class="mb-0">{{__('Delivery Charges & COD')}}</h4>
                         </div>
                         @can('set-delivery-charge')
                         <div class="dt-action-buttons text-right">
                             <div class="dt-buttons d-inline-flex">
                                 <a href="{{ route('admin.merchant.delivery.charge.create', $merchant->id) }}" class="btn btn-sm btn-primary" title="Set delivery charge">
                                     <i class="fas fa-hand-holding-usd"></i> {{__('Set Delivery Charge')}}
                                 </a>
                             </div>
                         </div>
                         @endcan

                     </div>
                     <div class="card-body">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>Sl no</th>
                                     <th>City Type</th>
                                     <th>Weight Range</th>
                                     <th>Delivery Charge (TK)</th>
                                     <th>COD (%)</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @forelse($merchant->delivery_charges as $deliveryCharge)
                                 <tr>
                                     <td>{{$loop->iteration}}</td>
                                     <td>{{$deliveryCharge->cityType->name}}</td>
                                     <td>{{$deliveryCharge->weightRange->min_weight}} - {{$deliveryCharge->weightRange->max_weight}} KG</td>
                                     <td>{{$deliveryCharge->delivery_charge}}</td>
                                     <td>{{$deliveryCharge->cod}}</td>
                                     <td>
                                         @if($deliveryCharge->status === 'active')
                                         <div class="badge badge-success">Active</div>
                                         @else
                                         <div class="badge badge-danger">Inactive</div>
                                         @endif
                                     </td>
                                     <td>
                                         @php

                                         if(auth()->user()->can('edit-set-delivery-charge')){
                                         $actions['edit'] = route('admin.merchant.delivery.charge.edit', $deliveryCharge->id);
                                         }
                                         $actions['delete'] = route('admin.merchant.delivery.charge.delete', $deliveryCharge->id);
                                         @endphp
                                         <x-action-component :actions="$actions" status="{{ $merchant->status }}" />
                                     </td>
                                 </tr>
                                 @empty
                                 <td colspan="7" class="text-center text-danger">No Delivery Charge Set Yet !</td>
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