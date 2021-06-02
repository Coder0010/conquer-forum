@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "role")
    @slot("tablePluralName", "roles")
    @slot("tableColumnsTitle",[
        "role",
        "users_count",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.roles.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    @if ($item->id != config("system.roles.super.id") && $item->id != config("system.roles.normal.id"))
                        <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    @else
                        <th scope="row"> <label class="checkbox checkbox-disabled"> <span></span> </label> </th>
                    @endif
                    <td> <span data-tooltip="tooltip" data-original-title="{{ __("main.name") }}"> {{ $item->name }} </span> <hr> <span data-tooltip="tooltip" data-original-title="{{ __("main.alias_name") }}"> {{ $item->alias_name }} </span> </td>
                    <td>{{ $item->users()->count() }}</td>
                    <td>
                        @if ($item->id != config("system.roles.super.id") && $item->id != config("system.roles.normal.id"))
                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Role")
                                @slot("buttonOnclickFunction", "roleEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Role")
                                @slot("message", __("main.role") ."[ {$item->name} ]" )
                                @slot("route", route("admin.roles.delete", $item->id))
                            @endcomponent
                        @else
                            <span class="st-icon-delicious"></span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
