{{--Skill Index--}}
@extends('layouts.master')

@section('title', 'Skill')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('skill', 'Skills')}}
    {{link_to('skilltype', 'Skill Types')}}
@endsection

@section('content')
    @include('notifications.success')
    
    @foreach($skills as $skill)
        {{link_to("skill/{$skill->id}", "$skill->name")}} <br />
    @endforeach
    
    {{link_to('skill/create', 'Create A New Skill')}}
@endsection