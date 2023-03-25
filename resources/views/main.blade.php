@extends('layouts/master')

@section('title', 'Welcome')

@section('main-nav')
    @parent
    {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@stop

