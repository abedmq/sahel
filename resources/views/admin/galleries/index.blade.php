@extends('admin.base.index')


{{--@php($options=['edit'=>true,'destroy'=>true])--}}
@section('column')
    <script>
        let column = [
            {
                field: 'title',
                title: 'الاسم',
            },

            {
                field: 'files_count',
                title: 'عدد الملفات',
                sortable: false,
            },
        ]

    </script>
@endsection
