@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Threads</div>
                <div class="panel-body">
                    @foreach($threads as $thread)
                        <a href="{{$thread->path()}}"><h4>{{$thread->title}}</a>
                        <div class="content">{{$thread->body}} </div> 
                        <hr>   
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection