@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "type")
    @slot("tablePluralName", "types")
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.types.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td> <img src="{{ $item->getMainMedia() }}" width="50" height="70"> </td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Type")
                                @slot("message", __("main.types") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.types.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Type")
                                @slot("message", __("main.types") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.types.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Type")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.types.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Type")
                                @slot("buttonOnclickFunction", "typeEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Type")
                                @slot("message", __("main.type") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.types.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
