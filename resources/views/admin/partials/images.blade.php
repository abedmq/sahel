<div class="form-group row" id="kt_repeater_images">
    <div data-repeater-list="images" class="col-lg-12">

        <div data-repeater-list="">
            <div data-repeater-item class="form-group row align-items-center">
                <div class="col-md-10">
                    <input type="radio" class="image-selected">
                    <label for="file" class="file-label">
                        <img src="media/svg/icons/Files/File-plus.svg" class="image-preview" alt="">
                    </label>
                    <input type="file" name="file" accept="image/*" class="file-input" onchange="readURL(this)">
                    <input type="text" name="text" class="file-input-text">
                    <input type="hidden" name="width" class="width">
                    <input type="hidden" name="height" class="height">
                    <input type="hidden" name="ratio" class="ratio">
                    <input type="hidden" name="key" class="key">
                </div>

                @if(!isset($cantAdd)||!$cantAdd)

                    <div class="col-md-2"><br>
                        <a href="javascript:;" data-repeater-delete=""
                           class="btn btn-sm font-weight-bolder btn-light-danger">
                            <i class="la la-trash-o"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(!isset($cantAdd)||!$cantAdd)
        <div class="form-group row">
            <div class="col-lg-4">
                <a href="javascript:;" data-repeater-create=""
                   class="btn btn-sm font-weight-bolder btn-light-primary">
                    اضافة
                </a>
            </div>
        </div>
    @endif
</div>
@push('scripts')
    <script>


        var $imagesRepeater = $('#kt_repeater_images').repeater({
            initEmpty: false,

            // defaultValues: {
            //     'text-input': 'foo'
            // },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });


        @if(isset($images_val))

        $imagesRepeater.setList([
                @foreach($images_val as $key=> $image)
            {
                text: '{{$image}}',

                @php($data = getimagesize(storage_path('app/original/'.$image)))
                width: "{{$data[0]}}",
                width: "{{$data[0]}}",
                height: "{{$data[1]}}",
                ratio: "{{$data[0]/$data[1]}}",
                key: "{{$key}}"
            },
            @endforeach
        ]);
        @endif
        $('.file-input-text').each(function () {
            if ($(this).val())
                $(this).parent().find('.image-preview').attr('src', '{{get_images_folder('high')}}' + $(this).val());
        })
        $('body').on('click', '.file-label', function () {
            $(this).parent().find('input').click()
        });
    </script>
@endpush
