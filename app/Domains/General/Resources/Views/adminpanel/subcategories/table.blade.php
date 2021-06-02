@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "subcategory")
    @slot("tablePluralName", "subcategories")
    @slot("tableColumnsSearch")
        @component("adminpanel.components.html-tags.select")
            @slot("tagHideLabel", true)
            @slot("tagParentClass", "col-3")
            @slot("tagOptions", $categories)
            @slot("tagTitle", __("main.category"))
            @slot("tagClass", "search_input")
            @slot("tagName", "subcategory_search_category_id")
            @slot("tagValue", request("subcategory_search_category_id"))
        @endcomponent
    @endslot
    @slot("tableColumnsTitle",[
        "subcategory",
        "category",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.subcategories.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td>{{ optional($item->category)->name_val }}</td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Subcategory")
                                @slot("message", __("main.subcategories") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategories.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Subcategory")
                                @slot("message", __("main.subcategories") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategories.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Subcategory")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.subcategories.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Subcategory")
                                @slot("buttonOnclickFunction", "subcategoryEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Subcategory")
                                @slot("message", __("main.category") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategories.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
