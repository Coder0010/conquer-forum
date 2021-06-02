@component("adminpanel.components.modal-component")
    @slot("modalID", "subcategoryCreateModalID")

    @slot("permission", "Create_Subcategory")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "subcategory_create__category_id",
        "subcategory_create__name_en",
        "subcategory_create__name_ar",
    ])
@endcomponent
