<div class="d-inline-block">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#riderSubAreaModal-{{$rider->id}}">
        Areas
    </button>
    <!-- Modal -->
    <div class="modal fade text-left modal-primary" id="riderSubAreaModal-{{$rider->id}}" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Sub Areas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  @isset($assignAreas)
                        @foreach($assignAreas as $assignArea)
                            <span class="badge badge-primary">{{$assignArea->sub_area->name??''}} ({{$assignArea->sub_area->code??''}})</span>
                        @endforeach
                    @else
                      <span class="text-center text-danger">Sorry No Area Found</span>
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div>
