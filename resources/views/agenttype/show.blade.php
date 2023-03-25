{{--Show Agent Type--}}
@extends('layouts.master')

@section('title','View - Agent Type')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
     {{link_to('message', 'Messages')}}
     {{link_to('agenttype', 'Agent Types')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    <h1>{{link_to("agenttype/$agenttype->id/edit","$agenttype->name")}}</h1>
    <p>{{$agenttype->description}}</p>
@endsection