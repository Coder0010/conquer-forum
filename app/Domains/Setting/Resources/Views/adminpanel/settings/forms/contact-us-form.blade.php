@php
    $contact_us_form_en_errors = "";
    $contact_us_form_ar_errors = "";
    $contact_us_inputs = ["contact_us_title", "contact_us_description",];
@endphp
@foreach ($contact_us_inputs as $item)
    @error("{$item}_en")
        @php $contact_us_form_en_errors = "text-danger en"; @endphp
        @break
    @enderror
@endforeach
@foreach ($contact_us_inputs as $item)
    @error("{$item}_ar")
        @php $contact_us_form_ar_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach
<div class='card card-custom gutter-b border border-primary'>
    <div class='card-header card-header-tabs-line'>
        <div class='card-title'>
            <h3 class='card-label'> </h3>
        </div>
        <div class='card-toolbar'>
            <ul class='nav nav-tabs nav-bold nav-tabs-line'>
                @if(count(AppLanguages()) > 1)
                    @foreach (AppLanguages() as $lang)
                        <li class='nav-item'>
                            <a class='nav-link {{ $lang == "en" ? $contact_us_form_en_errors : $contact_us_form_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "{$form}_{$lang}_tab" }}' data-toggle='tab'>
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
    <div class="card-body">
        <div class="tab-content mb-2">
            @foreach (AppLanguages() as $lang)
                <div class='tab-pane fade {{ $loop->first ? "active show" : "" }}' id='{{ "{$form}_{$lang}_tab" }}' role='tabpanel' aria-labelledby='{{ "{$form}_{$lang}_tab" }}'>
                    @component("adminpanel.components.html-tags.general")
                        @slot("tagTitle", __("main.contact_us_title_{$lang}"))
                        @slot("tagName", "contact_us_title_{$lang}")
                        @slot("tagValue", GetSettingByKey("contact_us_title_{$lang}"))
                    @endcomponent
                    @component("adminpanel.components.html-tags.textarea")
                        @slot("tagEditor", true)
                        @slot("tagTitle", __("main.contact_us_description_{$lang}"))
                        @slot("tagName", "contact_us_description_{$lang}")
                        @slot("tagValue", GetSettingByKey("contact_us_description_{$lang}"))
                    @endcomponent
                </div>
            @endforeach
        </div>
        <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>
        @foreach (["email", "phone", "hotline", "fax", "timework",] as $item)
            @component("adminpanel.components.html-tags.general")
                @switch($item)
                    @case("email")
                        @slot("tagType", "email")
                        @break
                    @case("phone")
                        @slot("tagType", "number")
                        @break
                    @case("hotline")
                        @slot("tagType", "number")
                        @break
                    @case("fax")
                        @slot("tagType", "number")
                        @break
                    @case("stopwatch")
                        @slot("tagFont", "fa-stopwatch")
                        @slot("tagType", "number")
                        @break
                    @default
                @endswitch
                @slot("tagName", $item)
                @slot("tagTitle", __("main.{$item}"))
                @slot("tagValue", GetSettingByKey($item))
            @endcomponent
        @endforeach
    </div>
</div>
