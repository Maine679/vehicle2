@extends('vehicles.layout')
@if(isset($vehicle))
    @section('title', 'Update vehicle')
@else
    @section('title','Create vehicle')
@endif

@section('content')
    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('vehicles.index')}}">Return vehicle list</a>
    </div>

    <form method="POST" action="{{isset($vehicle) ? route('vehicles.update',$vehicle):route('vehicles.store')}}">
        @if(isset($vehicle))
            @method('PUT')
        @endif

        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            <input type="text" value="{{old('vehicle_name',isset($vehicle) ? $vehicle->vehicle_name:NULL)}}"
                   name="vehicle_name" class="form-control"
                   aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
            @error('vehicle_name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select type of vehicle</span>
            <select name="type" class="form-select" aria-label="Default select example">
                @foreach($vehicle_types as $vehicle_type)
                    <option
                        @if(isset($vehicle) && $vehicle->vehicle_type->id === $vehicle_type->id)
                        selected
                        @endif
                        value="{{$vehicle_type->id}}">{{$vehicle_type->name}}</option>
                @endforeach
            </select>
            @error('type')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Vincode</span>
            <input value="{{old('vincode', isset($vehicle) ? $vehicle->vincode:Null)}}" type="text" name="vincode"
                   class="form-control"
                   aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
            @error('vincode')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Number plate</span>
            <input value="{{old('number_plate', isset($vehicle) ? $vehicle->number_plate :Null)}}" type="text"
                   name="number_plate" class="form-control"
                   aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
            @error('number_plate')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select owner vehicle</span>
            <select name="user_id" class="form-select" aria-label="Default select example">
                @foreach($users as $user)
                    <option
                        @if(isset($vehicle) && $vehicle->user->id === $user->id)
                        selected
                        @endif
                        value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            @if(isset($vehicle))
                Update
            @else
                Create
            @endif
        </button>
    </form>
@endsection
