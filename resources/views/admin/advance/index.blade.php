@extends('layouts.master')

@section('title', 'Advance List')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Advance List'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Advance List' :links="$links" />
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Advance List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.advance.print')}}" class="btn btn-info mr-1" target="_blank"> {{__('Print Advance')}}</a>
                                <a href="{{route('admin.advance.create')}}" class="btn btn-primary"> {{__('Add Advance')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       <table class="table table-bordered table-secondary table-bordered table-striped">
                           <tbody>
                           <tr>
                               <th>Total Advance</th>
                               <td>{{number_format($advanceData['totalAdvance'])}} TK</td>
                           </tr>
                           <tr>
                               <th>Total Adjust</th>
                               <td>{{number_format($advanceData['totalAdjust'])}} TK</td>
                           </tr>

                           <tr>
                               <th>Total Receivable</th>
                               <td>{{number_format($advanceData['totalAdvance'] - $advanceData['totalAdjust'])}} TK</td>
                           </tr>
                           </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="table-responsive">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('Advance List For Admin')}}</h4>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="adminDataTable" class="datatables-basic table table-bordered table-secondary table-striped">
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>SL no</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Total Advance</th>--}}
{{--                                <th>Total Adjust</th>--}}
{{--                                <th>Receivable</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($admins as $admin)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$loop->iteration}}</td>--}}
{{--                                    <td>{{$admin->name}}</td>--}}
{{--                                    <td>{{number_format($admin->TotalAdvance())}}</td>--}}
{{--                                    <td>{{number_format($admin->TotalAdjust())}}</td>--}}
{{--                                    <th>{{number_format($admin->TotalAdvance() - $admin->TotalAdjust())}}</th>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-modal-ex">--}}
{{--                                            <!-- Button trigger modal -->--}}
{{--                                            @if($admin->TotalAdvance() > 0)--}}
{{--                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#admin-{{$admin->id}}" title="Make Adjustment">--}}
{{--                                                    <i class="fas fa-equals"></i>--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
{{--                                            <!-- Modal -->--}}
{{--                                            <div class="modal fade text-left" id="admin-{{$admin->id}}" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">--}}
{{--                                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <h4 class="modal-title" id="myModalLabel33">Adjustment Form</h4>--}}
{{--                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                <span aria-hidden="true">×</span>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                        <form action="{{route('admin.advance.adjust')}}" method="post" id="adjustForm" data-id="{{$admin->id}}">--}}
{{--                                                            @csrf--}}
{{--                                                            <div class="modal-body">--}}
{{--                                                                <label>Input Amount: </label>--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <input type="hidden" name="created_for_admin" value="{{$admin->id}}">--}}
{{--                                                                    <input type="hidden" name="advance_total" value="{{$admin->TotalAdvance()}}">--}}
{{--                                                                    <input type="hidden" name="receivable" value="{{$admin->TotalAdvance() - $admin->TotalAdjust()}}">--}}
{{--                                                                    <input type="number" name="adjust" placeholder="Input Amount Here" class="form-control" max="{{$admin->TotalAdvance()}}" min="0">--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="modal-footer">--}}
{{--                                                                <button type="submit" id="adjustButton" class="btn btn-primary waves-effect waves-float waves-light">Make Adjustment</button>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            <tr class="table-warning">--}}
{{--                                <th></th>--}}
{{--                                <th>Total</th>--}}
{{--                                <th>{{number_format($totalAdvanceForAdmin)}}</th>--}}
{{--                                <th>{{number_format($totalAdjustForAdmin)}}</th>--}}
{{--                                <th>{{number_format($totalAdvanceForAdmin - $totalAdjustForAdmin)}}</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
                            <tfoot>
                            <tr class="table-warning">
                                <th></th>
                                <th>Total</th>
                                <th>{{number_format($advanceData['totalAdvanceForAdmin'])}}</th>
                                <th>{{number_format($advanceData['totalAdjustForAdmin'])}}</th>
                                <th>{{number_format($advanceData['totalAdvanceForAdmin'] - $advanceData['totalAdjustForAdmin'])}}</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('Advance List For Rider')}}</h4>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="riderDataTable" class="datatables-basic table table-bordered table-secondary table-striped">
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>SL no</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Total Advance</th>--}}
{{--                                <th>Total Adjust</th>--}}
{{--                                <th>Receivable</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($riders as $rider)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$loop->iteration}}</td>--}}
{{--                                    <td>{{$rider->name}}</td>--}}
{{--                                    <td>{{number_format($rider->TotalAdvance())}}</td>--}}
{{--                                    <td>{{number_format($rider->TotalAdjust())}}</td>--}}
{{--                                    <th>{{number_format($rider->TotalAdvance() - $rider->TotalAdjust())}}</th>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-modal-ex">--}}
{{--                                            <!-- Button trigger modal -->--}}
{{--                                            @if($rider->TotalAdvance() > 0)--}}
{{--                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#rider-{{$rider->id}}" title="Make Adjustment">--}}
{{--                                                    <i class="fas fa-equals"></i>--}}
{{--                                                </button>--}}
{{--                                            @endif--}}

{{--                                            <!-- Modal -->--}}
{{--                                            <div class="modal fade text-left" id="rider-{{$rider->id}}" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">--}}
{{--                                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <h4 class="modal-title" id="myModalLabel33">Adjustment Form</h4>--}}
{{--                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                <span aria-hidden="true">×</span>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                        <form action="{{route('admin.advance.adjust')}}" method="post" id="adjustForm">--}}
{{--                                                            @csrf--}}
{{--                                                            <div class="modal-body">--}}
{{--                                                                <label>Input Amount: </label>--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <input type="hidden" name="created_for_rider" value="{{$rider->id}}">--}}
{{--                                                                    <input type="hidden" name="advance_total" value="{{$rider->TotalAdvance()}}">--}}
{{--                                                                    <input type="hidden" name="receivable" value="{{$rider->TotalAdvance() - $rider->TotalAdjust()}}">--}}
{{--                                                                    <input type="number" name="adjust" placeholder="Input Amount Here" class="form-control" max="{{$rider->TotalAdvance()}}" min="0">--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="modal-footer">--}}
{{--                                                                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light" id="adjustButton">Make Adjustment</button>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            <tr class="table-warning">--}}
{{--                                <th></th>--}}
{{--                                <th>Total</th>--}}
{{--                                <th>{{number_format($totalAdvanceForRider)}}</th>--}}
{{--                                <th>{{number_format($totalAdjustForRider)}}</th>--}}
{{--                                <th>{{number_format($totalAdvanceForRider - $totalAdjustForRider)}}</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
                            <tfoot>
                                <tr class="table-warning">
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{number_format($advanceData['totalAdvanceForRider'])}}</th>
                                    <th>{{number_format($advanceData['totalAdjustForRider'])}}</th>
                                    <th>{{number_format($advanceData['totalAdvanceForRider'] - $advanceData['totalAdjustForRider'])}}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection

{{--<script>--}}
{{--    let form = document.getElementById('adjustForm');--}}
{{--    let submitButton = document.getElementById('adjustButton');--}}


{{--    form.addEventListener('submit', function () {--}}
{{--        submitButton.setAttribute('disabled', 'disabled');--}}
{{--        submitButton.innerHTML = 'Please wait...';--}}
{{--    }, false);--}}
{{--</script>--}}


@push('script')
    <script>
        $(document).ready(function () {
            $('#adminDataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('admin.advance.admin') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:"Name", searchable: true},
                    {data: "advance", title:"Total Advance", searchable: true},
                    {data: "adjust", title:"Total Adjust", searchable: true},
                    {data: "receivable", title:"Receivable", searchable: true},
                    {data: "action", title:"Action", searchable: true},

                ],
            });

        })

        $(document).ready(function () {
            $('#riderDataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('admin.advance.rider') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:"Name", searchable: true},
                    {data: "advance", title:"Total Advance", searchable: true},
                    {data: "adjust", title:"Total Adjust", searchable: true},
                    {data: "receivable", title:"Receivable", searchable: true},
                    {data: "action", title:"Action", searchable: true},
                ],
            });
        })
    </script>

@endpush

