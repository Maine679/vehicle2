@extends('deals.layout')
@section('title')
    Create deal
@endsection
@section('content')

    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('vehicles.index')}}">Vehicle list</a>
    </div>

    <form method="POST"
          @if($deal)
          action="{{route('deals.update',$deal, ['vehicle_id'=>$vehicle->id,'salesman_id'=>$userOwner->id])}}"
          @else
          action="{{route('deals.store',['vehicle_id'=>$vehicle->id,'salesman_id'=>$userOwner->id])}}"
        @endif
    >
        @if($deal)
            @method('PUT')
        @endif
        @csrf

        <div class="card mb-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Id: <b>{{$vehicle->id}}</b></li>
                <li class="list-group-item">Name: <b>{{$vehicle->vehicle_name}}</b></li>
                <li class="list-group-item">Type: <b>{{$vehicle->vehicle_type->name}}</b></li>
                <li class="list-group-item">Vincode: <b>{{$vehicle->vincode}}</b></li>
                <li class="list-group-item">Number: <b>{{$vehicle->number_plate}}</b></li>
                @if(isset($deal))
                    <li class="list-group-item">Owner: <b>{{$deal->salesman->name}}</b></li>
                @else
                    <li class="list-group-item">Owner: <b>{{$vehicle->user->name}}</b></li>
                @endif
                <li class="list-group-item">Created: <b>{{$vehicle->created_at}}</b></li>
                <li class="list-group-item">Updated: <b>{{$vehicle->updated_at}}</b></li>
            </ul>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select buyer</span>
            <select name="buyer_id" class="form-select" aria-label="Default select example">
                @foreach($users as $user)


                    @if(isset($userBuyer))
                        <option
                            @if(isset($userBuyer) && $userBuyer->id == $user->id)
                            selected
                            @endif
                            value="{{$user->id}}">{{$user->name}}
                        </option>
                    @else
                        @if($user->id != $vehicle->user->id)
                            <option
                                @if(isset($userBuyer) && $userBuyer->id == $user->id)
                                selected
                                @endif
                                value="{{$user->id}}">{{$user->name}}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            @error('buyer_id')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input name="price" value="{{old('price', isset($deal) ? $deal->price:Null)}}" type="text"
                   class="form-control" id="price"
                   aria-describedby="price">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mileage" class="form-label">Mileage</label>
            <input name="mileage" value="{{old('mileage', isset($deal) ? $deal->mileage:Null)}}" type="text"
                   class="form-control" id="mileage"
                   aria-describedby="mileage">
            @error('mileage')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <button class="btn btn-success" type="submit">
            @if($deal)
                Update deal
            @else
                Create deal
            @endif
        </button>
    </form>

@endsection
