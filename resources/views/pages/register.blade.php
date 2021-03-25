@extends('layouts.app')

@section('content')
    <div class="container row">
        <div class="col l6 offset-l3 m8 offset-m2 s12">
            <form action="/user/register" autocomplete="off" method="post">
                {{ @csrf_field() }}
                <ul class="collection with-header">
                    <li class="collection-header"><h4 class="center">Register</h4></li>
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="firstname" class="active"><i class="fa fa-envelope"></i> Firstname</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname">
                        </div>
                    </li>
                    <li class="collection-item">
                        <div class="input-field">
                            <label for="lastname" class="active"><i class="fa fa-envelope"></i> Lastname</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname">
                        </div>
                    </li>
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
                    </li>
                    <li class="collection-item">
                        <button class="btn btn-flat cyan darken-1 waves-effect waves-light white-text max-width" type="submit">
                            Register
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection