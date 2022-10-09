@extends('layouts.master')
@section('title', 'Expense Update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Expense list'=>route('admin.expense.index'),
                'Expense Update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Expense edit' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Expense Edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.expense.update', $expense->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="expense_head_id">Expense Title</label>
                                                <select class="form-control form-control-sm" name="expense_head_id" id="expense_head_id">
                                                    <option value="" disabled>Select one</option>
                                                    @foreach($expenseHeads as $expenseHead)
                                                        <option value="{{$expenseHead->id}}" {{$expenseHead->id === $expense->expense_head_id?'selected': ''}}>{{$expenseHead->title}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('expense_head_id'))
                                                    <small class="text-danger">{{$errors->first('expense_head_id')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="c">Amount</label>
                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" value="{{$expense->amount}}">
                                                @if($errors->has('amount'))
                                                    <small class="text-danger">{{$errors->first('amount')}}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea name="note" id="note" placeholder="Additional Note" class="form-control form-control-sm">{{$expense->note}}</textarea>
                                                @if($errors->has('amount'))
                                                    <small class="text-danger">{{$errors->first('amount')}}</small>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>
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
