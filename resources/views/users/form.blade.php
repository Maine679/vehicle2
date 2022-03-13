@extends('users.layout')
@section('title')
    @if(isset($user))
        Update user
    @else
        Add user
    @endif
@endsection
@section('content')
    <div class="col">
        <a type="button" class="btn btn-secondary" href="{{route('users.index')}}">Back to user list</a>
    </div>

    <form method="POST"
          @if(!isset($user))
          action="{{route('users.store')}}"
          @else
          action="{{route('users.update', $user)}}"
        @endif
    >
        @isset($user)
            @method('PUT')
        @endisset

        @csrf
        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input name="name" value="{{old('name',isset($user) ? $user->name : Null)}}" type="text" class="form-control" id="name"
                   aria-describedby="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input name="email" value="{{old('email',isset($user) ? $user->email : Null)}}" type="email" class="form-control"
                   id="email" aria-describedby="email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input name="password" value="{{ isset($user) ? $user->password : Null }}" type="password"
                   class="form-control" id="password">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">
            @if(!isset($user))
                Create
            @else
                Update
            @endif
        </button>
    </form>
    @if(isset($user))
        <form method="POST" action="{{route('users.destroy', $user)}}">
            @method("DELETE")
            @csrf
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    @endif
@endsection
