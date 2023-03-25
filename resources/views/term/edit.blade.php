{{--Edit Term--}}
@extends('layouts.master')

@section('title', 'Edit Term')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
@endsection

@section('content')
    @include('notifications.error')
    
    {{Form::model($term, array('url' => "/term/{$term->id}", 'method' => 'put'))}}
    @include('term.partials.form', ['submit' => 'Update Term'])
    <input type='submit' name='delete' value='Remove Term' >
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection