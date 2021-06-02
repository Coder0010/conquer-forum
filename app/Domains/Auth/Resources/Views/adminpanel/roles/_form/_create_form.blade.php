@component("adminpanel.components.form-component")
    @slot("permission", "Create_Role")

    @slot("formID", "roleCreateFormID")

    @slot("formAction", route("admin.roles.store"))

    @slot("formInputs")
        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.create") }}</h3>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @foreach (["role_create_name", "role_create_alias_name"] as $item)
                        @component("adminpanel.components.html-tags.general")
                            @slot("tagName", $item)
                            @slot("tagTitle", __("main.{$item}"))
                            @slot("tagValue", old($item))
                        @endcomponent
                    @endforeach

                    @foreach($permissions as $model => $group)
                        @error("role_create_permissions") <strong class="text-danger"> {{ $message }} </strong> @enderror
                        <div class="form-group">
                            <label class="h6 header-title" id="{{ $model }}"> [ {{ $model }} ] {{ __("main.permissions") }}</label>
                            <select name="role_create_permissions[]" id="{{ $model }}" multiple class="custom-select select-2 role_create_permissions form-control {{ $errors->has("permissions") ? "is-invalid" : "" }}">
                                @foreach ($group as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.roles.create"))
            <script>
                function roleCreateModalJsFunction(){
                    toggleModalCreate("role");
                }
            </script>
        @elseif(Route::is("admin.roles.create"))
            <script>  </script>
        @endif

        @if(old("role_create_permissions"))
            <script>
                window.addEventListener('load', (event) => {
                    $(".role_create_permissions").val( @json(old("role_create_permissions")) ).trigger("change");
                });
            </script>
        @endif
    @endslot
@endcomponent
