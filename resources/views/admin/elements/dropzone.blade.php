<div id="my-dropzone-{{$name}}" class="my-dropzone dropzone mb-3">
    <div class="dz-message needsclick">
        Drag and drop image to upload.<br>
{{--        Maximum {{$maxFiles}} images<br>--}}
        <span class="note needsclick">(Image size must be less than <b>1.5M</b>)</span>
    </div>
</div>
@once
    @push('custom_style_header')
        <!-- Dropzone style -->
        <link rel="stylesheet" href="{{asset('statics/plugins/dropzone/dropzone.css')}}?v=1">
    @endpush

    @push('custom_style_header')
        <!-- Dropzone js -->
        <script src="{{asset('statics/plugins/dropzone/dropzone.js')}}?v=1"></script>
        <script>
            Dropzone.autoDiscover = false;
        </script>
    @endpush
@endonce

@push('custom_script_footer')
    <script>
        // Dropzone has been added as a global variable.
        var dropzone{{$name}} = new Dropzone("div#my-dropzone-{{$name}}", {
            url: '/admin/ajax/uploadmultiimage/{{ $config }}',
            maxFilesize: 1.5,
            acceptedFiles: '.jpg,.png,.jpeg',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            maxFiles: {{$maxFiles}},
            dictInvalidFileType: 'The image format must be png, jpeg, jpg.',
            dictFileTooBig: 'File is too big (@{{filesize}}MB). Max filesize: @{{maxFilesize}}MB.',
            init: function () {
                var thisDZ = this;

                $.ajax({
                    url: '/admin/ajax/loadmultiimage/{{ $config }}',
                    params: {
                        _token: "{{ csrf_token() }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(key, value) {
                            var mockFile = {id: value.id, name: value.name, size: value.size };
                            mockFile.status = Dropzone.ADDED;
                            mockFile.accepted = true;
                            thisDZ.emit("addedfile", mockFile);
                            thisDZ.emit("thumbnail", mockFile, value.path);
                            thisDZ.emit("complete", mockFile);

                            $(mockFile.previewElement).attr('data-id', value.id);
                            $(mockFile.previewElement).addClass('dz-processing');
                        });

                        var $dzMaxFiles = {{$maxFiles}} - data.length;

                        console.log('{{$name}}', thisDZ.options.maxFiles);

                        thisDZ.options.maxFiles = $dzMaxFiles;

                        thisDZ._updateMaxFilesReachedClass();

                        console.log('{{$name}}', thisDZ.options.maxFiles);
                    }
                });

                thisDZ.on("error", (fileObject, response) => {
                    let msg
                    try {
                        msg = JSON.parse(response).join(', ')
                    } catch (e) {
                        msg = response;
                    }
                });
            },
            success:function(file, response){
                var thisDZ = this;

                var obj = JSON.parse(response);

                $(file.previewElement).attr('data-id', obj.id);
            },
            addRemoveLinks: true,
            removedfile: function(file) {
                var thisDZ = this;

                var $id = $(file.previewElement).attr('data-id');

                file.previewElement.remove();

                if (typeof $id == "undefined") {

                    console.log(thisDZ.options.maxFiles);

                    thisDZ._updateMaxFilesReachedClass();

                    return false;
                }

                $.ajax({
                    url: '/admin/ajax/deletemultiimage/{{ $config }}',
                    params: {
                        _token: "{{ csrf_token() }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: 'GET',
                    dataType: 'json',
                    data: {id: $id},
                    success: function(data){
                        var fileCount = $('#my-dropzone-{{$name}} .dz-processing').length;
                        var $dzMaxFiles = {{$maxFiles}} - fileCount;
                        thisDZ.options.maxFiles = $dzMaxFiles;
                        thisDZ._updateMaxFilesReachedClass();

                        console.log(thisDZ.options.maxFiles +'--'+ fileCount+'--'+$dzMaxFiles);
                    }
                });
            },
            // autoProcessQueue: false
        });
    </script>
@endpush
