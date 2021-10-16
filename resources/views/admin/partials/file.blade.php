<div class="image-input image-input-empty image-input-outline" id="">
    <label
        data-toggle="tooltip" title="">
        <input type="file" name="{{$key=isset($key)?$key:"file"}}"/>
        @if(isset($item))
            <a href="{{$item->getFile()}}" class="btn btn-info" download="{{$item->title.".".$item->extension}}">تحميل</a>
            <br>
            <span class="text-danger">اذا لم ترد تغير الملف فاترك الحقل فارغا</span>
        @endif
    </label>


    </span>
    @if($errors->has($key))
        <label for="" class="error">{{$errors->first($key)}}</label>
    @endif
</div>

@push('scripts')
    <script>
        var avatar5 = new KTImageInput('kt_image_5');

        avatar5.on('cancel', function (imageInput) {

        });

        avatar5.on('change', function (imageInput) {

        });

    </script>
@endpush
