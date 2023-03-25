{{--Show Agent--}}
@extends('layouts.master')

@section('main-nav')
    @parent
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    <img src='{{URL::to("/")."/{$agent->furi}"}}' width='150' height='200'/>
    <h3>{{link_to("agent/$agent->id/edit", "$agent->firstName $agent->lastName")}} ({{$agent->agency}})</h3>
    {{ucfirst($agent->agenttype->name)}} - ({{$agent->location}})<br />
    {{link_to("", "$agent->email")}}<br />
    {{$agent->phone}}
    
    {{--Latest Note--}}
    @if(count($agent->notes)>0)
        <p>{{link_to("agent/{$agent->id}/notes/{$agent->notes()->orderBy('created_at', 'desc')->first()->id}", 
            substr($agent->notes()->orderBy('created_at', 'desc')->first()->note, 0, 50))}}</p>
    @endif
    
    {{Form::open(array('url' => 'note', 'method' => 'post'))}}
    {{Form::hidden('agent_id', $agent->id)}}
    {{Form::label('note', 'Note')}} <br />
    {{Form::text('name', '', array('placeholder' => 'Descriptive Name Here'))}} <br />
    {{Form::textarea('note')}}<br />
    {{Form::submit('Save New Note')}}
    {{Form::close()}}
    
    <p>{{link_to("agent/{$agent->id}/notes", 'Notes')}}</p>
    
        
    @if(count($agent->solicitations)>0)
        <p>{{link_to("agent/{$agent->id}/solicitations/{$agent->solicitations()->orderBy('created_at', 'desc')->first()->id}",
        "{$agent->solicitations()->orderBy('created_at', 'desc')->first()->company}")}}</p>
    @endif
    <p>{{link_to("agent/{$agent->id}/solicitations", 'Solicitations')}}</p>
@endsection