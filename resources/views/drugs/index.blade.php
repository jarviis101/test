@extends('layouts.main')
@section('content')
    {{ Form::open(array('url' => 'drugs/', 'class' => 'form')) }}
        <div class="form-group">
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}
        </div>
        <div class="form-group">
            {{ Form::text('price', Input::old('price'), array('class' => 'form-control', 'placeholder' => 'Price')) }}
        </div>

        <div class="form-group">
            {{ Form::select('manufacturer_id', $manufacturers, Input::old('manufacturer_id'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::select('ingredient_id', $ingredients, Input::old('ingredient_id'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    <table>
        <tr>
            <th>ID: </th>
            <th>Name: </th>
            <th>Price: </th>
            <th>Ingredient: </th>
            <th>Manufacturer: </th>
            <th>Actions: </th>
        </tr>
        @foreach($drugs as $drug)
            <tr>
                <th>{{$drug->id}}</th>
                <th>{{$drug->name}}</th>
                <th>{{$drug->price}} $</th>
                <th>
                    <a href="/ingredients/{{$drug->ingredient_id}}">
                        {{$drug->ingredient}}
                    </a>
                </th>
                <th>
                    <a href="/manufacturers/{{$drug->manufacturer_id}}">
                        {{$drug->manufacturer}}
                    </a>
                </th>
                <th>
                    <div class="row">
                        <a href="/drugs/{{$drug->id}}">open</a>
                        <a href="/drugs/{{$drug->id}}/edit">edit</a>
                        {{ Form::open(array('url' => 'drugs/' . $drug->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('delete') }}
                        {{ Form::close() }}
                        <a href=""></a>
                    </div>
                </th>
            </tr>
        @endforeach
    </table>
@endsection
