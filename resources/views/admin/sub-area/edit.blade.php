@extends('layouts.master')
@section('title', 'Sub Area update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Sub Area list'=>route('admin.sub-area.index'),
                'Sub Area update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Sub Area update' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sub Area Edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.sub-area.update', $subArea->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="district_id">Select Area</label>

                                            <select class="form-control select2" name="area_id" id="area_id">
                                                <option value="">Select one</option>
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}" {{$area->id === $subArea->area_id ? 'selected' : ''}}>{{$area->area_name}} ({{$area->area_code}})</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('area_id'))
                                                <small class="text-danger">{{$errors->first('area_id')}}</small>
                                            @endif

                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Sub Area Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$subArea->name}}">
                                                @if($errors->has('name'))
                                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="code">Sub Area Code</label>
                                                <input type="text" class="form-control" id="code" name="code" placeholder="Enter area code" value="{{$subArea->code}}">
                                                <input type="hidden"  id="id" name="id" value="{{$subArea->id}}">
                                                @if($errors->has('code'))
                                                    <small class="text-danger">{{$errors->first('code')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="district_id">Change Status</label>

                                            <select class="form-control select2" name="status" id="status">
                                                <option value="active" {{$subArea->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$subArea->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                            @if($errors->has('area_id'))
                                                <small class="text-danger">{{$errors->first('area_id')}}</small>
                                            @endif

                                        </div>
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Update</button>
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
