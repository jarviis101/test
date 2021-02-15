@extends('layouts.main')
@section('content')
    <h2>Drug name - {{$drug->name}}</h2>
    <p>Price: {{$drug->price}}$</p>
    <p>Ingredient: <a href="/ingredients/{{$drug->ingredient_id}}">{{$drug->ingredient}}</a></p>
    <p>Manufacturer: <a href="/manufacturers/{{$drug->manufacturer_id}}">{{$drug->manufacturer}}</a></p>
@endsection
