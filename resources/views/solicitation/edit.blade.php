{{--Edit Solicitation--}}
@extends('layouts.master')

@section('title', 'Edit Sol')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('skilltype', 'Skill Types')}}
    {{link_to('term', 'Terms')}}
    {{link_to("agent/{$solicitation->agent->id}/solicitations/{$solicitation->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    
    {{Form::model($solicitation, array('url' => "/solicitation/{$solicitation->id}", 'method' => 'put'))}}
    @include('solicitation.partials.form', ['submit' => 'Update', 'agentid' => $solicitation->agent_id])
    <input type='submit' name='delete' value='Remove Solicitation' >
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection