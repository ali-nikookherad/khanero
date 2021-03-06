$(document).ready(function(e){
    tinymce.init({
        selector: '#editor',
        height: '200px',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen  ',
            'insertdatetime media nonbreaking save table contextmenu directionality' ,
            'template paste textcolor colorpicker textpattern  codesample toc help emoticons hr'
        ],
        toolbar1: 'newdocument | print preview searchreplace | spellchecker a11ycheck | undo redo | insert | bullist numlist outdent indent |   visualblocks advcode fullscreen help',
        toolbar2: 'styleselect | fontselect | fontsizeselect | bold italic underline  | alignleft aligncenter alignright alignjustify | forecolor backcolor | removeformat',
        // enable title field in the Image dialog
        image_title: true,
        // enable automatic uploads of images represented by blob or data URIs
        automatic_uploads: true,
        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
        // images_upload_url: 'postAcceptor.php',
        // here we add custom filepicker only to Image dialog
        file_picker_types: 'image',
        // and here's our custom image picker
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            // Note: In modern browsers input[type="file"] is functional without
            // even adding it to the DOM, but that might not be the case in some older
            // or quirky browsers like IE, so you might want to add it to the DOM
            // just in case, and visually hide it. And do not forget do remove it
            // once you do not need it anymore.

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    // Note: Now we need to register the blob in TinyMCEs image blob
                    // registry. In the next release this part hopefully won't be
                    // necessary, as we are looking to handle it internally.
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        }
    });

    tinymce.init({
        selector: '#editor_user',
        height: '200px',
        plugins: [
            'advlist autolink  link  charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen  ',
            'insertdatetime  nonbreaking save table contextmenu directionality' ,
            'template paste textcolor colorpicker textpattern  codesample toc help emoticons hr'
        ],
        toolbar1: 'newdocument | print preview searchreplace | spellchecker a11ycheck | undo redo  | bullist numlist outdent indent |   visualblocks advcode fullscreen help',
        toolbar2: 'styleselect | fontselect | fontsizeselect | bold italic underline  | alignleft aligncenter alignright alignjustify | forecolor backcolor | removeformat',
    });


    tinymce.init({
        selector: '#editor_en',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen  ',
            'insertdatetime media nonbreaking save table contextmenu directionality' ,
            'template paste textcolor colorpicker textpattern  codesample toc help emoticons hr'
        ],
        toolbar1: 'newdocument | print preview searchreplace | spellchecker a11ycheck | undo redo | insert | bullist numlist outdent indent |   visualblocks advcode fullscreen help',
        toolbar2: 'styleselect | fontselect | fontsizeselect | bold italic underline  | alignleft aligncenter alignright alignjustify | forecolor backcolor | removeformat',
        // enable title field in the Image dialog
        image_title: true,
        // enable automatic uploads of images represented by blob or data URIs
        automatic_uploads: true,
        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
        // images_upload_url: 'postAcceptor.php',
        // here we add custom filepicker only to Image dialog
        file_picker_types: 'image',
        // and here's our custom image picker
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            // Note: In modern browsers input[type="file"] is functional without
            // even adding it to the DOM, but that might not be the case in some older
            // or quirky browsers like IE, so you might want to add it to the DOM
            // just in case, and visually hide it. And do not forget do remove it
            // once you do not need it anymore.

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    // Note: Now we need to register the blob in TinyMCEs image blob
                    // registry. In the next release this part hopefully won't be
                    // necessary, as we are looking to handle it internally.
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        }
    });
});