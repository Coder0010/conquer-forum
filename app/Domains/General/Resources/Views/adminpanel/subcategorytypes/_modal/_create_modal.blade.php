@component("adminpanel.components.modal-component")
    @slot("modalID", "subcategorytypeCreateModalID")

    @slot("permission", "Create_Subcategorytype")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "subcategorytype_create_category_id",
        "subcategorytype_create_subcategory_id",
        "subcategorytype_create_name_en",
        "subcategorytype_create_name_ar",
    ])
@endcomponent
