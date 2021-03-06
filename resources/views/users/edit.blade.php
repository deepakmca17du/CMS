@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">My Profile</div>

        <div class="card-body">
            @include('partials.errors')

            <form action="{{route('users.update-profile')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="about">About Me</label>
                    <textarea type="text" id="about" name="about" rows="5" cols="5" class="form-control">{{$user->about}}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
            </form>
        </div>

    </div>

@endsection
