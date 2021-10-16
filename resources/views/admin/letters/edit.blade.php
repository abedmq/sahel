@extends('layout.admin.default')

@section('content')
    <form action="{{route('admin.'.$route.'.update',$item)}}" method="post" class="form-validate ajax-form"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{route('admin.'.$route.'.index')}}">{{$title}}</a>
                        </h3>
                    </div>
                    <!--begin::Form-->

                    <div class="card-body">

                        <div class="form-group">
                            <label>العنوان<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="ادخل العنوان"
                                   value="{{$item->title}}"
                                   required name="title"/>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label>التنسيق<span class="text-danger">*</span></label>--}}
                        {{--                            <textarea type="text" style="direction: ltr;text-align: left" dir="ltr" class="form-control" id="style" placeholder="ادخل التنسيق"--}}
                        {{--                                      required name="style">{{old('style',$item->style)}}</textarea>--}}
                        {{--                        </div>--}}

                        <h3>المتغيرات</h3>
                        <div id="kt_repeater_1">
                            <div class="form-group row" id="kt_repeater_1">
                                <div data-repeater-list="variable" class="col-lg-12">


                                    <div data-repeater-item class="item-repeated form-group row align-items-center">
                                        <div class="col-md-3">

                                            <label>اسم المتغير:</label>
                                            <div class="form-group"><input type="radio" data-repeat-radio
                                                                           class="var-selected">
                                                <input type="text" class="form-control"
                                                       style="    width: 90%;display: inline-block;"
                                                       placeholder="ادخل اسم المتغير"
                                                       required name="title"/>

                                            </div>
                                            <div class="d-md-none mb-2">


                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            الصورة
                                            @foreach($item->images as $key=>$val)
                                                <p class="text text-muted h-30px "
                                                   style="line-height: 50px">{{$key+1}}</p>

                                            @endforeach
                                        </div>
                                        <div class="col-md-2">
                                            <label>ازاحة افقي:</label>
                                            @foreach($item->images as $key=>$val)
                                                <input type="text" class="form-control mb-3" required
                                                       {{--                                                           placeholder="ازاحة افقي:"--}}
                                                       name="x_{{$key}}"
                                                       id="x_{{$key}}"
                                                />
                                                <div class="d-md-none mb-2"></div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-2">

                                            <label>ازاحة عمودي:</label>
                                            @foreach($item->images as $key=>$val)
                                                <input type="text" class="form-control mb-3" required
                                                       id="y_{{$key}}"
                                                       name="y_{{$key}}"/>
                                                <div class="d-md-none mb-2"></div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-3">
                                            <label>شكل:</label>
                                            <input type="text" class="form-control"
                                                   name="style"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>

                                        <div class="col-md-1"><br>

                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>
                                            </a>
                                        </div>
                                        <div class="col-12 border-bottom h-20px"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <a href="javascript:;" data-repeater-create=""
                                       class="btn btn-sm font-weight-bolder btn-light-primary">
                                        <i class="la la-plus"></i>اضافة
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                </div>
                <br>

            </div>
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            تفاصيل
                        </h3>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.images',['images_val'=>$item->images,'cantAdd'=>true])

                    </div>

                </div>
                <br>
                <div class="card card-custom">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary mr-2 w-100 mb-4">حفظ
                            <i class="fa fa-spinner fa-spin loader" style="display: none;"></i>
                        </button>
                        <button type="button" class="btn btn-info mb-4 w-100 preview-letter">معاينة</button>
                        <button type="reset" class="btn btn-secondary w-100">الغاء</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="card card-custom preview-card">
            <div class="card-header">
                <h3 class="card-title">
                    معاينة
                </h3>
            </div>
            <div class="card-body card-body-preview ">
                <img src="" alt="" id="preview-image">
            </div>
        </div>

    </form>

    <!--end::Card-->
@endsection

@push('scripts')
    <script>
        $repeater = $('#kt_repeater_1').repeater({
            initEmpty: true,

            defaultValues: {
                'title': 'foo'
            },

            show: function () {
                $(this).slideDown();
                $('.var-selected').attr('name', 'var-selected');

            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $repeater.setList([
                @foreach($item->variable??[] as $variable)
            {
                title: '{{$variable['title']}}',

                @foreach($item->images as $key=>$val)
                x_{{$key}}: {{$variable['x_'.$key]??0}},
                @endforeach

                        @foreach($item->images as $key=>$val)
                y_{{$key}}: {{$variable['y_'.$key]??0}},
                @endforeach

                style: '{{$variable['style']}}',
            },
            @endforeach
        ]);
        var screen_ratio = 1;
        $('#preview-image').click(function (e) {
            let rect = e.target.getBoundingClientRect();
            let x = (e.clientX - rect.left); //x position within the element.
            let y = e.clientY - rect.top;  //y position within the element.

            let imageSelected = $('.image-selected:checked');
            // if (selected.length)
            let key = imageSelected.parent().find('.key').val();


            $('.var-selected:checked').closest('.item-repeated').find('#x_' + key).val(parseInt(x));
            $('.var-selected:checked').closest('.item-repeated').find('#y_' + key).val(parseInt(y));
            $('.preview-letter').click();
        })
        $('.var-selected').attr('name', 'var-selected');
        if (!$('.var-selected:checked').length)
            $('.var-selected').first().attr('checked', true);

        $('.image-selected').attr('name', 'image-selected');

        if (!$('.image-selected:checked').length)
            $('.image-selected').first().attr('checked', true);

        $('.preview-letter').click(function () {
            let selected = $('.image-selected:checked');
            // if (selected.length)
            let preview = selected.parent().find('.image-preview');
            let parent = preview.parent().parent();
            let val = preview.attr('src');
            let width = parent.find('.width').val();
            let height = parent.find('.height').val();
            let key = parent.find('.key').val();
            let ratio = parent.find('.ratio').val();
            // screen_ratio = ($('#preview-image').width() / width);
            screen_ratio = 1;

            // $('.preview-card .card-body').css('background-image','url('+val+')');
            if (val) {
                $('#preview-image').attr('src', val);
                $('#preview-image').css('height', height);
                $('#preview-image').css('width', width);
                $('.card-body-preview').css('width', width);
                let vars = $repeater.repeaterVal();
                $('.preview-variables').remove();
                for (let element of vars['variable']) {
                    let html = '<span class="preview-variables" style="position:absolute;left: ' + (element['x_' + key] * screen_ratio) + 'px;top:' + (screen_ratio * element['y_' + key]) + 'px;' + element['style'] + ';' +
                        '"' + ">" +
                        element['title'] + "</span";
                    $('.preview-card .card-body').append(html)
                }
            } else {
                showMsgError('خطأ في المعاينة', 'لم يتم رفع اي صورة لمعاينتها')
            }
        });
    </script>
@endpush

