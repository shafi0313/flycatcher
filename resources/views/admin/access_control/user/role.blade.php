@if($admin->getRoleNames()->isNotEmpty())
<span class="badge badge-primary">
    {!! $admin->getRoleNames()->implode("</span> <span class='badge badge-primary'>") !!}
</span>
@endif