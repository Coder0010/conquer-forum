{{-- @component("adminpanel.components.html-tags.general")
    @slot("tagDisabled", "disabled")
    @slot("tagClass", "")
    @slot("tagID", "password")
    @slot("tagName", "password")
    @slot("tagType", "password")
    @slot("tagValue") password @endslot
    @slot("tagErrorName", "name") // For Multi Lang
@endcomponent --}}

@php
    if ($tagParentClass ?? null){
        $_tagParentClass = $tagParentClass;
    }else{
        $_tagParentClass = "";
    }

    if ($tagHideLabel ?? null){
        $_tagHideLabel = $tagHideLabel;
    }else{
        $_tagHideLabel = false;
    }

    if ($tagRequired ?? null){
        $_tagRequired = $tagRequired;
    }else{
        $_tagRequired = "";
    }

    if ($tagType ?? null){
        $_tagType = $tagType;
    }else{
        $_tagType = "text";
    }

    if ($tagValue ?? null){
        $_tagValue = $tagValue;
    }else{
        $_tagValue = "";
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

    if ($tagDisabled ?? null){
        $_tagDisabled = $tagDisabled;
        $_tagName = "";
    }else{
        $_tagDisabled = "";
    }

    // ajax calls
    if ($tagOnchange ?? null){
        $_tagOnchange = $tagOnchange;
    }else{
        $_tagOnchange = "";
    }
@endphp
<div id='{{ "holder_{$_tagID}" }}' class="{{ $_tagParentClass }}" {{ $_tagType == "hidden" ? "d-none" : "" }}>
    @error($_tagErrorName) <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
    <div class='form-group'>
        @if($_tagHideLabel == false)
            <label for='{{ $_tagID }}'>
                {{ $_tagTitle }}
                <span class='text-danger'> {{ $_tagRequired }} </span>
            </label>
        @endif
        <input type='{{ $_tagType }}' id='{{ $_tagID }}' name='{{ $_tagName }}' placeholder='{{ $_tagTitle }}' value='{{ $_tagValue }}' onchange='{{ $_tagOnchange }}' class='form-control {{ $_tagClass }} @error($_tagErrorName) is-invalid @enderror' {{ $_tagDisabled }}>
    </div>
</div>
