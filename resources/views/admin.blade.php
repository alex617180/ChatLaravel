@extends('layouts.master')
@section('title', 'Админка')
@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Админ панель</h3>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Аватар</th>
                                        <th>Имя</th>
                                        <th>Дата</th>
                                        <th>Комментарий</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($comments as $user)
                                        <tr>
                                            <td>
                                                <img src="img/{{$user->image}}" alt="" class="img-fluid" width="64" height="64">
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{date('d/m/Y', strtotime($user->date))}}</td>
                                            <td>{{$user->text}}</td>
                                            <td>
                                                @if ($user->skip == 1)
                                                    <form action="/admin" method="post">
                                                        @csrf
                                                        <button type="submit" name="show" value="{{$user->id}}" class="btn btn-success">Показано</button>
                                                    </form>
                                                @else
                                                    <form action="/admin" method="post">
                                                        @csrf
                                                        <button type="submit" name="skip" value="{{$user->id}}; ?>" class="btn btn-warning">Скрыто</button>
                                                    </form>
                                                @endif
                                                <form action="/admin" method="post">
                                                    @csrf
                                                    <button onclick="return confirm('are you sure?')" type="submit" name="del" value="{{$user->id}}" class="btn btn-danger">Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Пагинация: -->
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection