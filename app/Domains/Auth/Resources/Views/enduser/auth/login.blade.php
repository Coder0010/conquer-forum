@extends("{$nameSpace}.layouts.main")

@section("title", __("site.login"))

@section("content")
    <section class="login-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h2>{{ __("site.login") }}</h2>
                        @include("global.partials._flash_messages")
                        <input name="email" type="email" class="app-btn grey @error('email') is-invalid @enderror" placeholder="{{ __('site.email') }}" value="{{ old("email") }}" autocomplete="off">
                        <input name="password" type="password" class="app-btn grey @error('password') is-invalid @enderror" placeholder="{{ __('site.password') }}">
                        <div class="forget-password">
                            <a href="{{ route("password.request") }}">{{ __("site.forgot_my_password") }}</a>
                        </div>
                        <button type="submit" class="app-btn dark mb-2">{{ __("site.login") }}</button>
                        <a href="{{ route('register') }}" class="app-btn light">{{ __("site.register") }}</a>
                    </form>
                </div>
                <div class="col-lg-7">
                    <img src="{{ asset('enduser/images/login.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="login-bottom"></div>
    </section>
@endsection
