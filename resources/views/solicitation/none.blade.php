{{--Solicitation None--}}
@extends('layouts.master')

@section('title', 'Solicitations')

@section('main-nav')
    @parent
    {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('agenttype', 'Agent Types')}}
@endsection


@section('content')
    <h3>Sorry, the solicitation you requested is not listed</h3>
@endsection