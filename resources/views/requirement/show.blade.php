{{--Requirement Show--}}
@extends('layouts.master')

@section('title', 'Requirement')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to("agent/{$requirement->solicitation->agent->id}/solicitations/{$requirement->solicitation->id}", 'Back')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{link_to("solicitations/{$requirement->solicitation->id}/requirement/{$requirement->id}/edit",
    "{$requirement->skill->name} ({$requirement->experience})")}}</h3>
@endsection