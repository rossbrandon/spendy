@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4">Welcome to Spendy</h1>
            <p class="lead">Spendy is a super simple budget and expense tracker.</p>
            <hr class="my-4">
            <p>Track expenses in your own custom budget categories and get your spending under control!</p>
            <a class="btn btn-success btn-lg" href="{{ route('dashboard') }}" role="button">Let's Get Started!</a>
        </div>
@endsection
