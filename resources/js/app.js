require('./bootstrap');

require('tinymce/themes/silver');
import tinymce from 'tinymce';
require('tinymce/plugins/image');
require('tinymce/plugins/code');

tinymce.init({

    selector: 'textarea#inputContent',
    plugins:'code image',
    skin:false,
    content_css:false,
    image_title:true,
    images_upload_handler: function (blobInfo, success, failure) {
        let formData = new FormData();
        formData.append('file', blobInfo.blob());
        axios.post('/admin/upload', formData)
            .then(function(res){
                success(res.data.location);
            });
    }

});
