@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <form action="{{ route('user.teams.add') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <input type="text" class="form-control" id="teamName" name="name" placeholder="Team Name">
                    @error('name')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add team</button>
            </form>
        </div>
        <div class="col-12 mb-4">
            <h1 class="page-title">Admin Teams Page</h1>
        </div>
        @foreach($teams as $key=>$team)
            <div class="col-12 col-md-4 mb-4">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTmNu_ftzSIZ8THbnQ5s1ajwKKdWahEEmEOg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$team->name}}</h5>
                        <a href="#" class="btn btn-info">member</a>
                        <a href="#" class="btn btn-warning text-white">Edit</a>
                        <a href="#" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
