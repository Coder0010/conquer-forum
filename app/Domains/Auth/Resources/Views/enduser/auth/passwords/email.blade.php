@extends("{$nameSpace}.layouts.main")

@section("title", __("site.login"))

@section("content")
    <section class="login-container">
        <div class="container">
            <div class="row ">
                <div class="col-lg-5 col-md-8 col-12 pb-5 m-auto">
                    <form class="forget-password" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h2>{{ __("site.forgot_my_password") }}</h2>
                        @include("global.partials._flash_messages")
                        <input type="email" name="email" class="app-btn grey @error('email') is-invalid @enderror" value="{{ old("email") }}" placeholder="{{ __('site.email') }}" autocomplete="off">
                        <button type="submit" class="app-btn dark mt-3">{{ __("site.forgot_my_password") }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="login-bottom"></div>
    </section>
@endsection
