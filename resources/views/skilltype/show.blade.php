@extends('layouts.master')

@section('title', 'Skill Type')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{link_to("skilltype/{$skilltype->id}/edit", $skilltype->name)}}</h3>
    <p>{{$skilltype->description}}</p>
@endsection