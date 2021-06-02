<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{ GetLanguage() }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ GetLanguage() }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ GetLanguage() }}" dir="{{ GetDirection() }}" style="direction: {{ GetDirection() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta http-equiv="cache-control" content="private, max-age=0, no-cache" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" / />
        <meta name="turbolinks-cache-control" content="no-cache" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="{{ config("system.developer.name") }}" />
        <meta property="og:author" content="{{ config("system.developer.name") }}" />
        <meta property="og:title" content="{{ GetSettingTransByKey("name") ?? config("app.name") }}" />
        <meta property="og:description" content="{{ GetSettingTransByKey("description") }}" />
        <meta property="og:image" content="{{ GetSettingMediaUrl("favicon_".GetLanguage()) }}" />
        <title> {{ GetSettingTransByKey("name") ?? config("app.name") }} || @yield("title") </title>
        <link href='{{ GetSettingMediaUrl("favicon_".GetLanguage()) }}' rel="shortcut icon" type="image/png">
        @if($_SERVER["HTTP_HOST"] !== env("LOCAL_DOMAIN"))
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"/>
        @endif
        <link href="{{ asset('adminpanel/assets/plugins/global/plugins.bundle'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/compiled'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        @include("adminpanel.partials._header_assets")
        @yield("styles")
        @yield("header_scripts")
    </head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable footer-fixed page-loading">
        @include("global.partials._loader")
        @include("adminpanel.components.mobile-header-component")
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <x-AdminPanel.left-aside-component/>
                <!--begin::Wrapper-->
                <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
                    <x-AdminPanel.upper-navbar-component/>
                    <!--begin::Content-->
                    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                        <x-AdminPanel.content-navbar-component :child="$title"/>
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container-fluid">
                                <x-AdminPanel.flash-messages-component/>
                                @yield("content")
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
                    <!--end::Content-->
                    <x-AdminPanel.content-footer-component/>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!------end::Main------>
        <!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <!--end::Scrolltop-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{ asset('adminpanel/compiled.js') }}"></script>
        <script src='https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_API_KEY") }}&libraries=places'></script>
        @include("adminpanel.partials._footer_assets")
        @yield("js_vendors")
        @yield("js_scripts")
        @yield("popup_modals")
    </body>
</html>
