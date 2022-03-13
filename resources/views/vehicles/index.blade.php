@extends('vehicles.layout')
@section('title')
    Vehicle list
@endsection
@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">{{session('danger')}}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{session('warning')}}</div>
    @endif

    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('vehicles.create')}}">Create vehicle</a>
        <a type="button" class="btn btn-success" href="{{route('users.index')}}">Back to user list</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name vehicle</th>
            <th scope="col">type</th>
            <th scope="col">Owner</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @if($vehicles->count())
            @foreach($vehicles as $vehicle)
                <tr>
                    <th scope="row">{{$vehicle->id}}</th>
                    <td>{{$vehicle->vehicle_name}}</td>
                    <td>{{$vehicle->vehicle_type->name}}</td>
                    <td>{{$vehicle->user->name}}</td>
                    <td>
                        <form method="POST" action="{{route('vehicles.destroy',$vehicle)}}">
                            @csrf
                            <a type="button" class="btn btn-success" href="{{route('vehicles.show',$vehicle)}}">Show</a>
                            <a type="button" class="btn btn-warning"
                               href="{{route('vehicles.edit',$vehicle)}}">Update</a>
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
