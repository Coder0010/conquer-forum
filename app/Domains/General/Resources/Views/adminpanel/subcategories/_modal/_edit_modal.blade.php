@component("adminpanel.components.modal-component")
    @slot("modalID", "subcategoryEditModalID")

    @slot("permission", "Edit_Subcategory")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "subcategory_edit_category_id",
        "subcategory_edit_name_en",
        "subcategory_edit_name_ar",
    ])
@endcomponent
