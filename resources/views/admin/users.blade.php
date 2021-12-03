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
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$team)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$team->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
