@extends('layouts.master')

@section('title', 'Terms')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to('term', 'Terms')}}
    {{link_to('skilltype', 'Skilltypes')}}
@endsection

@section('content')
    @include('notifications.success')
    @foreach($terms as $term)
        <p>{{link_to("term/{$term->id}", "{$term->name}")}}</p>
    @endforeach
    {{link_to("term/create", "Create New Term")}}
@endsection