@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="cold-md-8 offset-2">
                <a href="{{route('admin_channels_create')}}" type="button" class="btn-lg btn-success">Add New Channel</a>
                <hr>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Threads</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($channels as $channel)
                        <tr>
                            <td><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></td>
                            <td><a href="/threads/{{ $channel->slug }}">{{ $channel->slug }}</a></td>
                            <td>{{ $channel->threads_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nothing here.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection