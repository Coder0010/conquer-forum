@component("adminpanel.components.form-component")
    @slot("permission", "Create_Lead")

    @slot("formID", "leadCreateFormID")

    @slot("formAction", route("admin.leads.store"))

    @slot("formInputs")
        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.create") }}</h3>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.name"))
                        @slot("tagName", "lead_create_name")
                        @slot("tagValue", old("lead_create_name"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.email"))
                        @slot("tagName", "lead_create_email")
                        @slot("tagType", "email")
                        @slot("tagValue", old("lead_create_email"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.phone"))
                        @slot("tagType", "number")
                        @slot("tagName", "lead_create_phone")
                        @slot("tagValue", old("lead_create_phone"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.textarea")
                        @slot("tagTitle", __("main.description"))
                        @slot("tagName", "lead_create_description")
                        @slot("tagValue") {!! old("lead_create_description") !!} @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.leads.create"))
            <script>
                function leadCreateModalJsFunction(){
                    toggleModalCreate("lead");
                }
            </script>
        @elseif(Route::is("admin.leads.create"))
            <script> </script>
        @endif
    @endslot
@endcomponent
