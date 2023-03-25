@extends('layouts.master')

@section('title', 'Agent Types')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    <h3>Agent Types</h3>
    @include('partials.list', ['type' => 'agenttype', 'items' => $agenttypes])
    <p>{{link_to('agenttype/create', 'Create New Agent Type')}}</p>
@endsection