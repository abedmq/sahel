@extends('admin.base.index')


{{--@php($options=['edit'=>true,'destroy'=>true])--}}
@section('column')
    <script>
        let column = [
            {
                field: 'title',
                title: 'العنوان',
            }
        ]

    </script>
@endsection
