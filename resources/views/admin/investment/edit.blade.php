@extends('layouts.master')
@section('title', 'Investment Update')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Investment list'=>route('admin.investments.index'),
    'Investment Update'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Investment Edit' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Investment Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.investments.update', $investment->id)}}" method="POST">
                                @method('put')
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="title" class="form-control" id="title" name="title" placeholder="Enter title" value="{{$investment->title}}">
                                            @if($errors->has('title'))
                                            <small class="text-danger">{{$errors->first('title')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{$investment->amount}}">
                                            @if($errors->has('amount'))
                                            <small class="text-danger">{{$errors->first('amount')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" placeholder="Additional Note" class="form-control">{{$investment->note}}</textarea>
                                            @if($errors->has('note'))
                                            <small class="text-danger">{{$errors->first('note')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Now</button>
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