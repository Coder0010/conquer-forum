@component("adminpanel.components.modal-component")
    @slot("modalID", "brandCreateModalID")

    @slot("permission", "Create_Brand")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "brand_create_name_en",
        "brand_create_name_ar",
        "brand_create_description_en",
        "brand_create_description_ar",
        "brand_create_image",
    ])
@endcomponent
