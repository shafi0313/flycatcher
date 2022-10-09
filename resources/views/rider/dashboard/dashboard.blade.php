@extends('layouts.rider')
@section('title','Dashboard')
@section('content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card card-apply-job">
                <div class="card-body">
                    <form action="{{route('rider.collection.send.incharge')}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="apply-job-package bg-light-primary rounded">
                            <div class="badge badge-pill badge-light-primary">Collected Amount</div>
                            <div>
                                <h4 class="d-inline mr-25">{{number_format($totalCollectedAmount)}} TK</h4>
                            </div>
                        </div>
                        <input type="hidden" value="{{$totalCollectedAmount}}">
                        <div class="form-group">
                            <select class="form-control select2" name="admin_id" id="admin_id">
                                <option value=" ">Select One</option>
                                @foreach($incharges as $incharge)
                                <option value="{{$incharge->id}}">{{$incharge->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('admin_id'))
                            <small class="text-danger">{{$errors->first('admin_id')}}</small>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-float waves-light" {{$totalCollectedAmount === 0 ? 'disabled': ''}}>
                            Request For Transfer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content">
                            <i data-feather='briefcase'></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">{{$totalRequestedAmountForTransaction}} TK</h2>
                    <p class="card-text">Request For Transaction</p>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-danger p-50 mb-1">
                        <div class="avatar-content">
                            <i data-feather='truck'></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">5</h2>
                    <p class="card-text">Returns</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content">
                            <i data-feather='truck'></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">9</h2>
                    <p class="card-text">In Transit</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content">
                            <i data-feather='truck'></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">9</h2>
                    <p class="card-text">Hold</p>
                </div>
            </div>
        </div> -->
    </div>
</section>
@endsection
@push('script')

@endpush
