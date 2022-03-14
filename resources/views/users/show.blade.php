@extends('users.layout')
@section('title', "Show user " . $user->name)
@section('content')

    <div class="col">
        <a type="button" class="btn btn-secondary" href="{{route('users.index')}}">Back to user list</a>
    </div>


    <div class="card" style="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Id:</b> {{$user->id}}</li>
            <li class="list-group-item"><b>Name:</b> {{$user->name}}</li>
            <li class="list-group-item"><b>Email:</b> {{$user->email}}</li>
            <li class="list-group-item"><b>Password:</b> {{$user->password}}</li>
            <li class="list-group-item"><b>Created:</b> {{$user->created_at}}</li>
            <li class="list-group-item"><b>Updated:</b> {{$user->updated_at}}</li>
        </ul>
    </div>


    <div class="h3">User deal</div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Vehicle</th>
            <th scope="col">Price</th>
            <th scope="col">Mileage</th>

        </tr>
        </thead>
        <tbody>
        @if($user->sales->count())
            @foreach($user->sales as $deal)
                <tr>
                    <th scope="row">{{$deal->id}}</th>
                    <td>{{$deal->vehicle->vehicle_name}}</td>
                    <td>{{$deal->price}}</td>
                    <td>{{$deal->mileage}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>






    <form method="POST" action="{{route('users.destroy', $user)}}">
        <a class="btn btn-warning" type="button" href="{{ route('users.edit',$user) }}">Update</a>
        @method("DELETE")
        @csrf
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>

@endsection
