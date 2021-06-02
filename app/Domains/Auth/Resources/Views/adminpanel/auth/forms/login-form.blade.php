<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __("main.sign_in_to_admin") }}</h3>
        <div class="text-muted font-weight-bold">{{ __("main.enter_your_details_to_login_to_your_account") }}:</div>
    </div>
    <form id="kt_login_signin_form" class="form" method="POST" action="{{ route('admin.login') }}">
        @csrf
        @error("email") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-5">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control h-auto py-4 px-8" placeholder="{{ __('main.email') }}" autocomplete="off">
        </div>
        @error("password") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-5">
            <input type="password" name="password" class="form-control h-auto py-4 px-8" placeholder="{{ __('main.password') }}">
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
            <div class="checkbox-inline">
                <label class="checkbox m-0 text-muted">
                    <input type="checkbox" name="remember" /> <span></span>{{ __("main.remember_me") }}
                </label>
            </div>
            <a id="kt_login_forgot" class="text-muted text-hover-primary" href="javascript:;">{{ __("main.forget_password") }}</a>
        </div>
        <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            {{ __("main.sign_in") }}
        </button>
    </form>
</div>
<!--end::Login Sign in form-->
