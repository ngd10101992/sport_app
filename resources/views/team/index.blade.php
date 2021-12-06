@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Teams Page</h1>
        </div>
        <div class="col-12 mb-4">
            <form action="{{ route('user.teams.add') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" class="form-control form-control-search" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <input type="text" class="form-control form-control-search" id="teamName" name="name" placeholder="Team Name">
                    @error('name')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-basic btn-search">Add team</button>
            </form>
            @if(Session::has('yes'))
                <div class="alert alert-success mt-3" role="alert">
                    {{Session::get('yes')}}
                </div>
            @endif
        </div>
        @foreach($user->teams as $key=>$team)
            <div id="team-{{$team->id}}" class="col-12 col-md-4 mb-5">
                <div class="card">
                    <img src="{{ asset('images/teams-vecto.jpg') }}" />
                    <div class="card-body">
                        <h5 class="card-title td-info" data-name="name">{{$team->name}}</h5>
                        <a href="{{ route('user.members.show', [Auth::user()->id, $team->id]) }}" class="btn btn-basic btn-info">Member</a>
                        <!-- Modal Edit -->
                        <button type="button" class="btn btn-edit btn-basic" data-toggle="modal" data-target="#editModal-{{$team->id}}">Edit</button>
                        <div class="modal fade" id="editModal-{{$team->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <input type="hidden" class="form-control" name="id" value="{{$team->id}}">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="team-{{$team->id}}" name="name" placeholder="Team Name" value="{{$team->name}}">
                                                @error('name')
                                                    <small class="help-block text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-update" data-element-id="team-{{$team->id}}" data-url="{{ route('user.teams.update') }}">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Modal Edit -->


                        <!-- Modal Remove -->
                        <button type="button" class="btn btn-remove btn-basic" data-toggle="modal" data-target="#removeModal">Remove</button>
                        <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <button class="btn btn-danger w-100 btn-delete" data-element-id="#team-{{$team->id}}" data-url="{{ route('user.teams.delete', [$team->id]) }}">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Modal Remove -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
