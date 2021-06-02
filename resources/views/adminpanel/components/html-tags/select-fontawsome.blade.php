{{--
    @component("adminpanel.components.html-tags.select-fontawsome")
        @slot("tagOptions", $tagOptions) // not required
        @slot("tagName") {{ "role" }} @endslot   // Required
        @slot("tagTitle") {{ __("main.role") }} @endslot // Required
        @slot("tagValue") {{ old("role_id") }} @endslot // Required
        @slot("tagID") {{ "classID" }} @endslot  // Required at trans
        @slot("tagClass") {{ "className" }} @endslot
        @slot("tagErrorName") {{ "role" }} @endslot   // Required at trans
    @endcomponent
--}}
@php
    if ($tagOptions ?? null){
        $_tagOptions = $tagOptions;
    }else{
        $_tagOptions = [];
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

    if ($tagReadonly ?? null){
        $_tagReadonly = "readonly";
    }else{
        $_tagReadonly = "";
    }

    if ($tagDisabled ?? null){
        $_tagDisabled = $tagDisabled;
    }else{
        $_tagDisabled = "";
    }

    if ($tagParentClass ?? null){
        $_tagParentClass = $tagParentClass;
    }else{
        $_tagParentClass = "";
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
    }
    if ($tagErrorName ?? null){
        $_tagErrorName = $tagErrorName;
    }else{
        $_tagErrorName = $_tagID;
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
        <select id='{{ $_tagID }}' name='{{ $_tagName }}' class='{{ $_tagClass }} fa form-control @error($_tagErrorName) is-invalid @enderror' {{ $_tagDisabled }} {{ $_tagReadonly }}>
            <option value=''>{{ $_tagTitle }}</option>
            <option value='fa fa-address-book'>&#xf2b9; fa-address-book</option>
            <option value='fa fa-bar-chart'>&#xf080; fa-bar-chart</option>
            <option value='fa fa-bar-chart-o'>&#xf080; fa-bar-chart-o</option>
            <option value='fa fa-bell'>&#xf0f3; fa-bell</option>
            <option value='fa fa-bell-slash'>&#xf1f6; fa-bell-slash</option>
            <option value='fa fa-bookmark'>&#xf02e; fa-bookmark</option>
            <option value='fa fa-building'>&#xf1ad; fa-building</option>
            <option value='fa fa-calendar'>&#xf073; fa-calendar</option>
            <option value='fa fa-calendar-check-o'>&#xf274; fa-calendar-check-o</option>
            <option value='fa fa-calendar-minus-o'>&#xf272; fa-calendar-minus-o</option>
            <option value='fa fa-calendar-o'>&#xf133; fa-calendar-o</option>
            <option value='fa fa-calendar-plus-o'>&#xf271; fa-calendar-plus-o</option>
            <option value='fa fa-calendar-times-o'>&#xf273; fa-calendar-times-o</option>
            <option value='fa fa-caret-square-o-down'>&#xf150; fa-caret-square-o-down</option>
            <option value='fa fa-caret-square-o-left'>&#xf191; fa-caret-square-o-left</option>
            <option value='fa fa-caret-square-o-right'>&#xf152; fa-caret-square-o-right</option>
            <option value='fa fa-caret-square-o-up'>&#xf151; fa-caret-square-o-up</option>
            <option value='fa fa-cc'>&#xf20a; fa-cc</option>
            <option value='fa fa-check-circle'>&#xf058; fa-check-circle</option>
            <option value='fa fa-check-square'>&#xf14a; fa-check-square</option>
            <option value='fa fa-circle'>&#xf111; fa-circle</option>
            <option value='fa fa-clock-o'>&#xf017; fa-clock-o</option>
            <option value='fa fa-comment'>&#xf075; fa-comment</option>
            <option value='fa fa-commenting'>&#xf27a; fa-commenting</option>
            <option value='fa fa-comments'>&#xf086; fa-comments</option>
            <option value='fa fa-compass'>&#xf14e; fa-compass</option>
            <option value='fa fa-copy'>&#xf0c5; fa-copy</option>
            <option value='fa fa-copyright'>&#xf1f9; fa-copyright</option>
            <option value='fa fa-dot-circle-o'>&#xf192; fa-dot-circle-o</option>
            <option value='fa fa-edit'>&#xf044; fa-edit</option>
            <option value='fa fa-envelope'>&#xf0e0; fa-envelope</option>
            <option value='fa fa-envelope-o'>&#xf003; fa-envelope-o</option>
            <option value='fa fa-envelope-open'>&#xf2b6; fa-envelope-open</option>
            <option value='fa fa-eye'>&#xf06e; fa-eye</option>
            <option value='fa fa-eye-slash'>&#xf070; fa-eye-slash</option>
            <option value='fa fa-file'>&#xf15b; fa-file</option>
            <option value='fa fa-file-archive-o'>&#xf1c6; fa-file-archive-o</option>
            <option value='fa fa-file-audio-o'>&#xf1c7; fa-file-audio-o</option>
            <option value='fa fa-file-code-o'>&#xf1c9; fa-file-code-o</option>
            <option value='fa fa-file-excel-o'>&#xf1c3; fa-file-excel-o</option>
            <option value='fa fa-file-image-o'>&#xf1c5; fa-file-image-o</option>
            <option value='fa fa-file-movie-o'>&#xf1c8; fa-file-movie-o</option>
            <option value='fa fa-file-pdf-o'>&#xf1c1; fa-file-pdf-o</option>
            <option value='fa fa-file-photo-o'>&#xf1c5; fa-file-photo-o</option>
            <option value='fa fa-file-picture-o'>&#xf1c5; fa-file-picture-o</option>
            <option value='fa fa-file-powerpoint-o'>&#xf1c4; fa-file-powerpoint-o</option>
            <option value='fa fa-file-sound-o'>&#xf1c7; fa-file-sound-o</option>
            <option value='fa fa-file-text'>&#xf15c; fa-file-text</option>
            <option value='fa fa-file-video-o'>&#xf1c8; fa-file-video-o</option>
            <option value='fa fa-file-word-o'>&#xf1c2; fa-file-word-o</option>
            <option value='fa fa-file-zip-o'>&#xf1c6; fa-file-zip-o</option>
            <option value='fa fa-files-o'>&#xf0c5; fa-files-o</option>
            <option value='fa fa-flag'>&#xf024; fa-flag</option>
            <option value='fa fa-floppy-o'>&#xf0c7; fa-floppy-o</option>
            <option value='fa fa-folder'>&#xf07b; fa-folder</option>
            <option value='fa fa-folder-open'>&#xf07c; fa-folder-open</option>
            <option value='fa fa-frown-o'>&#xf119; fa-frown-o</option>
            <option value='fa fa-futbol-o'>&#xf1e3; fa-futbol-o</option>
            <option value='fa fa-thumbs-down'>&#xf165; fa-thumbs-down</option>
            <option value='fa fa-thumbs-up'>&#xf164; fa-thumbs-up</option>
            <option value='fa fa-times-circle'>&#xf057; fa-times-circle</option>
            <option value='fa fa-toggle-down'>&#xf150; fa-toggle-down</option>
            <option value='fa fa-toggle-left'>&#xf191; fa-toggle-left</option>
            <option value='fa fa-toggle-right'>&#xf152; fa-toggle-right</option>
            <option value='fa fa-toggle-up'>&#xf151; fa-toggle-up</option>
            <option value='fa fa-user'>&#xf007; fa-user</option>
            <option value='fa fa-user-circle'>&#xf2bd; fa-user-circle</option>
            <option value='fa fa-vcard'>&#xf2bb; fa-vcard</option>
            <option value='fa fa-window-maximize'>&#xf2d0; fa-window-maximize</option>
            <option value='fa fa-window-minimize'>&#xf2d1; fa-window-minimize</option>
            <option value='fa fa-window-restore'>&#xf2d2; fa-window-restore</option>
            <option value='fa fa-hand-grab-o'>&#xf255; fa-hand-grab-o</option>
            <option value='fa fa-hand-lizard-o'>&#xf258; fa-hand-lizard-o</option>
            <option value='fa fa-hand-o-down'>&#xf0a7; fa-hand-o-down</option>
            <option value='fa fa-hand-o-left'>&#xf0a5; fa-hand-o-left</option>
            <option value='fa fa-hand-o-right'>&#xf0a4; fa-hand-o-right</option>
            <option value='fa fa-hand-o-up'>&#xf0a6; fa-hand-o-up</option>
            <option value='fa fa-hand-paper-o'>&#xf256; fa-hand-paper-o</option>
            <option value='fa fa-hand-peace-o'>&#xf25b; fa-hand-peace-o</option>
            <option value='fa fa-hand-pointer-o'>&#xf25a; fa-hand-pointer-o</option>
            <option value='fa fa-hand-rock-o'>&#xf255; fa-hand-rock-o</option>
            <option value='fa fa-hand-scissors-o'>&#xf257; fa-hand-scissors-o</option>
            <option value='fa fa-hand-spock-o'>&#xf259; fa-hand-spock-o</option>
            <option value='fa fa-hand-stop-o'>&#xf256; fa-hand-stop-o</option>
            <option value='fa fa-handshake-o'>&#xf2b5; fa-handshake-o</option>
            <option value='fa fa-support'>&#xf1cd; fa-support</option>
            <option value='fa fa-sun-o'>&#xf185; fa-sun-o</option>
            <option value='fa fa-hdd-o'>&#xf0a0; fa-hdd-o</option>
            <option value='fa fa-heart'>&#xf004; fa-heart</option>
            <option value='fa fa-hospital-o'>&#xf0f8; fa-hospital-o</option>
            <option value='fa fa-hourglass'>&#xf254; fa-hourglass</option>
            <option value='fa fa-id-badge'>&#xf2c1; fa-id-badge</option>
            <option value='fa fa-id-card'>&#xf2c2; fa-id-card</option>
            <option value='fa fa-ils'>&#xf20b; fa-ils</option>
            <option value='fa fa-image'>&#xf03e; fa-image</option>
            <option value='fa fa-keyboard-o'>&#xf11c; fa-keyboard-o</option>
            <option value='fa fa-lemon-o'>&#xf094; fa-lemon-o</option>
            <option value='fa fa-life-bouy'>&#xf1cd; fa-life-bouy</option>
            <option value='fa fa-life-buoy'>&#xf1cd; fa-life-buoy</option>
            <option value='fa fa-life-ring'>&#xf1cd; fa-life-ring</option>
            <option value='fa fa-life-saver'>&#xf1cd; fa-life-saver</option>
            <option value='fa fa-lightbulb-o'>&#xf0eb; fa-lightbulb-o</option>
            <option value='fa fa-list-alt'>&#xf022; fa-list-alt</option>
            <option value='fa fa-map'>&#xf279; fa-map</option>
            <option value='fa fa-meh-o'>&#xf11a; fa-meh-o</option>
            <option value='fa fa-minus-square'>&#xf146; fa-minus-square</option>
            <option value='fa fa-moon-o'>&#xf186; fa-moon-o</option>
            <option value='fa fa-music'>&#xf001; fa-music</option>
            <option value='fa fa-newspaper-o'>&#xf1ea; fa-newspaper-o</option>
            <option value='fa fa-object-group'>&#xf247; fa-object-group</option>
            <option value='fa fa-object-ungroup'>&#xf248; fa-object-ungroup</option>
            <option value='fa fa-paper-plane'>&#xf1d8; fa-paper-plane</option>
            <option value='fa fa-pause-circle'>&#xf28b; fa-pause-circle</option>
            <option value='fa fa-pencil-square-o'>&#xf044; fa-pencil-square-o</option>
            <option value='fa fa-photo'>&#xf03e; fa-photo</option>
            <option value='fa fa-picture-o'>&#xf03e; fa-picture-o</option>
            <option value='fa fa-play-circle'>&#xf144; fa-play-circle</option>
            <option value='fa fa-plus-square'>&#xf0fe; fa-plus-square</option>
            <option value='fa fa-question-circle'>&#xf059; fa-question-circle</option>
            <option value='fa fa-registered'>&#xf25d; fa-registered</option>
            <option value='fa fa-save'>&#xf0c7; fa-save</option>
            <option value='fa fa-search'>&#xf002; fa-search</option>
            <option value='fa fa-send'>&#xf1d8; fa-send</option>
            <option value='fa fa-share-square'>&#xf14d; fa-share-square</option>
            <option value='fa fa-smile-o'>&#xf118; fa-smile-o</option>
            <option value='fa fa-snowflake-o'>&#xf2dc; fa-snowflake-o</option>
            <option value='fa fa-soccer-ball-o'>&#xf1e3; fa-soccer-ball-o</option>
            <option value='fa fa-square'>&#xf0c8; fa-square</option>
            <option value='fa fa-star'>&#xf005; fa-star</option>
            <option value='fa fa-star-half'>&#xf089; fa-star-half</option>
            <option value='fa fa-sticky-note'>&#xf249; fa-sticky-note</option>
            <option value='fa fa-stop-circle'>&#xf28d; fa-stop-circle</option>

        </select>
    </div>
</div>
<script>
    window.addEventListener('load', (event) => {
        $('{{ "#holder_{$_tagID}" }} select').val('{{ $_tagValue }}').trigger("change");
    });
</script>
