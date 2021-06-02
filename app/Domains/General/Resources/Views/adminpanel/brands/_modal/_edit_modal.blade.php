@component("adminpanel.components.modal-component")
    @slot("modalID", "brandEditModalID")

    @slot("permission", "Edit_Brand")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "brand_edit_name_en",
        "brand_edit_name_ar",
        "brand_edit_description_en",
        "brand_edit_description_ar",
        "brand_edit_image",
    ])
@endcomponent
