@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Settings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Env Dynamic
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class="card-title">Env Dynamic For Email</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.env-dynamic.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="MAIL_MAILER">MAIL MAILER</label>
                                            <input type="text" class="form-control" name="MAIL_MAILER" placeholder="MAIL_MAILER" id="MAIL_MAILER" value="{{ $default_values['MAIL_MAILER'] }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_HOST">MAIL_HOST</label>
                                            <input type="text" name="MAIL_HOST" id="MAIL_HOST" placeholder="MAIL_HOST" class="form-control" value="{{ $default_values['MAIL_HOST'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_PORT">MAIL_PORT</label>
                                            <input type="text" name="MAIL_PORT" placeholder="MAIL_PORT" id="MAIL_PORT" class="form-control" value="{{ $default_values['MAIL_PORT'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_USERNAME">MAIL_USERNAME</label>
                                            <input type="text" name="MAIL_USERNAME" placeholder="MAIL_USERNAME" id="MAIL_USERNAME" class="form-control" value="{{ $default_values['MAIL_USERNAME'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_PASSWORD">MAIL_PASSWORD</label>
                                            <input type="text" name="MAIL_PASSWORD" placeholder="MAIL_PASSWORD" id="MAIL_PASSWORD" class="form-control" value="{{ $default_values['MAIL_PASSWORD'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_ENCRYPTION">MAIL_ENCRYPTION</label>
                                            <input type="text" name="MAIL_ENCRYPTION" placeholder="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control" value="{{ $default_values['MAIL_ENCRYPTION'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_FROM_ADDRESS">MAIL_FROM_ADDRESS</label>
                                            <input type="text" name="MAIL_FROM_ADDRESS" placeholder="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" class="form-control" value="{{ $default_values['MAIL_FROM_ADDRESS']  }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="MAIL_FROM_NAME">MAIL_FROM_NAME</label>
                                            <input type="text" name="MAIL_FROM_NAME" placeholder="MAIL_FROM_NAME" id="MAIL_FROM_NAME" class="form-control" value="{{ $default_values['MAIL_FROM_NAME']  }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->

    </div>
</div>

@endsection
@section('vendor-css')


@endsection
@section('page-css')

@endsection
@push('style')

@endpush
@section('vendor-js')
@endsection
@section('page-js')

@endsection
@push('script')

@endpush
