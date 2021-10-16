@extends('front.layout.app')

@section('content')

    <div class="flex-row-fluid home ">
        <!--begin::Card-->
        <div class="  ">
            <div class="card-body">
                <!--begin::Section-->
                <div class="mb-11">

                    <!--begin::Products-->
                    <div class="row">
                    @foreach($letters as $letter)
                        <!--begin::Product-->
                            <div class="col-md-6 col-xxl-6 col-lg-12">
                                <!--begin::Card-->
                                <div class="card card-custom ">
                                    <div class="card-body p-0">
                                        <a href="{{route('letters.create',$letter->id)}}">
                                            <!--begin::Image-->
                                            <div class="overlay">
                                                <div class="overlay-wrapper rounded bg-light text-center">
                                                    <img src="{{get_image($letter->images[0],'med')}}"
                                                         class="img-fluid image-desktop"
                                                         class="mw-100 w-200px">
                                                </div>
                                            </div>
                                            <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                                                <a href="{{route('letters.create',$letter->id)}}" class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1">{{$letter->title}}</a>
{{--                                                <span class="font-size-lg">Outlines keep poorly thought</span>--}}
                                            </div>


                                        </a>
                                    </div>
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Product-->
                        @endforeach
                    </div>
                    <!--end::Products-->
                </div>
                <!--end::Section-->

            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

@push('scripts')

@endpush
