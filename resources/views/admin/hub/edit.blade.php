@extends('layouts.master')
@section('title', 'Edit Hub')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Hub list'=>route('admin.hub.index'),
            'Edit Hub'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Hub list' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hub Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.hub.update',$model->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="area_id">Area</label>
                                            <select class="select2 form-control" name="area_id">
                                                <option value="">Select One</option>
                                                @forelse($areas as $area)
                                                    <option value="{{$area->id}}" {{ $area->id == $model->area_id ?'selected':'' }}>{{$area->area_name}}</option>
                                                @empty
                                                @endforelse
                                                @if($errors->has('area_id'))
                                                    <small class="text-danger">{{$errors->first('area_id')}}</small>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$model->name}}" placeholder="Enter Name">
                                            @if($errors->has('name'))
                                                <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                            <input type="hidden" name="id" value="{{$model->id}}" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="hub_code">Hub Code</label>
                                            <input type="text" class="form-control" id="hub_code" name="hub_code" placeholder="Enter Hub Code" value="{{$model->hub_code}}">
                                            @if($errors->has('hub_code'))
                                                <small class="text-danger">{{$errors->first('hub_code')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="upazila_id">Select Status</label>

                                        <select class="form-control form-control-sm select2" name="status" id="status">
                                            <option value="active" {{$model->status === 'active' ? 'selected' : ''}}>Active</option>
                                            <option value="inactive" {{$model->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                        </select>
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

