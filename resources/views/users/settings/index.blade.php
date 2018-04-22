@extends('layouts.app') 

@section('content')
    <avatar-form :user="{{ @Auth::user() }}"></avatar-form>
@endsection