{{--Create Term--}}
@extends('layouts.master')

@section('title', 'Create Term')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
@endsection

@section('content')
    @include('notifications.error')
    
    {{Form::open(array('url' => 'term', 'method' => 'post'))}}
    @include('term.partials.form', ['submit' => 'Create'])
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection