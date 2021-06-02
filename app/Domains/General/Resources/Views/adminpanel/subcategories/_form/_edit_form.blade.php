@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Subcategory")

    @slot("formID", "subcategoryEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.subcategories.edit"))
        @slot("formAction", route("admin.subcategories.update", $edit->id))
    @endif

    @slot("formInputs")
        @php
            $subcategory_edit_en_errors = "";
            $subcategory_edit_ar_errors = "";
            $subcategory_edit_inputs = ["subcategory_edit_name", ];
        @endphp
        @foreach ($subcategory_edit_inputs as $item)
            @error("{$item}_en")
                @php
                    $subcategory_edit_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
            @endforeach
            @foreach ($subcategory_edit_inputs as $item)
            @error("{$item}_ar")
                @php
                    $subcategory_edit_ar_errors = "text-danger ar";
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
                                    <a class='nav-link {{ $lang == "en" ? $subcategory_edit_en_errors : $subcategory_edit_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "edit-category-{$lang}-tab" }}' data-toggle='tab'>
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
                        <div class='tab-pane fade {{ $loop->first ? "active show" : '' }}' id='{{ "edit-category-{$lang}-tab" }}' role="tabpanel" aria-labelledby='{{ "edit-category-{$lang}-tab" }}'>
                            @component("adminpanel.components.html-tags.general")
                                @slot("tagTitle", __("main.name_{$lang}"))
                                @slot("tagName", "subcategory_edit_name_{$lang}")
                                @if(Route::is("admin.subcategories.edit"))
                                    @slot("tagValue", $edit["name_{$lang}"])
                                @endif
                            @endcomponent
                        </div>
                    @endforeach

                    <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>

                    @component("adminpanel.components.html-tags.select")
                        @slot("tagOptions", $categories)
                        @slot("tagTitle", __("main.category"))
                        @slot("tagName", "subcategory_edit_category_id")
                        @if(Route::is("admin.subcategories.edit"))
                            @slot("tagValue", $edit->parent_id)
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.subcategories.edit"))
            <script>
                function subcategoryEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.subcategories.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.subcategories.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form  = document.getElementById("subcategoryEditFormID");
                            form.action = update_route,
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#subcategory_edit_name_en").val(res.payload.entity.name_en);
                                    if($("#subcategory_edit_name_ar").length > 0){
                                        $("#subcategory_edit_name_ar").val(res.payload.entity.name_ar);
                                    }
                                    $("#subcategory_edit_category_id").val( res.payload.entity.parent_id ).trigger("change");

                                    toggleModalEdit("subcategory", form, res.payload.entity.id);
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
        @elseif(Route::is("admin.subcategories.edit"))
            <script>  </script>
        @endif
    @endslot
@endcomponent
