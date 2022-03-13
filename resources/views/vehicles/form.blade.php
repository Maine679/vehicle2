@extends('vehicles.layout')
@section('title','Create vehicle')
@section('content')
    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('vehicles.index')}}">Return vehicle list</a>
    </div>

    <form method="POST" action="{{route('vehicles.store')}}">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            <input type="text" name="vehicle_name" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select type of vehicle</span>
            <select name="type" class="form-select" aria-label="Default select example">
                @foreach($vehicle_types as $vehicle_type)
                    <option value="{{$vehicle_type->id}}">{{$vehicle_type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Vincode</span>
            <input type="text" name="vincode" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Number plate</span>
            <input type="text" name="number_plate" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select owner vehicle</span>
            <select name="user_id" class="form-select" aria-label="Default select example">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
