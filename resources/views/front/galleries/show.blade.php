@extends('front.layout.app')

@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Todo Files-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_todo_aside"
                     style="    min-height: 68vh;">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body px-5">
                            <!--begin:Nav-->
                            <div
                                class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                            @foreach($galleries as $r)
                                <!--begin:Item-->

                                    <div class="navi-item my-2">
                                        <a href="{{route('galleries.show',$r->id)}}"
                                           class="navi-link {{@$gallery->id==$r->id?"active":""}}">

                                            <span
                                                class="navi-text font-weight-bolder font-size-lg">{{$r->title}}</span>
                                            <span class="navi-label">
																<span
                                                                    class="label label-rounded label-light-success font-weight-bolder">{{$r->files->count()}}</span>
															</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                            @endforeach

                            <!--begin:Item-->

                                <div class="navi-item my-2">
                                    <a href="{{route('galleries.show')}}"
                                       class="navi-link {{!@$gallery?"active":""}}">

                                            <span
                                                class="navi-text font-weight-bolder font-size-lg">بدون ألبوم</span>
                                        <span class="navi-label">
																<span
                                                                    class="label label-rounded label-light-success font-weight-bolder">{{\App\Models\File::where('type','')->count()}}</span>
															</span>
                                    </a>
                                </div>
                                <!--end:Item-->

                            </div>
                            <!--end:Nav-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                <!--begin::List-->
                <div class="flex-row-fluid d-flex flex-column ml-lg-8">
                    <div class="d-flex flex-column flex-grow-1">
                        <!--begin::Row-->
                        <div class="row">
                        @foreach($gallery->files??\App\Models\File::where('type','')->get() as $file)
                            <!--begin::Col-->
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <!--begin::Card-->
                                    <div class="card card-custom gutter-b card-stretch">
                                        <div class="card-header border-0">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-body">

                                            <a href="{{$file->getImage('mid')}}"
                                               download="{{$file->title.".".$file->extension}}">
                                                <div class="d-flex flex-column align-items-center">
                                                    <!--begin: Icon-->
                                                    <img alt="" class="max-h-65px"
                                                         {{--                                                         src="front/media/svg/files/{{$file->extension}}.svg"/>--}}
                                                         src="{{$file->getImage()}}"/>
                                                    <!--end: Icon-->
                                                    <!--begin: Tite-->
                                                    <p href="{{$file->getImage('high')}}"
                                                       download="{{$file->title.".".$file->extension}}"
                                                       class="text-dark-75 font-weight-bold mt-15 font-size-lg">{{$file->title}}</p>
                                                    <!--end: Tite-->
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--end:: Card-->
                                </div>
                                <!--end::Col-->
                            @endforeach
                        </div>
                        <!--end::Row-->

                    </div>
                </div>
                <!--end::List-->
            </div>
            <!--end::Todo Files-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@push('scripts')
    <script src="front/js/pages/custom/todo/todo.js"></script>

@endpush
