@extends('layouts.master')
@section('title', 'Expense Head Add')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Expense Head List'=>route('admin.expense-head.index'),
            'Expense Head Create'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Expense Head create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Expense Head Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.expense-head.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="title">Expense Head name</label>
                                            <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter Expense Head" value="{{old('title')}}">
                                            @if($errors->has('title'))
                                                <small class="text-danger">{{$errors->first('title')}}</small>
                                            @endif
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
