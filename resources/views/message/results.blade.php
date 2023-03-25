{{--Message Search Results--}}

@extends('layouts.master')

@section('title', 'Search Message Results')

@section('main-nav')
    @parent
    {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Back')}}
@endsection

@section('content')
    <h3>Message Results</h3>
    @if(count($messages)>0)
        @foreach($messages as $message)
            <h4>{{$message->name}}</h4>
            {{link_to("message/{$message->id}", 'View message')}}
        @endforeach
        @else
        <h5>Sorry, no results. Modify your search and {{link_to('message', 'try again.')}}</h5>
    @endif
@endsection
    