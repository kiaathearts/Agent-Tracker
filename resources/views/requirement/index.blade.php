@extends('layouts.master')

@section('title', 'Requirements')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@endsection

@section('content')
    @foreach($solicitation->requirements as $requirement)
        <p>{{link_to("solicitations/{$solicitation->id}/requirements/{$requirement->id}", "{$requirement->skill->name}")}}</p>
    @endforeach
    <p>{{link_to("solicitations/{$solicitation->id}/requirements/create", 'Add New Requirement')}}</p>
@endsection