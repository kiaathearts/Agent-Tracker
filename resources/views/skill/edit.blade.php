{{--Edit Skill--}}
@extends('layouts.master')

@section('title', 'Skill')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('skilltype', 'Skill Types')}}
    {{link_to('skill', 'Back')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    {{Form::model($skill, array('url' => "/skill/{$skill->id}", 'method' => 'put'))}}
    @include('skill.partials.form', ['skilltype_id' => $skill->skilltype->id, 'submit' => 'Update Skill'])
    <input type='submit' name='delete' value='Remove Skill'>
    <input type='submit' name='cancel' value='Cancel'>
    {{Form::close()}}
@endsection