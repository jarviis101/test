@extends('layouts.main')
@section('content')
    {{ Form::model($manufacturer, array('route' => array('manufacturers.update', $manufacturer->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('link', null, array('class' => 'form-control', 'placeholder' => 'Price')) }}
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
