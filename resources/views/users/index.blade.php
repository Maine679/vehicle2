@extends('users.layout')
@section('title')
    User list
@endsection
@section('content')

    <div class="col">
        <a class="btn btn-success" href="{{ route('users.create') }}">Create user</a>
        <a href="{{route('vehicles.index')}}" class="btn btn-success">Vehicle list</a>
    </div>

    @if(session('danger'))
        <div class="alert alert-danger">{{session('danger')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{session('warning')}}</div>
    @endif


    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Users</th>
            <th scope="col">Email</th>
            <th scope="col">Vehicles</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count())
            @foreach($users as $user)
                <tr>
                    <th scope="row"><a href="{{route("users.show",$user)}}">{{$user->id}}</a></th>
                    <td><a href="{{route("users.show",$user)}}">{{$user->name}}</a></td>
                    <td><a href="{{route("users.show",$user)}}">{{$user->email}}</a></td>
                    <td><a href="{{route('vehicles.index')}}">{{$user->vehicles->count()}}</a></td>
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
        @endif
        </tbody>
    </table>

    {{$users->links()}}
@endsection
