@extends('layouts.app')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>

@section('content')
<div><h3>Self-Help Articles</h3></div>

<div class="row">
@foreach($articles as $art)
<div class="col-md-12">
<div class="card mt-4">
        <div class="card-top text-center">
            <h3>{{$art->title}}</h3>
        </div>
        <div class="card-body">
            
            <div class="article"><?php echo html_entity_decode($art->content); ?></div>
        </div>
        <div class="card-footer">
            Added: {{$art->created_at->diffForHumans()}}<br>
            by {{$art->users->name}}
        </div>
    </div>
</div>
@endforeach
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#articles").addClass("active");
});
</script>
@endsection


@section('sidebar')

<div><h3>Books</h3></div>
<br>
@if(count($books)>0)
<div>
<div class="container">	
{{ $books->withQueryString()->onEachSide(0)->links("pagination::bootstrap-5") }}
    <div class="main">
        <ul id="bk-list" class="bk-list clearfix justify-content-center">
            @foreach($books as $book)
                <li class="box">
                    <!-- {{$book->id}}<br> -->
                    <div class="bk-book book-1 bk-bookdefault">
                        
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
                                <h4>{{$book->title}}</h4><br>
                                <h4>written by<br>{{$book->pen_name}}</h4>
                                <h4>PTO...</h4>
                            </div>
                            <div class="bk-content">
                                <p><?php echo substr($book->blurb, 0, 430); ?>...</p>
                            </div>
                        </div>
                        <div class="bk-back">
                            <p><?php echo substr($book->blurb, 0, 557); ?>...</p>
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
</div>
</div>
@else
    <p class="fs-4">No books have been found for your search term(s)<br>
    Clear the search or search for an alternative keyword or phrase</p>
    <strong>TIP! Single words or parts of words will render more results</strong>
@endif

@endsection
