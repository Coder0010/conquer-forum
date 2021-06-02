@extends("{$nameSpace}.layouts.main")

@section("title", __("site.register"))

@section("content")
<section class="login-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2>{{ __('site.register') }}</h2>
                    @include("global.partials._flash_messages")
                    <input type="text" name="name" class="app-btn grey @error('name') is-invalid @enderror" value="{{ old("name") }}" placeholder="{{ __('site.name') }}" autocomplete="off">
                    <input type="text" name="username" class="app-btn grey @error('username') is-invalid @enderror" value="{{ old("username") }}" placeholder="{{ __('site.username') }}" autocomplete="off">
                    <input type="email" name="email" class="app-btn grey @error('email') is-invalid @enderror" value="{{ old("email") }}" placeholder="{{ __('site.email') }}" autocomplete="off">
                    @foreach (["password", "password_confirmation"] as $item)
                        <input type="password" name="{{ $item }}" class="app-btn grey @error($item) is-invalid @enderror" placeholder="{{ __("site.${item}") }}">
                    @endforeach
                    <button type="submit" class="app-btn dark my-4">{{ __('site.register') }}</button>
                    <a href="{{ route('login') }}" class="have-email">{{ __("site.already_have_account") }}</a>
                </form>
            </div>
            <div class="col-lg-7">
                <img src="{{ asset('enduser/images/signup.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="login-bottom"></div>
</section>
@endsection

