@extends('layouts.master')
@section('title', 'Sub Area Add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Sub Area list'=>route('admin.sub-area.index'),
    'Sub Area create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Sub Area Create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sub Area Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sub-area.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="area_id">Area Name</label>

                                        <select class="form-control select2" name="area_id" id="area_id">
                                            <option value="" disabled>Select one</option>
                                            @foreach($areas as $area)
                                            @if (old('area_id')==$area->id)
                                            <option value={{$area->id}} selected>{{$area->area_name}} ({{$area->area_code}})</option>
                                            @else
                                            <option value="{{$area->id}}">{{$area->area_name}} ({{$area->area_code}})</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('area_id'))
                                        <small class="text-danger">{{$errors->first('area_id')}}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Sub Area Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Area Name" value="{{old('name')}}">
                                            @if($errors->has('name'))
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="code">Sub Area Code</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter area code" value="{{old('code')}}">
                                            @if($errors->has('code'))
                                            <small class="text-danger">{{$errors->first('code')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection