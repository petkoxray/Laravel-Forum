@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Channel</div>

                    <div class="panel-body">
                        <form action="{{route('admin_channels_store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Add channel</button>
                            </div>
                            @include('layouts._errors')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection