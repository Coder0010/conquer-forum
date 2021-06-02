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
        <link href="{{ asset('enduser/css/compiled.css') }}" rel="stylesheet" type="text/css" />
        @yield("styles")
    </head>
    <body>
        <div class="menu-container"></div>
        <div class="menu-btn">
            <div class="btn-line"></div>
            <div class="btn-line"></div>
            <div class="btn-line"></div>
        </div>
        <header>
            <div class="header-container">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 d-flex justify-content-between align-items-center px-5">
                            <a href="{{ route('index') }}" class="header-logo">
                                <img src="{{ asset('enduser/images/logo-header.svg') }}" class="img-fluid" alt="conquer logo">
                            </a>
                            <div class="header-content align-items-center">
                                <ul class="list-unstyled">
                                    <li class="{{ Route::is('index') ? 'active' : '' }}">
                                        <a href="{{ route('index') }}" class="app-btn {{ Route::is('index') ? 'dark' : 'grey' }}">{{ __("site.index") }}</a>
                                    </li>
                                    @auth
                                        <li class="{{ Route::is('profile') ? 'active' : '' }}">
                                            <a href="{{ route('profile') }}" class="app-btn mx-1 {{ Route::is('profile') ? 'dark' : 'grey' }}">{{ __('site.profile') }}</a>
                                        </li>
                                    @else
                                        <li class="{{ Route::is('login') ? 'active' : '' }}">
                                            <a href="{{ route('login') }}" class="app-btn mx-1 {{ Route::is('login') ? 'dark' : 'grey' }}">{{ __('site.login') }}</a>
                                        </li>
                                        <li class="{{ Route::is('register') ? 'active' : '' }}">
                                            <a href="{{ route('register') }}" class="app-btn mx-1 {{ Route::is('register') ? 'dark' : 'grey' }}">{{ __('site.register') }}</a>
                                        </li>
                                    @endauth
                                    <li class="{{ Route::is('contact_us') ? 'active' : '' }}">
                                        <a href="{{ route('contact_us') }}" class="app-btn mx-1 {{ Route::is('contact_us') ? 'dark' : 'grey' }}">{{ __('site.contact_us') }}</a>
                                    </li>
                                    @if(App::isLocale('ar'))
                                        <li>
                                            <a class="app-btn mx-1 grey" href="{{ route('lang.change', ['en']) }}"> English </a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="app-btn mx-1 grey" href="{{ route('lang.change', ['ar']) }}"> عربى </a>
                                        </li>
                                    @endif
                                </ul>
                                @auth
                                    <div class="btn-group">
                                        <button type="button" class="app-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ auth()->user()->name }}
                                            <img src="{{ asset('enduser/images/pexels-photo-220453.svg') }}" alt="">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" target="_blank" class="dropdown-item">{{ __("site.sign_out") }}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-border"></div>
        </header>

        <nav class="menu">
            <ul class="menu-nav">
                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link"> {{ __("site.index") }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link"> {{ __("site.profile") }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact_us') }}" class="nav-link"> {{ __("site.contact-us") }} </a>
                </li>
                @auth
                    <li class="nav-item">
                        <div class="nav-link">
                            <div class="btn-group">
                                <button type="button" class="app-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                    <img src="{{ asset('enduser/images/pexels-photo-220453.svg') }}" alt="">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="nav-item my-5">
                        <a href="{{ route("register") }}" class="app-btn light">{{ __("site.login") }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("login") }}" class="app-btn dark">{{ __("site.login") }}</a>
                    </li>
                @endauth
            </ul>
        </nav>

            @yield("content")

        <footer>
            <div class="footer-main">
                <div class="content">
                <img src="{{ asset('enduser/images/logo-footer.svg') }}" class="img-fluid" alt="conquer logo">
                <div class="text">
                    <a href="">سياسة الخصوصية</a>
                    <span></span>
                    <a href="">شروط الاستخدام</a>
                </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright 2021 - All Rights Reserved</p>
            </div>
        </footer>
        <script src="{{ asset('enduser/js/compiled.js') }}"></script>
        @include("global.scripts._recaptcha-script")
        @yield("js_scripts")
    </body>
</html>
