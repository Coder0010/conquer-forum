@component("adminpanel.components.form-component")
    @slot("permission", "Create_Subcategorytype")

    @slot("formID", "subcategorytypeCreateFormID")

    @slot("formAction", route("admin.subcategorytypes.store"))

    @slot("formInputs")
        @php
            $subcategorytype_create_en_errors = "";
            $subcategorytype_create_ar_errors = "";
            $subcategorytype_create_inputs = ["subcategorytype_create_name", "subcategorytype_create_description"];
        @endphp
        @foreach ($subcategorytype_create_inputs as $item)
            @error("{$item}_en")
                @php
                    $subcategorytype_create_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
            @endforeach
            @foreach ($subcategorytype_create_inputs as $item)
            @error("{$item}_ar")
                @php
                    $subcategorytype_create_ar_errors = "text-danger ar";
                @endphp
                @break
            @enderror
        @endforeach

        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.create") }}</h3>
                </div>
                <div class='card-toolbar'>
                    <ul class='nav nav-tabs nav-bold nav-tabs-line'>
                        @if(count(AppLanguages()) > 1)
                            @foreach (AppLanguages() as $lang)
                                <li class='nav-item'>
                                    <a class='nav-link {{ $lang == "en" ? $subcategorytype_create_en_errors : $subcategorytype_create_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "create-category-{$lang}-tab" }}' data-toggle='tab'>
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
                        <div class='tab-pane fade {{ $loop->first ? "active show" : '' }}' id='{{ "create-category-{$lang}-tab" }}' role="tabpanel" aria-labelledby='{{ "create-category-{$lang}-tab" }}'>
                            @component("adminpanel.components.html-tags.general")
                                @slot("tagTitle", __("main.name_{$lang}"))
                                @slot("tagName", "subcategorytype_create_name_{$lang}")
                                @slot("tagValue", old("subcategorytype_create_name_{$lang}"))
                            @endcomponent
                        </div>
                    @endforeach

                    <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>

                    @component("adminpanel.components.html-tags.select")
                        @slot("tagOptions", $categories)
                        @slot("tagTitle", __("main.category"))
                        @slot("tagName", "subcategorytype_create_category_id")

                        @slot("tagOnchange", "selectAjaxCall(this)")
                        @slot("tagDataRoute", route("get-sub-categories"))
                        @slot("tagDataChildID", "#subcategorytype_create_subcategory_id")
                        @slot("tagDataChildValue", old("subcategorytype_create_subcategory_id"))

                        @component("adminpanel.components.html-tags.select")
                            @slot("tagTitle", __("main.subcategory"))
                            @slot("tagName", "subcategorytype_create_subcategory_id")
                        @endcomponent
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.subcategorytypes.create"))
            <script>
                function subcategorytypeCreateModalJsFunction(){
                    toggleModalCreate("subcategorytype");
                }
            </script>
        @elseif(Route::is("admin.subcategorytypes.create"))
            <script>  </script>
        @endif

        @if (old("subcategorytype_create_category_id"))
            <script>
                setTimeout(function() {
                    $("#subcategorytype_create_category_id").val( {{ old("subcategorytype_create_category_id") }} ).trigger("change");
                }, globalTimeOut);
            </script>
        @endif
    @endslot
@endcomponent
