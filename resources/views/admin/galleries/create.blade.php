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


                        @include('admin.partials.dropzone')

                    </div>
                    <!--end::Form-->
                </div>
            </div>
            <div class="col-md-4">

                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            نفاصيل
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">بدون ألبوم</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input data-switch="true" type="checkbox" data-on-text="نعم" data-off-text="لا" name="without_album" value="1"/>
                            </div>
                        </div>
                    </div>
                </div>
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
@endpush

