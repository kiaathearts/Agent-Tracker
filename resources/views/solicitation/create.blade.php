{{--Create Solicitation--}}
@extends('layouts.master')

@section('title', 'Create Sol')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('skilltype', 'Skill Types')}}
    {{link_to('term', 'Terms')}}
    {{link_to("agent/{$agent->id}/solicitation", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')

    {{Form::open(array('url' => "solicitation", 'method' => 'post'))}}
    @include('solicitation.partials.form', ['submit' => 'Create Solicitation', 'agentid' => $agent->id])
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection