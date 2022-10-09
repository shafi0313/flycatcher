@php

$actions = [];
if($merchant->status === 'active'){
$actions['edit'] = route('admin.merchant.edit', $merchant->id);
$actions['active'] = route('admin.merchant.active', $merchant->id);
}

if($merchant->status === 'pending'){
$actions['pending'] = route('admin.merchant.pending', $merchant->id);
}
if($merchant->status === 'inactive'){
$actions['inactive'] = route('admin.merchant.inactive', $merchant->id);
}
$actions['show'] = route('admin.merchant.show', $merchant->id);
//$actions['delete'] = route('admin.merchant.destroy', $merchant->id);
@endphp
<div class="d-flex align-items-center">
    <x-action-component :actions="$actions" status="{{ $merchant->status }}" />
    @can('goto-dashboard-merchant')
    <div class="mr-1">
        <a href="{{route('admin.merchant.login', $merchant->id)}}" class="btn btn-sm btn-primary" title="Go to Merchant Dashboard">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    @endcan

</div>