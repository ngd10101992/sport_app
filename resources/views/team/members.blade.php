@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="page-title">Members of team {{$Team->name}}</h1>
        </div>
        <div class="col-12 mb-4">
            <!-- <span data-href="{{ route('teams.export', [$Team->id]) }}" id="export" class="btn btn-success">Export</span> -->
            <a class="btn btn-info" href="{{ route('teams.export', [$Team->id]) }}">Export File</a>
        </div>
        @guest  

        @else
            <div class="col-12 col-md-4 mb-4">
                <form action="{{ route('user.members.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="team_id" value="{{$Team->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="memberName" name="name" placeholder="Name">
                        @error('name')
                            <small class="help-block text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="memberAge" name="age" placeholder="Age">
                        @error('age')
                            <small class="help-block text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="memberNumber" name="number" placeholder="Number">
                        @error('number')
                            <small class="help-block text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="memberPosition" name="position" placeholder="Position">
                        @error('position')
                            <small class="help-block text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add member</button>
                </form>
            </div>
        @endguest
        @guest
            <div class="col-12 mb-4">
        @else
            <div class="col-12 col-md-8 mb-4">
        @endguest
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            <a href="{{ route('members.show', [$Team->id, 'order' => 'name']) }}">Name</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('members.show', [$Team->id, 'order' => 'age']) }}">Age</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('members.show', [$Team->id, 'order' => 'number']) }}">Number</a>
                        </th>
                        <th scope="col">
                            Position
                        </th>
                        @guest
                            
                        @else
                            <th scope="col">Edit</th>
                            <th scope="col">Remove</th>
                        @endguest
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $key=>$member)
                        <tr id="member-{{$member->id}}">
                            <th scope="row">{{$key}}</th>
                            <td class="td-info" data-name="name">{{$member->name}}</td>
                            <td class="td-info" data-name="age">{{$member->age}}</td>
                            <td class="td-info" data-name="number">{{$member->number}}</td>
                            <td class="td-info" data-name="position">{{$member->position}}</td>
                            @guest

                            @else
                                <!-- Modal Edit -->
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal{{$key}}">Edit</button>
                                    <div class="modal fade" id="Modal{{$key}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <input type="hidden" class="form-control" name="id" value="{{$member->id}}">

                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="memberName" name="name" placeholder="Name" value="{{$member->name}}">
                                                            @error('name')
                                                                <small class="help-block text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="memberAge" name="age" placeholder="Age" value="{{$member->age}}">
                                                            @error('age')
                                                                <small class="help-block text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="memberNumber" name="number" placeholder="Number" value="{{$member->number}}">
                                                            @error('number')
                                                                <small class="help-block text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="memberPosition" name="position" placeholder="Position" value="{{$member->position}}">
                                                            @error('position')
                                                                <small class="help-block text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-primary btn-update" data-element-id="member-{{$member->id}}" data-url="{{ route('user.members.update') }}">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!--End Modal Edit -->


                                <!-- Modal Remove -->
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeModal">Remove</button>
                                    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <button class="btn btn-danger w-100 btn-delete" data-element-id="#member-{{$member->id}}" data-url="{{ route('user.members.delete', [$member->id]) }}">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!--End Modal Remove -->
                            @endguest
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
