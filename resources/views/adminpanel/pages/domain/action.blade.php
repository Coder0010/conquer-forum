@extends("{$nameSpace}.layouts.main")

@section("title", $title)

@section("content")
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <div class="title m-0 text-capitalize text-center">
                        {{ $title }}
                    </div>
                </div>
                @include("{$domainAlias}::{$nameSpace}.{$crudName}._form.{$actionForm}")
            </div>
        </div>
    </div>
@endsection
