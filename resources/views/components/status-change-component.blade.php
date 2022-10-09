<div>
    <div class="d-flex justify-content-center">
        <div  role="group" class="btn-group btn-group-sm">
            @foreach($status as $statusName=>$cssClassName)
                <a href="{{route($route, ['status'=>$statusName])}}" class="btn btn-{{$cssClassName}} mr-1">{{ucfirst($statusName)}} {{$title}}</a>
            @endforeach
        </div>
    </div>
</div>
