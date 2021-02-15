@extends('layouts.main')
@section('content')
    {{ Form::model($drug, array('route' => array('drugs.update', $drug->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('price', null, array('class' => 'form-control', 'placeholder' => 'Price')) }}
    </div>

    <div class="form-group">
        {{ Form::select('ingredient_id', $ingredients, null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::select('manufacturer_id', $manufacturers, null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
