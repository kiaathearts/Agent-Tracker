{{--Edit Agent--}}
@extends('layouts.master')

@section('title', 'Edit Agent')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('agenttype', 'Agent Types')}}
    {{link_to("agent/$agent->id", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::model($agent, array('url' => "/agent/$agent->id", 'method' => 'put', 'enctype' => 'multipart/form-data'))}}
    @include('agent.partials.form', ['selected' => $agent->agenttype->id, 'submit' => 'Update'])
    <input type='submit' name='delete' value='Remove Agent' >
    {{Form::close()}}
@endsection