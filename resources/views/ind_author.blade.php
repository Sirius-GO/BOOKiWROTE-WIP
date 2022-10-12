@extends('layouts.app2')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>
@section('content')

<h1 class="m-4">Author Page</h1>
<div class="container p-4 bg-light">
<div class="row">
@if(request('id') != 0)

@if(count($author)>0)
    @foreach($author as $atr)
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <small>Pen Name:</small>
        <h2>{{$atr->pen_name}}</h2>   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="card p-4">
            <img src="{{asset($atr->image)}}" style="width: 400px; max-width: 100%;">
        <br>
        
        <small>Genres:</small>
        <h4 class="ml-2">
            <?php 
                $genres = explode(",", $atr->genres);
                foreach($genres as $gen){
                    echo ucwords($gen).'<br>';
                } 
            ?>        
        </h4>
        </div>
        <br>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
        <div class="blurb p-4">
            <small>Bio:</small>
            <h5>{{$atr->bio}}</h5>
        </div>
        <br>
    </div>
    
    <br><hr><br>
    <div class="card p-4">
    <h2>Author Web Links</h2>

    <div class="col-xs-12 col-sm-12">
        <!-- List of Links Here -->
        @if(count($other_links)>0)
        @foreach($other_links as $bol)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <p class="fs-5">
                        <b>{{$bol->platform}}:</b>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <p class="fs-5">
                        <a href="{{$bol->other_link}}" target="_blank" style="color: #1b95cd;"> {{$bol->link_title}} </a>
                    </p>
                </div>
            </div>
            @endforeach
        @else
            <p>No attributed author links have been added yet</p>
        @endif            
    
            </div>

    <br><br> <!-- END OF MAIN DIV -->
</div>
@endforeach
@endif


        <br><hr><br>
        <div class="card p-4">
        <h2>All Listed Books by this Author</h2>
            </div>
        @foreach($books as $book)
            <span class="box3 col-sm-12 col-md-4 col-lg-3">
                <a href="/book_details/{{$book->id}}">
                    <img src="{{asset($book->c_image)}}" class="booksize3">
                </a>
                <div class="d-flex justify-content-evenly mt-4">
                    @if($book->deleted_at === NULL)
                        <a href="/book_details/{{$book->id}}" class="btn btn-info btn-sm" >View</a>
                    @endif
                </div>
                <br>
            </span>                
        @endforeach

</div>

        <br><hr><br>
        <div class="card p-4">
        <h2>Audiobook Previews</h2><br>
        @if(count($audiobook)> 0)
            @foreach($audiobook as $as) 
                    <div> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <img src="{{asset($as->thumb)}}" style="width: 60%; margin: auto;">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9">
                                <h3>Title: {{$as->title}}</h3><br>
                                <audio controls="controls" id="audio_player_{{$as->id}}" style="display: none;">
                                    <source src="{{asset($as->audio_link)}}" type="audio/mpeg" />
                                    Your browser does not support the audio element.
                                </audio>
                                <div id="audio_player_{{$as->id}}" class="audio_player">
                                    <a onclick="playAudio({{$as->id}})" style="display: inline; float: left; margin: 10px 0px 0px 10px;">
                                        <img src="{{asset('images/play.png')}}" style="height: 50px;" id="play_pause_{{$as->id}}">
                                    </a>
                                    <div id="timeline" style="display: inline;">
                                      <div id="playhead_{{$as->id}}" class="playhead"></div>
                                    </div>
                                    <div id="ttime_{{$as->id}}" style="font-size: 11px; margin-top: 20px; text-align: center;"> -- / -- </div>
                                    <div id="volume_control">
                                      <label id="rngVolume_label" for="rngVolume">Volume:</label>
                                      <input type="range" onchange="setVolume(this.value, {{$as->id}})" id="rngVolume" min="0" max="1" step="0.01" value="1">
                                    </div>
                                </div>
                                <script>                                    
                                    function playAudio(el) {
                                        var music = document.getElementById("audio_player_" + el);
                                        var pp = document.getElementById("play_pause_" + el);
                                        if (music.paused) {
                                            music.play();
                                            pp.src = "{{asset('images/pause.png')}}";
                                            //Move Playhead
                                            music.ontimeupdate = function() {movePlayHead(el)};
                                        } else {
                                            music.pause();
                                            pp.src = "{{asset('images/play.png')}}";  
                                        }
                                    }
                                    
                                    function setVolume(volume, el) {
                                    var music = document.getElementById("audio_player_" + el);
                                    music.volume = volume;
                                    }
                        
                                    function movePlayHead(el){
                                        const music = document.getElementById("audio_player_" + el);
                                        let ct = document.getElementById("ttime_" + el);
                                        let ph = document.getElementById("playhead_" + el);
                                        let dur = document.getElementById("audio_player_" + el).duration;
                                        ph.style.left = Math.round((music.currentTime / dur)*150)+'px'; 
                                        ct.innerHTML = Math.round(music.currentTime) + ' / ' + Math.round(dur);
                                    }
                                </script>
                                @if(count($author_details)>0)
                                @foreach($author_details as $athr)
                                    <br>
                                    <h6>Written By {{$athr->pen_name}}</h6>       
                                @endforeach
                                @endif
                                    @if($as->narrator_id > 0)
                                    <h6>Narrated By <a href="/ind_narrator/{{$as->narrator_id}}">{{\App\Models\Narrator::findOrFail($as->narrator_id)->name}}</a></h6> 
                                    @else 
                                    <h6>Narrated By - {{\App\Models\Narrator::findOrFail(0)->name}}</h6> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="mt-4">
                @endforeach
			@else
				<p>No Audiobook previews have been added yet</p>
            @endif
            </div>

<br> <br>
</div>

</div>
</div>
@else 
<div class="container">
    <br>
    <div class="card p-4">
        No Author Page Found
    </div>
</div>
</div>
@endif
<br><br>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#authors").addClass("active");
});
</script>
@endsection