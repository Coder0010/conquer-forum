@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "brand")
    @slot("tablePluralName", "brands")
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.brands.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td> <img src="{{ $item->getMainMedia() }}" width="50" height="70"> </td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Brand")
                                @slot("message", __("main.brands") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.brands.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Brand")
                                @slot("message", __("main.brands") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.brands.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Brand")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.brands.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Brand")
                                @slot("buttonOnclickFunction", "brandEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Brand")
                                @slot("message", __("main.brand") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.brands.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
