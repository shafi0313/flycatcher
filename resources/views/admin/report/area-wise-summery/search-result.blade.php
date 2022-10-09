<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Parcel List</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>All</th>
                <td>
                    {{$all}}
                </td>
            </tr>
            <tr>
                <th>Wait for pickup</th>
                <td>
                    {{$wait_for_pickup}}
                </td>
            </tr>

            <tr>
                <th>Pending</th>
                <td>
                    {{$pending}}
                </td>
            </tr>
            <tr>
                <th>Transit</th>
                <td>
                    {{$transit}}
                </td>
            </tr>
            <tr>
                <th>Delivered</th>
                <td>
                    {{$delivered}}
                </td>
            </tr>
            <tr>
                <th>Partial Delivered</th>
                <td>
                    {{$partial}}
                </td>
            </tr>

            <tr>
                <th>Hold in rider</th>
                <td>
                    {{$hold}}
                </td>
            </tr>

            <tr>
                <th>Hold in office</th>
                <td>
                    {{$hold_accept_by_incharge}}
                </td>
            </tr>

            <tr>
                <th>Cancelled</th>
                <td>
                    {{$cancelled}}
                </td>
            </tr>

            <tr>
                <th>Cancel accept by incharge</th>
                <td>
                    {{$cancel_accept_by_incharge}}
                </td>
            </tr>

            <tr>
                <th>Cancel accept by merchant</th>
                <td>
                    {{$cancel_accept_by_merchant}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>



