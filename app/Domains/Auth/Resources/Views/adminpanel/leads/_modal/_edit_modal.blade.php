@component("adminpanel.components.modal-component")
    @slot("modalID", "leadEditModalID")

    @slot("permission", "Edit_Lead")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "lead_edit_name",
        "lead_edit_phone",
        "lead_edit_email",
        "lead_edit_description",
    ])
@endcomponent
