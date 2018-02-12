<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="{{route('user_profile', $reply->owner->name)}}">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form method="POST" action="{{route('favorite_reply', $reply)}}">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Like', $reply->favorites_count) }}
                    </button>
                </form>
            </div>

        </div>

        <div class="panel-body">
            {{ $reply->body }}
        </div>
    </div>
</div>