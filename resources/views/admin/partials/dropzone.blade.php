<div class="form-group row">
    <div class="col-sm-12">
        <div class="dropzone dropzone-default dropzone-success" id="kt_dropzone_3">
            <div class="dropzone-msg dz-message needsclick">
                <h3 class="dropzone-msg-title">اسحب الملفات هنا لرفعها.</h3>
                <span class="dropzone-msg-desc">ارفع الصور فقط</span>
            </div>
        </div>
    </div>
    @if($errors->has(isset($key)?$key:"file"))
        <label for="" class="error">{{$errors->first(isset($key)?$key:"file")}}</label>
    @endif
</div>
<style>
    .dropzone.dropzone-default .dz-remove {
        font-size: 14px;
    }
</style>
@push('scripts')
    <script>
        // file type validation
        var myDropzone = $('#kt_dropzone_3').dropzone({
            url: "{{route('admin.upload.image')}}", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 15, // MB
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            accept: function (file, done) {
                done();
            },
            init: function () {
                @foreach($files as $file)
                var mockFile = {name: '{{$file->original_name}}', size: {{$file->size}}, serverId: {{$file->id}}};
                this.emit("addedfile", mockFile);
                this.emit("thumbnail", mockFile, '{{$file->getImage()}}');
                this.emit("complete", mockFile);
                this.files.push(mockFile);
                this.options.maxFiles = this.options.maxFiles - 1;

                @endforeach


                this.on("success", function (file, response) {
                    file.serverId = response.id;
                    $(file.previewTemplate).append('<input type="hidden" name="images[]" value="' + response.id + '">');
                });


                this.on('removedfile', function (file) {

                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.images.remove')}}?id=" + file.serverId,
                        dataType: "json",
                        async: false,
                        success: function (response) {

                        }
                    });
                });

                this.on("addedfile", function (file) {
                    isUploadingImage = true;
                    $('form').find('[type=submit]').attr('disabled', true);

                });

                this.on("queuecomplete", function (file) {
                    isUploadingImage = false;
                    $('form').find('[type=submit]').attr('disabled', false);

                });
            }
        });



    </script>
@endpush
