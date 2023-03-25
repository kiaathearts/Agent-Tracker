{{--Message Index--}}
@extends('layouts.master')

@section('title', 'Messages')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
@endsection

@section('content')
    @include('notifications.success')
    {{Form::open(array('url' => 'message/search'))}}
    {{Form::text('search-message-name', null, array('placeholder' => 'Message Name'))}} <br />
    {{Form::text('search-message-body', null, array('placeholder' => 'Message Body'))}} <br />
    {{Form::submit('Search')}}
    {{Form::close()}}
    <h3>Messages</h3>
    @foreach($messages as $message)
        {{link_to("message/{$message->id}", $message->name)}} <br />
    @endforeach
    <h4>{{link_to('message/create', 'Create New Message')}}</h4>
@endsection