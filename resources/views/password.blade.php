@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">My Profile</h1>
        </div>
        <div class="col-12">
            <small class="help-block text-danger show-error"></small>
            <small class="help-block text-success show-success"></small>
            <form id="user-{{$userId}}">
                <input type="hidden" class="form-control" name="id" value="{{$userId}}">

                <div class="form-group">
                    <input type="password" class="form-control form-control-password" name="oldpassword" placeholder="Enter old password">
                    @error('oldpassword')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-password" name="newpassword" placeholder="Enter new password">
                    @error('newpassword')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-password" name="password_confirmation" placeholder="Enter password confirmation">
                    @error('password_confirmation')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-submit btn-update" data-remove-value="true" data-element-id="user-{{$userId}}" data-url="{{ route('user.password.update') }}">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
