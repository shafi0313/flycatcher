<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Rider List</h4>
    </div>
    <form action="{{route('admin.print-total-parcel-rider-wise')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body">
            @if(count($riders) > 0)

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Rider Details</th>
                        <th>Total Parcel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($riders as $rider)
                        <tr>
                            <td class="tc">{{$loop->iteration}}.</td>
                            <td>
                                <p><b>Name: </b>{{$rider->name}}</p>
                                <p><b>Mobile: </b>{{$rider->mobile}}</p>
                            </td>
                            <td>
                                <table class="table table-borderless">
                                        <tr>
                                        @foreach($rider['total_parcels'] as $key => $total)
                                            <td>
                                                <p><b>{{ucfirst($key)}}</b> {{$total}}</p>
                                            </td>
                                        @endforeach
                                        </tr>

                                </table>

                            </td>

                        </tr>
                    <input type="hidden" name="rider_id[]" value="{{ $rider->id }}" id="search_rider_id">
                    @endforeach
                    <input type="hidden" name="date_range" value="{{ $dateRange }}" id="search_rider_id">
                    </tbody>

                </table>
                <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="submit">Print</button>
            @else
                <p>Not found</p>
            @endif
        </div>

    </form>
</div>

