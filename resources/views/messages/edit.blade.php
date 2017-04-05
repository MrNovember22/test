@extends('layout.general')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <form action="/messages/edit/{{ $message->id }}" method="POST">
                {{ csrf_field() }}
                <h3>Edit your message</h3>

                <div class="form-group">
                    <textarea class="form-control" name="body" id="body">{{ $message->body }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@stop