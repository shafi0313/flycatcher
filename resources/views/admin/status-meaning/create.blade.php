@extends('layouts.master')
@section('title', 'Status Meaning Add')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Status Meaning list'=>route('admin.status-meanings.index'),
                'Status Meaning create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Status Meaning create' :links="$links"/>
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Status Meaning Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.status-meanings.store')}}" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control form-control" id="name"
                                                       name="name" placeholder="Enter Status Name"
                                                       value="{{old('name')}}">
                                                @if($errors->has('name'))
                                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="description">Name</label>
                                                <textarea name="description" class="form-control" placeholder="Write Status Description">{{old('description')}}</textarea>
                                                @if($errors->has('description'))
                                                    <small class="text-danger">{{$errors->first('description')}}</small>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">
                                        Submit
                                    </button>
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




