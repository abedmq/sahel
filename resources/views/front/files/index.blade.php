@extends('front.layout.app')

@section('content')
    <style>
        .title-footer{
            position: absolute;
            bottom: 15px;
            text-align: center;
            width: 100%;
            left: 0;
        }
    </style>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row">
                @foreach($files as $file)
                <!--begin::Column-->
                <a href="{{route('letters.files.show',$file->id)}}" class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <!--begin::Card-->

                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body text-center pt-4">

                            <!--begin::User-->
                            <div class="my-10">
                                <div class="image">
                                    <img class="img-fluid" src="{{@$file->image_preview?:get_image($file->letter->images[0],'med')}}" alt="image" />
                                </div>
                            </div>
                            <!--begin::Name-->
                            <div class="title-footer">
                                {{$file->letter->title}}
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </a>
                <!--end::Column-->
                @endforeach

            </div>
            <!--end::Row-->
            {!! $files->links() !!}
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@push('scripts')
    <script>

    </script>
@endpush
