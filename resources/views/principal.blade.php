@extends('layouts.template_home')

@section('head')
<title>Batalha Humano x Orc</title>
@endsection

@section('header')
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,800,500" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">
@endsection

@section('section1')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('message'))
<div class="alert alert-danger">
    <ul>{{ Session::get('message') }}</ul>
</div>
@endif
@endsection
