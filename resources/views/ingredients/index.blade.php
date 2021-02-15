@extends('layouts.main')
@section('content')
    {{ Form::open(array('url' => 'ingredients/', 'class' => 'form')) }}
        <div class="form-group">
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}
        </div>
        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    <table>
        <tr>
            <th>ID: </th>
            <th>Name: </th>
            <th>Actions: </th>
        </tr>
        @foreach($ingredients as $ingredient)
            <tr>
                <th>{{$ingredient->id}}</th>
                <th>{{$ingredient->name}}</th>
                <th>
                    <div class="row">
                        <a href="/ingredients/{{$ingredient->id}}">open</a>
                        <a href="/ingredients/{{$ingredient->id}}/edit">edit</a>
                        {{ Form::open(array('url' => 'ingredients/' . $ingredient->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('delete') }}
                        {{ Form::close() }}
                    </div>
                </th>
            </tr>
        @endforeach
    </table>
@endsection
