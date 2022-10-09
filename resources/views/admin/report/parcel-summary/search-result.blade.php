<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcel List</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-body">
                <table class="table table-bordered table-secondary table-striped">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Oldest Report</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>All</th>
                        <td class="text-center">{{ $oldestAll }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['wait_for_pickup']),'start_date'=>$startDate])}}" target="_blank">
                                Wait For Pickup
                            </a>
                        </th>
                        <td class="text-center">{{ $oldestWaitForPickup }}</td>
                    </tr>
                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['pending']),'start_date'=>$startDate])}}" target="_blank">
                                Pending
                            </a>
                        </th>
                        <td class="text-center">{{ $oldestPending }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['transit']),'start_date'=>$startDate])}}" target="_blank">
                                Transit
                            </a>
                        </th>
                        <td class="text-center">{{ $oldestTransit }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['transfer']),'start_date'=>$startDate])}}" target="_blank">
                                Transfer
                            </a>
                        </th>
                        <td class="text-center">{{ $oldestTransfer }}</td>
                    </tr>

                    {{--                    <tr>--}}
                    {{--                        <td class="text-center">Hold In Rider</td>--}}
                    {{--                        <td class="text-center">{{ $oldestHoldInRider }}</td>--}}
                    {{--                    </tr>--}}

                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['hold', 'hold_accept_by_incharge']),'start_date'=>$startDate])}}" target="_blank">
                                <b>Hold</b> (In Rider and In Incharge)
                            </a>
                        </td>
                        <td class="text-center">{{$oldestHoldInRider + $oldestHoldInOffice }}</td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['delivered', 'partial']),'start_date'=>$startDate])}}" target="_blank">
                                <b>Delivered </b>(Full and Partial)
                            </a>
                        </td>
                        <td class="text-center">{{ $oldestDelivered + $oldestPartial}}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['cancelled', 'cancel_accept_by_incharge', 'cancel_accept_by_merchant']),'start_date'=>$startDate])}}" target="_blank">
                                <b>Cancelled </b>(In Rider, In Incharge in Merchant)
                            </a>
                        </td>
                        <td class="text-center">{{ $oldestCancelledInRider + $oldestCancelledInIncharge + $oldestCancelledInMerchant}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-body">
                <table class="table table-bordered table-striped table-secondary">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Search Result Report</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>All</td>
                        <td class="text-center">{{ $all }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['wait_for_pickup']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                Wait For Pickup
                            </a>
                        </th>
                        <td class="text-center">{{ $waitForPickup }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['pending']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                Pending
                            </a>
                        </th>
                        <td class="text-center">{{ $pending }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['transfer']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                Transfer
                            </a>
                        </th>
                        <td class="text-center">{{ $transfer }}</td>
                    </tr>

                    <tr>
                        <th>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['transit']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                Transit
                            </a>
                        </th>
                        <td class="text-center">{{ $transit }}</td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['hold', 'hold_accept_by_incharge']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                <b>Hold</b> (In Rider and In Incharge)
                            </a>
                        </td>
                        <td class="text-center">{{$holdInRider + $holdInOffice }}</td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['delivered', 'partial']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                <b>Delivered </b>(Full and Partial)
                            </a>
                        </td>
                        <td class="text-center">{{ $partial + $delivered}}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{route('admin.parcel.summary.details', ['status'=>json_encode(['cancelled', 'cancel_accept_by_incharge', 'cancel_accept_by_merchant']),'start_date'=>$startDate, 'end_date'=>$endDate])}}" target="_blank">
                                <b>Cancelled </b>(In Rider, In Incharge in Merchant)
                            </a>
                        </td>
                        <td class="text-center">{{ $cancelInRider + $cancelInOffice + $cancelInMerchant}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



