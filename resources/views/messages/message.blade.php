<div class="blog-post">
    <div class="row">
        <div class="col-lg-12">
            @if (Auth::user())
                @if ($user->id == $message->user_id)
                    <a href="/messages/delete/{{ $message->id }}" class="btn btn-xs btn-danger">Delete message</a>
                    <a href="/messages/edit/{{ $message->id }}" class="btn btn-xs btn-success">Edit message</a>
                @endif
            @endif
            <h4 class="blog-post-title">{{ $message->title }}</h4>
            <p class="blog-post-meta">{{ $message->created_at->toDayDateTimeString() }}</p>

            {{ $message->body }}
        </div>
    </div>
</div>