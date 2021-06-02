@component("adminpanel.components.modal-component")
    @slot("modalID", "userCreateModalID")

    @slot("permission", "Create_User")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "user_create_role_id",
        "user_create_name",
        "user_create_email",
        "user_create_phone",
        "user_create_password"
    ])
@endcomponent
