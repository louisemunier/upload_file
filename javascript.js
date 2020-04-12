$(document).ready(function() {
console.log("pop");
    var allowedTypes = ['png', 'jpeg', 'jpg', 'gif'];
        fileInput = $('#file'),
        prev = document.querySelector('#prev');
        // prev = $('#prev');

    fileInput.on('change', function() {
        var files = this.files,
            filesLength = files.length,
            imgType;
            $('#error-msg').hide();

            for (var i = 0; i < filesLength; i++) {
                imgType = files[i].name.split('.');
                imgType = imgType[imgType.length - 1].toLowerCase();

                if(allowedTypes.indexOf(imgType) != -1) {
                    createThumbnail(files[i]);
                    if(files[0]['size'] > 1048576){
                        var errorMsg = 'This image must be less than 1MB';
                        $('#error-msg').text(errorMsg);
                        $('#error-msg').css('color', 'red');
                        $('#error-msg').show();
                    }
                }
            }
    });

    function createThumbnail(file) {
        var reader = new FileReader();
        reader.addEventListener('load', function(){
            var imgElement = document.createElement('img');
            imgElement.style.maxWidth = '150px';
            imgElement.style.maxHeight = '150px';
            imgElement.style.margin = '3px';
            imgElement.src = this.result;
            prev.appendChild(imgElement);
        });
        reader.readAsDataURL(file);
    }

    $('[data-dlfiles]').on('change', function() {
        alert('Success : Your image has been saved !')
    });

    function removeFile(file) {
        remove(file);
    }

    // $('.alert').alert();

});
