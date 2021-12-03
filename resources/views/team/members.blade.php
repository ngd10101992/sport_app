@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="page-title">Members of team</h1>
        </div>
        <div class="col-12 mb-4">
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
                    <input type="text" class="form-control" id="memberRole" name="role" placeholder="Role">
                    @error('role')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add member</button>
            </form>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Team->members as $key=>$member)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$member->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
