@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    @include('enduser.partials.page_sub_header',[
        'child' => $title,
    ])
    <section class="page-inner">
        <div class="container page-content">
            <div class="row justify-content-md-center row-eq-height">
                @foreach ($data as $item)
                    <div class="col-md-6" style="padding:20px; box-shadow: 0 0 2px #afafaf; height:100%;">
                        <a href="{{ route("products.show",$item) }}"> <h3 style="margin: 1rem 0">  {{ $item->name_val }} </h3> </a>
                        <div class="blog-img">
                            @if(GetImageUrlFromStorage($item, 'Product-Collection') != DefaultImage())
                                {!! ShowImageFromStorage($item, 'Product-Collection') !!}
                            @endif
                        </div>
                        {!! $item->description_val !!}
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
