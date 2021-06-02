{{--
    @component("adminpanel.components.html-tags.select")
        @slot("tagOptions", $tagOptions) // not required
        @slot("tagName") {{ "role" }} @endslot   // Required
        @slot("tagTitle") {{ __("main.role") }} @endslot // Required
        @slot("tagValue") {{ old("role_id") }} @endslot // Required
        @slot("tagID") {{ "classID" }} @endslot  // Required at trans
        @slot("tagClass") {{ "className" }} @endslot
        @slot("tagErrorName") {{ "role" }} @endslot   // Required at trans

        @slot("tagOnchange") {{ "js_function_name" }} @endslot
        @slot("tagDataRoute") {{ "route_to_go_on_change" }} @endslot
        @slot("tagDataChildID") {{ "id_of_child" }} @endslot
        @slot("tagDataChildValue") {{ "route_to_go_on_change" }} @endslot
    @endcomponent
--}}
@php
    if ($tagOptions ?? null){
        $_tagOptions = $tagOptions;
    }else{
        $_tagOptions = [];
    }

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
        $_tagRequired = "*";
    }else{
        $_tagRequired = "";
    }

    if ($tagName ?? null){
        $_tagName = $tagName;
    }else{
        $_tagName = "default-name";
    }
    if ($tagTitle ?? null){
        $_tagTitle = $tagTitle;
    }else{
        $_tagTitle = PrettifyString($_tagName);
    }
    if ($tagValue ?? null){
        $_tagValue = $tagValue;
    }else{
        $_tagValue = "";
    }
    if ($tagID ?? null){
        $_tagID = $tagID;
    }else{
        $_tagID = $_tagName;
    }
    if ($tagClass ?? null){
        $_tagClass = $tagClass;
    }else{
        $_tagClass = "";
        // $_tagClass = "custom-select select-2";
    }
    if ($tagErrorName ?? null){
        $_tagErrorName = $tagErrorName;
    }else{
        $_tagErrorName = $_tagID;
    }

    if ($tagMultiple ?? null){
        $_tagMultiple = 'multiple';
    }else{
        $_tagMultiple = "";
    }

    // ajax calls
    if ($tagOnchange ?? null){
        $_tagOnchange = $tagOnchange;
    }else{
        $_tagOnchange = "";
    }
    if ($tagDataRoute ?? null){
        $_tagDataRoute = $tagDataRoute;
    }else{
        $_tagDataRoute = "";
    }
    if ($tagDataChildID ?? null){
        $_tagDataChildID = $tagDataChildID;
    }else{
        $_tagDataChildID = "";
    }
    if ($tagDataChildValue ?? null){
        $_tagDataChildValue = $tagDataChildValue;
    }else{
        $_tagDataChildValue = "";
    }
@endphp
<div id='{{ "holder_{$_tagID}" }}' class="{{ $_tagParentClass }}">
    @error($_tagErrorName) <div class='text-danger'> <strong>{{ $message }}</strong> </div> @enderror
    <div class='form-group text-capitalize'>
        @if($_tagHideLabel == false)
            <label for='{{ $_tagID }}'>
                {{ $_tagTitle }}
                <span class='text-danger'> {{ $_tagRequired }} </span>
            </label>
        @endif
        <select id='{{ $_tagID }}' name='{{ $_tagName }}' {{ $_tagMultiple }} class='{{ $_tagClass }} form-control @error($_tagErrorName) is-invalid @enderror' onchange='{{ $_tagOnchange }}' data-route='{{ $_tagDataRoute }}' data-child-id='{{ $_tagDataChildID }}' data-child-value='{{ $_tagDataChildValue }}'>
            <option value=''>{{ $_tagTitle }}</option>
            @foreach ($_tagOptions as $item)
                <option value='{{ $item['id'] }}' {{ $item['id'] == $_tagValue ?? '' ? 'selected' : '' }}>
                    {{ $item['name_val'] ?? $item['name_en'] ?? $item['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    {!! $slot !!}
</div>
