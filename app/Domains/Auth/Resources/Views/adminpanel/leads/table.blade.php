@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "lead")
    @slot("tablePluralName", "leads")
    @slot("tableColumnsSearch")
        @component("adminpanel.components.html-tags.general")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagTitle", __("main.email"))
            @slot("tagName", "lead_search_email")
            @slot("tagClass", "search_input")
            @slot("tagType", "email")
            @slot("tagValue", request("lead_search_email"))
        @endcomponent
        @component("adminpanel.components.html-tags.general")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagTitle", __("main.phone"))
            @slot("tagClass", "search_input")
            @slot("tagName", "lead_search_phone")
            @slot("tagValue", request("lead_search_phone"))
        @endcomponent
    @endslot
    @slot("tableColumnsTitle",[
        "lead",
        "phone",
        "email",
        "description",
        "type",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.leads.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip="tooltip" data-original-title="{{ __("main.name") }}"> {{ $item->name }} </span> </td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td>{{ $item->email ?? '-' }}</td>
                    <td>{{ $item->description ?? '-' }}</td>
                    <td>{{ $item->type ?? '-' }}</td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Lead")
                                @slot("message", __("main.leads") ."[ {$item->name} ]" )
                                @slot("route", route("admin.leads.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Lead")
                                @slot("message", __("main.leads") ."[ {$item->name} ]" )
                                @slot("route", route("admin.leads.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("role", "Super_Role||Manager_Role")
                                @slot("permission", "Edit_Lead")
                                @slot("buttonOnclickFunction", "leadEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("role", "Super_Role||Manager_Role")
                                @slot("permission", "Delete_Lead")
                                @slot("message", __("main.lead") ."[ {$item->name} ]" )
                                @slot("route", route("admin.leads.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
