@extends('includes.default')
@section('content')
<form class="srvice_form" id="srvice_form">
    @csrf
    <input type="hidden" id="blog_id" name="blog_id" value="{{$blogs->id}}" >
    <div class="row">
       <div class="col-md-6 mt-2">
        <label>Cover Image *</label>
        <input type="file" class="form-control" id="cover" name="cover">

    </div>
    <div class="col-md-6 mt-2">
        <label>Title *</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$blogs->title}}">

    </div>

    <div class="col-md-6 mt-2">
        <label>Summery *</label>
        <textarea class="form-control" id="summery" name="summery">{{$blogs->summery}}</textarea>

    </div>

    <div class="col-md-12 mt-2">
        <label>Content *</label>
        <div class="form-group">
            <textarea id="vender_service" name="vender_service">{{$blogs->blog}} </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <input class="btn btn-success" value="Update" onclick="add_service()">
    </div>

    </div>
</form>
@stop
@section('script')
<script>
    var image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{{route("uploadstiny")}}');
        var token = '{{ csrf_token() }}';
        xhr.setRequestHeader("X-CSRF-Token", token);
        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({
                    message: 'HTTP Error: ' + xhr.status,
                    remove: true
                });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);

    });

    tinymce.init({

        setup(editor) {
            editor.on("keydown", function(e) {
                if ((e.keyCode == 8 || e.keyCode == 46) && tinymce.activeEditor.selection) {
                    var selectedNode = tinymce.activeEditor.selection.getNode();
                    if (selectedNode && selectedNode.nodeName == 'IMG') {
                        var imageSrc = selectedNode.src;


                        $.ajax({
                            type: 'POST',
                            url: '/remove_tiny_image',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "imageSrc": imageSrc,
                            },
                            success: function(data) {

                            }
                        });
                    }

                }
            });
        },

        automatic_uploads: false,
        selector: '#vender_service',
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount', 'image code'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | a11ycheck code table help | image code',
        images_upload_handler: image_upload_handler_callback
    });

    function add_service() {

        // tinymce.activeEditor.uploadImages();
        var form = document.getElementById('srvice_form');
        var formData = new FormData(form);
        var myContent = tinymce.activeEditor.getContent();

        formData.append('blog', myContent);



        $.ajax({
            type: 'POST',
            url: '/update_details',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == "errors") {
                    $(".validationMessage").remove();

                    $.each(data.error, function(key, val) {
                        // if($.isArray(val[0])){
                        if (typeof val[0] === 'object') {

                            $.each(val[0], function(key2, val2) {

                                $('.' + key2).after('<p class="validationMessage">' + val2 + '</p>');

                                toastr.error(val2, 'ERROR', {
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp",
                                    // timeOut: 2000
                                });

                            });
                        } else {
                            $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');
                            toastr.error(val[0], 'ERROR', {
                                "showMethod": "slideDown",
                                "hideMethod": "slideUp",
                                timeOut: 2000
                            });
                        }



                    });
                }
                if (data.status == "true") {
                    tinymce.activeEditor.uploadImages();
                    toastr.success(data.message, 'Success', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    // window.location.reload();
                }
                if (data.status == "false") {
                    toastr.error(data.message, 'ERROR', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                }
            }
        });

    }
</script>
@stop