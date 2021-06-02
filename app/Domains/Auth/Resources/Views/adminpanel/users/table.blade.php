@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "user")
    @slot("tablePluralName", "users")
    @slot("tableColumnsSearch")
        @component("adminpanel.components.html-tags.general")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagTitle", __("main.email"))
            @slot("tagName", "user_search_email")
            @slot("tagClass", "search_input")
            @slot("tagType", "email")
            @slot("tagValue", request("user_search_email"))
        @endcomponent
        @component("adminpanel.components.html-tags.general")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagTitle", __("main.phone"))
            @slot("tagClass", "search_input")
            @slot("tagName", "user_search_phone")
            @slot("tagValue", request("user_search_phone"))
        @endcomponent
        @component("adminpanel.components.html-tags.select")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagOptions", $roles)
            @slot("tagTitle", __("main.role"))
            @slot("tagClass", "search_input")
            @slot("tagName", "user_search_role_id")
            @slot("tagValue", request("user_search_role_id"))
        @endcomponent
        @component("adminpanel.components.html-tags.select")
            @slot("tagOptions", [
                ["id" => "facebook", "name" => "facebook"],
                ["id" => "google",   "name" => "google"],
            ])
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagTitle", __("main.provider"))
            @slot("tagClass", "search_input")
            @slot("tagName", "user_search_provider")
            @slot("tagValue", request("user_search_provider"))
        @endcomponent
        @component("adminpanel.components.html-tags.select")
            @slot("tagOptions", [
                ["id" => config("system.answers.no"),  "name" => __("main.no")],
                ["id" => config("system.answers.yes"), "name" => __("main.yes")],
            ])
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
        @slot("tagTitle", __("main.is_verified"))
            @slot("tagClass", "search_input")
        @slot("tagName", "user_search_is_verified")
        @slot("tagValue", request("user_search_is_verified"))
        @endcomponent
    @endslot
    @slot("tableColumnsTitle",[
        "user",
        "email",
        "phone",
        "role",
        "provider",
        "is_verified",
    ])
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.users.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    @if ($item->id != config("system.roles.super.id"))
                        <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    @else
                        <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> - <span></span> </label> </th>
                    @endif
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ optional($item->roles->first())->name }}</td>
                    <td>{{ optional($item->provider)->name ?? "Normal Register" }}</td>
                    <td class="{{ $item->email_verified_at ? 'text-success' : 'text-danger' }}">{{ $item->email_verified_at ? "verified" : "Not verified" }}</td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_User")
                                @slot("message", __("main.users") ."[ {$item->name} ]" )
                                @slot("route", route("admin.users.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_User")
                                @slot("message", __("main.users") ."[ {$item->name} ]" )
                                @slot("route", route("admin.users.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.show-btn")
                                @slot("permission", "Show_User")
                                @slot("route", route("admin.users.show", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_User")
                                @slot("buttonOnclickFunction", "userEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_User")
                                @slot("message", __("main.user") ."[ {$item->name} ]" )
                                @slot("route", route("admin.users.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
