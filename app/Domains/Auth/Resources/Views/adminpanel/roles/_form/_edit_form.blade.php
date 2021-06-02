@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Role")

    @slot("formID", "roleEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.roles.edit"))
        @slot("formAction", route("admin.roles.update", $edit->id))
    @endif

    @slot("formInputs")
        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.edit") }}</h3>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @foreach (["role_edit_name", "role_edit_alias_name"] as $item)
                        @component("adminpanel.components.html-tags.general")
                            @slot("tagName", $item)
                            @switch($item)
                                @case("role_edit_name")
                                    @slot("tagDisabled", "disabled")
                                    @break
                            @endswitch
                            @slot("tagTitle", __("main.{$item}"))
                            @if(Route::is("admin.roles.edit"))
                                @slot("tagValue", $edit[$item])
                            @endif
                        @endcomponent
                    @endforeach

                    @foreach($permissions as $model => $group)
                        @error("role_edit_permissions") <strong class="text-danger"> {{ $message }} </strong> @enderror
                        <div class="form-group">
                            <label class="h6 header-title" id="edit-{{ $model }}"> [ {{ $model }} ] {{ __("main.permissions") }}</label>
                            <select name="role_edit_permissions[]" id="edit-{{ $model }}" multiple class="custom-select select-2 role_edit_permissions form-control">
                                @foreach ($group as $item)
                                    <option value="{{$item->id}}"> {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.roles.edit"))
            <script>
                function roleEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.roles.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.roles.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form = document.getElementById("roleEditFormID");
                            form.action = update_route,
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $(".role_edit_permissions").val( res.payload.entity.permissions ).trigger("change");
                                    $("#role_edit_name").val(res.payload.entity.name);
                                    $("#role_edit_alias_name").val(res.payload.entity.alias_name);

                                    toggleModalEdit("role", form, res.payload.entity.id);
                                }else{
                                    errorMessage(res.payload);
                                }
                            },
                            error: function(res){
                                errorMessage(res);
                            },
                        });
                    }
                }
            </script>
        @elseif(Route::is("admin.roles.edit"))
            <script>
                window.addEventListener('load', (event) => {
                    $(".role_edit_permissions").val( @json($edit->permissions()->allRelatedIds()) ).trigger("change");
                });
            </script>
        @endif
    @endslot
@endcomponent
