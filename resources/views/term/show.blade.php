@extends('layouts.master')

@section('title', 'Term')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
@endsection

@section('content')
    @include('notifications.success')
    <h3>{{link_to("term/{$term->id}/edit", $term->name)}}</h3>
    <p>{{$term->description}}</p>
@endsection