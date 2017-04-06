@extends('layout.general')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="/user/profile" method="POST">
                {{ csrf_field() }}
                <h3>Edit Profile</h3>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"  value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="/user/profile/change-password" method="POST">
                {{ csrf_field() }}
                <h3>Change password</h3>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirm</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change password</button>
                </div>
            </form>
        </div>
    </div>

@stop