@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('yes'))
        <div class="alert alert-success" role="alert">
        {{Session::get('yes')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="team" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="teamName" name="name" placeholder="Team Name">
                    @error('name')
                        <small class="help-block text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add team</button>
            </form>
        </div>
    </div>
</div>
@endsection
