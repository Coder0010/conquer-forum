@component("adminpanel.components.modal-component")
    @slot("modalID", "roleCreateModalID")

    @slot("permission", "Create_Role")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "role_create_name",
        "role_create_alias_name",
        "role_create_permissions",
    ])
@endcomponent
