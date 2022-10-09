@extends('layouts.master')
@section('title', 'Weight Range update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Weight Range list'=>route('admin.weight-range.index'),
                'Weight Range update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Weight Range' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Weight Range Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.weight-range.update', $weightRange->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="min_weight">Min weight in kg</label>
                                                <input type="text" class="form-control form-control-sm" id="min_weight" name="min_weight" placeholder="Enter min weight" value="{{$weightRange->min_weight}}">
                                                @if($errors->has('min_weight'))
                                                    <small class="text-danger">{{$errors->first('min_weight')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="max_weight">Max weight in kg</label>
                                                <input type="text" class="form-control form-control-sm" id="max_weight" name="max_weight" placeholder="Enter max weight" value="{{$weightRange->max_weight}}">
                                                <input type="hidden"  name="id"  value="{{$weightRange->id}}">
                                                @if($errors->has('max_weight'))
                                                    <small class="text-danger">{{$errors->first('max_weight')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="Enter Code" value="{{$weightRange->code}}">
                                                @if($errors->has('code'))
                                                    <small class="text-danger">{{$errors->first('code')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <label for="status">Select Status</label>

                                            <select class="form-control form-control-sm" name="status" id="status">
                                                <option value="active" {{$weightRange->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$weightRange->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
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
