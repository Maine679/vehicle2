@extends('vehicles.layout')
@section('title','Show vehicle' . $vehicle->vehicle_name . ' Num Plate: '. $vehicle->number_plate)
@section('content')

    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('vehicles.index')}}">Return to list</a>
    </div>

    @if(session('error'))
        <div class="alert alert-error">{{session('error')}}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{session('warning')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif


    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Id: <b>{{$vehicle->id}}</b></li>
            <li class="list-group-item">Name: <b>{{$vehicle->vehicle_name}}</b></li>
            <li class="list-group-item">Type: <b>{{$vehicle->vehicle_type->name}}</b></li>
            <li class="list-group-item">Vincode: <b>{{$vehicle->vincode}}</b></li>
            <li class="list-group-item">Number: <b>{{$vehicle->number_plate}}</b></li>
            <li class="list-group-item">Owner: <b>{{$vehicle->user->name}}</b></li>
            <li class="list-group-item">Created: <b>{{$vehicle->created_at}}</b></li>
            <li class="list-group-item">Updated: <b>{{$vehicle->updated_at}}</b></li>
        </ul>
    </div>

    <form method="POST" action="{{route('vehicles.destroy', $vehicle)}}">
        @csrf
        @method('DELETE')
        <a type="button" class="btn btn-warning" href="{{route('vehicles.edit', $vehicle)}}">Update</a>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
