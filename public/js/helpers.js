let newsTask = (() => {


    function makeRequest(url, method, headers, data, success, error) {

        return $.ajax({

            headers: headers,
            url: url,
            method: method,
            dataType: 'json',
            contentType: 'application/json; charset=utf-8;',
            data: (data),
            success: success,
            error: error,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                //Download progress
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        progressElem.html(Math.round(percentComplete * 100) + "%");
                    }
                }, false);
                return xhr;
            }
        });
    }


    function loadImage(buttonId, previewId) {
        let image = '';
        $("#" + buttonId).change(function () {

            let input = this;

            if (input.files && input.files[0]) {

                let reader = new FileReader();

                reader.onload = function (e) {
                    $("#" + previewId).attr('src', e.target.result);
                };

                if (input.files[0].size < 2480000) {

                    if ((input.files[0].type == 'image/jpeg' || input.files[0].type == 'image/gif' || input.files[0].type == 'image/png')) {

                        reader.readAsDataURL(input.files[0]);
                        image = $("#" + previewId);
                        $('#fileMessage').html('<b>Име: </b>' + input.files[0].name)

                    } else {

                        $('#fileMessage').html('<b><span style="color: orangered">Можеш да качваш само изображения във формат: png, jpg, gif</span> </b>');
                    }

                } else {

                    $("#" + buttonId).val('');

                    $('#fileMessage').html('<b><span style="color: orangered">Изображението не трябва да надхвърля 2Mb</span> </b>');
                }
            }
        });
    }

    function imageResizer(canvas, img, inWidth, inHeight) {

        let MAX_WIDTH = inWidth;
        let MAX_HEIGHT = inHeight;


        let width = img.width;
        let height = img.height;


        if (width > height) {
            if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }

        canvas.width = width;
        canvas.height = height;

        //If you want to save the proportion of image just comment section below
        width = 500;
        height = 500;
        canvas.width = 500;
        canvas.height = 500;

        let ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);
    }

    function notification(type, text) {

        let n = noty({

            text: text,
            type: type,
            dismissQueue: false,
            layout: 'topCenter',
            theme: 'defaultTheme',
            timeout  : 2000,
            animation: {
                open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
        });

        return n;
    }

    function checkForNotification(){

        let url = location.href;

        if(url.indexOf('success')>0){

            let message = url.split('=')[1] || "Успена заявка";
            let escapedMessage = unescape(decodeURIComponent(message));
            escapedMessage = escapedMessage.replace(/\+/g,' ');
            notification('success',escapedMessage);

        }else if(url.indexOf('error') > 0){

            let message = url.split('=')[1] || "Неуспешна заявка";
            let escapedMessage = unescape(decodeURIComponent(message));
            escapedMessage = escapedMessage.replace(/\+/g,' ');
            notification('error',escapedMessage);
        }
    }

    return {
        makeRequest: makeRequest,
        loadImage: loadImage,
        imageResizer: imageResizer,
        checkForNotification: checkForNotification
    }
})();
