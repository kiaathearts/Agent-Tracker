{{--Agent Index--}}
@extends('layouts.master')

@section('title', 'Agents')

@section('main-nav')
    @parent
    {{link_to('agent', 'Agents')}}
    {{link_to('agenttype', 'Agent Types')}}
@endsection


@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    <h3>Search Agents</h3>
    {{Form::open(array('url' => 'agent/search'))}}
    {{Form::text('agent-search-first-name', null, array('placeholder' => 'First Name'))}} 
    {{Form::text('agent-search-last-name', null, array('placeholder' => 'Last Name'))}} <br />
    {{Form::text('agent-search-agency', null, array('placeholder' => 'Agent Company'))}} 
    {{Form::text('agent-search-location', null, array('placeholder' => 'Agent Location'))}} <br />
    {{Form::text('agent-search-phone', null, array('placeholder' => 'Phone Number'))}} 
    {{Form::text('agent-search-email', null, array('placeholder' => 'Agent Email'))}} <br />
    {{Form::submit('Search')}} <br />
    {{Form::close()}}
    
    <h3>Agents</h3>
    @foreach($agents as $agent)
        {{link_to("agent/{$agent->id}", "{$agent->firstName} {$agent->lastName} ({$agent->agency})") }}<br />
    @endforeach
    <p>{{link_to('agent/create', 'New Agent')}}</p>
@endsection

