{{--Skilltype Create--}}
@extends('layouts.master')

@section('title', 'Skilltype')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::open(array('url' => 'skilltype', 'method' => 'post'))}}
    @include('skilltype.partials.form', ['submit' => 'Create'])
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection