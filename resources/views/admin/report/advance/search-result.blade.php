<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Advance List</h4>
        <div>
            <form action="{{route('admin.advance-report-print')}}" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="start_date" value="{{$startDate}}">
                <input type="hidden" name="end_date" value="{{$endDate}}">
                <input type="hidden" name="hub_id" value="{{$hub_id}}">
                <button class="btn btn-success btn-block">Print Now</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        @if(count($advances) > 0)
            <table class="table table-bordered table-secondary table-striped">
                <thead>
                <tr class="text-center">
                    <th colspan="5" style="background-color:#a9611d;color:#fff">Advance Summary</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Advance (TK)</th>
                    <th>Adjust (TK)</th>
                    <th>Receivable (TK)</th>
                </tr>
                </thead>
                @php
                    $totalAdvance = 0;
                    $totalAdjust = 0;
                    $totalReceivable = 0;
                @endphp
                <tbody>
                @foreach($advances as $advance)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$advance->guard_name === 'admin'? $advance->admin->name : $advance->rider->name}}</td>
                        <td>
                            {{number_format($advance->total_advance_for_specific_user)}}
                            @php
                                $totalAdvance+=$advance->total_advance_for_specific_user
                            @endphp
                        </td>
                        <td>
                            {{number_format($advance->total_adjust_for_specific_user)}}
                            @php
                                $totalAdjust+=$advance->total_adjust_for_specific_user
                            @endphp
                        </td>
                        <td>
                            {{number_format($advance->total_receivable_for_specific_user)}}
                            @php
                                $totalReceivable+=$advance->total_receivable_for_specific_user
                            @endphp
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th>{{number_format($totalAdvance)}}</th>
                    <th>{{number_format($totalAdjust)}}</th>
                    <th>{{number_format($totalReceivable)}}</th>
                </tr>
                </tfoot>
            </table>
        @else
            <p>Not found</p>
        @endif
    </div>

{{--    <div class="card-body">--}}
{{--        @if(count($riderCollections) > 0)--}}
{{--            <table class="table table-bordered table-secondary table-striped">--}}
{{--                <thead>--}}
{{--                <tr class="text-center">--}}
{{--                    <th colspan="7" style="background-color:#a9611d;color:#fff">Rider Advance Summary</th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Advance (TK)</th>--}}
{{--                    <th>Adjust (TK)</th>--}}
{{--                    <th>Receivable (TK)</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @php--}}
{{--                    $totalAdvanceForRider = 0;--}}
{{--                    $totalAdjustForRider = 0;--}}
{{--                    $totalReceivableForRider = 0;--}}
{{--                @endphp--}}
{{--                @foreach($riderCollections as $riderCollection)--}}
{{--                    <tr>--}}
{{--                        <td>{{$loop->iteration}}</td>--}}
{{--                        <td>{{$riderCollection->rider_name}}</td>--}}
{{--                        <td>--}}
{{--                            {{number_format($riderCollection->totalAdvance)}}--}}
{{--                            @php--}}
{{--                                $totalAdvanceForRider+=$riderCollection->totalAdvance--}}
{{--                            @endphp--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{number_format($riderCollection->totalAdjust)}}--}}
{{--                            @php--}}
{{--                                $totalAdjustForRider+=$riderCollection->totalAdjust--}}
{{--                            @endphp--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{number_format($riderCollection->totalReceivable)}}--}}
{{--                            @php--}}
{{--                                $totalReceivableForRider+=$riderCollection->totalReceivable--}}
{{--                            @endphp--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                    <th colspan="2">Total</th>--}}
{{--                    <th>{{number_format($totalAdvanceForRider)}}</th>--}}
{{--                    <th>{{number_format($totalAdjustForRider)}}</th>--}}
{{--                    <th>{{number_format($totalReceivableForRider)}}</th>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
{{--            </table>--}}
{{--        @else--}}
{{--            <p>Not found</p>--}}
{{--        @endif--}}
{{--    </div>--}}
</div>

