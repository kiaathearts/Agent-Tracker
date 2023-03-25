@extends('layouts.email_layouts.master')

@section('header')
    @parent
@endsection

@section('content')
    @if(isset($content))
        <p>{{$content}}</p>
    @else
        <p>This is some test email conent.</p>
    @endif
@endsection