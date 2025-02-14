tinymce.init({
    selector: '#mytext',
    height: 300,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor ',
      'pagebreak searchreplace wordcount visualblocks visualchars ',
      'code fullscreen insertdatetime media nonbreaking save table ',
      'contextmenu directionality emoticons template paste textcolor ',
      'colorpicker textpattern imagetools'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic | ' +
    'alignleft aligncenter alignright alignjustify | ' + 
    'bullist numlist outdent indent | link image',
    menubar: false
});