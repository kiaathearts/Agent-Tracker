{{--Message Create/Edit--}}
@extends('layouts.master')

@section('title', 'Create Message')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
@endsection

@section('content')
    @include('notifications.error')
    @include('notifications.success')
    
    <div>
        <strong>Tag List</strong><br />
        @foreach($tags as $tag)
            <i>{{"[$tag]"}} <br /></i>
        @endforeach
    </div>

    <h3>Create New Message</h3>
    {{Form::open(array('url' => "/message", 'method' => 'post')) }}
    @include('message.partials.form', ['submit' => 'Create'])
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection