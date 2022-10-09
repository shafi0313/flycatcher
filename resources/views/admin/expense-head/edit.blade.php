@extends('layouts.master')
@section('title', 'Expense Head update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Expense Head list'=>route('admin.expense-head.index'),
                'Expense Head update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Expense Head edit' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Expense Head Edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.expense-head.update', $expenseHead->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <input type="hidden"  id="id" name="id" value="{{$expenseHead->id}}">
                                                <label for="title">Expense Head name</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Expense Head " value="{{$expenseHead->title}}">
                                                @if($errors->has('title'))
                                                    <small class="text-danger">{{$expenseHead->first('title')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <label for="status">Select Status</label>
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="active" {{$expenseHead->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$expenseHead->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
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
