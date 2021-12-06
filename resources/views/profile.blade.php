@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">My Profile</h1>
        </div>
        
        <div class="col-12">
            <form id="user-{{$user->id}}">
                <small class="help-block text-danger show-error"></small>
                <small class="help-block text-success show-success"></small>
                <input type="hidden" class="form-control" name="id" value="{{$user->id}}">

                <div class="form-group">
                    <input type="text" class="form-control" id="userName" name="name" placeholder="Name" value="{{$user->name}}">
                    @error('name')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="input-group date" id="datetimepicker1" style="margin-bottom:1rem" data-target-input="nearest">
                    <input type="text" name="birthday" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{$user->birthday}}" required/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('birthday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
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

                <button type="submit" class="btn btn-primary btn-submit btn-update" data-remove-value="true" data-element-id="user-{{$user->id}}" data-url="{{ route('user.profiles.update') }}">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
