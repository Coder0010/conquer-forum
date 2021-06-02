@component("adminpanel.components.modal-component")
    @slot("modalID", "categoryEditModalID")

    @slot("permission", "Edit_Category")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "category_edit_name_en",
        "category_edit_name_ar",
        "category_edit_description_en",
        "category_edit_description_ar",
    ])
@endcomponent
