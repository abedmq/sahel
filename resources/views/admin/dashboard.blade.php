{{-- Extends layout --}}
@extends('layout.admin.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        @include('admin.pages.dashboard.state',['type'=>1,'title'=>'عدد المستخدمين','amount'=>\App\Models\User::count()])
        @include('admin.pages.dashboard.state',['type'=>1,'title'=>'عدد الخطابات','amount'=>\App\Models\Letter::type()->count()])
        @include('admin.pages.dashboard.state',['type'=>1,'title'=>'عدد الدعوات','amount'=>\App\Models\Letter::type('invitations')->count()])
        @include('admin.pages.dashboard.state',['type'=>1,'title'=>'عدد قوالب الشكر','amount'=>\App\Models\Letter::type('thanks')->count()])
    </div>
    <div class="row">

    <div class="col-lg-6 col-xxl-4">
{{--        @include('admin.pages.dashboard._recent_orders', ['class' => 'card-stretch gutter-b','orders'=>\App\Models\LetterFile::latest()->where('created_at','>',\Carbon\Carbon::now()->subDays(5))->limit(5)->get()])--}}
    </div>

{{--    <div class="col-lg-6 col-xxl-4">--}}
{{--        @include('pages.widgets._widget-3', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
{{--        @include('pages.widgets._widget-4', ['class' => 'card-stretch card-stretch-half gutter-b'])--}}
{{--    </div>--}}

{{--    <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">--}}
{{--        @include('pages.widgets._widget-5', ['class' => 'card-stretch gutter-b'])--}}
{{--    </div>--}}

    <div class="col-xxl-8 order-2 order-xxl-1">
{{--        @include('admin.pages.dashboard._latst_provider', ['class' => 'card-stretch gutter-b','providers'=>\App\Models\File::latest()->where('created_at','>',\Carbon\Carbon::now()->subDays(50))->limit(10)->get()])--}}
    </div>

{{--    <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--        @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b'])--}}
{{--    </div>--}}

{{--    <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">--}}
{{--        @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])--}}
{{--    </div>--}}

{{--    <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">--}}
{{--        @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])--}}
{{--    </div>--}}


@endsection

{{-- Scripts Section --}}
@push('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endpush
