@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="page-header">
                    <h1>
                        {{ $profileUser->username }}
                    </h1>
                </div>

                @forelse ($activities as $date => $activity)
                    <h3 class="page-header">{{ $date }}</h3>

                    @foreach ($activity as $record)
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @empty
                    <h3>Sorry, user has no activities yet :(</h3>
                @endforelse

            </div>
        </div>
    </div>
@endsection