@extends('layouts.master')
@section('title', 'Role Edit')
@section('content')
    <div class="content-wrapper">
        @include('components.bread-crumb-component', [
        'title'=>'Role Edit',
        'links'=>[
            'Home'=>route('admin.dashboard'),
             'Role List'=>route('admin.role.index'),
             'Role Create'=>''
            ]
        ])
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Role Edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.role.update',$model)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" value="{{ $model->name }}"
                                               name="name" placeholder="Enter a Role Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Permissions</label>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkPermissionAll"
                                                   value="1" {{ \App\Models\Admin::roleHasPermissions($model, $all_permissions) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="checkPermissionAll">All</label>
                                        </div>
                                        <hr>
                                        @php $i = 1; @endphp
                                        @foreach ($permission_groups as $group)
                                            <div class="row">
                                                @php
                                                    $permissions = App\Models\Admin::getpermissionsByGroupName($group->name);
                                                    $j = 1;
                                                @endphp

                                                <div class="col-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="{{ $i }}Management" value="{{ $group->name }}"
                                                               onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\Admin::roleHasPermissions($model, $permissions) ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                               for="{{ $i }}Management">{{ $group->name }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-9 role-{{ $i }}-management-checkbox">

                                                    @foreach ($permissions as $permission)
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                                                   name="permissions[]"
                                                                   {{ $model->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}"
                                                                   value="{{ $permission->name }}">
                                                            <label class="custom-control-label"
                                                                   for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                        @php $j++; @endphp
                                                    @endforeach
                                                    <br>
                                                </div>

                                            </div>
                                            @php $i++; @endphp
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role</button>
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
    <script>
        /**
         * Check all the permissions
         */
        $("#checkPermissionAll").click(function () {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // un check all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        function checkPermissionByGroup(className, checkThis) {
            const groupIdName = $("#" + checkThis.id);
            const classCheckBox = $('.' + className + ' input');
            if (groupIdName.is(':checked')) {
                classCheckBox.prop('checked', true);
            } else {
                classCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }

        function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.' + groupClassName + ' input');
            const groupIDCheckBox = $("#" + groupID);
            // if there is any occurance where something is not selected then make selected = false
            if ($('.' + groupClassName + ' input:checked').length == countTotalPermission) {
                groupIDCheckBox.prop('checked', true);
            } else {
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
        }

        function implementAllChecked() {
            const countPermissions = "{{ count($all_permissions) }}";
            const countPermissionGroups = "{{ count($permission_groups) }}";

            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);

            if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)) {
                $("#checkPermissionAll").prop('checked', true);
            } else {
                $("#checkPermissionAll").prop('checked', false);
            }
        }
    </script>
@endpush
