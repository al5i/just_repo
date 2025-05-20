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
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Просмотр постов</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unfixed Layout</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$post->title}}</h3>
                                <div class="card-tools">
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-lte-toggle="card-collapse"
                                        title="Collapse"
                                    >
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-lte-toggle="card-remove"
                                        title="Remove"
                                    >
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">content</div>
                            <!-- /.card-body -->
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::App Content-->
        <form action="{{ route('post.update',['post' => $post->id]) }}" method="POST" style="margin-left: 25px; margin-top: 25px;">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Изменить Название Категории</label>
                <input type="text" name="id" class="form-control" id="id" value="{{$post->id}}" placeholder="Enter category" style="width: 50%; display: none;">
                <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="Enter category" style="width: 50%;">
                <small id="emailHelp" class="form-text text-muted">Подсказку</small>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>

        <form action="{{ route('post.delete',['post' => $post->id]) }}" method="POST" style="margin-left: 25px; margin-top: 25px;">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <label for="exampleInputEmail1">Удалить Категорию</label>
                <input type="text" name="id" class="form-control" id="id" value="{{$post->id}}" placeholder="Enter category" style="width: 50%; display: none;">
                <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="Enter category" disabled style="width: 50%;">
                <small id="emailHelp" class="form-text text-muted">Подсказку</small>
            </div>
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
        <form action="{{ route('posts.like', $post->id) }}" method="POST" style="margin-left: 25px; margin-top: 25px;">
            @csrf
            <button type="submit" class="btn btn-danger" style="background-color: deeppink">
                @if(auth()->user()->likedPosts->contains($post->id))
                    Unlike
                @else
                    Like
                @endif
            </button>
        </form>
        <form action="{{ route('posts.comment', $post) }}" method="POST" enctype="multipart/form-data" style="margin-left: 10px; margin-top: 10px;">
            @csrf
            <div class="form-group">
                <h2 for="exampleInputmessage">Добавить Комментарий</h2>
                <label style="margin-top: 10px;" for="exampleInputmessage">Комментарий</label>
                <textarea id="message" name="message" style="width: 50%;"></textarea>
                @error('message') <!-- Проверяем, есть ли ошибка для поля message -->
                <div class="alert alert-danger">{{ $message }}</div> <!-- Выводим сообщение об ошибке -->
                @enderror
                <div style="margin-top: 25px;">
                    <small id="emailHelp" class="form-text text-muted">Подсказку</small>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <script>
                    $(document).ready(function() {
                        $('#message').summernote({
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

            <h3 class="">Все комментарии:</h3>
            @foreach($comments as $comment)
            <div class="card" style="width: 18rem; margin-top: 10px;">
                <div class="card-body">
                    <h5 class="">{{$username}}</h5>
                    <h6 class="">{{$comment->created_at->diffForHumans()}}</h6>
                    <p class="">{!!$comment->message!!}</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            @endforeach
        </form>

    </main>

<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="../../../dist/js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!--end::Script-->
</body>
@endsection
<!--end::Body-->
</html>
