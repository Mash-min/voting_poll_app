@extends('layouts.app')

@section('content')
    <div class="container row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">
            <form action="/user/login" autocomplete="off" method="post">
                {{ @csrf_field() }}
                <ul class="collection with-header">
                    <li class="collection-header"><h4 class="center">Login</h4></li>
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="email" class="active"><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email">
                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="password" class="active"><i class="fa fa-lock"></i> Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password">
                        </div>
                        <p>
                            <input type="checkbox" id="test5" name="remember_me" />
                            <label for="test5">Remember me</label>
                        </p>
                    </li>
                    <li class="collection-item">
                        <button class="btn btn-flat cyan darken-1 waves-effect waves-light white-text max-width" type="submit">
                            Login
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection