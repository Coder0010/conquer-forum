<div class='card card-custom gutter-b border border-primary'>
    <div class='card-header card-header-tabs-line'>
        <div class='card-title'>
            <h3 class='card-label'> </h3>
        </div>
    </div>
    <div class='card-body'>
        @foreach (['facebook', 'instagram', 'twitter', 'linkedin', 'youtube'] as $item)
            @component("adminpanel.components.html-tags.general")
                @slot("tagTitle", __("main.{$item}"))
                @slot("tagName", $item)
                @slot("tagType", "url")
                @slot("tagValue", GetSettingByKey($item))
            @endcomponent
        @endforeach
    </div>
</div>
