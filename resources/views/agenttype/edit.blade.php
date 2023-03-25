{{--Create/Edit Agent Type--}}
@extends('layouts.master')

@section('title', 'Agent Type')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to("agenttype/{$agenttype->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')

    {{Form::model($agenttype, array('url' => "/agenttype/$agenttype->id", 'method' => 'put'))}}
    @include('agenttype.partials.form', ['submit' => 'Update Type'])
    <input type='submit' name='delete'  value='Remove Type' >
    {{Form::close()}}
@endsection
