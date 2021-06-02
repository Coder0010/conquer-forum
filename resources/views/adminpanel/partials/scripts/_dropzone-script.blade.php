<script>
    /*
    * init create Drop zone
    */
    var initCreateDropzone = function(_formID, _dropzoneID, _other_media_name = "other_media[]", _other_media_original_name="other_media_original_name[]", _destory = true){
        window.uploaded_image ='';
        if(_destory == true){
            $(".dropzone").each(function () {
                let dz = $(this)[0].dropzone;
                if (dz) {
                    dz.destroy();
                }
            });
        }
        $(_dropzoneID).dropzone({
            url: "{{ route('api.media.store') }}",
            maxFilesize: 10,
            maxFiles: 10,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            error: function(file, res) {
                $(file.previewElement).addClass("dz-error").find(".dz-error-message").text(res.message);
            },
            thumbnail: function(file, thumb){
                file.xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $(file.previewElement).find(".dz-image:first").css({"background-size": "cover", "background-image": 'url(' + thumb + ')', });
                        var uploaded_image = JSON.parse(this.responseText);
                        $(file.previewElement).append(
                            '<div id="' + uploaded_image.name + '">' +
                                '<input type="hidden" name="'+ _other_media_name +'" value="' + uploaded_image.name + '">' +
                                '<input type="hidden" name="'+ _other_media_original_name +'" value="' + uploaded_image.original_name + '">' +
                            '</div>'
                        );
                    }
                };
            },
            removedfile: function (file) {
                file.previewElement.remove();
                if (typeof file.file_name !== "undefined") $(_formID).find('div[id="' + file.file_name + '"]').remove();
            },
            init: function() {

            }
        });
        $(_dropzoneID).sortable({
            items:'.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: _dropzoneID,
            distance: 20,
            tolerance: 'pointer'
        });
    }

    /*
    * init edit Drop zone
    */
    var initEditDropzone = function(_formID, _dropzoneID, _editingMedia = [], _other_media_name = "edit_other_media[]", _other_media_original_name="edit_other_media_original_name[]", _destory = true){
        if(_destory == true){
            $(".dropzone").each(function () {
                let dz = $(this)[0].dropzone;
                if (dz) {
                    dz.destroy();
                }
            });
        }
        $(_dropzoneID).dropzone({
            url: "{{ route('api.media.store') }}",
            maxFilesize: 10,
            maxFiles: 10,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            success: function (file, res) {
                $(_formID).append(
                    '<div id="' + res.name + '">' +
                        '<input type="hidden" name="'+ _other_media_name +'" value="' + res.name + '">' +
                        '<input type="hidden" name="'+ _other_media_original_name +'" value="' + res.original_name + '">' +
                    '</div>'
                );
            },
            error: function(file, res) {
                $(file.previewElement).addClass("dz-error").find(".dz-error-message").text(res.message);
            },
            thumbnail: function(file, thumb){
                $(file.previewElement).find(".dz-image:first").css({"background-size": "cover", "background-image": 'url(' + thumb + ')', });
            },
            removedfile: function (file) {
                file.previewElement.remove();
                if (typeof file.file_name !== "undefined") $(_formID).find('div[id="' + file.file_name + '"]').remove();
            },
            init: function () {
                let dz = document.getElementById(_dropzoneID.replace("#", "")).dropzone;
                if(_editingMedia.length > 0){
                    dz.previewsContainer.innerHTML = "";
                    _editingMedia.forEach(function(media){
                        dz.options.addedfile.call(dz, media);
                        media.previewElement.classList.add("dz-complete");
                        $(media.previewElement).append(
                            '<div id="' + media.file_name + '">' +
                                '<input type="hidden" name="'+ _other_media_name +'" value="' + media.file_name + '">' +
                                '<input type="hidden" name="'+ _other_media_original_name +'" value="' + media.name + '">' +
                            '</div>'
                        );
                        dz.emit("thumbnail", media, "{{ route('api.media.show', ['mediaItem' => 'replaceMe', 'size' => 'avatar']) }}".replace('replaceMe', media.id));
                    });
                }else{
                    dz.previewsContainer.innerHTML = "<div class='dz-message'> <h2> {{ __('main.other_images') }} </h2> <div class='icon'><span class='fas fa-cloud-upload-alt fa-5x fa-fw'></span></div> </div>";
                }
            }
        });
        $(_dropzoneID).sortable({
            items:'.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: _dropzoneID,
            distance: 20,
            tolerance: 'pointer'
        });
    }

</script>
