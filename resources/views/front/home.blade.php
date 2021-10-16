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
                        <!--begin::Product-->
                        <div class="col-md-6 col-xxl-6 col-lg-12">
                            <!--begin::Card-->
                            <div class="card card-custom ">
                                <div class="card-body p-0">
                                    <a href="{{route('letters.index')}}">
                                        <!--begin::Image-->
                                        <div class="overlay">
                                            <div class="overlay-wrapper rounded bg-light text-center">
                                                <img src="front/media/blocks/1.jpeg" class="img-fluid image-desktop"
                                                     class="mw-100 w-200px">
                                                <img src="front/media/blocks/1_mobile.jpeg" class="img-fluid image-mobile"
                                                     class="mw-100 w-200px">
                                            </div>
                                        </div>


                                    </a>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Product-->

                        <!--begin::Product-->
                        <div class="col-md-6 col-xxl-6 col-lg-12">
                            <!--begin::Card-->
                            <div class="card card-custom ">
                                <div class="card-body p-0">
                                    <a href="{{route('letters.index')}}">
                                        <!--begin::Image-->
                                        <div class="overlay">
                                            <div class="overlay-wrapper rounded bg-light text-center"
                                            >
                                                <img src="front/media/blocks/2.jpeg" class="img-fluid image-desktop"
                                                     class="mw-100 w-200px">
                                                <img src="front/media/blocks/2_mobile.jpeg" class="img-fluid image-mobile"
                                                     class="mw-100 w-200px">
                                            </div>
                                        </div>


                                    </a>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Product-->

                        <!--begin::Product-->
                        <div class="col-md-6 col-xxl-6 col-lg-12 ">
                            <!--begin::Card-->
                            <div class="card card-custom ">
                                <div class="card-body p-0">
                                    <a href="{{route('letters.index')}}">
                                        <!--begin::Image-->
                                        <div class="overlay">
                                            <div class="overlay-wrapper rounded bg-light text-center"
                                            >
                                                <img src="front/media/blocks/3.jpeg" class="img-fluid image-desktop"
                                                     class="mw-100 w-200px">
                                                <img src="front/media/blocks/3_mobile.jpeg" class="img-fluid image-mobile"
                                                     class="mw-100 w-200px">
                                            </div>
                                        </div>



                                    </a>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Product-->

                        <!--begin::Product-->
                        <div class="col-md-6 col-xxl-6 col-lg-12">
                            <!--begin::Card-->
                            <div class="card card-custom ">
                                <div class="card-body p-0">
                                    <a href="{{route('letters.index')}}">
                                        <!--begin::Image-->
                                        <div class="overlay">
                                            <div class="overlay-wrapper rounded bg-light text-center"
                                            >
                                                <img src="front/media/blocks/4.jpeg" class="img-fluid image-desktop"
                                                     class="mw-100 w-200px">
                                                <img src="front/media/blocks/4_mobile.jpeg" class="img-fluid image-mobile"
                                                     class="mw-100 w-200px">
                                            </div>
                                        </div>


                                    </a>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Product-->

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
