@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="page-title">Home Page</h1>
        </div>
        @foreach($teams as $key=>$team)
            <div class="col-12 col-md-4 mb-4">
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
