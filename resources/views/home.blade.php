@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <form action="{{ route('teams.search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-search" name="search" placeholder="Team name">
                </div>
                <button type="submit" class="btn btn-primary btn-basic btn-search">Search</button>
            </form>
        </div>
        @foreach($teams as $key=>$team)
            <div class="col-12 col-md-4 mb-5">
                <div class="card">
                    <img src="{{ asset('images/teams-vecto.jpg') }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{$team->name}}</h5>
                        <a href="{{ route('members.show', [$team->id]) }}" class="btn btn-info btn-basic">Member</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
