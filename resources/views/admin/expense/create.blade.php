@extends('layouts.master')
@section('title', 'Expense Add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Expense List'=>route('admin.expense.index'),
    'Expense Create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Expense create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Expense Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.expense.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="expense_head_id">Expense Title</label>
                                            <select class="form-control select2" name="expense_head_id" id="expense_head_id">
                                                <option value="">Select One</option>
                                                @foreach($expenseHeads as $expenseHead)
                                                <option value="{{$expenseHead->id}}">{{$expenseHead->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('expense_head_id'))
                                            <small class="text-danger">{{$errors->first('expense_head_id')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="c">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{old('amount')}}">
                                            @if($errors->has('amount'))
                                            <small class="text-danger">{{$errors->first('amount')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" placeholder="Additional Note" class="form-control" rows="1">{{old('note')}}</textarea>
                                            @if($errors->has('amount'))
                                            <small class="text-danger">{{$errors->first('amount')}}</small>
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