<style>
    ::-webkit-input-placeholder , :-moz-placeholder , ::-moz-placeholder , :-ms-input-placeholder , select2-container--default, select, select option:checked{
        text-transform: capitalize;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    div.pac-container {
        z-index: 99999999999 !important;
    }
</style>
<script>
    var globalTimeOut = 500;
    var langs = @json(AppLanguages());
    var repeaterOptions = {
        initEmpty: false,
        isFirstItemUndeletable: true,
        defaultValues: {
            "text-input": ""
        },
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if(confirm("Are you sure you want to delete this element?")) {
                $(this).slideUp(deleteElement);
            }
        }
    };
</script>
