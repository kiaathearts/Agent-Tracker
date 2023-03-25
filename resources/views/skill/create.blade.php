{{--Create Skill--}}
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

    {{Form::open(array('url' => 'skill', 'method' => 'post'))}}
    @include('skill.partials.form', ['skilltype_id' => '', 'submit' => 'Create'])
    <input type='submit' name='cancel' value='Cancel'>
    {{Form::close()}}
@endsection