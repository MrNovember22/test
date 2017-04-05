@extends('layout.general')

@section('content')
<div class="row">
    <div class="col-md-6">
        <form action="/user/login" method="POST">
            {{ csrf_field() }}
            <h3>Enter email and password</h3>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
        </form>
    </div>
</div>
@stop