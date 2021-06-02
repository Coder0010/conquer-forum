@component("adminpanel.components.modal-component")
    @slot("modalID", "categoryCreateModalID")

    @slot("permission", "Create_Category")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "category_create_name_en",
        "category_create_name_ar",
        "category_create_description_en",
        "category_create_description_ar",
    ])
@endcomponent
