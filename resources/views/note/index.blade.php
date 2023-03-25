{{--Agent Note Index--}}
@extends('layouts.master')

@section('title', 'Agent Note')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    @if(!empty($agent))
        {{link_to("agent/$agent->id", 'Back')}}
    @endif
@endsection

@section('content')
    @include('notifications.success')
    
    @if(!empty($agent))
        <h2>Notes</h2> 
        <h3>{{$agent->firstName}} {{$agent->lastName}}</h3>
    @else
        <h3>All Notes</h3>
    @endif
    
    @foreach($notes as $note)
        {{link_to("agent/{$note->agent->id}/notes/{$note->id}", "$note->name")}} - 
            {{substr($note->created_at, 0, 11)}}<br />
    @endforeach
@endsection