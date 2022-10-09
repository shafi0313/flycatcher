@extends('layouts.master')
@section('title', 'User Create')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'User list'=>route('admin.admin.index'),
            'User create'=>''
        ]
    @endphp
    <x-bread-crumb-component title='User create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.admin.store')}}" method="POST" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="hub">Hub Name</label>
                                            <select name="hub_id" id="hub" class="form-control form-control-sm select2">
                                                @foreach($hubs as $hub)
                                                    <option value="{{$hub->id}}">{{$hub->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('hub_id'))
                                                <small class="text-danger">{{$errors->first('hub_id')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{old('name')}}">
                                             @if($errors->has('name'))
                                                <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
                                             @if($errors->has('email'))
                                                <small class="text-danger">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile"  value="{{old('mobile')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>Role</label>
                                        <select class="select2 form-control" name="roles[]" multiple="">
                                            @forelse($roles as $role)
                                            <option value="{{$role}}">{{$role}}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password"  value="{{old('password')}}">
                                            @if($errors->has('password'))
                                                <small class="text-danger">{{$errors->first('password')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password Confirmation"  value="{{old('password_confirmation')}}">
                                            @if($errors->has('password_confirmation'))
                                                <small class="text-danger">{{$errors->first('password_confirmation')}}</small>
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
@push('script')

@endpush
