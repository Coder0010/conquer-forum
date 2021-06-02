@extends("{$nameSpace}.layouts.main")

@section("title", __("site.profile"))

@section("content")
    <!-- start profile form -->
    <div class="profile-form">
        <div class="container">
            @include("global.partials._flash_messages")
            <div class="row">
                <div class="col-lg-10 col-md-12 m-auto">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method("patch")
                        <div class="img-container">
                            <div class="circle">
                                {{-- <img class="profile-pic" src="https://via.placeholder.com/150"> --}}
                                <img class="profile-pic" src="{{ auth()->user()->getMainMedia() }}">
                            </div>
                            <div class="p-image">
                                <div class="upload-button">
                                    <i class="fas fa-images"></i>
                                </div>
                                <input class="file-upload" name="image" type="file" accept="image/*" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="input-container">
                                    <label for="name">{{ __("site.name") }}</label>
                                    <input type="text" name="name" id="name" class="app-btn grey @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="input-container">
                                    <label for="username">{{ __("site.username") }}</label>
                                    <input type="text" name="username" id="username" class="app-btn grey @error('username') is-invalid @enderror" value="{{ auth()->user()->username }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="input-container">
                                    <label for="rank">{{ __("site.rank") }}</label>
                                    <input type="text" name="rank" id="rank" class="app-btn grey @error('rank') is-invalid @enderror" value="{{ auth()->user()->rank }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="input-container">
                                    <label for="email">{{ __("site.email") }}</label>
                                    <input type="email" name="email" id="email" class="app-btn grey @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                            @foreach (["password", "password_confirmation"] as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="input-container">
                                        <label for="{{ $item }}">{{ __("site.{$item}") }}</label>
                                        <input type="password" name="{{ $item }}" id="{{ $item }}" class="app-btn grey @error($item) is-invalid @enderror">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="app-btn dark mx-auto my-3 px-5 text-center d-flex"> {{ __('site.update_user') }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of profile form -->
@endsection

@section("js_scripts")
    <script>
        $(document).ready(function () {
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function () {
                readURL(this);
            });
            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });
        });
    </script>
@endsection
