@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">My Profile</h1>
        </div>
        <div class="col-12">
            <form id="user-{{$user->id}}">
                <input type="hidden" class="form-control" name="id" value="{{$user->id}}">

                <div class="form-group">
                    <input type="text" class="form-control" id="userName" name="name" placeholder="Name" value="{{$user->name}}">
                    @error('name')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="userPhone" name="phone" placeholder="Phone" value="{{$user->phone}}">
                    @error('phone')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="userEmail" name="email" placeholder="Email" value="{{$user->email}}">
                    @error('email')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-submit btn-update" data-element-id="user-{{$user->id}}" data-url="{{ route('user.profiles.update') }}">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
