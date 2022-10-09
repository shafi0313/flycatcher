<div class="mr-1">
    <div class="form-modal-ex">
        <!-- Button trigger modal -->
        @if($userInfo->TotalAdvance() > 0)
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{$type}}-{{$userInfo->id}}" title="Make Adjustment">
                <i class="fas fa-equals"></i>
            </button>
        @endif
    <!-- Modal -->
        <div class="modal fade text-left" id="{{$type}}-{{$userInfo->id}}" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Adjustment Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('admin.advance.adjust')}}" method="post" id="adjustForm" data-id="{{$userInfo->id}}">
                        @csrf
                        <div class="modal-body">
                            <label>Input Amount: </label>
                            <div class="form-group">
                                <input type="hidden" name="{{$type==='admin'? 'created_for_admin' : 'created_for_rider'}}" value="{{$userInfo->id}}">
                                <input type="hidden" name="advance_total" value="{{$userInfo->TotalAdvance()}}">
                                <input type="hidden" name="receivable" value="{{$userInfo->TotalAdvance() - $userInfo->TotalAdjust()}}">
                                <input type="number" name="adjust" placeholder="Input Amount Here" class="form-control" max="{{$userInfo->TotalAdvance()}}" min="0">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="adjustButton" class="btn btn-primary waves-effect waves-float waves-light">Make Adjustment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

