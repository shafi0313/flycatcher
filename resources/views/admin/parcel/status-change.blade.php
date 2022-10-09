{{--@extends('admin.layouts.master')--}}

{{--@section('title', 'Parcel details')--}}
{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        @php--}}
{{--            $links = [--}}
{{--                'Home'=>route('admin.dashboard'),--}}
{{--                'Parcel list'=>route('admin.parcel.index'),--}}
{{--                'Parcel status change'=>''--}}
{{--            ]--}}
{{--        @endphp--}}
{{--        <x-bread-crumb-component title='Parcel Status Change' :links="$links" />--}}
{{--        <div class="content-body">--}}
{{--            <!-- Responsive tables start -->--}}
{{--            <div class="row" id="table-responsive">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header ">--}}
{{--                            <div class="head-label">--}}
{{--                                <h4 class="mb-0">{{__('Parcel Status Change')}}</h4>--}}
{{--                            </div>--}}
{{--                            <div class="dt-action-buttons text-right">--}}
{{--                                <div class="dt-buttons d-inline-flex">--}}
{{--                                    <a href="{{route('admin.parcel.index')}}" class="btn btn-primary">{{__('View parcel list')}}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <form action="{{route('admin.parcel.status.change.store', $parcel->id)}}" method="POST">--}}
{{--                                @method('PUT')--}}
{{--                                @csrf--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="status">Select a status</label>--}}
{{--                                    <select class="form-control form-control-sm" id="status" name="status" onchange="myFunction()">--}}
{{--                                        <option value=" ">Select One</option>--}}
{{--                                        <option value="delivered">Full Delivered</option>--}}
{{--                                        <option value="partial">Partial Delivered</option>--}}
{{--                                        <option value="hold">Hold</option>--}}
{{--                                        <option value="cancelled">Cancel</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group partial_amount">--}}
{{--                                    <label for="partial_amount">Enter amount</label>--}}
{{--                                    <input type="number" class="form-control form-control-sm" name="partial_amount" placeholder="Enter partial amount">--}}
{{--                                </div>--}}
{{--                                <div class="form-group cancel_reason">--}}
{{--                                    <label>Select A Cancel Reason: </label>--}}
{{--                                    <select class="form-control form-control-sm" name="reason_type_id">--}}
{{--                                        <option value="" selected disabled>Select one</option>--}}
{{--                                        @foreach($cancelReasons as $cancelReason)--}}
{{--                                            <option value="{{$cancelReason->id}}">{{$cancelReason->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @if($errors->has('reason_type_id'))--}}
{{--                                        <small class="text-danger">{{$errors->first('reason_type_id')}}</small>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group hold_reason">--}}
{{--                                    <label>Select A Hold Reason: </label>--}}
{{--                                    <select class="form-control form-control-sm" name="reason_type_id">--}}
{{--                                        <option value="" selected disabled>Select one</option>--}}

{{--                                        @foreach($holdReasons as $holdReason)--}}
{{--                                            <option value="{{$holdReason->id}}">{{$holdReason->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @if($errors->has('reason_type_id'))--}}
{{--                                        <small class="text-danger">{{$errors->first('reason_type_id')}}</small>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group note">--}}
{{--                                    <label>Note: </label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <textarea class="form-control form-control-sm" name="note"  placeholder="Note"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Responsive tables end -->--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@push('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.cancel_reason').hide();--}}
{{--            $('.hold_reason').hide();--}}
{{--            $('.partial_amount').hide();--}}
{{--            $('.note').hide();--}}

{{--        });--}}
{{--        function myFunction() {--}}
{{--            let status= $('#status option:selected').val();--}}
{{--            if(status==='transit'){--}}
{{--                $('.cancel_reason').hide();--}}
{{--                $('.hold_reason').hide();--}}
{{--                $('.partial_amount').hide();--}}
{{--                $('.note').hide();--}}
{{--            }--}}
{{--            if(status==='delivered'){--}}
{{--                $('.cancel_reason').hide();--}}
{{--                $('.hold_reason').hide();--}}
{{--                $('.partial_amount').hide();--}}
{{--                $('.note').hide();--}}
{{--            }--}}
{{--            if(status==='partial'){--}}
{{--                $('.cancel_reason').hide();--}}
{{--                $('.hold_reason').hide();--}}
{{--                $('.partial_amount').show();--}}
{{--                $('.note').show();--}}
{{--            }--}}
{{--            if(status==='hold'){--}}

{{--                $('.cancel_reason').hide();--}}
{{--                $('.hold_reason').show();--}}
{{--                $('.partial_amount').hide();--}}
{{--                $('.note').hide();--}}
{{--            }--}}
{{--            if(status==='cancelled'){--}}

{{--                $('.cancel_reason').show();--}}
{{--                $('.hold_reason').hide();--}}
{{--                $('.partial_amount').hide();--}}
{{--                $('.note').hide();--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}


