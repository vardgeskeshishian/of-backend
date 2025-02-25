<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize TinyMCE for each textarea dynamically based on its ID
        let editors = document.querySelectorAll('.editor-block textarea[name^="blocks"][name$="[content]"]');

        editors.forEach(function (editor) {
            tinymce.init({
                selector: `textarea[name="${editor.name}"]`,
                license_key: 'gpl',
                setup: function (editorInstance) {
                    editorInstance.on('change', function () {
                        editorInstance.save();
                    });
                }
            });
        });
    });
</script>
