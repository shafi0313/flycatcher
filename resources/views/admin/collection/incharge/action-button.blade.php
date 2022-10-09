@php
    $actions = [
        'show' =>route('admin.incharge.collection.show', $riderId),
    ];
@endphp
<div class="d-flex align-items-center">
    <x-action-component :actions="$actions" status=" " />
    <div class="mr-1">
        <form action="{{route('admin.collection.incharge.collect', $riderId)}}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-success btn-sm" type="submit" title="Collected Here">
                {{bladeIcon('deliver')}}
            </button>
        </form>
    </div>
</div>
