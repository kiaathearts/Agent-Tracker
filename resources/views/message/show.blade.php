{{--Message Show--}}
@extends('layouts.master')

@section('title', 'View Message')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{link_to("message/{$message->id}/edit", "{$message->name}")}}</h3>
    <h4>{{$message->message}}</h4>
    {{Form::open(array('url' => "message/{$message->id}/send", 'method' => 'get'))}}
    {{Form::submit('Send')}}
    {{Form::close()}}
@endsection