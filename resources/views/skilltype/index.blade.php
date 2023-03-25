@extends('layouts.master')

@section('title', 'Skilltypes')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
    {{link_to('skill', 'Skills')}}
@endsection

@section('content')   
    @include('notifications.success')
    @foreach($skilltypes as $skilltype)
        <p>{{link_to("skilltype/{$skilltype->id}", "$skilltype->name")}}</p>
    @endforeach
    {{link_to("skilltype/create", "Create New Skill Type")}}
@endsection