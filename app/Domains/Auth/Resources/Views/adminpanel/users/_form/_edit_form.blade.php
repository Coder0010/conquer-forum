@component("adminpanel.components.form-component")
    @slot("permission", "Edit_User")

    @slot("formID", "userEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.users.edit"))
        @slot("formAction", route("admin.users.update", $edit->id))
    @endif

    @slot("formInputs")
        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.create") }}</h3>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @component("adminpanel.components.html-tags.select")
                        @slot("tagOptions", $roles)
                        @slot("tagTitle", __("main.role"))
                        @slot("tagName", "user_edit_role_id")
                        @if(Route::is("admin.users.edit"))
                            @slot("tagValue", optional($edit->roles->first())->id ?? '')
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagName", "user_edit_name")
                        @slot("tagTitle", __("main.name"))
                        @if(Route::is("admin.users.edit"))
                            @slot("tagValue", $edit->name)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.email"))
                        @slot("tagType", "email")
                        @slot("tagName", "user_edit_email")
                        @if(Route::is("admin.users.edit"))
                            @slot("tagValue", $edit->email)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.phone"))
                        @slot("tagName", "user_edit_phone")
                        @slot("tagType", "number")
                        @if(Route::is("admin.users.edit"))
                            @slot("tagValue", $edit->phone)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.password") )
                        @slot("tagType", "password")
                        @slot("tagName", "user_edit_password")
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.password_confirmation"))
                        @slot("tagType", "password")
                        @slot("tagName", "user_edit_password_confirmation")
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.users.edit"))
            <script>
                function userEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.users.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.users.update', ':id') }}",
                        update_route = update.replace(":id", id);

                        var form        = document.getElementById("userEditFormID");
                            form.action = update_route,
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#user_edit_role_id").val( res.payload.entity.role.id ).trigger("change");
                                    $("#user_edit_name").val(res.payload.entity.name);
                                    $("#user_edit_email").val(res.payload.entity.email);
                                    $("#user_edit_phone").val(res.payload.entity.phone);

                                    toggleModalEdit("user", form, res.payload.entity.id);
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
        @elseif(Route::is("admin.users.edit"))
            <script>  </script>
        @endif
    @endslot
@endcomponent
