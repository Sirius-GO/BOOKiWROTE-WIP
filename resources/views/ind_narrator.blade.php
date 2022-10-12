@extends('layouts.app2')

@section('content')
<h1 class="m-4">Narrator Page</h1>
<div class="container p-4 bg-light">  
<div class="row">
@if(count($narrator)>0 && request('id') != 0)
@foreach($narrator as $nr)
	<?php $nid = $nr->user_id; $nida = $nr->narrator_id; ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 titlebox">
        <small>Narrator Name:</small>
        <h2>{{$nr->name}}</h2>   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

            <center>    
                <img src="{{asset($nr->image)}}" style="width: 400px; max-width: 100%;">
            </center>
        <br>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
        <div class="blurb">
        <small style="margin-left: -35px;">Bio:</small>
        <h4>{{$nr->bio}}</h4>
        </div>
        <br>
        <h2>Find out more about me, via the link(s) below:</h2>
		@if(!Auth::guest())
		@if($nid == auth()->user()->id)
			<a href="#" data-toggle="modal" data-target="#create_narrator_link" onclick="createNarratorLink({{$nida}})" class="btn btn-info btn-sm">
				<i class="fa fa-plus fa-lg"></i> Add a Narrator Link
			</a><br>   
		@endif
		@endif
		<!-- List of Links Here -->
         
        @if(count($nr->nlinks)>0)
        @foreach ($nr->nlinks as $nl)
            <br>

            <h4>
				<b>{{$nl->platform}}:</b> <a href="{{$nl->link}}" target="_blank" style="color: #1b95cd;"> {{$nl->link_title}} </a>
				@if(!Auth::guest())
                    @if(auth()->user()->id === $nid)
                        &nbsp;&nbsp;&nbsp;
                        <a href="" data-toggle="modal" data-target="#delete_narrator_link" onclick="delLinkId({{$nl->id}})" class="btn btn-danger btn-sm" style="color #eee; margin-top: 5px;">
                            <i class="fa fa-trash fa-lg"></i> 
                        </a>
                    @endif
				@endif
			</h4>
        @endforeach
        @endif
	</div>	
	<div class="col-sm-12"> <br><hr></div>
	
	<div class="col-sm-12 col-md-6">
		<small>Voice Character:</small>
        <h4>{{$nr->voice_character}}</h4>
        <small>Voice Quality:</small>
        <h4>{{$nr->voice_quality}}</h4>
        <small>Voice Age:</small>
        <h4>{{$nr->voice_age}}</h4>
        <small>Apperance:</small>
        <h4>{{$nr->appearance}}</h4>
	</div>
	<div class="col-sm-12 col-md-6">
        <small>Singing Voice:</small>
        <h4>{{$nr->singing_voice}}</h4>
        <small>Nationality:</small>
        <h4>{{$nr->nationality}}</h4>
		<small>Voice Accent:</small>
        <h4>{{$nr->voice_accent}}</h4>
	</div>

@if(count($nr->audiobooks)>0)    
	<div class="col-sm-12"> <hr><br></div>
   
	<div class="col-sm-12">
        <h2>My Audio Book Previews</h2><br>
		@if(!Auth::guest())
			@if(auth()->user()->id === $nid)
				<a href="#" data-toggle="modal" data-target="#create_audiobook_preview" onclick="createAudiobookPreview({{$nida}})" class="btn btn-info btn-sm">
					<i class="fa fa-plus fa-lg"></i> Add an Audiobook Preview 
				</a><br>
			@endif
		@endif
		
        @foreach($nr->audiobooks as $as)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 mt-4">
                    <img src="{{asset($as->thumb)}}" style="height: 180px;">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <br><h3>Title: {{$as->title}}</h3>
                    <audio controls="controls" id="audio_player_{{$as->id}}" style="display: none;">
                        <source src="{{asset($as->audio_link)}}" type="audio/mpeg" />
                        Your browser does not support the audio element.
                    </audio>
                    <div id="audio_player_{{$as->id}}" class="audio_player">
                        <a onclick="playAudio({{$as->id}})" style="display: inline; float: left; margin: 10px 0px 0px 10px;">
                            <img src="{{asset('/images/play.png')}}" style="height: 50px;" id="play_pause_{{$as->id}}">
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
                                pp.src = "{{asset('/images/pause.png')}}";
                                //Move Playhead
                                music.ontimeupdate = function() {movePlayHead(el)};
                            } else {
                                music.pause();
                                pp.src = "{{asset('/images/play.png')}}";  
                            }
                        }
                        
                        function setVolume(volume, el) {
                        var music = document.getElementById("audio_player_" + el);
                        music.volume = volume;
                        }
            
                        function movePlayHead(el){
                            var music = document.getElementById("audio_player_" + el);
                            var ct = document.getElementById("ttime_" + el);
                            var ph = document.getElementById("playhead_" + el);
                            var dur = document.getElementById("audio_player_" + el).duration;
                            ph.style.left = Math.round((music.currentTime / dur)*150); 
                            ct.innerHTML = Math.round(music.currentTime) + ' / ' + Math.round(dur);
                        }
                    </script>
                        <br>
                        <h6>Written By <a href="/author_page/{{$as->author_id}}" style="color: #1b95cd;">{{\App\Models\Author::findOrFail($as->author_id)->pen_name}}</a></h6>
                </div>
                
            </div>
            <br><hr>
    @endforeach
    
    </div>
  
@endif   

    @if(count($author_collabs)>0)
    <h2 style="margin-left: 15px;">My Author Collaborations</h2><br>                    
            <div class="boxes_pen" style="width: 98%; margin: 1%;"> 
                <div class="container">
                    <div class="row">
                        @foreach($author_collabs->unique('author_id') as $ns)                    
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-3">  
                                <img src="{{asset($ns->image)}}" height="100px;" style="border: solid 1px #333;"> 
                                <div class="boxes_pen"><small>Author Name:</small><h6>{{$ns->pen_name}}</h6></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-9">           
                                <div class="card"><small>Bio:</small><h6><?php echo substr($ns->bio, 0, 250); ?>......
                                    <a href="/ind_author/{{$ns->author_id}}" style="color: #1b95cd;"> Read More </a></h6></div>
                                <a href="/ind_author/{{$ns->author_id}}" class="btn btn-info btn-sm mt-2">
                                    View Authors Page 
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>                  
    @endif


        <br><br> <!-- END OF MAIN DIV -->


@endforeach

@else 
<div class="container">
    <br>
    <div class="card p-4">
        No Narrator Page Found
    </div>
</div>
</div>
@endif
<br><br>


</div>
<br><br>

</div>


</div>
</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#narrators").addClass("active");
});
</script>
@endsection
