<!DOCTYPE html>
<html>
<head>
    @if(isset($print))
        {{--    <base href="{{url('')}}">--}}
    @endif
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .center {
            margin: 0;
            width: 100%;
            padding: 0;
        }

        @page {
            size: auto;
            margin: 0;
            height: 250px;
        }
    </style>
</head>
<body>
<img src="{{ url($file->image_preview) }}" class="center image" id="image">
<script !src="">
    @if(isset($print))
    window.print();
    @endif
</script>
</body>
</html>
