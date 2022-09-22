@extends('layouts.app')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">{{ __('Search Books') }}</div>
            <div class="card-body">
                <form class="d-flex" method="post" action="{{route('search.books')}}">
                    @csrf 
                    <input class="form-control me-2" type="search" name="search_books" placeholder="Search Books by Author, Genre or Book Title" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    <button class="btn btn-outline-danger my-2 my-sm-0 m-2" type="submit">Clear</button>
                </form>
            </div>  
        </div>
    </div>
</div>
<br>
<div><h3>Short Stories &amp; Poetry</h3></div>

<div class="row">
@foreach($stories as $story)
<div class="col-md-6">
<div class="card mt-4">
        <div class="card-img-top">
        <a href="/stories/{{$story->id}}" class="storylink" title="View {{$story->title}}">
            <img src="{{asset('stories/'.$story->img)}}" class="top_img" height="250px"/>
        </a>
        </div>
        <div class="card-body">
            <h3><a href="/stories/{{$story->id}}" class="storylink" title="View {{$story->title}}">{{$story->title}}</a></h3>
        </div>
        <div class="card-footer">
            Added: {{$story->created_at->diffForHumans()}}<br>
            by {{$story->users->name}}
        </div>
    </div>
</div>
@endforeach
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#stories").addClass("active");
});
</script>
@endsection


@section('sidebar')
<div class="col-md-12">
    <div class="card">
    <div class="card-header">{{ __('Administration Panel') }}</div>
        <div class="card-body">
            <!-- <a href="/api/bookresponse" class="btn btn-primary"> Developer API JSON Reponse </a> -->
            @if(Auth::check())
                <a href="/admin" class="btn btn-outline-success my-2 my-sm-0">  Open Administration Panel </a>
            @else 
                <a href="/login" class="btn btn-outline-success my-2 my-sm-0">Please log in to access admin functions</a>
            @endif
        </div>  
    </div>
</div>
<br>
<div><h3>Self-Help Articles</h3></div>
@foreach($articles as $article)
<div class="card mt-4">
        <div class="card-body" style="height:150px">
        <h3><a href="/article/{{$article->id}}" class="storylink" title="View {{$article->title}}">{{$article->title}}</a></h3>
        </div>
        <div class="card-footer">
            Added: {{$article->created_at->diffForHumans()}}<br>
        </div>
    </div>
@endforeach

@endsection
