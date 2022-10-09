@extends('layouts.master')
@section('title', 'Reason add')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Reason list'=>route('admin.reason.index'),
                'Reason create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Reason create' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reason Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.reason.store')}}" method="POST" class="">
                                    @csrf
                                    <div class="row" >
                                        <div class="form-group col-md-6">
                                            <label for="name">Reason Name</label>

                                            <textarea name="name" id="name" class="form-control form-control-sm" placeholder="Reason name">{{old('name')}}</textarea>
                                            @if($errors->has('name'))
                                                <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="reason_type">Reason Type</label>

                                            <select class="form-control form-control-sm" name="reason_type" id="reason_type">
                                                <option value="" disabled selected>Select one</option>
                                                <option value="hold" >Hold</option>
                                                <option value="cancel" >Cancel</option>
                                                <option value="both" >Both</option>
                                            </select>
                                            @if($errors->has('reason_type'))
                                                <small class="text-danger">{{$errors->first('reason_type')}}</small>
                                            @endif

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


