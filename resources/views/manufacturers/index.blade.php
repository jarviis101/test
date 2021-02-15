@extends('layouts.main')
@section('content')
    {{ Form::open(array('url' => 'manufacturers/', 'class' => 'form')) }}
        <div class="form-group">
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}
        </div>
        <div class="form-group">
            {{ Form::text('link', Input::old('link'), array('class' => 'form-control', 'placeholder' => 'Link')) }}
        </div>
        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    <table>
        <tr>
            <th>ID: </th>
            <th>Name: </th>
            <th>Link: </th>
            <th>Actions: </th>
        </tr>
        @foreach($manufacturers as $manufacturer)
            <tr>
                <th>{{$manufacturer->id}}</th>
                <th>{{$manufacturer->name}}</th>
                <th><a href="{{$manufacturer->link}}">{{$manufacturer->link}}</a></th>
                <th>
                    <div class="row">
                        <a href="/manufacturers/{{$manufacturer->id}}">open</a>
                        <a href="/manufacturers/{{$manufacturer->id}}/edit">edit</a>
                        {{ Form::open(array('url' => 'manufacturers/' . $manufacturer->id)) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('delete') }}
                        {{ Form::close() }}
                    </div>
                </th>
            </tr>
        @endforeach
    </table>
@endsection
