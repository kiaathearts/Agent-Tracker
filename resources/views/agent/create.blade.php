{{--Create Agent--}}
@extends('layouts.master')

@section('title', 'Create Agent')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('agenttype', 'Agent Types')}}
@endsection


@section('content')
    @include('notifications.error')
    @include('notifications.success')

    {{Form::open(array('url' => '/agent', 'method' => 'post', 'enctype' => 'multipart/form-data'))}}
    
    @include('agent.partials.form', ['selected' => null, 'submit' => 'Add Agent'])
    {{Form::close()}}
@endsection