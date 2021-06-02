@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Lead")

    @slot("formID", "leadEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.leads.edit"))
        @slot("formAction", route("admin.leads.update", $edit->id))
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
                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.name"))
                        @slot("tagName", "lead_edit_name")
                        @if(Route::is("admin.leads.edit"))
                            @slot("tagValue", $editname)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.email"))
                        @slot("tagType", "email")
                        @slot("tagName", "lead_edit_email")
                        @if(Route::is("admin.leads.edit"))
                            @slot("tagValue", $edit->email)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.phone"))
                        @slot("tagName", "lead_edit_phone")
                        @slot("tagType", "number")
                        @if(Route::is("admin.leads.edit"))
                            @slot("tagValue", $edit->phone)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.textarea")
                        @slot("tagTitle", __("main.description"))
                        @slot("tagName", "lead_edit_description")
                        @if(Route::is("admin.leads.edit"))
                            @slot("tagValue") {!! $edit->description !!} @endslot
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.leads.edit"))
            <script>
                function leadEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.leads.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.leads.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form  = document.getElementById("leadEditFormID");
                            form.action = update_route;
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#lead_edit_name").val(res.payload.entity.name);
                                    $("#lead_edit_email").val(res.payload.entity.email);
                                    $("#lead_edit_phone").val(res.payload.entity.phone);
                                    $("#lead_edit_country_id").val(res.payload.entity.country_id).trigger("change");
                                    setTimeout(() => {
                                        $("#lead_edit_city_id").val(res.payload.entity.city_id).trigger("change");
                                    }, 500);
                                    $("#lead_edit_description").val(res.payload.entity.description);

                                    toggleModalEdit("lead", form, res.payload.entity.id);
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
        @elseif(!Route::is("admin.leads.edit"))
            <script>  </script>
        @endif
    @endslot
@endcomponent
