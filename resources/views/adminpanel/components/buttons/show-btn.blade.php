@isActive
    @php
        $_role = false;
        $_permission = false;
        $role = 'Super_Role||Manager_Role';
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

    @if ($_permission || $_role)
        <a class='show_btn btn btn-sm btn-clean btn-icon border border-dark' href='{{ $route }}' data-permission='{{ $_permission }}' data-role='{{ $_role }}' data-tooltip='kt-tooltip' data-original-title='{{ __("main.show") }}'>
            <i class="fa fa-eye fa-1x"></i>
        </a>
    @else
        <a disabled class='btn btn-sm btn-clean btn-icon border border-dark' data-tooltip='kt-tooltip' data-original-title='{{ __("main.your_dont_have_permission_for_this_action") }}'>
            <i class="fa fa-eye fa-1x"></i>
        </a>
    @endif
@endisActive
