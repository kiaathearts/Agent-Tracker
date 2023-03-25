{{--Agent Results--}}

@extends('layouts.master')

@section('title', 'Agent Search Results')

@section('main-nav')
    @parent
    {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Back')}}
@endsection

@section('content')
    @foreach($groups as $agent)
        <h4>{{$agent->firstName}}</h4>
    @endforeach
@endsection