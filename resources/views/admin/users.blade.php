@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="page-title">Admin Users Page</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                    <tr id="user-{{$user->id}}">
                        <th scope="row">{{$key}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role == 1 ? 'Admin' : 'User'}}</td>
                        <!-- Modal Edit -->
                        <td>
                            <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#Modal{{$key}}">Edit</button>
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
                                                    <input type="email" class="form-control" id="userEmail" name="email" placeholder="Number" value="{{$user->email}}">
                                                    @error('email')
                                                        <small class="help-block text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="userRole" name="role" placeholder="Role" value="{{$user->role}}">
                                                    @error('role')
                                                        <small class="help-block text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-update" data-element-id="user-{{$user->id}}">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!--End Modal Edit -->

                        @if (Auth::user()->id !== $user->id)
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
                                                <button class="btn btn-danger w-100 btn-delete" data-element-id="#user-{{$user->id}}" data-url="{{ route('admin.users.delete', [$user->id]) }}">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!--End Modal Remove -->
                        @else
                            <td>
                                <button class="btn disabled">It's Me</button>
                            </td>
                        @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
