@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Type")

    @slot("formID", "typeEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.types.edit"))
        @slot("formAction", route("admin.types.update", $edit->id))
    @endif

    @slot("formInputs")
        @php
            $type_edit_en_errors = "";
            $type_edit_ar_errors = "";
            $type_edit_inputs = ["type_edit_name", "type_edit_description"];
        @endphp
        @foreach ($type_edit_inputs as $item)
            @error("{$item}_en")
                @php
                    $type_edit_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
            @endforeach
            @foreach ($type_edit_inputs as $item)
            @error("{$item}_ar")
                @php
                    $type_edit_ar_errors = "text-danger ar";
                @endphp
                @break
            @enderror
        @endforeach

        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.edit") }}</h3>
                </div>
                <div class='card-toolbar'>
                    <ul class='nav nav-tabs nav-bold nav-tabs-line'>
                        @if(count(AppLanguages()) > 1)
                            @foreach (AppLanguages() as $lang)
                                <li class='nav-item'>
                                    <a class='nav-link {{ $lang == "en" ? $type_edit_en_errors : $type_edit_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "edit-type-{$lang}-tab" }}' data-toggle='tab'>
                                        <span class='symbol symbol-20 m-2'>
                                            <img src='{{ asset(GetLanguageValues($lang, "flag")) }}' alt='{{ GetLanguageValues($lang,'name') }}'/>
                                        </span>
                                        <span class='navi-text'> {{ GetLanguageValues($lang, "name") }} </span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @foreach (AppLanguages() as $lang)
                        <div class='tab-pane fade {{ $loop->first ? "active show" : '' }}' id='{{ "edit-type-{$lang}-tab" }}' role="tabpanel" aria-labelledby='{{ "edit-type-{$lang}-tab" }}'>
                            @component("adminpanel.components.html-tags.general")
                                @slot("tagTitle", __("main.name_{$lang}"))
                                @slot("tagName", "type_edit_name_{$lang}")
                                @if(Route::is("admin.types.edit"))
                                    @slot("tagValue") {!! $edit["name_{$lang}"] !!} @endslot
                                @endif
                            @endcomponent
                            @component("adminpanel.components.html-tags.textarea")
                                @slot("tagEditor", true)
                                @slot("tagTitle", __("main.description_{$lang}"))
                                @slot("tagName", "type_edit_description_{$lang}")
                                @if(Route::is("admin.types.edit"))
                                    @slot("tagValue") {!! $edit["description_{$lang}"] !!} @endslot
                                @endif
                            @endcomponent
                        </div>
                    @endforeach

                    <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>

                    @component("adminpanel.components.html-tags.image")
                        @slot("tagTitle", __("main.image"))
                        @slot("tagName", "type_edit_image")
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.types.edit"))
            <script>
                function typeEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.types.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.types.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form  = document.getElementById("typeEditFormID");
                            form.action = update_route,
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#type_edit_name_en").val(res.payload.entity.name_en);
                                    if($("#type_edit_name_ar").length > 0){
                                        $("#type_edit_name_ar").val(res.payload.entity.name_ar);
                                    }
                                    if(res.payload.entity.data){
                                        document.querySelector("#type_edit_description_en").children[0].innerHTML = res.payload.entity.data.description_en ? res.payload.entity.data.description_en : '';
                                        if($("#type_edit_description_ar").length > 0){
                                            document.querySelector("#type_edit_description_ar").children[0].innerHTML = res.payload.entity.data.description_ar ? res.payload.entity.data.description_ar : '';
                                        }
                                    }

                                    $("#holder_type_edit_image .image-input-wrapper").css({"background-image": "url("+res.payload.entity.image+")"});

                                    toggleModalEdit("type", form, res.payload.entity.id);
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
        @elseif(Route::is("admin.types.edit"))
            <script>  </script>
        @endif
    @endslot
@endcomponent
