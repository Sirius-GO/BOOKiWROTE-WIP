@extends('layouts.app')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>

@section('content')
<div class="card">
<div class="card-header">{{ __('404 Error') }}</div>
    <div class="card-body">
        <h1>Page not found</h1>
    </div>  
</div>
<br><br><br>


@endsection
@section('sidebar')
    <div class="card">
    <div class="card-header">{{ __('Advice') }}</div>
        <div class="card-body">
            <h3>Please use the navigation menu to visit an alternative page</h3>
        </div>  
    </div>

@endsection
