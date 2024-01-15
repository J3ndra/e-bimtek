<html>
    <head>
        <style>
            {!! $data->n_import_font !!}
            {!! $data->d_import_font !!}
        </style>
    </head>
    <body>
        <div style="position: relative; width: 100%; height: auto; margin: auto;">
            <img src="{{ asset(Storage::url($data->file)) }}" style="position: absolute; width: 100%; height: auto; z-index: -1000;" />
            <div id="name" style="padding-left:{{ $data->n_margin_left }}px;
                        padding-right:{{ $data->n_margin_right }}px;
                        width:100%;
                        text-align:{{ $data->n_horizontal }};
                        margin-top:{{ $data->n_vertical }}px;
                        position:absolute;
                        display:block;
                        font-family: '{{ $data->n_font_style }}', 'sans';
                        font-size: {{ $data->n_font_size }}px">
                @if(isset($course))
                {!! $user->name !!}
                @else
                Bagas Aditya Mahendra
                @endif
            </div>
            <div style="padding-left:{{ $data->d_margin_left }}px;
                        margin-right:{{ $data->d_margin_right }}px;
                        width:{{ $data->d_width }}%;
                        text-align:{{ $data->d_horizontal }};
                        margin-top:{{ $data->d_vertical }}px;
                        position:absolute;
                        display:block;
                        font-family: '{{ $data->d_font_style }}', 'sans';
                        font-size: {{ $data->d_font_size }}">
                @if(isset($course))
                Dengan ini menyatakan bahwa {{ $user->name }} telah berhasil menyelesaikan {{ $course->duration }} dari kursus {{ $course->name }} dan lulus post test dengan {{ $course->post_test->amount }} soal.
                @else
                Dengan ini menyatakan bahwa Bagas Aditya Mahendra telah berhasil menyelesaikan 3 Hari dari kursus Belajar Teknologi & Informasi dan lulus post test dengan 10 soal.
                @endif
            </div>

        </div>

    </body>
</html>
