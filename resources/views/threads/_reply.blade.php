<reply :attributes="{{$reply}}" inline-template v-cloak>
    <div id="reply-{{$reply->id}}" class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <h5 class="flex">
                    <a href="{{route('user_profile', $reply->owner->name)}}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </h5>

                @auth
                    <div>
                        <favorite :reply="{{$reply}}"></favorite>
                    </div>
                @endauth

            </div>

            <div class="panel-body">
                <div v-if="editing">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body"></textarea>
                    </div>
                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                    <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
                </div>
                <div v-else v-text="body">
                </div>
            </div>
        </div>

        @can ('update', $reply)
            <div class="panel-footer level">
                <button type="submit" @click="editing = true" class="btn btn-xs">Edit</button>
                <button type="submit" @click="destroy" class="btn btn-danger btn-xs">Delete</button>
            </div>
        @endcan
    </div>
</reply>