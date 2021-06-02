<script>
    $(document).ready(function(){
        $.ajaxSetup({ cache: false });

        var DT_EN_Trans = {
            processing: "<i class='fa fa-spinner fa-spin fa-3x fa-fw'></i><span class='sr-only'>Loading...</span> ",
        };
        if($("html").attr("lang") == "ar"){
            var DT_AR_Trans = {
                lengthMenu: "عرض _MENU_ بالصحفة والواحدة",
                zeroRecords: "لا يوجد نتائج",
                info: "عرض الصحفة _PAGE_ من _PAGES_",
                infoEmpty: "لا توجد سجلات متاحة",
                search: 'بحث',
            }
        }
        var DT_Translations = {
            ...DT_EN_Trans,
            ...DT_AR_Trans
        };
        window.DT_Options = {
            responsive: true,
            processing: true,
            bInfo: false,
            paging: false,
            bSort: false,
            bFilter: false,
            aaSorting: [],
            language: DT_Translations,
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            columnDefs: [
                { orderable: false, targets: 0, },
                { orderable: false, targets: -1 },
            ],
            buttons: [
                "print",
                "copyHtml5",
                "excelHtml5",
                "csvHtml5",
                "pdfHtml5",
            ],
        };
        $("table").DataTable(DT_Options);
        dataTableSortable("table tbody");

        /*
        * search inputs
        */
        $(document).on("change", ".search_input", function(e){
            var _this             = $("#"+$(this).attr("id")),
                _component_id     = _this.parents('.component_container').data("component-id"),
                _table_id         = _this.parents('.component_container').data("table-id"),
                _search_form_id   = _this.parents('.component_container').data("search-form-id"),
                _form_with_params = $(_search_form_id).serialize(),
                _crud_name        = (_search_form_id.split("-"))[0].split("#")[1];
            $(_search_form_id).ajaxSubmit({
                beforeSend: function(xhr){
                    KTApp.blockPage();
                },
                success: function(res){
                    $(_table_id).DataTable().destroy();
                    $(_component_id).replaceWith(res);
                    $(_table_id).DataTable(DT_Options).draw();
                    dataTableSortable(_table_id + " tbody");
                },
                complete: function(res){
                    setTimeout(function() {
                        $(_component_id).find("select").trigger("click");
                        window.history.pushState($(_search_form_id).serialize(), 'search', '/admin/'+ _crud_name +'?'+_form_with_params);
                        KTApp.unblockPage();
                    }, globalTimeOut);
                },
            });
        });

        /*
        * clear search inputs
        */
        $(document).on("click", ".search_clear_form_inputs", function(e){
            var _this     = $(this),
                _table_id = _this.parents('.component_container').data("table-id"),
                _form_id  = _this.parents('.component_container').data("search-form-id");
            $(_form_id).find("input, select").val("");
            $(_form_id).find("input:first").val("").trigger("change");
        });

        /*
        * ajax pagination for tables
        */
        $(document).on("click", ".pagination a", function(e){
            e.preventDefault();
            var _component_id   = $(this).parents('.component_container').data("component-id"),
                _table_id       = $(this).parents('.component_container').data("table-id"),
                _search_form_id = $(this).parents('.component_container').data("search-form-id"),
                _limit          = $(_component_id).find(".perPage").val(),
                _route          = $(this).attr("href");
            $.ajax({
                url: _route,
                beforeSend: function(xhr){
                    KTApp.blockPage();
                },
                success: function(res){
                    $(_table_id).DataTable().destroy();
                    $(_component_id).replaceWith(res);
                    $(_table_id).DataTable(DT_Options).draw();
                    dataTableSortable(_table_id + " tbody");
                },
                complete: function(res){
                    setTimeout(function() {
                        $(_component_id).find("select").trigger("click");
                        KTApp.unblockPage();
                    }, globalTimeOut);
                },
            });
        });


        /*
        * This Button to change the statu of entity
        */
        $(document).on("click", ".status_btn", function(){
            console.clear();
            KTApp.blockPage();
            var
                _permission = $(this).data("permission"),
                _role       = $(this).data("role"),
                _id         = $(this).attr("data-modal-id"),
                route       = $(this).attr("data-route");
            if(_id !== null && _id !== "" && route !== null && route !== ""){
                var _btn = $(this);
                $.get({
                    url: route,
                    beforeSend: function () { $(this).css("pointer-events","none") },
                    complete: function(){ $(this).css("pointer-events","auto") },
                    success: function(res, xhr){
                        if (_permission || _role) {
                            if(xhr == "success"){
                                if(res.payload.case == "active"){
                                    _btn.html("<i class='fa fa-toggle-on fa-1x fa-fw'></i>");
                                }else if(res.payload.case == "deactivate"){
                                    _btn.html("<i class='fa fa-toggle-off fa-1x fa-fw'></i>");
                                }
                                KTApp.unblockPage();
                                swal.fire({ title: res.payload.case, icon: "success", text: res.payload.message, timer: globalTimeOut, showCancelButton: false, showConfirmButton: false})
                            }else{
                                errorMessage(res.payload);
                            }
                        }else{
                            swal.fire("{{ __('main.no_role_or_permission_for_this_action') }}");
                            setTimeout(function() { location.reload(); }, globalTimeOut);
                        }
                    },
                    error: function(res){
                        errorMessage(res);
                    }
                })
            }
        });

        /*
        * This Button to delete modal of entity
        */
        $(document).on("click", ".delete_btn", function(){
            console.clear();
            var _permission = $(this).data("permission"),
            _role       = $(this).data("role"),
            _message    = $(this).data("message"),
            _route      = $(this).data("route");
            swal.fire({
                title: "{{ __('main.are_you_sure_you_want_to_delete_this_record') }}",
                text: _message,
                icon: "warning",
                confirmButtonText: "{{ __('main.yes') }}",
                cancelButtonText: "{{ __('main.no') }}",
                showCancelButton: true,
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    if (_permission || _role) {
                        var form = $("<form>", { "method": "POST", "action": _route}),
                        hiddenInput = $("<input>", { "name": "_method","type": "hidden","value": "DELETE"}),
                        hiddenToken = $("<input>", { "name": "_token", "type": "hidden", "value": jQuery("meta[name='csrf-token']").attr("content")});
                        form.append(hiddenInput).append(hiddenToken).appendTo("body").submit();
                    }else{
                        swal.fire("{{ __('main.no_role_or_permission_for_this_action') }}");
                        setTimeout(function() { location.reload(); }, globalTimeOut);
                    }
                }
            });
        });

        /*
        * This Button to restore modal of entity
        */
        $(document).on("click", ".restore_btn", function(){
            console.clear();
            var _permission = $(this).data("permission"),
            _role       = $(this).data("role"),
            _message    = $(this).data("message"),
            _route      = $(this).data("route");
            swal.fire({
                title: "{{ __('main.are_you_sure_you_want_to_restore_this_record') }}",
                text: _message,
                icon: "warning",
                confirmButtonText: "{{ __('main.yes') }}",
                cancelButtonText: "{{ __('main.no') }}",
                showCancelButton: true,
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    if (_permission || _role) {
                        var form = $("<form>", { "method": "POST", "action": _route}),
                        hiddenInput = $("<input>", { "name": "_method","type": "hidden","value": "post"}),
                        hiddenToken = $("<input>", { "name": "_token", "type": "hidden", "value": jQuery("meta[name='csrf-token']").attr("content")});
                        form.append(hiddenInput).append(hiddenToken).appendTo("body").submit();
                    }else{
                        swal.fire("{{ __('main.no_role_or_permission_for_this_action') }}");
                        setTimeout(function() { location.reload(); }, globalTimeOut);
                    }
                }
            });
        });

        /*
        * This Button to destory modal of entity
        */
        $(document).on("click", ".destory_btn", function(){
            console.clear();
            var _permission = $(this).data("permission"),
            _role       = $(this).data("role"),
            _message    = $(this).data("message"),
            _route      = $(this).data("route");
            swal.fire({
                title: "{{ __('main.are_you_sure_you_want_to_destory_this_record') }}",
                text: _message,
                icon: "warning",
                confirmButtonText: "{{ __('main.yes') }}",
                cancelButtonText: "{{ __('main.no') }}",
                showCancelButton: true,
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    if (_permission || _role) {
                        var form = $("<form>", { "method": "POST", "action": _route}),
                        hiddenInput = $("<input>", { "name": "_method","type": "hidden","value": "DELETE"}),
                        hiddenToken = $("<input>", { "name": "_token", "type": "hidden", "value": jQuery("meta[name='csrf-token']").attr("content")});
                        form.append(hiddenInput).append(hiddenToken).appendTo("body").submit();
                    }else{
                        swal.fire("{{ __('main.no_role_or_permission_for_this_action') }}");
                        setTimeout(function() { location.reload(); }, globalTimeOut);
                    }
                }
            });
        });

        /*
        * This Button to select all rows at table
        */
        $(document).on("click", ".all_table_ids", function(e){
            if($(this).is(":checked")){
                $(this).parents("table").children("tbody").children("tr").children("th").children("label").children("input:checkbox").not(this).prop("checked", true);
            }else{
                $(this).parents("table").children("tbody").children("tr").children("th").children("label").children("input:checkbox").not(this).prop("checked", false);
            }
        });

        /*
        * multi delete for tables
        */
        $(document).on("click", ".multi_delete_table", function(e){
            var _component_id  = $(this).parents('.component_container').data("component-id");
            swal.fire({
                title: "{{ __('main.are_you_sure_you_want_to_delete_this_record') }}",
                icon: "warning",
                confirmButtonText: "{{ __('main.yes') }}",
                cancelButtonText: "{{ __('main.no') }}",
                showCancelButton: true,
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    var _form = $(_component_id+" .table_form");
                    _form.attr('action', _form.data('multi-delete'));
                    _form.submit();
                }
            });
        });

        /*
        * multi restore for tables
        */
        $(document).on("click", ".multi_restore_table", function(e){
            var _component_id  = $(this).parents('.component_container').data("component-id");
            swal.fire({
                title: "{{ __('main.are_you_sure_you_want_to_restore_this_record') }}",
                icon: "warning",
                confirmButtonText: "{{ __('main.yes') }}",
                cancelButtonText: "{{ __('main.no') }}",
                showCancelButton: true,
                reverseButtons: true
            })
            .then((result) => {
                if (result.value) {
                    var _form = $(_component_id+" .table_form");
                    _form.attr('action', _form.data('multi-restore'));
                    _form.submit();
                }
            });
        });

    });

    var dataTableSortable = function(_table_id) {
        return;
        $(_table_id).sortable({
            items: "tr",
            cursor: "move",
            placeholder: "ui-state-highlight",
            opacity: 0.6,
            update: function() {
                var order = [];
                $(this).children("tr").each(function(i,el) {
                    if($(this).attr("data-id") > 0 ){
                        order.push({
                            id: $(this).attr("data-id"),
                            position: i + 1
                        });
                    }
                });

                $.post({
                    dataType: "json",
                    url: $(this).children("tr").parent("tbody").data("order-route"),
                    data: {
                        order: order,
                        _token: $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function(xhr){
                        KTApp.blockPage();
                    },
                    success: function(res){
                        console.log(res.payload.data);
                    },
                    complete: function(res){
                        setTimeout(function() {
                            KTApp.unblockPage();
                        }, globalTimeOut);
                    },
                });
            }
        });
    }

</script>
