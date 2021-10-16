@extends('layout.admin.default')

@section('content')
    <form action="{{route('admin.'.$route.'.update',$item->id)}}" method="post" class="form-validate ajax-form"
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
                                   value="{{old('title',$item->title)}}"
                                   required name="title"/>
                        </div>

                        <div class="form-group">
                            <label>نوع المرفق<span class="text-danger">*</span></label>
                            <select name="album_id" id="album_id" class="form-control">
                                <option value="">اختر</option>
                                @foreach($albums as $album)
                                    <option value="{{$album->id}}" {{old('album_id',$item->album_id)==$album->id?"selected":""}}>{{$album->title}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <!--end::Form-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            الملف
                        </h3>
                    </div>

                    <div class="card-body">
                        @include('admin.partials.file',['key'=>'file'])

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
@endpush

