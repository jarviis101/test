@extends('layouts.main')
@section('content')
    <h2>Manufacturer - {{$manufacturer->name}}</h2>
    <a href="{{$manufacturer->link}}">link</a>
@endsection
