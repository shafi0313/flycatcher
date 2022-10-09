@php
    $actions = [
        'show' =>route('admin.account.collection.show', $inchargeId),
    ];
@endphp
<div class="d-flex align-items-center">
    <x-action-component :actions="$actions" status=" " />
    <div class="mr-1">
        <form action="{{route('admin.collection.account.collect', $inchargeId)}}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-success btn-sm" type="submit" title="Collect Now">
                {{bladeIcon('deliver')}}
            </button>
        </form>
    </div>
</div>
