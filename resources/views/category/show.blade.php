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
</head>

<body>
<form action="{{ route('category.create') }}" method="POST" style="margin-left: 10px; margin-top: 10px;">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Добавить Категорию</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter category" style="width: 50%;">
        <small id="emailHelp" class="form-text text-muted">Подсказку</small>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>


    <div class="card mb-4" style="margin-top: 10px;">
        <div class="card-header">
            <h3 class="card-title">Все категории</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Категории</th>
                    <th>Progress</th>
                    <th style="width: 40px">Label</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                <tbody>
                <tr class="align-middle">
                    <td>{{$category->id}}.</td>
                    <td>{{$category->title}}</td>
                    <td>
                        <a class="" style="color: red;" href="{{ route('category.show_category', $category->id) }}">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </a>
                    </td>
                    <td>
                        <span class="badge text-bg-danger">55%</span>
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
