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
        <title> {{ GetSettingTransByKey("name") ?? config("app.name") }} || @yield("title") </title>
        <link href='{{ GetSettingMediaUrl("favicon_".GetLanguage()) }}' rel="shortcut icon" type="image/png">
        @if($_SERVER["HTTP_HOST"] != "local.nurtravel")
            <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"/>
        @endif
        <link href="{{ asset('adminpanel/assets/plugins/global/plugins.bundle'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/assets/plugins/custom/prismjs/prismjs.bundle'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/assets/css/style.bundle'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/compiled'.addRtl().'.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
        @yield("styles")
        @yield("header_scripts")
    </head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize aside-minimize-hoverable footer-fixed page-loading">
        <x-AdminPanel.flash-messages-component/>
        @yield("content")
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{ asset('adminpanel/compiled.js') }}"></script>
        <script src="{{ asset('adminpanel/assets/js/pages/custom/login/login-general.js') }}"></script>
        @yield("js_vendors")
        @yield("js_scripts")
        @yield("popup_modals")
    </body>
</html>
