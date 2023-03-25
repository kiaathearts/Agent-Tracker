{{--Create Requirement--}}
@extends('layouts.master')

@section('title', 'Requirement')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Message')}}
    {{link_to("solicitation/{$solicitationid}", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::open(array('url' => "requirement", 'method' => 'post'))}}
    @include('requirement.partials.form', ['skills' => $skills, 'skillid' => null, 'experience' => null, 'submit' => 'Create'])
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::hidden('solicitation_id', "{$solicitationid}")}}
    {{Form::close()}}
    
    {{link_to('skill/create', 'Create New Skill')}}
    
@endsection