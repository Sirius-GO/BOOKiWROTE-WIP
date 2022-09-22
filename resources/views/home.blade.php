@extends('layouts.app')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>
@section('banner')

@endsection 

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
<div><h3>Book Listings</h3></div>
<br>
@if(count($books)>0)
<div>
<div class="container">	
{{ $books->withQueryString()->onEachSide(0)->links("pagination::bootstrap-5") }}
    <div class="main">
        <ul id="bk-list" class="row bk-list clearfix justify-content-center">
            @foreach($books as $book)
                <li class="box col-sm-12 col-md-6">
                    <!-- {{$book->id}}<br> -->
                    <div class="bk-book book-1 bk-bookdefault" style="margin-left: 30px;">
                        
                            <div class="bk-front">
                            <div class="bk-cover-back"></div>
                                <div class="bk-cover">
                                    <a href="book_details/{{$book->id}}">
                                        <img src="{{asset($book->c_image)}}" class="booksize">
                                    </a>
                                </div> 
                        </div>
                        <div class="bk-page"><!-- Internal page content -->
                            <div class="bk-content bk-content-current">
                                <h5>{{$book->title}}</h5><br>
                                <h5>written by<br>{{$book->pen_name}}</h5>
                                <h5>PTO...</h5>
                            </div>
                            <div class="bk-content">
                                <p><?php echo substr($book->blurb, 0, 430); ?>...</p>
                            </div>
                        </div>
                        <div class="bk-back">
                            <p><?php echo substr($book->blurb, 0, 350); ?>...</p>
                        </div>
                        <div class="bk-right"></div>
                        <div class="bk-left">
                            <h2><!-- spine text -->
                                <span>{{$book->pen_name}}</span>
                                <span>{{$book->title}}...</span>
                            </h2>
                        </div>
                        <div class="bk-top"></div>
                        <div class="bk-bottom"></div>
                    </div>
                    <div class="bk-info">
                        <button class="bk-bookback">Blurb</button>
                        <button class="bk-bookview">Preview</button>
                        <a href="book_details/{{$book->id}}"><button class="bk-view">Read More</button></a>
                        <h3>
                            <span>{{$book->pen_name}} - <b class="price">from {{$book->pformat}}{{$book->price}}</b></span>
                            <span>{{$book->title}}</span>
                        </h3>
                        <p><?php echo substr($book->blurb, 0, 430); ?>...<br><a href="book_details/{{$book->id}}">(read more)</a></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="d-flex justify-content-center">
    {{ $books->withQueryString()->onEachSide(0)->links("pagination::bootstrap-5") }}
    </div>
</div>
</div>
@else
    <p class="fs-4">No books have been found for your search term(s)<br>
    Clear the search or search for an alternative keyword or phrase</p>
    <strong>TIP! Single words or parts of words will render more results</strong>
@endif

<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#home").addClass("active");
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
                <a href="/admin" class="btn btn-outline-success my-2 my-sm-0 d-flex justify-content-center">  Open Administration Panel </a>
            @else 
                <a href="/login" class="btn btn-outline-success my-2 my-sm-0 d-flex justify-content-center">Please log in to access admin functions</a>
            @endif
        </div>  
    </div>
</div>
<br>
<div class="col-md-12">
    <div class="card">
    <div class="card-header">{{ __('Latest News from BOOKiWROTE') }}</div>
        <div class="card-body">
            <h2>
                Contribute to our next anthology - 
                <button class="btn btn-outline-success my-2 my-sm-0 m-2">
                    find out more!
                </button>
            </h2>
        </div>  
    </div>
</div>
<br>
<div><h3>Short Stories Selection</h3></div>
<div class="card mt-4">
    <div class="card-body">
        <h3><a href="{{route('stories')}}" class="btn btn-outline-success my-2 my-sm-0 d-flex justify-content-center">View all Short Stories & Poems</a></h3>
    </div>
</div>
@foreach($stories as $story)
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
@endforeach

@endsection

