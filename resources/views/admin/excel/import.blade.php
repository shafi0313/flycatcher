@extends('layouts.master')
@section('title', 'File Upload')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel Create'=>route('admin.parcel.create'),
    'Bacth Upload'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Bacth Upload' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bacth Upload</h4>
                            <a class="btn btn-info" href="{{asset('batch/parcelsheba-sample.xlsx')}}">Sample Excel Download</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.import')}}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="merchant_id">Merchant <span style="color: red;">*</span></label>
                                        <select class="form-control select2" id="merchant_id" name="merchant_id" required>
                                            <option value="">Select One</option>
                                            @foreach($merchants as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">File</label>
                                        <input type="file" name="file" class="form-control" required>

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