@component("adminpanel.components.modal-component")
    @slot("modalID", "leadCreateModalID")

    @slot("permission", "Create_Lead")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "lead_create_name",
        "lead_create_phone",
        "lead_create_email",
        "lead_create_description",
    ])
@endcomponent
