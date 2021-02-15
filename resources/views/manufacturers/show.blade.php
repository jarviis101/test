@extends('layouts.main')
@section('content')
    <div class="innerManufacturer">
        <h2>Manufacturer - {{$manufacturer->name}}</h2>
        <a href="{{$manufacturer->link}}">link</a>
    </div>
@endsection
