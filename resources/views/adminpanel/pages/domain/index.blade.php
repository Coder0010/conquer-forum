@extends("{$nameSpace}.layouts.main")

@section("title", $title)

@section("content")
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                @include("{$domainAlias}::{$nameSpace}.{$crudName}.table")
            </div>
        </div>
    </div>
@endsection

@section("popup_modals")

    @include("{$domainAlias}::{$nameSpace}.{$crudName}._modal._create_modal")

    @include("{$domainAlias}::{$nameSpace}.{$crudName}._modal._edit_modal")

@endsection
