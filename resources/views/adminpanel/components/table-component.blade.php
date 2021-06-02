@php
    if ($tableSingularName ?? null) {
        $_tableSingularName = $tableSingularName;
    }else{
        $_tableSingularName = "";
    }
    if ($tablePluralName ?? null) {
        $_tablePluralName = $tablePluralName;
    }else{
        $_tablePluralName = "";
    }

    if ($tableColumnsTitle ?? null) {
        $_tableColumnsTitle = $tableColumnsTitle;
    }else{
        $_tableColumnsTitle = [
            $_tableSingularName,
            "image",
        ];
    }

    if ($tableEnableSearch ?? null) {
        $_tableEnableSearch = false;
        $_resetBtnClass = "col-3";
    }else{
        $_tableEnableSearch = true;
        $_resetBtnClass = "col";
    }

    if ($tableDefaultSearch ?? null) {
        $_tableDefaultSearch = false;
    }else{
        $_tableDefaultSearch = true;
    }

    if ($tableColumnsSearch ?? null) {
        $_tableColumnsSearch = $tableColumnsSearch;
    }else{
        $_tableColumnsSearch = "";
    }

    $_componentID = $_tablePluralName . "-component";
    $_tableID     = $_tablePluralName . "-table";
@endphp
{!! $slot !!}
<div id='{{ $_componentID }}' class='component_container card border border-dark mb-2' data-component-id='{{ "#{$_componentID}" }}' data-table-id='{{ "#{$_tableID}" }}' data-search-form-id='{{ "#{$_tableID}-search-form" }}' data-delete-form-id='{{ "#{$_tableID}-delete-form" }}'>
    <div class='card-header border-bottom border-dark'>
        <div class="row">
            <div class="col-sm-4 d-flex justify-content-start align-items-center">
                <h6 class='mg-b-0'> {{ __("main.all") .' '. __("main.{$_tablePluralName}") }} </h6>
            </div>
            <div class="col-sm-4 offset-sm-4 text-right">
                @if(!Route::is("admin.users.show"))
                    @if(!Route::is("admin.{$_tablePluralName}.index"))
                        @component("adminpanel.components.buttons.show-btn")
                            @slot("permission", "Show_".Str::title($_tableSingularName))
                            @slot("route", route("admin.{$_tablePluralName}.index"))
                        @endcomponent
                    @endif
                    @if($data->count())
                        <a href='javascript:;' class='multi_restore_table btn btn-sm btn-clean btn-icon border border-dark' data-tooltip='kt-tooltip' data-original-title='{{ __("main.multi_restore") }}'>
                            <i class='fa fa-trash-restore fa-1x'></i>
                        </a>
                        <a href='javascript:;' class='multi_delete_table btn btn-sm btn-clean btn-icon border border-dark' data-tooltip='kt-tooltip' data-original-title='{{ __("main.multi_delete") }}'>
                            <i class='fa fa-trash fa-1x'></i>
                        </a>
                    @endif
                    @component('adminpanel.components.buttons.create-btn')
                        @slot("permission", "Create_".Str::title($_tableSingularName))
                        @slot("buttonOnclickFunction", "{$_tableSingularName}CreateModalJsFunction()")
                    @endcomponent
                @endif
            </div>
        </div>
    </div>
    <div class='card-body text-center'>
        @if($_tableEnableSearch)
            <form id='{{ "{$_tableID}-search-form" }}' class='table_search_form mb-2' action='{{ route("admin.{$_tablePluralName}.index") }}' method='get'>
                @if($_tableDefaultSearch)
                    <div class="form-row">
                        @if($data->count())
                            @component("adminpanel.components.html-tags.select")
                                @slot("tagHideLabel", true)
                                @slot("tagParentClass", "col")
                                @slot("tagOptions", [
                                    ["id" => 5,   "name" => 5],
                                    ["id" => 10,  "name" => 10],
                                    ["id" => 25,  "name" => 25],
                                    ["id" => 50,  "name" => 50],
                                    ["id" => 100, "name" => 100],
                                    ["id" => 150, "name" => 150],
                                    ["id" => 200, "name" => 200],
                                    ["id" => 250, "name" => 250],
                                ])
                                @slot("tagTitle", __("main.perPage"))
                                @slot("tagID", "{$_tableID}-search-per-page")
                                @slot("tagClass", "search_input")
                                @slot("tagName", "perPage")
                                @slot("tagValue", request("perPage"))
                            @endcomponent
                        @endif
                        @component("adminpanel.components.html-tags.select")
                            @slot("tagHideLabel", true)
                            @slot("tagParentClass", "col")
                            @slot("tagOptions", [
                                ["id" => config("system.status.active"),     "name" => __("main.active")],
                                ["id" => config("system.status.deactivate"), "name" => __("main.deactivate")],
                            ])
                            @slot("tagTitle", __("main.status"))
                            @slot("tagID", "{$_tableID}-search-status")
                            @slot("tagClass", "search_input")
                            @slot("tagName", "search_status")
                            @slot("tagValue", request("search_status"))
                        @endcomponent
                        @component("adminpanel.components.html-tags.select")
                            @slot("tagHideLabel", true)
                            @slot("tagParentClass", "col")
                            @slot("tagOptions", [
                                ["id" => "with-trash",    "name" => "with-trash"],
                                ["id" => "without-trash", "name" => "without-trash"],
                                ["id" => "only-trash",    "name" => "only-trash"],
                            ])
                            @slot("tagClass", "search_input")
                            @slot("tagName", "search_soft_delete")
                            @slot("tagTitle", __("main.soft_delete"))
                            @slot("tagID", "{$_tableID}-search-soft-delete")
                            @slot("tagValue", request("search_soft_delete"))
                        @endcomponent
                        @component("adminpanel.components.html-tags.general")
                            @slot("tagHideLabel", true)
                            @slot("tagParentClass", "col")
                            @slot("tagTitle", __("main.name"))
                            @slot("tagID", "{$_tableID}-search-name")
                            @slot("tagClass", "search_input")
                            @slot("tagName", "search_name")
                            @slot("tagValue", request("search_name"))
                        @endcomponent
                    </div>
                @endif
                <div class="form-row">
                    {!! $_tableColumnsSearch !!}
                    <div class='{{ $_resetBtnClass }}'>
                        <div class='form-group text-capitalize'>
                            <a class='search_clear_form_inputs form-control btn btn-primary text-white' href='javascript:;'>{{ __("main.reset") }}</a>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <form class='table_form' method='post' action='' data-multi-delete='{{ route("admin.{$_tablePluralName}.multi.delete") }}' data-multi-restore='{{ route("admin.{$_tablePluralName}.multi.restore") }}'>
            @csrf
            @method('post')
            <div class='table-responsive'>
                <table id='{{ $_tableID }}' class='table table-bordered table-hover table-checkable'>
                    <thead>
                        <tr>
                            <th scope='row'>
                                <label class='checkbox checkbox-inline checkbox-primary'> <input class='all_table_ids' type='checkbox'> <span></span> </label>
                            </th>
                            @foreach ($_tableColumnsTitle as $item)
                                <th> {{ __("main.{$item}") }} </th>
                            @endforeach
                            <th>{{ __("main.actions") }}</th>
                        </tr>
                    </thead>
                    {!! $tableData !!}
                    <tfoot>
                        <tr>
                            <th scope="row">
                                *-*
                            </th>
                            @foreach ($_tableColumnsTitle as $item)
                                <th> {{ __("main.{$item}") }} </th>
                            @endforeach
                            <th>{{ __("main.actions") }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
        @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class='d-flex justify-content-end'>
                {!! $data->links("pagination::bootstrap-4") !!}
            </div>
        @endif
    </div>
</div>
