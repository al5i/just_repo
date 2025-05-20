@extends('layouts.admin_template')
@section('content2')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Добавьте ссылку на ваш скомпилированный файл стилей, если используется Laravel Mix -->
    {{-- Подключение скриптов (раскомментировать, если скрипты доступны) --}}
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
</head>

<body>
<form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data" style="margin-left: 10px; margin-top: 10px;">
    @csrf
    <div class="form-group">
        <h1 for="exampleInputEmail1">Добавить Пост</h1>
        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">Название</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter" style="width: 50%;">
        @error('title') <!-- Проверяем, есть ли ошибка для поля title -->
        <div class="alert alert-danger">{{ $message }}</div> <!-- Выводим сообщение об ошибке -->
        @enderror
        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">Контент</label>
        <textarea id="content" name="content" style="width: 50%;"></textarea>
        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">Изображение</label>
        <input type="file" name="image" class="form-control" style="width: 50%;">
        <label class="input-group-text" for="image" style="width: 50%;">Upload</label>
{{--        <label for="validationCustom04" class="form-label" style="margin-top: 30px; margin-bottom: -20px;">Категория</label>--}}
{{--        <select class="form-select" style="width: 50%;" id="validationCustom04" required>--}}
{{--            <option selected disabled value="">Choose...</option>--}}
{{--            <option>...</option>--}}
{{--        </select>--}}
{{--        <div class="invalid-feedback">Please select a valid state.</div>--}}
        <div style="margin-top: 25px;">
        <small id="emailHelp" class="form-text text-muted">Подсказку</small>
        <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
        <script>
            $(document).ready(function() {
                $('#content').summernote({
                    toolbar: false
                });
            });
        </script>
        <script>
            function setWidth() {
                var element = document.querySelector('.note-editor.note-frame.panel.panel-default');
                if (element) {
                    element.style.width = '50%';
                }
            }

            var observer = new MutationObserver(setWidth);

            setWidth();

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
            if (element) {
                element.style.width = '50%';
                observer.disconnect();
            }
        </script>
    </div>


    <div class="card mb-4" style="margin-top: 50px; max-width: 830px;">
        <div class="card-header">
            <h3 class="card-title">Все Посты</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Посты</th>
                    <th>Контент</th>
                    <th style="text-align: center;">Фото</th>
                    <th style="width: 40px;">Посмотреть</th>
                    <th style="width: 40px;">Лайки</th>
                </tr>
                </thead>
                @foreach($posts as $post)
                <tbody>
                <tr class="align-middle">
                    <td>{{$post->id}}.</td>
                    <td>{{$post->title}}</td>
                    <td style="margin-right: 50px;">{!!$post->content!!}</td>
                    <td>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Image" style=" margin-left: 200px; max-width: 200px; max-height: 200px;" />
                    </td>
                    <td>
                        <a class="" style="color: red; margin-left: 40px;" href="{{ route('post.show_category', $post->id) }}">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </a>
                    </td>
                    <td>
                        {{$post->likers()->count()}}
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</form>
</body>
@endsection
