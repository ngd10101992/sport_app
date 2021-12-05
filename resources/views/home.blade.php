@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <form action="{{ route('teams.search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Team name">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        @foreach($teams as $key=>$team)
            <div class="col-12 col-md-4 mb-5">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTmNu_ftzSIZ8THbnQ5s1ajwKKdWahEEmEOg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$team->name}}</h5>
                        <a href="{{ route('members.show', [$team->id]) }}" class="btn btn-info">Member</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
