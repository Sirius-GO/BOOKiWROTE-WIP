@extends('layouts.app')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>

@section('content')
<div><h3>Short Stories &amp; Poetry</h3></div>

<div class="row">
@foreach($stories as $story)
<div class="col-md-12">
<div class="card mt-4">
        <div class="card-top text-center">
            <h3>{{$story->title}}</h3>
        </div>
        <div class="card-body">
            
            <div class="article"><?php echo html_entity_decode($story->content); ?></div>
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
<div><h3>Self-Help Articles</h3></div>
@foreach($articles as $article)
<div class="card mt-4">
        <div class="card-body" style="height:150px">
            <h3>{{$article->title}}</h3>
        </div>
        <div class="card-footer">
            Added: {{$article->created_at->diffForHumans()}}<br>
        </div>
    </div>
@endforeach

@endsection
