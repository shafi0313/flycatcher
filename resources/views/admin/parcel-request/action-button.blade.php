<div class="d-flex justify-content-center">
    @if($parcel->status === 'wait_for_pickup')
    <div class="mr-1">
        <a href="{{ route('admin.parcel.show',$parcel->id)}}" class="btn btn-sm btn-info" title="Show">
            {{bladeIcon('show')}}
        </a>
    </div>
    <div class="mr-1">
        <a href="{{ route('admin.parcel.edit',$parcel->id)}}" class="btn btn-sm btn-primary" title="Edit">
            {{bladeIcon('edit')}}
        </a>
    </div>
    <div class="mr-1">
        <form action="{{ route('admin.parcel.destroy', $parcel->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm confirm-text" type="submit" title="Delete Now">
                {{bladeIcon('delete')}}
            </button>
        </form>
    </div>
    <div class="mr-1">
        <a href="{{ route('admin.single.parcel.accept',$parcel->id)}}" class="btn btn-sm btn-success" title="Accept">
            {{bladeIcon('accept')}}
        </a>
    </div>
    @endif