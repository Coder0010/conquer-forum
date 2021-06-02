<!--begin::Login forgot password form-->
<div class="login-forgot">
    <div class="mb-20">
        <h3>{{ __("main.forget_password") }}</h3>
        <div class="text-muted font-weight-bold">{{ __("main.enter_your_email_to_reset_your_password") }}</div>
    </div>
    <form id="kt_login_forgot_form" class="form" method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        @error("email") <div class="text-danger"> <strong>{{ $message }}</strong> </div> @enderror
        <div class="form-group mb-10">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control h-auto py-4 px-8 @error("email") is-invalid @enderror" placeholder="{{ __('main.email') }}" autocomplete="off">
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __("main.request") }}</button>
            <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __("main.cancel") }}</button>
        </div>
    </form>
</div>
<!--end::Login forgot password form-->
