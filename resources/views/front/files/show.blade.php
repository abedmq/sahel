@extends('front.layout.app')

@section('content')
    <div class="card mb-8">
        <!--begin::Body-->
        <div class="card-body p-10">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-3">
                    <!--begin::Navigation-->
                    <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0"
                        role="tablist">
                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" href="{{route('letters.files.pdf',$file->id)}}">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">مشاركة pdf</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" href="{{url($file->image_preview)}}" download="{{$file->letter->title}}.jpg">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">مشاركة صورة</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->


                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" href="{{route('letters.files.print',$file->id)}}" target="_blank">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">طباعة</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                    </ul>
                    <!--end::Navigation-->
                </div>
                <div class="col-lg-9">
                    <!--begin::Tab Content-->
                    <h5 class="text-dark font-weight-bold mb-10 mt-5">
                        معاينة| {{$file->letter->title}}
                    </h5>
                    @if($file->image_preview)
                        @php($imageInfo=getImageInfo($file->image_preview))

                        <div class="symbol-label min-w-65px min-h-150px  preview-image-tab"
                             style="background-image: url('{{url($file->image_preview)}}');
                                 width: 100%;
                                 ;background-repeat:no-repeat;background-size: 100% ">
                        </div>

                        @else
                        @php($imageInfo=$file->getImageInfo())

                        <div class="symbol-label min-w-65px min-h-150px preview-image-tab "
                         style="background-image: url('{{get_image(($imageInfo)['image'],'high')}}');
                             width: 100%;
                             ;background-repeat:no-repeat;background-size: 100%;position:relative ">

                        @foreach($file->letter->variable as  $key=>$var)
                            <span class="preview-variables"
                                  data-left="{{$var['x_'.$file->image]}}"
                                  data-top="{{$var['y_'.$file->image]}}"
                                  style="position:absolute;left: {{$var['x_'.$file->image]}}px;top{{$var['y_'.$file->image]}}px; {!! $var['style'] !!}; {{$file->letter->style}} ">
                            {{$file->variable[$key]}}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <!--end::Tab Content-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
    </div>
@endsection

@push('scripts')
    <script>

        screen_ratio = $('.preview-image-tab').width() / {{$imageInfo[0]}};
        $('.preview-image-tab').height(screen_ratio * {{$imageInfo[1]}});
        $('.preview-variables').each(function () {
            let left = $(this).data('left');
            let top = $(this).data('top');
            $(this).css('left', left * screen_ratio);
            $(this).css('top', top * screen_ratio);
        });
    </script>
@endpush
