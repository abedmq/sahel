@extends('layout.admin.default')

@section('content')
    <form action="{{route('admin.'.$route.'.store')}}" method="post" class="form-validate ajax-form"
          enctype="multipart/form-data">
        @csrf
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
                                   value="{{old('title')}}"
                                   required name="title"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>التنسيق<span class="text-danger">*</span></label>--}}
{{--                            <textarea type="text" class="form-control"  style="direction: ltr;text-align: left" dir="ltr" placeholder="ادخل التنسيق"--}}
{{--                                      required name="style">{{old('style')}}</textarea>--}}
{{--                        </div>--}}

{{--                        <h3>المتغيرات</h3>--}}
{{--                        <div id="kt_repeater_1">--}}
{{--                            <div class="form-group row" id="kt_repeater_1">--}}
{{--                                <div data-repeater-list="variable" class="col-lg-12">--}}

{{--                                    <div data-repeater-list="">--}}
{{--                                        <div data-repeater-item class="form-group row align-items-center">--}}
{{--                                            <div class="col-md-3">--}}
{{--                                                <label>اسم المتغير:</label>--}}
{{--                                                <input type="text" class="form-control" placeholder="ادخل اسم المتغير"--}}
{{--                                                       required name="title"/>--}}
{{--                                                <div class="d-md-none mb-2"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-2">--}}
{{--                                                <label>ازاحة افقي:</label>--}}
{{--                                                <input type="number" class="form-control" required--}}
{{--                                                       name="x"--}}
{{--                                                />--}}
{{--                                                <div class="d-md-none mb-2"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-2">--}}
{{--                                                <label>ازاحة عمودي:</label>--}}
{{--                                                <input type="number" class="form-control" required--}}
{{--                                                       name="y"/>--}}
{{--                                                <div class="d-md-none mb-2"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <label>شكل:</label>--}}
{{--                                                <input type="text" class="form-control"--}}
{{--                                                       name="style"/>--}}
{{--                                                <div class="d-md-none mb-2"></div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-1"><br>--}}
{{--                                                <a href="javascript:;" data-repeater-delete=""--}}
{{--                                                   class="btn btn-sm font-weight-bolder btn-light-danger">--}}
{{--                                                    <i class="la la-trash-o"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <a href="javascript:;" data-repeater-create=""--}}
{{--                                       class="btn btn-sm font-weight-bolder btn-light-primary">--}}
{{--                                        <i class="la la-plus"></i>اضافة--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Form-->--}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            تفاصيل
                        </h3>
                    </div>

                    <div class="card-body">
                        @include('admin.partials.images')

                    </div>

                </div>
                <br>
                <div class="card card-custom">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary mr-2 w-100 mb-4">حفظ
                            <i class="fa fa-spinner fa-spin loader" style="display: none;"></i>
                        </button>
                        <button type="reset" class="btn btn-secondary w-100">الغاء</button>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <!--end::Card-->
@endsection

@push('scripts')
    <script>
        $('#kt_repeater_1').repeater({
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
    </script>
@endpush

