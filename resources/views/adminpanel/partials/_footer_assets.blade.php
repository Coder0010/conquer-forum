{{-- @include("global.scripts._recaptcha-script") --}}
@include("adminpanel.partials.scripts._editor-script")
@include("adminpanel.partials.scripts._select-script")
@include("adminpanel.partials.scripts._dropzone-script")
{{-- @include("adminpanel.partials.scripts._chart-script") --}}
@include("adminpanel.partials.scripts._datatable-script")
<script>
    if(location.hostname === "{{ env('LOCAL_DOMAIN') }}"){
        $("body").addClass('aside-minimize');
    }

    /*
    * init Repeater Content
    */
    var repeaterContent = function(_crud, i, _row){
        var title_name        = _crud+"["+i+"][title]";
        var title_value       = _row ? _row.title : '';
        var description_name  = _crud+"["+i+"][description]";
        var description_value = _row ? _row.description : '';
        var content;
            content = '<div data-repeater-item class="repeater_container mt-1 border border-primary">';
                content += '<h4 class="header-title text-center"> <a class="btn btn-danger btn-elevate btn-icon delete-package-data" data-repeater-delete href="javascript:;"><i class="fa fa-trash"></i></a> </h4>';

                content += '<div class="col">';
                    content += '<div class="form-group">';
                        content += '<label>title</label>';
                        content += '<input type="text" name="'+title_name+'" value="'+title_value+'" class="form-control">';
                    content += '</div>';
                content += '</div>';

                content += '<div class="col">';
                    content += '<div class="form-group">';
                        content += '<label>description</label>';
                        content += '<textarea rows="3" cols="3" name="'+description_name+'" class="form-control">'+ description_value +'</textarea>';
                    content += '</div>';
                content += '</div>';

            content += '</div>';
        return content;
    }

    /*
    * init Edit Repeater
    */
    var initEditRepeater = function(_id , _data) {
        $("#"+_id+" .repeater_container").not(':first').remove();
        for (let index = 0; index < _data.length; index++) {
            var content = repeaterContent(_id, index, _data[index]);
            $("#"+_id+" > div").append(content);
        }
        $("#"+_id).sortable({
            items: ".repeater_container",
            cursor: "move",
            placeholder: "ui-state-highlight",
            opacity: 0.6,
        });
    }

    /*
    * init tagify
    */
    var initTagify = function(_id) {
        var input = document.getElementById(_id);
        if(input){
            const tagify = new Tagify(input);
        }
    }

    /*
    * init avater of file input
    */
    var initAvater = function(_input) {
        const avatar = new KTImageInput(_input);
        avatar.on('cancel', function(imageInput) {
            // swal.fire("Image successfully canceled!", "You clicked the button!", "info");
        });

        avatar.on('change', function(imageInput) {
            // swal.fire("Image successfully changed!", "You clicked the button!", "success");
        });

        avatar.on('remove', function(imageInput) {
            // swal.fire("Image successfully removed!", "You clicked the button!", "warning");
        });
    }

    /*
    * This Function submit hidden inputs for create modal
    */
    var toggleModalCreate = function(_crud){
        KTApp.blockPage();
        setTimeout(function() {
            KTApp.unblockPage();
            $("#"+ _crud +"CreateFormID").append("<input name='_js_function_name' type='hidden' value='"+ _crud +"CreateModalJsFunction'>");
            $("#"+ _crud +"CreateModalID").modal("toggle");
        }, globalTimeOut);
    }

    /*
    * This Function submit hidden inputs for edit modal
    */
    var toggleModalEdit = function(_crud, _form, _id_value){
        $(_form).submit(function(e) {
            $(this).append("<input name='_js_function_name' type='hidden' value='"+ _crud +"EditModalJsFunction'>");
            $(this).append("<input name='_"+ _crud +"_id' type='hidden' value='"+ _id_value +"'>");
        });
        setTimeout(function() {
            KTApp.unblockPage();
            $("#"+ _crud +"EditModalID").modal("toggle");
        }, globalTimeOut);
    }

    /*
    * This Function for fire error message
    */
    var errorMessage = function(text){
        swal.fire({ title: "{{ __('main.error') }}", icon: "error", text: text, timer: globalTimeOut, showCancelButton: false, showConfirmButton: false})
    }

    $(document).ready(function(){
        /*
        * init tooltip
        */
        $("html, body").tooltip({ selector: "[data-tooltip='kt-tooltip']" });

        /*
        * init select 2
        */
        if ($(".select-2").length) { $(".select-2").select2({ width: "100%" }); }

        /*
        *add ui-block-loading
        */
        $(document).on("submit", function(e){
            KTApp.blockPage({
                overlayColor: "red",
                opacity: 0.1,
                state: "primary",
                message: "{{ __('main.processing') }}"
            });
        });

    });
</script>
