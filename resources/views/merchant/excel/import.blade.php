@extends('merchant.layouts.master')
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
                            <p style="color: #d30a0a;">এক্সেল ফাইল আপলোড দেওয়ার আগে দয়া করে চেক করে নিবেন যাতে এরিয়া কোড মিসিং না হয়  ।সর্বোচ্চ ৬৫ টি পার্সেল একসাথে আপলোড দিন। 
 নির্দেশনাটি ফলো করার জন্য ধন্যবাদ</p>
                            <form action="{{route('merchant.import')}}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">File</label>
                                        <input type="file" name="file" class="form-control">

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