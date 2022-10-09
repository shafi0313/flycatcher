@extends('layouts.master')
@section('title', 'Advance Add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Advance List'=>route('admin.advance.index'),
    'Advance Create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Advance create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Advance Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.advance.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <div class="form-group">
                                            <label for="type">Select Type</label>
                                            <select name="" id="type" class="form-control" onchange="myFunction()">
                                                <option value="staff">Staff</option>
                                                <option value="rider">Rider</option>
                                            </select>
                                            @if($errors->has('title'))
                                            <small class="text-danger">{{$errors->first('title')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 mb-1 admin">
                                        <div class="form-group">
                                            <label for="type">Select an Admin</label>
                                            <select name="created_for_admin" id="type" class="form-control">
                                                <option value="">Select One</option>
                                                @foreach($admins as $admin)
                                                    <option value="{{$admin->id}}">{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('title'))
                                                <small class="text-danger">{{$errors->first('title')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 mb-1 rider">
                                        <div class="form-group">
                                            <label for="type">Select Rider</label>
                                            <select name="created_for_rider" id="type" class="form-control">
                                                <option value="">Select One</option>
                                                @foreach($riders as $rider)
                                                    <option value="{{$rider->id}}">{{$rider->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('title'))
                                                <small class="text-danger">{{$errors->first('title')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <div class="form-group">
                                            <label for="advance">Amount</label>
                                            <input type="number" class="form-control" id="advance" name="advance" placeholder="Enter Amount" value="{{old('advance')}}">
                                            @if($errors->has('advance'))
                                            <small class="text-danger">{{$errors->first('advance')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" placeholder="Additional Note" class="form-control" rows="1">{{old('note')}}</textarea>
                                            @if($errors->has('note'))
                                            <small class="text-danger">{{$errors->first('note')}}</small>
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

@push('script')
    <script>
        $(document).ready(function () {
            $('.admin').show();
            $('.rider').hide();
        });

        function myFunction() {
            let type = $('#type option:selected').val();
            if (type === 'rider') {
                $('.admin').hide();
                $('.rider').show();
            }
            if (type === 'staff') {
                $('.admin').show();
                $('.rider').hide();
            }
        }
    </script>
@endpush
