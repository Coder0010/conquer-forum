@extends("{$nameSpace}.layouts.main")

@section("title", $title)

@section("content")
    @include("adminpanel.partials.page_sub_header",[
        "grandParent"      => __("main.dashboard"),
        "grandParentRoute" => route("admin.dashboard"),
        "parent"           => __("main.users"),
        "parentRoute"      => route("admin.users.index"),
        "child"            => "Profile :- ".$title
    ])

    <div class="row mt-4">
        <div class="col-12 card mb-4">
            <div class="card-body p-0">
                <div class="text-normal user-details__user-data border-top border-bottom p-4">
                    @foreach (["name", "email", "phone"] as $item)
                        <div class="row mb-3">
                            <div class="col w-100">
                                <span>{{ __("main.{$item}") }}</span>
                                <span class="text-lowercase">{{ $show[$item] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="user-details__tags p-4">
                    <span class="badge badge-pill mb-2 border" data-tooltip="kt-tooltip" data-original-title="{{ __("main.role") }}">{{ $show->roles[0]->name }}</span>
                    <span class="badge badge-pill mb-2 border" data-tooltip="kt-tooltip" data-original-title="{{ __("main.orders") }}">{{ $orders->count() }}</span>
                </div>
            </div>
        </div>
        @include("items::adminpanel.orders.table", ["data" => $orders])
    </div>
@endsection

@section("popup_modals")
    @include("items::adminpanel.orders._modal._create_modal",[
        "domainAlias"   => "items",
        "nameSpace"     => "adminpanel",
        "crudName" => "orders",
    ])
@endsection
