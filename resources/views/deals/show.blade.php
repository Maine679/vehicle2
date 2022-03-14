@extends('vehicles.layout')
@section('title','Show deal')
@section('content')

    <div class="col">
        <a type="button" class="btn btn-success" href="{{route('deals.index')}}">Return to deal list</a>
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
            <li class="list-group-item">Deal id: <b>{{$deal->id}}</b></li>
            <li class="list-group-item">Sales: [id: <b>{{$deal->salesman_id}}</b>][name: <b>{{$deal->salesman->name}}</b>]</li>
            <li class="list-group-item">Buyer: [id: <b>{{$deal->buyer_id}}</b>][name: <b>{{$deal->buyer->name}}</b>]</li>
            <li class="list-group-item">Vehicle: [id: <b>{{$deal->vehicle_id}}</b>][name: <b>{{$deal->vehicle->vehicle_name}}</b>]</li>
            <li class="list-group-item">Price: <b>{{$deal->price}}</b></li>
            <li class="list-group-item">Mileage: <b>{{$deal->mileage}}</b></li>
            <li class="list-group-item">Created: <b>{{$deal->created_at}}</b></li>
            <li class="list-group-item mb-5">Updated: <b>{{$deal->updated_at}}</b></li>



            <li class="list-group-item">Vahicle Id: <b>{{$deal->vehicle->id}}</b></li>
            <li class="list-group-item">Vahicle Name: <b>{{$deal->vehicle->vehicle_name}}</b></li>
            <li class="list-group-item">Vahicle Type: <b>{{$deal->vehicle->vehicle_type->name}}</b></li>
            <li class="list-group-item">Vahicle Vincode: <b>{{$deal->vehicle->vincode}}</b></li>
            <li class="list-group-item">Vahicle Number: <b>{{$deal->vehicle->number_plate}}</b></li>
            <li class="list-group-item">Vahicle Owner: <b>{{$deal->vehicle->user->name}}</b></li>
            <li class="list-group-item">Vahicle Created: <b>{{$deal->vehicle->created_at}}</b></li>
            <li class="list-group-item">Vahicle Updated: <b>{{$deal->vehicle->updated_at}}</b></li>
        </ul>
    </div>

    <form method="POST" action="{{route('deals.destroy', $deal)}}">
        @csrf
        @method('DELETE')
        <a type="button" class="btn btn-warning" href="{{route('deals.edit', $deal)}}">Update</a>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
