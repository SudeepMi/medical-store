
$(function() {

    // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("h1").text("Drag here");
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Upload");
        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();
        fd.append('file', file[0]);
        $("#uploadfile h1").remove();
        $("#uploadfile label").remove();
        $("#uploadfile").html('<div id="thumbnail" class="thumbnail"></div>');
        $("#thumbnail").html('<img src="" width="150px" height="170px" id="thumbs">');


        var reader = new FileReader();
        reader.onload = function (e) {
            $('#thumbs')
                .attr('src', e.target.result)
                .width(150)
                .height(170);
        };

        reader.readAsDataURL(file[0]);
    });

    // Open file selector on div click
    $("#uploadfile").click(function(e){
        e.preventDefault();
     var obj = $(".files");
     obj.click();
    });

    // file selected
    $(".files").change(function(){
        var fd = new FormData();

        var files = $('.files')[0].files[0];

        fd.append('file',files);

        addThumbnail(fd);
    });
});

// Sending AJAX request and upload file
function uploadData(formdata){
    $.ajax({
        url: '/menu/item/pics',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,

    }).done(function(response){
        console.log(response)
            addThumbnail(response);
        });
}

// Added thumbnail
function addThumbnail(data){

    $("#uploadfile h1").remove();
    $("#uploadfile label").remove();
    var len = $("#uploadfile div.thumbnail").length;

    var num = Number(len);
    num = num + 1;

    var size = convertSize(data.size);
    var src = data.src;
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#thumbs')
            .attr('src', e.target.result)
            .width(150)
            .height(170);
    };

    reader.readAsDataURL( $('.files')[0].files[0]);
    // Creating an thumbnail
    $("#uploadfile").html('<div id="thumbnail" class="thumbnail"></div>');
    $("#thumbnail").html('<img src="" width="150px" height="170px" id="thumbs">');

}

// Bytes conversion
function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
