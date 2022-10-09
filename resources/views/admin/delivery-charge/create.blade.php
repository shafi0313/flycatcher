@extends('layouts.master')
@section('title', 'Delivery charge add')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Delivery charge list'=>route('admin.delivery-charge.index'),
                'Delivery charge create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Delivery charge create' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Delivery Charge Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.delivery-charge.store')}}" method="POST" class="">
                                    @csrf
                                    @include('admin.partials.create-delivery-charge')
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


