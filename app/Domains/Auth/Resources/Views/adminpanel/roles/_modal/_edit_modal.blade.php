@component("adminpanel.components.modal-component")
    @slot("modalID", "roleEditModalID")

    @slot("permission", "Edit_Role")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "role_edit_name",
        "role_edit_alias_name",
        "role_edit_permissions",
    ])
@endcomponent
