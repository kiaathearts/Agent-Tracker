{{--Note Show--}}
@extends('layouts.master')

@section('title', 'Note')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to("agent/{$note->agent->id}/notes", 'Back')}}
@endsection

@section('content')
    <h4>{{$note->name}}</h4>
    <p>{{$note->note}}</p>
    {{Form::open(array('url' => "note/{$note->id}", 'method' => 'patch'))}}
    {{Form::hidden('_method', 'delete')}}
    {{Form::submit('Delete Note')}}
    {{Form::close()}}
@endsection