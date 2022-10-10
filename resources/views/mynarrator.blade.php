<x-admin-master>

@section('content')
<h1 class="m-4">Narrator Page</h1>
<div class="container">  
<div class="row">
@if(count($narrator)>0)
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
		
        @foreach ($nr->audiobooks as $as)
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
                    @if(count($authors)>0)
                    @foreach($authors as $athr)
                    <br>
                    <h6>Written By <a href="/author_page/{{$athr->id}}" style="color: #1b95cd;">{{$athr->pen_name}}</a></h6>
                    @endforeach
                    @endif
                </div>
                
            </div>
            <br><hr>
    @endforeach

    </div>    
    @if(count($authors)>0)
    <h2 style="margin-left: 15px;">My Author Collaborations</h2><br>                    
            <div class="boxes_pen" style="width: 98%; margin: 1%;"> 
                <div class="container">
                    <div class="row">
                        @foreach($authors as $ns)                    
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-3">  
                                <img src="{{asset($ns->image)}}" height="100px;" style="border: solid 1px #333;"> 
                                <div class="boxes_pen"><small>Author Name:</small><h6>{{$ns->pen_name}}</h6></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-9">           
                                <div class="boxesa" style="text-align: left;"><small>Bio:</small><h6><?php echo substr($ns->bio, 0, 250); ?>......
                                    <a href="/author_page/{{$ns->id}}" style="color: #1b95cd;"> Read More </a></h6></div>
                                <a href="/author_page/{{$ns->id}}" class="btn btn-info btn-sm" style="margin: 5px 10px 0px 10px;">
                                        View Author's Page 
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
        No Narrator Page Found - To create one choose Add Narrator Page from the left-hand menu
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






<!-- MODAL HERE -->

<div class="modal fade" tabindex="-1" role="dialog" id="create_audiobook_preview">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Add a New Audiobook</h4>
        </div>
        <div class="modal-body">

            <form action="{{ route('audiopreview.create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<?php
						$book_selection = [];
					?>
					<label>Choose Book:</label>
					@if(count($book_selection) > 0)
					<select name="book_id" id="book_id" class="form-control">
						@foreach($book_selection as $bsel)
						<option value="{{$bsel->id}}"> 
							{{$bsel->title}} by 
							<?php 
							$author_name = Author::where('id', $bsel->book_author_id)->get(); 
							if(count($author_name) > 0){
								foreach($author_name as $an){ 
									echo $an->pen_name; 
								} 
							} else {
								echo 'Unkown';
							}
							?> 
						</option>
						@endforeach
					</select>
					@endif
					<p>BOOK NOT LISTED? To create an audio preview the Author MUST first add the book.</p>
                    <label>Choose Audiobook Preview File:</label>
					<input type="file" class="form-control" name="audio_link" required> 				
					<input type="hidden" name="narrator_id" id="abk_id">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-info btn-sm"> 
                        <i class="fa fa-plus fa-lg"> </i> Add Audiobook Preview 
                    </button>
                    <button class="pull-right btn btn-warning btn-sm" data-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function createAudiobookPreview(audid){
                    var bidd = audid;
                    document.getElementById('abk_id').value = bidd; 
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="create_narrator_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Add a New Narrator Link</h4>
        </div>
        <div class="modal-body">

            <form action="{{ route('narratorlink.create') }}" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Choose Platform:</label>
					<select name="platform" id="platform" class="form-control">
						<option value="Spotlight"> Spotlight </option>
						<option value="ACX"> ACX </option>
						<option value="Stage 32"> Stage 32 </option>
						<option value="IMDb"> IMDb </option>
						<option value="Other"> Other </option>
					</select>
                    <label>Enter Link Text:</label>
					<input type="text" class="form-control" name="link_title" maxlength="150" placeholder="Link Text" required> 
                    <label>Enter Narrator Link URL:</label>
					<input type="text" class="form-control" name="link_url" maxlength="200" placeholder="Narrator Link URL" required>				
                    <input type="hidden" name="narrator_id" id="n_id">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-info btn-sm"> 
                        <i class="fa fa-plus fa-lg"> </i> Add Narrator Link 
                    </button>
                    <button class="pull-right btn btn-warning btn-sm" data-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function createNarratorLink(narid){
                    var nid = narid;
                    document.getElementById('n_id').value = nid; 
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="delete_narrator_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Delete Narrator Link</h4>
        </div>
        <div class="modal-body">

            <form action="{{ route('narrator.delete') }}" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Are you sure you want to permanently Delete this Link?</label> 
					<input type="hidden" name="id" id="nid">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-danger"> 
                        <i class="fa fa-trash"> </i> Delete Link
                    </button>
                    <button class="pull-right btn btn-primary" data-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function delLinkId(id){
                    var ntrid = id;
                      
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection


</x-admin-master>
