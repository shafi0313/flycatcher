@extends('layouts.master')
@section('title', 'Delivery charge update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Delivery charge list'=>route('admin.delivery-charge.index'),
                'Delivery charge update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Delivery charge update' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Delivery charge Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.delivery-charge.update', $charge->id)}}" method="POST" class="">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.partials.edit-delivery-charge')
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

