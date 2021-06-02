@extends("{$nameSpace}.layouts.main")

@section("title", $title)

@php
    $forms_crud = [
        "seo-form",
        "navbar-form",
        "contact-us-form",
        "social-media-form",
    ];
    $error_type = "";
    $navbar_form_errors="";
    $contact_us_form_errors = "";
    $seo_form_errors = "";
    $social_media_form_errors = "";
    $map_form_errors = "";
@endphp
@foreach (["navbar_trans_home", "navbar_trans_contact_us", "navbar_trans_about_us"] as $item)
    @error("{$item}_en")
        @php $navbar_form_errors = "text-danger en"; @endphp
        @break
    @enderror
    @error("{$item}_ar")
        @php $navbar_form_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach

@foreach (["name", "keywords", "description", "favicon", "logo"] as $item)
    @error("{$item}_en")
        @php $seo_form_errors = "text-danger en"; @endphp
        @break
    @enderror
    @error("{$item}_ar")
        @php $seo_form_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach

@foreach (["contact_us_title", "contact_us_description",] as $item)
    @error("{$item}_en")
        @php $contact_us_form_errors = "text-danger en"; @endphp
        @break
    @enderror
    @error("{$item}_ar")
        @php $contact_us_form_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach

@foreach (["facebook", "instagram", "twitter", "linkedin", "youtube"] as $item)
    @error($item)
        @php $social_media_form_errors = "text-danger"; @endphp
        @break
    @enderror
@endforeach

@section("content")

    <form class='form row' id='setting-form' method='POST' action='{{ route("admin.settings.update") }}' enctype='multipart/form-data'>

        @method('post')
        @csrf

        <div class='col-12 mb-5'>
            <button type='submit' class='btn btn-success col'>{{ __('main.submit') }}</button>
        </div>
        <div class='col-md-3 col-sm-12'>
            <ul class='nav nav-pills nav-boldest flex-column text-center' id='settings-tabs' role='tablist'>
                @foreach ($forms_crud as $form)
                    @switch($form)
                        @case("navbar-form")
                            @php $error_type = $navbar_form_errors; @endphp
                            @break
                        @case("contact-us-form")
                            @php $error_type = $contact_us_form_errors; @endphp
                            @break
                        @case("seo-form")
                            @php $error_type = $seo_form_errors; @endphp
                            @break
                        @case("social-media-form")
                            @php $error_type = $social_media_form_errors; @endphp
                            @break
                        @default
                    @endswitch
                    <li class="nav-item">
                        <a class='nav-link {{ $loop->first ? 'active' : "" }}' id='{{ "{$form}-btn-pill" }}' href='#{{ "{$form}-tab" }}' data-toggle='tab' role="tab" aria-controls="{{ $form }}" aria-selected="true">
                            <span class='nav-text {{ $error_type }}'>{{ __("main.{$form}-setting") }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class='col-md-9 col-sm-12'>
            <div class='tab-content' id='all-settings-tab'>
                @foreach ($forms_crud as $form)
                    <div class='tab-pane fade {{ $loop->first ? "active show" : "" }}' id='{{ "{$form}-tab" }}' aria-labelledby='{{ "{$form}-btn-pill" }}' role='tabpanel'>
                        @include("settings::adminpanel.settings.forms.{$form}")
                    </div>
                @endforeach
            </div>
        </div>
        <div class='col-12 mt-5'>
            <button type='submit' class='btn btn-success col'>{{ __('main.submit') }}</button>
        </div>

    </form>

@endsection

@section("js_scripts")
    <script>
        @unlessrole('Super_Role')
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        @endunlessrole

        $(document).ready(function(){
            langs.forEach(lang => {
                initTagify(`keywords_`+lang);
                if($(`#services_${lang}`).length){
                    $(`#services_${lang}`).repeater(repeaterOptions);
                }
                if($(`#branches_${lang}`).length){
                    $(`#branches_${lang}`).repeater(repeaterOptions);
                }
            });
        });

        if($('#mapCanvas').length){
            var initialize = function() {
                var position = ['{{ GetSettingByKey("map_lat") }}', '{{ GetSettingByKey("map_lng") }}'];
                var latlng = new google.maps.LatLng(position[0], position[1]);
                var searchBox = new google.maps.places.SearchBox(document.getElementById('map_search'));
                google.maps.event.addListener(searchBox,'places_changed',function(){
                    var places = searchBox.getPlaces();
                    var bounds = new google.maps.LatLngBounds();
                    var _i;
                    var _place;
                    for(_i=0; _place=places[_i]; _i++){
                        $('#map_address').val(_place.formatted_address);
                        bounds.extend(_place.geometry.location);
                        marker.setPosition(_place.geometry.location);
                        $('#map_lat').val(_place.geometry.location.lat());
                        $('#map_lng').val(_place.geometry.location.lng());
                    }
                    map.fitBounds(bounds);
                    map.setZoom(15);
                });

                var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                    zoom: 16,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                });

                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: 'Latitude:'+position[0]+' | Longitude:'+position[1],
                    animation: google.maps.Animation.DROP,
                });
                const infowindow = new google.maps.InfoWindow({
                    content: '<div id=\'content\'> {{ GetSettingTransByKey("name") }} </div>',
                });
                marker.addListener('click', () => {
                    infowindow.open(map, marker);
                });
                $('#map_lat').val(position[0]);
                $('#map_lng').val(position[1]);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        }

    </script>
@endsection
