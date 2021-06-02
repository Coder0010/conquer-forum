@isActive
    @php
        $_role = false;
        $_permission = false;
        $role = "Super_Role||Manager_Role";
    @endphp

    @if ($role ?? null)
        @role($role)
            @php $_role = true; @endphp
        @endrole
    @endif

    @if ($permission ?? null)
        @can($permission)
            @php $_permission = true; @endphp
        @endcan
    @endif

    @if($status ?? null)
        @if($status == config("system.status.deactivate"))
            @php
                $bg_color = "btn-warning";
                $fa_icon = "fa-toggle-off";
            @endphp
        @elseif($status == config("system.status.active"))
            @php
                $bg_color = "btn-success";
                $fa_icon = "fa-toggle-on";
            @endphp
        @endif
    @endif
    @if ($_permission || $_role)
        <a class='status_btn btn btn-sm btn-clean btn-icon border border-dark' data-modal-id='{{ $id }}' data-route='{{ $route }}' data-role='{{ $_role }}' data-permission='{{ $_permission }}' data-tooltip='kt-tooltip' data-original-title='{{ __("main.status") }}'>
            <i class='fa {{ $fa_icon }} fa-1x'></i>
        </a>
    @else
        <a disabled class='btn btn-sm btn-clean btn-icon border border-dark' data-tooltip='kt-tooltip' data-original-title='{{ __("main.your_dont_have_permission_for_this_action") }}'>
            <i class='fa fa-toggle-off fa-1x'></i>
        </a>
    @endif
@endisActive
