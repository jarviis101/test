@extends('layouts.main')
@section('content')
    {{ Form::model($ingredient, array('route' => array('ingredients.update', $ingredient->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
