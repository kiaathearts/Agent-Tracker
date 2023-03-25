{{--Create Agent Type--}}
@extends('layouts.master')

@section('title', 'Agent Type')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('agenttype', 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')

    {{Form::open(array('url' => '/agenttype', 'method' => 'post'))}}
    @include('agenttype.partials.form', ['submit' => 'Save New Type'])
    {{Form::close()}}
@endsection
