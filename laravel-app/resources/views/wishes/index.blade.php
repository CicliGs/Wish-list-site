@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мой виш-лист</h1>
    <a href="{{ route('wishes.create') }}" class="btn btn-primary mb-3">Добавить желание</a>
    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Ссылка</th>
                <th>Картинка</th>
                <th>Цена</th>
                <th>Бронировано</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wishes as $wish)
                <tr>
                    <td>{{ $wish->title }}</td>
                    <td>@if($wish->url)<a href="{{ $wish->url }}" target="_blank">Ссылка</a>@endif</td>
                    <td>@if($wish->image)<img src="{{ $wish->image }}" alt="image" style="max-width:60px;max-height:60px;">@endif</td>
                    <td>{{ $wish->price ? number_format($wish->price, 2) : '' }}</td>
                    <td>{!! $wish->is_reserved ? '<span class="text-success">Забронировано</span>' : '<span class="text-danger">Свободно</span>' !!}</td>
                    <td>
                        <a href="{{ route('wishes.edit', $wish) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('wishes.destroy', $wish) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 