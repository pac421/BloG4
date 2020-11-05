$(document).ready(function(){
    console.log('article_content : ', article_content);
    console.log('article_lst_categories : ', article_lst_categories);

    if(article_lst_categories.length > 0){
        $.each(article_lst_categories, function(i, v){
            $('#checkbox-newFiche-category-'+v).attr('checked','checked');
        });
    }
});

tinymce.init({
    selector: 'textarea#tinymce',
    placeholder: "Contenu de l'article",
    branding: false,
    elementpath: false,
    height: '90%',
    menubar: false,
    resize: false,
    statusbar: false,
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    toolbar_mode: 'sliding',
    contextmenu: 'link table',
    setup: function (editor) {
        editor.on('init', function (e) {
            editor.setContent(article_content);
        });
    }
});

var dz = $("div#picture_upload").dropzone({
    url: "#",
    thumbnailWidth: $("div#picture_upload").width(),
    thumbnailHeight: $("div#picture_upload").height(),
    maxFiles: 1,
    previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><img data-dz-thumbnail /></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div>',
    init: function() {
        this.on("addedfile", function() {
            $('#default_picture_upload_message').css('display', 'none');
            $('#btn_picture_upload_suppr').removeClass('invisible');
        });
    }
});

$('#btn_picture_upload_suppr').click(function(){
    console.log('evt btn_picture_upload_suppr click start');

    dz[0].dropzone.removeAllFiles(true);
    $('#btn_picture_upload_suppr').addClass('invisible');
    $('#default_picture_upload_message').css('display', 'unset');
})
