@extends("{$nameSpace}.layouts.auth")

@section("title", $title)

@section("content")
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div id="kt_login" class="login login-4 login-reset-on d-flex flex-row-fluid">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset('adminpanel/assets/media/bg/bg-3.jpg') }});">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('adminpanel/assets/media/logos/logo-letter-13.png') }}" class="max-h-75px" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    @include("auths::adminpanel.auth.forms.reset-form")
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
