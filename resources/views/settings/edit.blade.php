@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Изменение настроек</h2>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.requestChange') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="setting_key" class="form-label">Ключ настройки</label>
            <input type="text" class="form-control" id="setting_key" name="setting_key" required>
        </div>

        <div class="mb-3">
            <label for="setting_value" class="form-label">Новое значение</label>
            <input type="text" class="form-control" id="setting_value" name="setting_value" required>
        </div>

        <div class="mb-3">
            <label for="method" class="form-label">Метод получения кода подтверждения</label>
            <select class="form-select" id="method" name="method" required>
                <option value="">Выберите метод</option>
                <option value="sms">SMS</option>
                <option value="email">Email</option>
                <option value="telegram">Telegram</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Отправить код подтверждения</button>
    </form>

    <hr class="my-4">

    <h4>Подтверждение изменения настройки</h4>

    <form action="{{ route('settings.confirmChange') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="setting_key_confirm" class="form-label">Ключ настройки</label>
            <input type="text" class="form-control" id="setting_key_confirm" name="setting_key" required>
        </div>

        <div class="mb-3">
            <label for="token" class="form-label">Код подтверждения</label>
            <input type="text" class="form-control" id="token" name="token" required>
        </div>

        <button type="submit" class="btn btn-success">Подтвердить изменение</button>
    </form>
</div>
@endsection
