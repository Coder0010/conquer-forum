<script>
    /*
    * This Function for append incoming ajax data from api to select option html tag
        - first i called this method by onClick jq method then provide current instance of this tag by using (this).
    */
    var selectAjaxCall = function(_selectTag){
        var _this          = $("#"+_selectTag.id),
            _parent_val    = _this.val(),
            _parent_route  = _this.data("route"),
            _child_id      = _this.data("child-id"),
            _child_value   = _this.data("child-value"),
            _child_content = "<option value=''>----</option>";
        if(_parent_val !== null && _parent_val !== ""){
            $.get({
                url:  _parent_route,
                data: {id:_parent_val},
                success: function(res, xhr){
                    $(_child_id).parent().show();
                    if(res.payload.length > 0){
                        $.each(res.payload, function(key, value){
                            // $("#nationality").append(new Option(value, value))
                            _child_content = _child_content.concat("<option value='"+value.id+"'>"+value.id +' -- '+ value.text+"</option>");
                        });
                        $(_child_id).html(_child_content);
                        if(_child_value !== null && _child_value !== ""){
                            $(_child_id).val(_child_value).trigger("change");
                        }
                    }else{
                        $(_child_id).parent().hide();
                    }
                },
            });
        }
    }
</script>
