@isActive
    @php
        if ($formClass ?? null){
            $_formClass = $formClass;
        }else{
            $_formClass = "";
        }

        if ($formID ?? null){
            $_formID = $formID;
        }else{
            $_formID = "";
        }

        if ($formMethod ?? null){
            $_formMethod = $formMethod;
        }else{
            $_formMethod = "post";
        }

        if ($formAction ?? null){
            $_formAction = $formAction;
        }else{
            $_formAction = "";
        }

        $_permission = false;
        $_role = false;
        $role = "Super_Role||Manager_Role";
    @endphp
    @if ($permission ?? null)
        @can($permission)
            @php $_permission = true; @endphp
        @endcan
    @endif
    @if ($role ?? null)
        @role($role)
            @php $_role = true; @endphp
        @endrole
    @endif
    @if ($_permission || $_role)
        <form class='{{ $_formClass }}' id='{{ $_formID }}' action='{{ $_formAction }}' method='POST' enctype='multipart/form-data'>
            @csrf
            @method($_formMethod)
            {!! $formInputs !!}
            @switch($_formMethod)
                @case("post")
                    <div class="text-center">
                        <div class="d-inline-block" id="g-recaptcha-1"></div>
                    </div>
                    @break
                @default
                    <div class="text-center">
                        <div class="d-inline-block" id="g-recaptcha-2"></div>
                    </div>
                @break
            @endswitch
            <div class='modal-footer'>
                <button type='button' class='btn btn-light-primary font-weight-bold' data-dismiss='modal'>{{ __("main.close") }}</button>
                <button type='submit' class='btn btn-primary font-weight-bold'> {{ __("main.submit") }} </button>
            </div>
        </form>
        {!! $formScripts !!}
    @endif
@endisActive
