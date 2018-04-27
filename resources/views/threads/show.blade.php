@extends('layouts.app') 
@section('header')
<link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection
 
@section('content')
<thread-view :thread="{{ $thread }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8" v-cloak>
                @include('threads._thread')

                <replies @added="repliesCount++" @removed="repliesCount--"></replies>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently has <span v-text="repliesCount"></span> 
                            {{ str_plural('comment', $thread->replies_count) }} .
                        </p>

                        <div class="level">
                            <subscribe-button :active="{{json_encode($thread->isSubscribedTO)}}" v-if="signedIn"></subscribe-button>
                            @role('admin')
                                <button class="btn btn-warning ml-a" @click="toggleLock" v-text="locked ? 'Unlock' : 'Lock'"></button>    
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection