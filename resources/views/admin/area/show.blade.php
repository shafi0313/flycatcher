<div class="modal-size-default d-inline-block">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#areaModal-{{$area->id}}">
        {{$area->area_name}} ({{$area->area_code}})
    </button>
    <div class="modal fade text-left" id="areaModal-{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">{{$area->area_name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @forelse($subAreas as $subArea)
                        <div class="badge badge-success mb-1">{{$subArea->name}} ({{$subArea->code}})</div>
                    @empty
                        <h4 class="text-danger text-center">No Sub Area Found</h4>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
