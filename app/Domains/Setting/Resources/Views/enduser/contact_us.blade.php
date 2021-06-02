@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-md-center row-eq-height text-center">
                <section class="login-container">
                    <div class="container">
                        <div class="row">
                            @if(GetSettingTransByKey("contact_us_title") && GetSettingTransByKey("contact_us_description"))
                                <div class="col-12 mb-2 mt-5">
                                    <h3>{{ GetSettingTransByKey("contact_us_title") }}</h3>
                                    <p> {!! GetSettingTransByKey('contact_us_description') !!} </p>
                                </div>
                            @endif
                            <div class="col-lg-5">
                                @include('auths::enduser._sections._leads')
                            </div>
                            <div class="col-lg-7">
                                <img src="{{ asset('enduser/images/contact-us.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="login-bottom"></div>
                </section>
            </div>
        </div>
    </section>
@endsection
