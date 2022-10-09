@php
    $actions = [
                    'show'=>route('admin.bad-debts.show', $badDebt->id),
                    'edit'=>route('admin.bad-debts.edit', $badDebt->id),
                    'delete' =>route('admin.bad-debts.destroy', $badDebt->id),
                ];
@endphp
<div class="d-flex">
    <x-action-component :actions="$actions" status="{{ $badDebt->status }}" />
    @if($badDebt->receivable_amount > 0)
        <div>
            <div class="form-modal-ex">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm ml-1" data-toggle="modal" data-target="#badDebtAdjustmentForm--{{$badDebt->id}}" title="Make Adjustment">
                    <i class="fas fa-adjust"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="badDebtAdjustmentForm--{{$badDebt->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Bad Debt Adjust Form</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.bad-debt-adjusts.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label for="amount">Amount: </label>
                                    <div class="form-group">
                                        <input type="hidden" name="bad_debt_id" value="{{$badDebt->id}}" />
                                        <input type="number" id="amount" placeholder="Enter number" class="form-control" name="amount" />
                                    </div>

                                    <label for="note">Note: </label>
                                    <div class="form-group">
                                        <textarea name="note" id="note" class="form-control" placeholder="Enter note"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>



