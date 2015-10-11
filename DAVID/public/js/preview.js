//Defining the auto complete variable
 var acomplete = [];
$.getJSON('acomplete.json', function(data) {
    acomplete = data;
    console.log(acomplete);
    $(".acomplete").autocomplete({
       source: acomplete
    })
});

//Making the form a html object
var form = $('.hidden').html();

//DropZone plugin setup
Dropzone.autoDiscover = false;
$("#dropzone").dropzone({ 
    url: "uploads.php",
    addRemoveLinks: true,
    maxFileSize: 100,
    acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
    thumbnailWidth: 250,
    thumbnailHeight: 250,
    dictResponseError: "Ha ocurrido un error en el servidor",
    dictCancelUpload: "cancelar",
    drop: function () {
        $('.dz-message').remove();
    },
    complete: function (file) {
        if (file.status == "success") {
            console.log('El archivo se ha subido correctamente');
            $(".dz-success-mark").html(form);
            // $('.dz-error-mark').hide();
            $(".acomplete").autocomplete({
               source: acomplete
            });

            //Save function
            $('.submit').click(function () {
                var p = $(this).parent('.upload'); //Selecting button father
                var t = p.find('.titulo').val();  //geting title value
                var u = p.find('.users').children('p'); //selecting p tags
                var uval = u.text().split("X");  //geting the p values and making an array from it
                console.log(t, u.length, uval);
                $.ajax({
                    type: 'POST',
                    url: '../includes/upload-query.php',
                    data: "text="+t+"&users="+uval,
                    success: function(response) {
                        if (response == "true") {
                            p.children().remove();
                            p.html('Informacion enviada con exito');

                        };
                    }
                });
            });
            //Auto complete setup
            $('.acomplete').keypress(function (e) {
                if (e.keyCode == 13) {
                    e.preventDeault;
                    var users = $(this).val();
                    $(this).parent('.users').append('<p>'+users+'<button class="remove" type="button">X</button></p>').fadeIn(300);
                    $('.acomplete').val('');
                    $('.remove').click(function () {
                        $(this).parent('p').remove();
                    });
                };
            })
        };
    },
    error: function (file){ 
        alert('Error subiendo el arcchivo');
    },
    removedFile: function(file, serverFileName) {
        var name = file.name;
        $.ajax({
            type: 'POST',
            url: '..includes/uploads?remove=true',
            data: "filename="+name,
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == true) {
                    var element;
                    (element = filePreviewElement) != null ?
                    element.parentNode.removeChild(file.previewElement) : 
                    false;
                    alert('El elemento ' + name + ' fue eliminado con exito')
                };
            }
        });
    }

});