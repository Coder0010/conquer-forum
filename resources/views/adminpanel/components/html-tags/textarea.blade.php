{{-- @component("adminpanel.components.html-tags.textarea")
    @slot("tagClass", "")
    @slot("tagID", "")
    @slot("tagName", "")
    @slot("tagType", "")
    @slot("tagValue")  @endslot
    @slot("tagErrorName", "name") // For Multi Lang
@endcomponent --}}

@php
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

    if ($tagParentClass ?? null){
        $_tagParentClass = $tagParentClass;
    }else{
        $_tagParentClass = "";
    }

    if ($tagEditor ?? null){
        $_tagEditor = $tagEditor;
    }else{
        $_tagEditor = "";
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
    }else{
        $_tagDisabled = "";
    }
@endphp
<div id='{{ "holder_{$_tagID}" }}' class="{{ $_tagParentClass }}">
    @error($_tagErrorName) <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
    <div class='form-group'>
        <label for='{{ $_tagID }}'>
            {{ $_tagTitle }}
            <span class='text-danger'> {{ $_tagRequired }} </span>
        </label>
        @if($_tagEditor)
            <div id='{{ $_tagID }}'>{!! $_tagValue !!}</div>
        @else
            <textarea id='{{ $_tagID }}' name='{{ $_tagName }}' placeholder='{{ $_tagTitle }}' rows='3' cols='3' class='form-control @error($_tagErrorName) is-invalid @enderror'>{{ $_tagValue }}</textarea>
        @endif
    </div>
</div>
