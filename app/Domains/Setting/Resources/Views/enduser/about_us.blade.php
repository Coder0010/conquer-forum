@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-md-center row-eq-height">
                <div class="col-md-6 mb-5 text-center">
                    <h3>{{ GetSettingTransByKey("about_us_title") }}</h3>
                    <p> {!! GetSettingTransByKey('about_us_description') !!} </p>
                </div>
            </div>
        </div>
    </section>
@endsection
