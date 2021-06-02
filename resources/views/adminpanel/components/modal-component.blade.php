@isActive
    @php
        if ($modalID ?? null) {
            $_modalID = $modalID;
        }else{
            $_modalID = '';
        }
        if ($modalClass ?? null) {
            $_modalClass = $modalClass;
        }else{
            $_modalClass = '';
        }
        $_permission = false;
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
        <div class='modal fade {{ $_modalClass }}' id='{{ $_modalID }}' @unlessrole('Super_Role') data-backdrop='static' data-keyboard='false' @endunlessrole tabindex='-1' role='dialog' aria-labelledby='staticBackdrop' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered modal-xl' role='document'>
                <div class='modal-content'>
                    {!! $formStructure !!}
                </div>
            </div>
        </div>
        @foreach ($formErrors as $item)
            @if($errors->has($item))
                <script>
                    var showModal = '{{ old("_js_function_name") }}';
                    switch(showModal) {
                        case 'userCreateModalJsFunction':
                            userCreateModalJsFunction();
                            break;
                        case 'userEditModalJsFunction':
                            userEditModalJsFunction('{{ old("_user_id") }}');
                            break;
                        case 'leadCreateModalJsFunction':
                            leadCreateModalJsFunction();
                            break;
                        case 'leadEditModalJsFunction':
                            leadEditModalJsFunction('{{ old("_lead_id") }}');
                            break;

                        case 'categoryCreateModalJsFunction':
                            categoryCreateModalJsFunction();
                            break;
                        case 'categoryEditModalJsFunction':
                            categoryEditModalJsFunction('{{ old("_category_id") }}');
                            break;

                    }
                </script>
                @break
            @endif
        @endforeach
    @endif
@endisActive
