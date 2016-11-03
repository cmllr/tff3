function str_replace(string, search, replace) {
    return string.split(search)
            .join(replace);
}


function use_this(my_obj) {
    var dd = 0;
    dd = document.getElementById('tags');
    dd.value = str_replace(dd.value, my_obj.value + ',', '');
    if (my_obj.checked) {
        dd.value += my_obj.value + ',';
    } else {
        dd.value = str_replace(dd.value, my_obj.value + ',', '');
    }
}


function doconfirm(message) {
    return confirm(message);
}


function youtube_parser() {
    url = document.getElementById('yt')
            .value;
    var regExp =
            /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match && match[7].length == 11) {
        b1.src = 'http://img.youtube.com/vi/' + match[7] + '/0.jpg';
        b2.src = 'http://img.youtube.com/vi/' + match[7] + '/1.jpg';
        b3.src = 'http://img.youtube.com/vi/' + match[7] + '/2.jpg';
        b4.src = 'http://img.youtube.com/vi/' + match[7] + '/3.jpg';
        b5.src = 'http://img.youtube.com/vi/' + match[7] + '/hqdefault.jpg';
        b6.src = 'http://img.youtube.com/vi/' + match[7] + '/mqdefault.jpg';
        b7.src = 'http://img.youtube.com/vi/' + match[7] +
                '/maxresdefault.jpg';
    }
}

function blurit() {
    document.getElementById('yt')
            .blur();
}

function grabit() {
    setTimeout("blurit()", 1000);
}

function uns_new() {
    dd = document.getElementById('folder_new');
    dd.value = '';
}

function open_filer() {
    file_manager = document.getElementById('filer_dialog');
    file_manager.style.display = 'block';
    while (file_manager.firstChild) {
        file_manager.removeChild(file_manager.firstChild);
    }
    file_iframe = document.createElement('iframe');
    file_iframe.src = WEBROOT + 'admin/filer';
    file_iframe.width = '100%';
    file_iframe.height = '100%';
    file_manager.appendChild(file_iframe);
    return false;
}
var mouseX;
var mouseY;
$(document)
        .ready(function () {
            $('.preview')
                    .hover(function () {
                        $('#show_preview img')
                                .attr('src', $(this)
                                        .attr('data-src'));
                        $('#show_preview')
                                .show(20);
                        $(document)
                                .mousemove(function (e) {
                                    mouseX = e.pageX - 250;
                                    mouseY = e.pageY - 350;
                                    $('#show_preview')
                                            .css({
                                                'top': mouseY,
                                                'left': mouseX
                                            });
                                });
                    }, function () {
                        $('#show_preview img')
                                .attr('src', '#');
                        $('#show_preview')
                                .hide(20);
                    });
            $('.close_file_dialog')
                    .click(function () {
                        $('#file_dialog')
                                .hide();
                    });
            $('.file_dialog')
                    .click(function () {
                        linkimg = $(this)
                                .children('img')
                                .attr('data-src-2');
                        filename = $(this)
                                .children('img')
                                .attr('alt');
                        r = $(this)
                                .attr('data-src');
                        load_file_info(filename, linkimg, r);
                    });
            ;
        });

function load_file_info(filename, linkimg, delete_info) {
    $('#h_file_name').html(filename);
    $('#file_preview').attr('src', WEBROOT + MEDIADIR + filename);
    $('#file_dialog').show('slow');
    $('#file_filename').val(WEBROOT + MEDIADIR + filename);
    $('#file_delete').attr('href', WEBROOT + 'admin/filer/delete/' + delete_info);
    $('#usage_file').load(WEBROOT + 'admin/filer/usage/' + delete_info);
}



function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById("thumbnil");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}