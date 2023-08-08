@extends('includes.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped ">

            <thead>
                <tr>
                    <th>id</th>

                    <th>title</th>
                    <th>summery</th>
                    <th>action</th>

                </tr>
            </thead>
            <tbody>

                @foreach($blogs as $blog)
                <tr>
                    <td>
                        {{$blog->id}}
                    </td>
                    <td>
                        {{$blog->title}}
                    </td>
                    <td>
                        {{$blog->summery}}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{url('blog_update',$blog->id)}}">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </a>

                        <a class="btn btn-danger" onclick="delete_blog('{{$blog->id}}')" href="{{url('blog_update',$blog->id)}}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        {{ $blogs->links('pagination::bootstrap-4') }}
    </div>
</div>
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
            url: '/add_blog',
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
    function delete_blog(id){
        $.ajax({
            type: 'POST',
            url: '/delete_blog',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            beforeSend: function() {},
            success: function(data) {
                $(".validationMessage").remove();
                if (data.status == "errors") {

                    $.each(data.error, function(key, val) {

                        $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');
                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, data.title, {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    window.location.href = '/blog_list';
                }
                if (data.status == "false") {
                    toastr.error(data.message, 'ERROR', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    window.location.href = '/blog_list';

                }
            }
        });
    }
</script>
@stop