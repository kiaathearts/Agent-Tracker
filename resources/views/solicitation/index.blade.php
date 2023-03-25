{{--Solicitation Index--}}
@extends('layouts.master')

@section('title', 'Solicitations')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agent')}}
    {{link_to('message', 'Message')}}
    {{link_to("agent/{$agent->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{$agent->firstName}} {{$agent->lastName}}</h3>
    @foreach($agent->solicitations as $solicitation)
        {{--TODO: Add "($term)" next to company--}}
        {{link_to("solicitation/{$solicitation->id}", "{$solicitation->company}")}}<br />
    @endforeach
    
    <p>{{link_to("agent/{$agent->id}/solicitations/create", 'New Solicitation')}}</p>
@endsection