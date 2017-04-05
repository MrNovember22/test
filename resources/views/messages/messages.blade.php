@extends('layout.general')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <h3>Messages</h3>
            <hr>
            @foreach($messages as $message)
                <li class="list-group-item">
                    @include('messages.message')
                </li>
            @endforeach
        </div>

        <div class="col-lg-9">
            <form action="/messages/create" method="POST">
                {{ csrf_field() }}
                <h3>Write Message</h3>

                <div class="form-group">
                    <textarea class="form-control" name="body" id="body"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
@stop