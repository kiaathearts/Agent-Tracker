{{--Message Create/Edit--}}
@extends('layouts.master')

@section('title', 'Edit Message')

@section('main-nav')
    @parent
    | {{link_to('agent', 'Agents')}}
    {{link_to('message', 'Messages')}}
    {{link_to("message/{$message->id}", 'Back')}}
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
    
    <h3>Edit</h3>
    {{Form::model($message, array('url' => "/message/$message->id", 'method' => 'put'))}}
    @include('message.partials.form', ['submit' => 'Update Message'])
    <input type='submit' name='delete' value="Remove Message" >
    <input type='submit' name='cancel' value='Cancel' >
    {{Form::close()}}
@endsection