@extends('front.layout.app')
@section('head')
    <link href="{{asset('front/css/pages/wizard/wizard-4.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .wizard.wizard-4 .wizard-nav .wizard-steps {
            justify-content: flex-start;
        }
    </style>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-transparent">
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin::Wizard Nav-->
                <div class="wizard-nav">
                    <div class="wizard-steps">
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-wrapper">
                                <div class="wizard-number">1</div>
                                <div class="wizard-label">
                                    <div class="wizard-title">بيانات {{$title_2}}</div>
                                    <div class="wizard-desc"> ادخل بيانات {{$title_2}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-number">2</div>
                                <div class="wizard-label">
                                    <div class="wizard-title">معاينة</div>
                                    <div class="wizard-desc">معاينة وحفظ {{$title_2}} </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Wizard Nav-->
                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-8 px-12 py-lg-15 ">
                            <div class="col-xl-12 col-xxl-12">
                                <!--begin::Wizard Form-->
                                <form class="form" id="kt_form" action="{{route('letters.store',$letter->id)}}"
                                      method="post">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-sm-12">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content"
                                                 data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold mb-10">بيانات {{$title_2}}:</h5>

                                                <div class="row">
                                                    <div class="col-md-6 " style="border-left: 1px solid #eee">
                                                        <div class="form-group m-0">
                                                            <label>اختر القالب:</label>
                                                            <div class="row">
                                                                @foreach($letter->images as $key=>$val)
                                                                    <div class="col-md-4 ">
                                                                        <label class="option">
                                                                      <span class="option-control">
                                                                       <span class="radio">
                                                                        <input type="radio" class="image-input-letter"
                                                                               name="image"
                                                                               required
                                                                               @php($data = getimagesize(storage_path('app/original/'.$val)))
                                                                               data-width="{{$data[0]}}"
                                                                               data-height="{{$data[1]}}"
                                                                               data-ratio="{{$data[0]/$data[1]}}"
                                                                               data-image="{{get_image($val,'high')}}"
                                                                               value="{{$key}}"
                                                                               {{$key==0?"checked":""}}/>
                                                                        <span></span>
                                                                       </span>
                                                                      </span>
                                                                            <span class="option-label">
                                                                        <img src="{{get_image($val,'thump')}}"
                                                                             class="image" alt="">
                                                                    </span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <!--begin::Group-->
                                                        <hr>
                                                        @foreach($letter->variable as $key=> $var)
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    {{$var['title']}}
                                                                </label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input
                                                                        required
                                                                        class="form-control form-control-solid form-control-lg variables-input"
                                                                        @foreach($letter->images as $k=>$val)
                                                                        data-var-x-{{$k}}="{{$var['x_'.$k]??0}}"
                                                                        data-var-y-{{$k}}="{{$var['y_'.$k]??0}}"
                                                                        @endforeach
                                                                        data-var-style="{{$var['style']??''}}"
                                                                        name="variables[{{$key}}]" type="text"
                                                                        value=""/>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        @endforeach
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h3>معاينة القالب</h3>
                                                        @foreach($letter->images as $key=>$val)
                                                            <img src="{{get_image($val,'med')}}" width="100%"
                                                                 class="image image-preview-letter image-preview-letter-{{$key}}"
                                                                 style="display: none;" alt="">
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Step 2-->
                                            <div class="my-5 step" data-wizard-type="step-content">
                                                <h5 class="text-dark font-weight-bold mb-10 mt-5">
                                                    معاينة
                                                </h5>
                                                <div class="symbol-label min-w-65px min-h-100px preview-image-tab "
                                                     style="background-image: url('front/media/books/4.png');background-repeat:no-repeat;background-size: 100%;position:relative "></div>
                                            </div>
                                            <!--end::Wizard Step 2-->
                                            <!--end::Wizard Step 4-->
                                            <!--begin::Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                <div class="mr-2">
                                                    <button type="button" id="prev-step"
                                                            class="btn btn-light-primary font-weight-bolder px-9 py-4"
                                                            data-wizard-type="action-prev">السابق
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                            class="btn btn-success font-weight-bolder px-9 py-4 action-submit"
                                                            data-wizard-type="action-submit">
                                                        حفظ
                                                        <i class="fa fa-spinner fa-spin loader-al"
                                                           style="display: none;"></i>
                                                    </button>
                                                    <button type="button" id="next-step"
                                                            class="btn btn-primary font-weight-bolder px-9 py-4"
                                                            data-wizard-type="action-next">التالي
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end::Wizard Actions-->
                                        </div>

                                    </div>
                                </form>
                                <!--end::Wizard Form-->
                            </div>

                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Wizard-->
        </div>
    </div>
    <!--end::Card-->
@endsection

@push('scripts')
    <script>


        $('.image-input-letter').click(function () {
            $('.image-preview-letter').hide();
            $('.image-preview-letter-' + $(this).val()).show();
        }).click()


        var fields = {
            @foreach($letter->variable as $key=> $var)
            "variables[{{$key}}]": {
                validators: {
                    notEmpty: {
                        message: 'هذا الحقل مطلوب'
                    }
                }
            },
            @endforeach
        };

        var showLocation = "{{route('letters.files')}}";

    </script>
    <script src="front/js/add-letter.js?d={{time()}}"></script>

@endpush
