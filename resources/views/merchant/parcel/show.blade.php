@extends('merchant.layouts.master')

@section('title', 'Parcel details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Parcel list'=>route('merchant.parcel.index'),
                'Parcel details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel details' :links="$links" />
        <div class="content-body">
            @include('components.parcel-details')
        </div>
    </div>
@endsection

