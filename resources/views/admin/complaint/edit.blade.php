@extends('layouts.master')
@section('title', 'Complaint Update')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Complaint list'=>route('admin.complaints.index'),
    'Complaint Update'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Complaint' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Complaint Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.complaints.update', $complaint->id)}}" method="POST" class="">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="merchant_id">Merchant<span style="color: red;">*</span></label>
                                        <select class="form-control select2" name="merchant_id" id="merchant_id" class="form-control" required>
                                            <option value="">Select one</option>
                                            @foreach($merchants as $merchant)
                                            <option value="{{ $merchant->id }}" {{$merchant->id === $complaint->merchant_id ? 'selected' : ''}}>{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="status">Select Status</label>
                                        <select class="form-control form-control-sm select2" name="status" id="status">
                                            <option value="seen" {{$complaint->status === 'seen' ? 'selected' : ''}}>Seen</option>
                                            <option value="unseen" {{$complaint->status === 'unseen' ? 'selected' : ''}}>Unseen</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="description">Complaint</label>
                                            <textarea class="form-control form-control-sm" name="description">{{ $complaint->description }}</textarea>
                                            @if($errors->has('description'))
                                            <small class="text-danger">{{$errors->first('description')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="reply">Reply</label>
                                            <textarea class="form-control form-control-sm" name="reply">{{ $complaint->reply }}</textarea>
                                            @if($errors->has('reply'))
                                            <small class="text-danger">{{$errors->first('reply')}}</small>
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