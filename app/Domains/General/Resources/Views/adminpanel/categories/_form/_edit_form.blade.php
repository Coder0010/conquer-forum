@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Category")

    @slot("formID", "categoryEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.categories.edit"))
        @slot("formAction", route("admin.categories.update", $edit->id))
    @endif

    @slot("formInputs")
        @php
            $category_edit_en_errors = "";
            $category_edit_ar_errors = "";
            $category_edit_inputs = ["category_edit_name", "category_edit_description"];
        @endphp
        @foreach ($category_edit_inputs as $item)
            @error("{$item}_en")
                @php
                    $category_edit_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
            @endforeach
            @foreach ($category_edit_inputs as $item)
            @error("{$item}_ar")
                @php
                    $category_edit_ar_errors = "text-danger ar";
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
                                    <a class='nav-link {{ $lang == "en" ? $category_edit_en_errors : $category_edit_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "edit-category-{$lang}-tab" }}' data-toggle='tab'>
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
                                @slot("tagName", "category_edit_name_{$lang}")
                                @if(Route::is("admin.categories.edit"))
                                    @slot("tagValue", $edit["name_{$lang}"])
                                @endif
                            @endcomponent
                            @component("adminpanel.components.html-tags.textarea")
                                @slot("tagEditor", true)
                                @slot("tagID", "category_edit_description_{$lang}")
                                @slot("tagTitle", __("main.description_{$lang}"))
                                @if(Route::is("admin.categories.edit"))
                                    @slot("tagValue") {!! $edit["description_{$lang}"] !!} @endslot
                                @endif
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.categories.edit"))
            <script>
                function categoryEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.categories.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.categories.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form  = document.getElementById("categoryEditFormID");
                            form.action = update_route,
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#category_edit_name_en").val(res.payload.entity.name_en);
                                    if($("#category_edit_name_ar").length > 0){
                                        $("#category_edit_name_ar").val(res.payload.entity.name_ar);
                                    }
                                    if(res.payload.entity.data){
                                        document.querySelector("#category_edit_description_en").children[0].innerHTML = res.payload.entity.data.description_en ? res.payload.entity.data.description_en : '';
                                        if($("#category_edit_description_ar").length > 0){
                                            document.querySelector("#category_edit_description_ar").children[0].innerHTML = res.payload.entity.data.description_ar ? res.payload.entity.data.description_ar : '';
                                        }
                                    }

                                    toggleModalEdit("category", form, res.payload.entity.id);
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
        {{-- @elseif(Route::is("admin.categories.edit"))
            <script> </script> --}}
        @endif
    @endslot
@endcomponent
