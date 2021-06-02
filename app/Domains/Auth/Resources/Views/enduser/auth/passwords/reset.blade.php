@extends("{$nameSpace}.layouts.main")

@section("title", __("site.reset_password"))

@section("content")
    <section class="login-container ">
        <div class="container">
            <div class="row ">
                <div class="col-lg-5 col-md-8 col-12 pb-5 m-auto">
                    <form class="forget-password" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <h2>{{ __('site.forgot_my_password') }}</h2>
                        @include("global.partials._flash_messages")
                        <input type="hidden" name="token" class="app-btn grey" value="{{ request('token') }}">
                        <input type="hidden" name="email" class="app-btn grey" value="{{ request('email') }}">
                        @foreach (["password", "password_confirmation"] as $item)
                            <input type="password" name="{{ $item }}" class="app-btn grey @error($item) is-invalid @enderror" placeholder="{{ __("site.${item}") }}">
                        @endforeach
                        <button type="submit"  class="app-btn dark mt-3">{{ __('site.reset_password') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="login-bottom"></div>
    </section>
@endsection
