@extends("enduser.layouts.main")

@section("title", __("site.home"))

@section("content")
    <main class="main">
        <img src="{{ asset('enduser/images/main.png') }}" class="img-fluid">
    </main>

    <div class="subjects">
        <div class="container">
            <div class="subjects-header d-flex justify-content-between align-items-center flex-md-row flex-column my-3 py-2 px-md-4 px-2">
                <p>المـنـتـــدى الـعـــــــام</p>
                <p>
                    Conqueror's Blade
                    المنتدي العربي الأول للعبة
                </p>
            </div>
            <div class="row">
                <div class="col-12">
                    <!--  start subject content HEADER -->
                    <div class="subject-content-header my-2 d-flex justify-content-between align-items-center">
                        <div class="writer text-center">
                        شعار المنتدي </div>
                        <div class="subject-text text-right">
                        المنتديات الفرعية
                        </div>
                        <div class="last-comment text-right">
                        آخر مشاركة </div>
                        <div class="number-of-comments text-center">
                        عدد المواضيع
                        </div>
                        <div class="number-of-views text-center">
                        عدد المشاركات
                        </div>
                    </div>
                    <!--  end of subject content HEADER -->

                    <!--  start subject content -->
                    <div class="subject-content my-2 d-flex justify-content-between align-items-center">
                        <div class="writer d-flex flex-column text-center align-items-center ">
                            <img src="{{ asset('enduser/images/community.svg') }}" class="img-fluid" width="70px">
                        </div>
                        <div class="subject-text d-flex flex-column text-right">
                        <div class="header d-flex justify-content-between">
                            <h3>
                                قسم الترحيب والتعارف
                            </h3>
                            <span>
                                154
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="text d-flex justify-content-between align-items-center">
                            <span> أسرة موقعنا منزل واحد يجمعنا كلنا أدخل عرفنا بنفسك بشكل أكثر</span>
                        </div>
                        </div>
                        <div class="last-comment d-flex flex-column text-right">
                            <h3>
                                كل سنة وأنتو طيبين
                            </h3>
                            <div class="text d-flex justify-content-between ">
                                <p>
                                    <span> بواسطة :</span>
                                    <span>
                                        <a href="">Username</a>
                                    </span>
                                </p>
                                <p class="text-left">
                                    <span>AM 06:59</span> <br>
                                    <span>02/05/2021</span>
                                </p>
                            </div>
                        </div>
                        <div class="number-of-comments d-flex flex-column justify-content-center text-center">
                            <span>302</span>
                        </div>
                        <div class="number-of-views d-flex flex-column justify-content-center text-center">
                            <span>
                                450
                            </span>
                        </div>
                    </div>
                    <!--  end of subject content -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js_scripts")
    <script>

    </script>
@endsection
