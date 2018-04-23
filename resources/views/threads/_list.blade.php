@foreach ($threads as $thread)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                    </h4>
                    <h5>
                        Posted
                        by:
                        <img src="{{ $thread->creator->avatar_path }}"
                             alt="{{ $thread->creator->name }}"
                             width="25"
                             height="25"
                             class="mr-1">
                        <a href="{{route('user_profile', $thread->creator)}}"> {{$thread->creator->name}}</a>

                    </h5>
                </div>

                <a href="{{ $thread->path() }}">
                    {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                </a>
            </div>
        </div>

        <div class="panel-body">
            <div class="body">{{ $thread->body }}</div>
        </div>
        <div class="panel-footer">
            Visits: {{$thread->visits}}
        </div>
    </div>
@endforeach