<!--begin::Login reset password form-->
<div class="login-reset">
    <div class="mb-20">
        <h3>{{ __("main.reset_password") }}</h3>
        <div class="text-muted font-weight-bold">{{ __("main.enter_your_email_to_reset_your_password") }}</div>
    </div>
    <form id="kt_login_reset_form" class="form" method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        @error("email") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-10">
            <input type="email" name="email" value="{{ $email }}" class="form-control h-auto py-4 px-8 @error("email") is-invalid @enderror" placeholder="{{ __('main.email') }}" autocomplete="off">
        </div>
        @error("password") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-5">
            <input type="password" name="password" class="form-control h-auto py-4 px-8" placeholder="{{ __('main.password') }}">
        </div>
        @error("password_confirmation") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-5">
            <input type="password" name="password_confirmation" class="form-control h-auto py-4 px-8" placeholder="{{ __('main.password_confirmation') }}">
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button id="kt_login_reset_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __("main.request") }}</button>
        </div>
    </form>
</div>
<!--end::Login reset password form-->
