@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "subcategorytype")
    @slot("tablePluralName", "subcategorytypes")
    @slot("tableColumnsTitle",[
        "subcategorytype",
        "subcategory",
        "category",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.subcategorytypes.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td>{{ optional($item->subcategory)->name_val }}</td>
                    <td>{{ optional($item->subcategory->category)->name_val }}</td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Subcategorytype")
                                @slot("message", __("main.subcategorytype") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategorytype.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Subcategorytype")
                                @slot("message", __("main.subcategorytype") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategorytype.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Subcategorytype")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.subcategorytypes.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Subcategorytype")
                                @slot("buttonOnclickFunction", "subcategorytypeEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Subcategorytype")
                                @slot("message", __("main.sub_category_type") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.subcategorytypes.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
