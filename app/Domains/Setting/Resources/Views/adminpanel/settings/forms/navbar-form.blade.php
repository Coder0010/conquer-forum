@php
    $navbar_form_en_errors = "";
    $navbar_form_ar_errors = "";
    $navbar_inputs = ["home", "contact_us", "about_us"];
@endphp
@foreach ($navbar_inputs as $item)
    @error("{$item}_en")
        @php $navbar_form_en_errors = "text-danger en"; @endphp
        @break
    @enderror
@endforeach
@foreach ($navbar_inputs as $item)
    @error("{$item}_ar")
        @php $navbar_form_ar_errors = "text-danger ar"; @endphp
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
                            <a class='nav-link {{ $lang == "en" ? $navbar_form_en_errors : $navbar_form_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "{$form}_{$lang}_tab" }}' data-toggle='tab'>
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
                    @foreach (["home", "contact_us", "about_us"] as $item)
                        @component("adminpanel.components.html-tags.general")
                            @slot("tagTitle", __("main.navbar_trans_{$item}_{$lang}"))
                            @slot("tagName", "navbar_trans_{$item}_{$lang}")
                            @slot("tagValue", GetSettingByKey("navbar_trans_{$item}_{$lang}"))
                        @endcomponent
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
