@component("adminpanel.components.modal-component")
    @slot("modalID", "userEditModalID")

    @slot("permission", "Edit_User")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "user_edit_role_id",
        "user_edit_name",
        "user_edit_email",
        "user_edit_phone",
        "user_edit_password"
    ])
@endcomponent
