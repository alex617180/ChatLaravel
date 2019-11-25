@extends('layouts.master')
@section('title', 'Профиль пользователя')
@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Профиль пользователя</h3>
                        </div>

                        <div class="card-body">
                            @if(session('status'))
                            <div class="alert alert-success text-center">{{session('status')}}</div>
                            @endif
                            <form action="/edit" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" maxlength="20" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleFormControlInput1" value="{{Auth::user()->name}}" required>
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email</label>
                                            <input type="email" maxlength="30" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleFormControlInput1" value="{{Auth::user()->email}}" required>
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Аватар</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="exampleFormControlInput1">
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <img src="img/{{Auth::user()->image}}" alt="" class="img-fluid">
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning">Edit profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header">
                            <h3>Безопасность</h3>
                        </div>

                        <div class="card-body">
                            <form action="/edit_password" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <input type="password" maxlength="20" name="password_current" class="form-control @error('password_current') is-invalid @enderror" id="exampleFormControlInput1" required>
                                            @error('password_current')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">New password</label>
                                            <input type="password" maxlength="20" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleFormControlInput1" required>
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Password confirmation</label>
                                            <input type="password" maxlength="20" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleFormControlInput1" required>
                                            @error('password_confirmation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection