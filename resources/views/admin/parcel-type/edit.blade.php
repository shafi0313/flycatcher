@extends('layouts.master')
@section('title', 'Parcel Type update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Parcel Type list'=>route('parcel-type.index'),
                'Parcel Type update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel type edit' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Parcel type edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('parcel-type.update', $parcelType->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <input type="hidden"  id="id" name="id" value="{{$parcelType->id}}">
                                                <label for="name">Parcel type name</label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Parcel type Name" value="{{$parcelType->name}}">
                                                @if($errors->has('name'))
                                                    <small class="text-danger">{{$parcelType->first('name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <label for="status">Select Status</label>
                                            <select class="form-control form-control-sm" name="status" id="status">
                                                <option value="active" {{$parcelType->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$parcelType->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
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
@section('css')

@endsection
@section('js')

@endsection
