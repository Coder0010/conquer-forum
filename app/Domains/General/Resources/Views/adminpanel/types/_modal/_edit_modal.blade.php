@component("adminpanel.components.modal-component")
    @slot("modalID", "typeEditModalID")

    @slot("permission", "Edit_Type")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "type_edit_name_en",
        "type_edit_name_ar",
        "type_edit_description_en",
        "type_edit_description_ar",
    ])
@endcomponent
