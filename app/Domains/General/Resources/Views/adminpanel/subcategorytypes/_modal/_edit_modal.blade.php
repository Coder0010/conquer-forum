@component("adminpanel.components.modal-component")
    @slot("modalID", "subcategorytypeEditModalID")

    @slot("permission", "Edit_Subcategorytype")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "subcategorytype_edit_category_id",
        "subcategorytype_edit_subcategory_id",
        "subcategorytype_edit_name_en",
        "subcategorytype_edit_name_ar",
    ])
@endcomponent
