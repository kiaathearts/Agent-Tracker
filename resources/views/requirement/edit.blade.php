{{--Edit Requirement--}}
@extends('layouts.master')

@section('title', 'Requirement')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Message')}}
    {{link_to("agent/{$requirement->solicitation->agent->id}/solicitations/{$requirement->solicitation->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::model($requirement, array('url' => "/requirement/{$requirement->id}", 'method' => 'put'))}}
    @include('requirement.partials.form', ['skills' => $skills, 'skillid' => $requirement->skill->id, 'submit' => 'Update'])
    <input type='submit' name='delete' value="Remove Requirement" >
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
    
    {{link_to('skill/create', 'Create New Skill')}}
@endsection