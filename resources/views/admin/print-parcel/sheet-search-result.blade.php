@if(count($sheets) > 0)
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Sheets({{ count($sheets) }})</h4>
    </div>
    <form action="{{route('admin.print-parcel-rider-wise-save')}}" method="POST" class="" target="_blank">
        @csrf
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rider Details</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sheets as $sheet)
                    <tr>
                        <td class="tc">{{$loop->iteration}}.</td>
                        <td>
                            {{ $sheet->rider->name }}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($sheet->date)->format('F j, Y, g:i a')}}
                        </td>
                        <td>
                            {{ucfirst($sheet->status)}}
                        </td>
                        <td>
                            <a href="{{url('admin/sheet-hisab/'.$sheet->id)}}" class="btn btn-warning waves-effect waves-float waves-light form-control">Hisab</a>
                        </td>
                        <td>
                            <a href="{{url('admin/sheet-print/'.$sheet->id)}}" class="btn btn-primary waves-effect waves-float waves-light form-control">Print</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </form>
</div>
@else
<div class="card">
    <div class="card-body">
        <h4 class="text-danger text-center">No data available</h4>
        <!-- <img class="mx-auto d-block" src="{{ asset('app-assets/images/404-not-found.png') }}" alt="Search Result Not Found"> -->
        <img class="mx-auto d-block" src="{{ asset('app-assets/images/no-data.svg') }}" alt="Search Result Not Found">
        <p class=" text-center"> Add new record or search with different criteria.</p>
    </div>
</div>
@endif