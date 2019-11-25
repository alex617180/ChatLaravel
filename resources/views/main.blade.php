@extends('layouts.master')
@section('title', 'Главная')
@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Комментарии</h3>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success text-center">{{session('status')}}</div>
                        @endif
                    </div>                    
                    {{-- вывод комментов: --}}
                    @foreach ($comments as $user)
                        @if ($user->skip == 1)
                            <div class="media">
                                <img src='img/{{$user->image}}' class='mr-3' alt='...' width='64' height='64'>
                                <div class='media-body'>
                                    <h5 class='mt-0'>{{$user->name}}</h5>
                                    <span><small>{{date('d/m/Y', strtotime($user->date))}}</small></span>
                                    <p>{{$user->text}}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            {{ $comments->links() }}
            <div class="col-md-12" >
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Оставить комментарий</h3>
                    </div>
                    @if(\Auth::check())
                        <div class="card-body">
                            <form action="/" method="post">
                                @csrf                                
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение </label>
                                    <textarea name="text" maxlength="200" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                    @error('text')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Отправить</button>

                            </form>
                        </div>
                    @else
                        <div class="card-body card__comment">
                            <p>Чтобы оставить комментарий, </p>
                            <a class="" href="/register">зарегистрируйтесь</a>
                            <p> или </p>
                            <a class="" href="/login">авторизуйтесь</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection