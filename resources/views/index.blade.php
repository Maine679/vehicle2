@extends('layout')
@section('title')
    @if(isset($user))
        User Update
    @else
        Users Create
    @endif
@endsection
@section('content')

    <div class="col">
        <a class="btn btn-success" href="{{ route('users.create') }}">Create user</a>
    </div>

    @if(session('danger'))
        <div class="alert alert-danger">{{session('danger')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Users</th>
            <th scope="col">Email</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row"><a href="{{route("users.show",$user)}}">{{$user->id}}</a></th>
                <td><a href="{{route("users.show",$user)}}">{{$user->name}}</a></td>
                <td><a href="{{route("users.show",$user)}}">{{$user->email}}</a></td>
                <td>
                    <form method="POST" action="{{route('users.destroy', $user)}}">
                        <a class="btn btn-warning" type="button" href="{{ route('users.edit',$user) }}">Update</a>
                        @method("DELETE")
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$users->links()}}
@endsection
