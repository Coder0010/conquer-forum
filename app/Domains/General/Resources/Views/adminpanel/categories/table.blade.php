@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "category")
    @slot("tablePluralName", "categories")
    @slot("tableColumnsTitle",[
        "category",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.categories.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Category")
                                @slot("message", __("main.categories") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.categories.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Category")
                                @slot("message", __("main.categories") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.categories.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Category")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.categories.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Category")
                                @slot("buttonOnclickFunction", "categoryEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Category")
                                @slot("message", __("main.category") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.categories.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
