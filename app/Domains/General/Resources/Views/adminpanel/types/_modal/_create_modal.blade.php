@component("adminpanel.components.modal-component")
    @slot("modalID", "typeCreateModalID")

    @slot("permission", "Create_Type")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "type_create_name_en",
        "type_create_name_ar",
        "type_create_description_en",
        "type_create_description_ar",
    ])
@endcomponent
