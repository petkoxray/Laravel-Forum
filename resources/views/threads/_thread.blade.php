{{-- Editing the thread. --}}
<div class="panel panel-default" v-if="editing">
    <div class="panel-heading">
        <div class="level">
            <input type="text" class="form-control" v-model="form.title">
        </div>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <wysiwyg v-model="form.body"></wysiwyg>
        </div>
    </div>

    <div class="panel-footer">
        <div class="level">
            <button class="btn btn-xs level-item" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-primary btn-xs level-item mr-1" @click="update">Update</button>
            <button class="btn btn-xs level-item" @click="resetForm">Cancel</button>

            @can ('update', $thread)
                <form action="{{ $thread->path() }}" method="POST" class="ml-a">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger btn-xs">Delete Thread</button>
                </form>
            @endcan

        </div>
    </div>
</div>


{{-- Viewing the question. --}}
<div class="panel panel-default" v-else>
    <div class="panel-heading">
        <div class="level">
            <img src="{{ $thread->creator->avatar_path }}"
                 alt="{{ $thread->creator->username }}"
                 width="25"
                 height="25"
                 class="mr-1">

            <span class="flex">
                <a href="{{ route('user_profile', $thread->creator) }}">
                    {{ $thread->creator->username }}</a> <span>({{$thread->creator->reputation}} XP)</span> posted: <span
                        v-text="title"></span>
            </span>
        </div>
    </div>

    <div class="panel-body" v-html="body"></div>

    <div class="panel-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-xs" @click="editing = true">Edit</button>
    </div>
</div>