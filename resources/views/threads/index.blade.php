@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('threads._list')
                {{$threads->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
@endsection