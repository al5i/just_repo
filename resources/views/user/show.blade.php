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
<form action="{{ route('user.create') }}" method="POST" style="margin-left: 10px; margin-top: 10px;">
    @csrf
    <div class="form-group">
        <h1 for="exampleInputEmail1">Добавить Пользователя</h1>
        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">Имя</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter" style="width: 50%;">
        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">EMail</label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter" style="width: 50%;">
        @error('email') <!-- Проверяем, есть ли ошибка для поля title -->
        <div class="alert alert-danger">{{ $message }}</div> <!-- Выводим сообщение об ошибке -->
        @enderror
{{--        <label style="margin-top: 10px; margin-bottom: -20px;" for="exampleInputEmail1">Пароль</label>--}}
{{--        <input type="text" name="password" class="form-control" id="password" placeholder="Enter" style="width: 50%;">--}}
        <small id="emailHelp" class="form-text text-muted">Подсказку</small>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>


    <div class="card mb-4" style="margin-top: 50px; max-width: 830px;">
        <div class="card-header">
            <h3 class="card-title">Все Пользователи</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Пользователи</th>
                    <th>Почта</th>
                    <th style="width: 40px">Профиль</th>
                </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                <tr class="align-middle">
                    <td>{{$user->id}}.</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->role == '1')
                            Админ
                        @elseif($user->role == '0')
                            Пользователь
                        @endif
                    </td>
                    <td>
                        <a class="" style="color: red; margin-left: 25px;" href="{{ route('tag.show_category', $user->id) }}">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </a>
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
