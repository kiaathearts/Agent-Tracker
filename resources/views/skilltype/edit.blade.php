{{--Skilltype Edit--}}
@extends('layouts.master')

@section('title', 'Skilltype')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to("skilltype/{$skilltype->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::model($skilltype, array('url' => "/skilltype/{$skilltype->id}", 'method' => 'put'))}}
    @include('skilltype.partials.form', ['submit' => 'Update Skill Type'])
    <input type='submit' name='delete' value='Remove Skill Type' >
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection
    