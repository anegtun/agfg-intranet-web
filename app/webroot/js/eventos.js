$(document).ready(function() {

    let editor;
    ClassicEditor
        .create(document.querySelector('#observacions'), { toolbar: [ 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'link', 'mediaEmbed' ] })
        .then(newEditor => editor = newEditor)
        .catch(error => console.error(error));

});