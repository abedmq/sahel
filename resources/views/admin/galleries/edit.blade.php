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
                                   value="{{old('title',$item->id)}}"
                                   required name="title"/>
                        </div>


                        @include('admin.partials.dropzone',['files'=>$item->files])

                    </div>
                    <!--end::Form-->
                </div>
            </div>
            <div class="col-md-4">
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

