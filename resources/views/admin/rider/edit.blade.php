@extends('layouts.master')
@section('title', 'Area update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Rider list'=>route('admin.rider.index'),
                'Rider update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Rider update' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rider Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.rider.update', $rider->id)}}" method="POST" class="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="area_id">Select Hub <small class="text-danger">*</small></label>
                                            <select class="form-control form-control-sm select2" name="hub_id" id="hub">
                                                @foreach($hubs as $hub)
                                                    <option value="{{$hub->id}}" {{$rider->hub_id === $hub->id ? 'selected' : ''}}>{{$hub->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('hub_id'))
                                                <small class="text-danger">{{$errors->first('hub_id')}}</small>
                                            @endif

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="sub_area_id">Area <small class="text-danger">*</small></label>
{{--                                            <select class="form-control form-control-sm select2" name="area_id" id="area_id" multiple="">--}}
{{--                                                @php--}}
{{--                                                    $arrayList = [];--}}
{{--                                                @endphp--}}
{{--                                                @foreach($riderAssignSubAreaList as $list)--}}
{{--                                                    {{array_push($arrayList, $list->id)}}--}}
{{--                                                @endforeach--}}
{{--                                                @foreach($areaListWithoutAssign as $area)--}}
{{--                                                    <option value="{{$list->id}}" >{{$list->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}


                                            {!! Form::select('sub_area_id[]', $totalEditAbleArea, $riderSubAreaIds, array('class' => 'select2 form-control form-control-sm','multiple' => 'multiple')) !!}

{{--                                            @if($errors->has('area_id'))--}}
{{--                                                <small class="text-danger">{{$errors->first('area_id')}}</small>--}}
{{--                                            @endif--}}

                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Rider name <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Rider Name" value="{{$rider->name}}">
                                                <input type="hidden"  name="id" value="{{$rider->id}}">
                                                @if($errors->has('name'))
                                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Rider Email</label>
                                                <input type="email" class="form-control form-control-sm" id="name" name="email" placeholder="Enter email" value="{{$rider->email}}">
                                                @if($errors->has('email'))
                                                    <small class="text-danger">{{$errors->first('email')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Rider phone <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="mobile" placeholder="Enter phone number" value="{{$rider->mobile}}">
                                                @if($errors->has('mobile'))
                                                    <small class="text-danger">{{$errors->first('mobile')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Rider NID number</label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="nid" placeholder="Enter nid" value="{{$rider->nid}}">
                                                @if($errors->has('nid'))
                                                    <small class="text-danger">{{$errors->first('nid')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="present_address">Present Address <small class="text-danger">*</small></label>
                                                <textarea class="form-control form-control-sm" name="present_address" id="present_address" rows="3" placeholder="Give present address">{{$rider->present_address}}</textarea>
                                                @if($errors->has('present_address'))
                                                    <small class="text-danger">{{$errors->first('present_address')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="permanent_address">Permanent Address <small class="text-danger"></small></label>
                                                <textarea class="form-control form-control-sm" name="permanent_address" id="permanent_address" rows="3" placeholder="Give present address">{{$rider->permanent_address}}</textarea>
                                                @if($errors->has('permanent_address'))
                                                    <small class="text-danger">{{$errors->first('permanent_address')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="salary_type">Salary type <small class="text-danger">(Required)</small></label>

                                            <select class="form-control form-control-sm" name="salary_type" id="salary_type">
                                                <option value="commission" {{$rider->salary_type=='commission'?'selected':''}}>Commission basis</option>
                                                <option value="fixed" {{$rider->salary_type=='fixed'?'selected':''}}>Fixed salary</option>
                                            </select>
                                            @if($errors->has('salary_type'))
                                                <small class="text-danger">{{$errors->first('salary_type')}}</small>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row" id="commission_salary" style="display: none">
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="commission_type">Commission type <small class="text-danger">(Required)</small></label>
                                                <select class="form-control form-control-sm" name="commission_type" id="commission_type">
                                                    <option value="">Select one</option>
                                                    <option value="percentage" {{$rider->commission_type=='percentage' ?'selected':''}}>Percentage</option>
                                                    <option value="fixed" {{$rider->commission_type=='fixed'?'selected':''}}>Fixed</option>
                                                </select>
                                                @if($errors->has('commission_type'))
                                                    <small class="text-danger">{{$errors->first('commission_type')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                                <label for="commission_rate">Commission rate <small class="text-danger">(Required)</small></label>
                                                <input type="number" class="form-control form-control-sm" id="commission_rate" name="commission_rate" placeholder="Enter commission rate" value="{{$rider->commission_rate}}">
                                                @if($errors->has('commission_rate'))
                                                    <small class="text-danger">{{$errors->first('commission_rate')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <label for="status">Select Status</label>

                                            <select class="form-control form-control-sm" name="status" id="status">
                                                <option value="active" {{$rider->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$rider->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
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
        $( document ).ready(function() {
            $("#salary_type").click(function(){
                let salaryType = $('#salary_type :selected').val();
                console.log(salaryType);
                if(salaryType === 'commission'){
                    $("#commission_salary").css({display: "block"});
                }
                if(salaryType === 'fixed'){
                    $("#commission_salary").css({display: "none"});
                    $("#commission_type").val('');
                    $("#commission_rate").val('');
                }
            });
        });

    </script>
@endpush
