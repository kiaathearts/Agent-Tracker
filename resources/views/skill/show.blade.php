{{--Skill Show--}}
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
    <h3>{{link_to("skill/{$skill->id}/edit", "{$skill->name} ({$skill->skilltype->name})")}}</h3>
    <p>{{"{$skill->description} "}}</p>
@endsection
    