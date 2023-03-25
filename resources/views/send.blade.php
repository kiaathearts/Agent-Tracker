@extends('layouts.master')

@section('title', 'Send Message')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@endsection

@section('content')
    <h3>{{$message->name}}:</h3>
    <p>{{$message->message}}</p>
    {{Form::open(array('url' => '/message/send', 'method' => 'post'))}}
    @foreach($agents as $agent)
        {{Form::checkbox('agents[]', $agent->id)}} 
        {{"{$agent->firstName} {$agent->lastName}({$agent->agency}) - {$agent->location}"}} <br />
    @endforeach
    {{Form::hidden('messageid', $message->id)}}
    {{Form::submit('Dispatch Emails')}}
    {{Form::close()}}
@endsection