<script>
    $(document).ready(function () {
        var _options = {
            modules: {
                toolbar: [
                    [
                        {
                            'header': [1, 2, 3, 4, 5, false]
                        }
                    ],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [
                        {
                            'header': 1
                        },
                        {
                            'header': 2
                        }
                    ],
                    [
                        {
                            'list': 'ordered'
                        },
                        {
                            'list': 'bullet'
                        }
                    ],
                    [
                        {
                            'script': 'sub'
                        },
                        {
                            'script': 'super'
                        }
                    ],
                    [
                        {
                            'indent': '-1'
                        },
                        {
                            'indent': '+1'
                        }
                    ],
                ],
            },
            placeholder: 'Words can be like x-rays if you use them properly...',
            theme: 'snow'
        };

        let _langs = ["en", "ar"];
        let _quill_array = [];
        let _grouped_cruds_name = [ "category", "type", "brand", "product", "page", "gallery", "blog", "slider",];
        let _grouped_cruds = [];
        let _ungrouped_cruds = [];
        _grouped_cruds_name.forEach(row => {
            _langs.forEach(lang => {
                _grouped_cruds.push({
                    "editor_id": `${row}_create_description_${lang}`,
                    "form_id": `#${row}CreateFormID`,
                });
                _grouped_cruds.push({
                    "editor_id": `${row}_edit_description_${lang}`,
                    "form_id": `#${row}EditFormID`,
                });
            });
        });
        _ungrouped_cruds = [
            {
                "editor_id": "about_us_description_en",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "about_us_description_ar",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "contact_us_description_en",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "contact_us_description_ar",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "service_description_en",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "service_description_ar",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "branch_description_en",
                "form_id": "#setting-form",
            },
            {
                "editor_id": "branch_description_ar",
                "form_id": "#setting-form",
            },
        ];
        var initEditor = function(_formID, _editorID){
            if ($(`#${_editorID}`).length) {
                new Quill(`#${_editorID}`, _options);
                $(_formID).submit(function (e) {
                    $(this).append( "<textarea name='" + _editorID + "' style='display:none'>" + document.querySelector(`#${_editorID}`).children[0].innerHTML + "</textarea>" );
                });
            }
        }

        _quill_array = _grouped_cruds.concat(_ungrouped_cruds);
        for (let i = 0; i < _quill_array.length; i++) {
            initEditor(_quill_array[i].form_id, _quill_array[i].editor_id);
        }

    });

</script>
