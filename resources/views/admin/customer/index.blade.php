@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Customer</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Customer List
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                        <a class="dropdown-item" href="{{route('user.create')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">Add Customer</span></a>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col" class="text-nowrap">Email</th>
                                    <th scope="col" class="text-nowrap">Mobile</th>
                                    <th scope="col" class="text-nowrap">Bin</th>
                                    <th scope="col" class="text-nowrap">Marketing Assign User</th>
                                    <th scope="col" class="text-nowrap">Accounts Assign User</th>
                                    <th scope="col" class="text-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $row)
                                <tr>
                                    <td class="text-nowrap">{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->mobile }}</td>
                                    <td>{{ $row->bin_no }}</td>
                                    <td>{{ $row->marketing_user->name??'' }}</td>
                                    <td>{{ $row->accounts_user->name??'' }}</td>
                                    <td>
                                        <div class="float-right">
                                            <form action="{{route('user.destroy', $row->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <a href="{{ route('user.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                    Edit
                                                </a>
                                                <a href="{{ route('user.show', $row->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                    Show
                                                </a>
                                                <button id="btnDelete" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@section('js')

@endsection
@push('script')

@endpush