@component("adminpanel.components.form-component")
    @slot("permission", "Create_Category")

    @slot("formID", "categoryCreateFormID")

    @slot("formAction", route("admin.categories.store"))

    @slot("formInputs")
        @php
            $category_create_en_errors = "";
            $category_create_ar_errors = "";
            $category_create_inputs = ["category_create_name", "category_create_description"];
        @endphp
        @foreach ($category_create_inputs as $item)
            @error("{$item}_en")
                @php
                    $category_create_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
        @endforeach
        @foreach ($category_create_inputs as $item)
            @error("{$item}_ar")
                @php
                    $category_create_ar_errors = "text-danger ar";
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
                                    <a class='nav-link {{ $lang == "en" ? $category_create_en_errors : $category_create_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "create-category-{$lang}-tab" }}' data-toggle='tab'>
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
                                @slot("tagName", "category_create_name_{$lang}")
                                @slot("tagValue", old("category_create_name_{$lang}"))
                            @endcomponent
                            @component("adminpanel.components.html-tags.textarea")
                                @slot("tagEditor", true)
                                @slot("tagTitle", __("main.description_{$lang}"))
                                @slot("tagName", "category_create_description_{$lang}")
                                @slot("tagValue") {!! old("category_create_description_{$lang}") !!} @endslot
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.categories.create"))
            <script>
                function categoryCreateModalJsFunction(){
                    toggleModalCreate("category");
                }
            </script>
        @elseif(Route::is("admin.categories.create"))
            <script> </script>
        @endif
    @endslot
@endcomponent
