@component("adminpanel.components.form-component")
    @slot("permission", "Create_User")

    @slot("formID", "userCreateFormID")

    @slot("formAction", route("admin.users.store"))

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
                        @slot("tagName", "user_create_role_id")
                        @slot("tagValue", old("user_create_role_id"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagName", "user_create_name")
                        @slot("tagTitle", __("main.name"))
                        @slot("tagValue", old("user_create_name"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.email"))
                        @slot("tagType", "email")
                        @slot("tagName", "user_create_email")
                        @slot("tagValue", old("user_create_email"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.phone"))
                        @slot("tagName", "user_create_phone")
                        @slot("tagType", "number")
                        @slot("tagValue", old("user_create_phone"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.password") )
                        @slot("tagType", "password")
                        @slot("tagName", "user_create_password")
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.password_confirmation"))
                        @slot("tagType", "password")
                        @slot("tagName", "user_create_password_confirmation")
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.users.create"))
            <script>
                function userCreateModalJsFunction(){
                    toggleModalCreate("user");
                }
            </script>
        @elseif(Route::is("admin.users.create"))
            <script>  </script>
        @endif
    @endslot
@endcomponent
