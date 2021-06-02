{{-- @component("adminpanel.components.html-tags.image")
    @slot("tagName", "image")
    @slot("tagTitle", __("main.image"))
    @slot("tagValue", "/adminpanel/assets/media/users/100_1.jpg")
@endcomponent --}}

@php
    if ($tagValue ?? null){
        $_tagValue = $tagValue;
    }else{
        $_tagValue = asset("adminpanel/assets/media/users/100_1.jpg");
    }

    if ($tagName ?? null){
        $_tagName = $tagName;
    }else{
        $_tagName = "";
    }

    if ($tagTitle ?? null){
        $_tagTitle = $tagTitle;
    }else{
        $_tagTitle = PrettifyString($_tagName);
    }

    if ($tagClass ?? null){
        $_tagClass = $tagClass;
    }else{
        $_tagClass = "";
    }

    if ($tagID ?? null){
        $_tagID = $tagID;
    }else{
        $_tagID = $_tagName;
    }

    if ($tagErrorName ?? null){
        $_tagErrorName = $tagErrorName;
    }else{
        $_tagErrorName = $_tagID;
    }
@endphp

<div id='{{ "container_{$_tagID}" }}' class='form-group text-center'>
    <h2>{{ $_tagTitle }}</h2>
    <div id='{{ "holder_{$_tagID}" }}' class='image-input image-input-outline'>
        <div class='image-input-wrapper' style='background-image: url({{ $_tagValue }});'></div>
        <label class='btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow' data-action='change' data-toggle='tooltip' data-original-title='{{ __("main.change_avater") }}'>
            <i class='fa fa-pen icon-sm text-muted'></i>
            <input type='file' name='{{ $_tagName }}' id='{{ $_tagID }}' class='@error($_tagErrorName) is-invalid @enderror' accept='.png, .jpg, .jpeg'>
        </label>
        <span class='btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow' data-action='cancel' data-toggle='tooltip' data-original-title='{{ __("main.cancel_avater") }}'> <i class='ki ki-bold-close icon-xs text-muted'></i> </span>
    </div>
    <span class='form-text text-muted'>Allowed file types: png, jpg, jpeg.</span>
    @error($_tagErrorName) <div class='text-danger'> <strong>{{ $message }}</strong> </div> @enderror
</div>

<script>
    window.addEventListener('load', (event) => {
        initAvater('{{ "holder_{$_tagID}" }}');
    });
</script>
