{{--Solicitations Show--}}
@extends('layouts.master')

@section('title', 'Solicitation')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to("agent/{$solicitation->agent->id}/solicitations", 'Back')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{link_to("solicitation/{$solicitation->id}/edit", "{$solicitation->company} - {$solicitation->date_of}")}}</h3>
    <p>Position ({{$solicitation->term->name}}): {{$solicitation->position}}</p>
    <p>Compensation: {{$solicitation->compensation}}</p>
    <p>Requirements:</p>
    @foreach($solicitation->requirements as $requirement)
        {{--Link to requirement detail screen--}}
        <p>{{link_to("solicitations/{$solicitation->id}/requirement/{$requirement->id}", 
        "({$requirement->skill->skilltype->name}) {$requirement->skill->name} - {$requirement->experience}")}}</p>
    @endforeach
    <p>{{link_to("solicitations/{$solicitation->id}/requirement/create", 
    'Add New Requirement')}}</p>
@endsection
    