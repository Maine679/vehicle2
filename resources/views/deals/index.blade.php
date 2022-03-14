@extends('deals.layout')
@section('title')
    Deals list
@endsection
@section('content')

    <div class="col">
        {{--        <a class="btn btn-success" href="{{ route('deals.create') }}">Create deals</a>--}}
        <a href="{{route('users.index')}}" class="btn btn-success">User list</a>
        <a href="{{route('vehicles.index')}}" class="btn btn-success">Vehicle list</a>
    </div>


    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{session('warning')}}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{session('error')}}</div>
    @endif


    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Salesman</th>
            <th scope="col">buyer</th>
            <th scope="col">Vehicle</th>
            <th scope="col">Price</th>
            <th scope="col">Mileage</th>
            <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        @if($deals->count())
            @foreach($deals as $deal)
                <tr>
                    <th scope="row">{{$deal->id}}</th>
                    <td>{{$deal->salesman->name}}</td>
                    <td>{{$deal->buyer->name}}</td>
                    <td>{{$deal->vehicle->vehicle_name}}</td>
                    <td>{{$deal->price}}</td>
                    <td>{{$deal->mileage}}</td>
                    <td>
                        <form method="POST" action="{{route('deals.destroy',$deal)}}">
                            @csrf
                            <a href="{{route('deals.show',$deal)}}" type="button" class="btn btn-success">Show</a>
                            <a type="button" class="btn btn-warning" href="{{route('deals.edit',$deal)}}">Edit</a>
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
