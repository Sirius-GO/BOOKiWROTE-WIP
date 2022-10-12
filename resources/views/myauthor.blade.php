<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>

<x-admin-master>

@section('content')

<h1 class="m-4">My Author Page</h1>
<div class="container">
<div class="row">


@if(count($author)>0 && request('id') != false)
@foreach($author as $atr)
	<?php $uid = $atr->user_id; $aid = $atr->id; ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <small>Pen Name:</small>
        <h2>{{$atr->pen_name}}</h2>   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <img src="{{asset($atr->image)}}" style="width: 400px; max-width: 100%;">
        <br>
        <small>Genres:</small>
        <h4 class="ml-2"><?php 
                $genres = explode(",", $atr->genres);
                foreach($genres as $gen){
                    echo ucwords($gen).'<br>';
                } 
            ?>        
        </h4>
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
            <h2>My Author Web Links</h2>
			@if(!Auth::guest())
				@if(auth()->user()->id == $uid)
                <div>
                    <a href="#" data-toggle="modal" data-target="#create_author_link" onclick="createAuthorLink({{$aid}})" class="btn btn-info btn-sm">
                        <i class="fa fa-plus fa-lg"></i> Add an Author Web Link
                    </a>
                </div>
                <br>
				@endif
			@endif	
            <div class="col-xs-12 col-sm-12">
                <!-- List of Links Here -->
                @if(count($other_links)>0)
                    @foreach($other_links as $bol)
                    <div class="row boxesa">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <p class="fs-5">
								<b>{{$bol->platform}}:</b>
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9">
                            <p class="fs-5">
                                @if(!Auth::guest())
                                    @if(auth()->user()->id === $bol->user_id)
                                    <a href="" data-toggle="modal" data-target="#delete_author_link" onclick="delLinkId({{$bol->id}})" class="btn btn-danger btn-sm" style="color #eee; margin-top: 5px;">
                                        <i class="fa fa-trash fa-lg"></i> 
                                    </a>
                                    @endif
								@endif
								<a href="{{$bol->other_link}}" target="_blank" style="color: #1b95cd;"> {{$bol->link_title}} </a>
 	
                            </p>
                        </div>
                    </div>
                    @endforeach
				@else
					<p>No attributed author links have been added yet</p>
                @endif            
            


            <br><br> <!-- END OF MAIN DIV -->
        </div>
    @endforeach

        <br><hr><br>
        <h2>My Books</h2>
        @foreach($books as $book)
            <span class="box3 col-sm-12 col-md-4 col-lg-3" style="margin-left: -15px;">
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
        <h2>My Audio Book Previews</h2><br>
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
                                    @if($as->narrator_id > 0)
                                        <h6>Narrated By <a href="/ind_narrator/{{$as->narrator_id}}">{{\App\Models\Narrator::findOrFail($as->narrator_id)->name}}</a></h6> 
                                    @else 
                                        <h6>Narrated By - {{\App\Models\Narrator::findOrFail($as->narrator_id)->name}}</h6> 
                                    @endif
                                @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                        <hr class="mt-4">
                @endforeach
			@else
				<p>No Audiobook previews have been added yet</p>
            @endif
    

<br> <br>
</div>

</div>
</div>

@else 
<div class="container">
    <br>
    <div class="card p-4">
        No Author Page Found - To create one choose Add Author Page from the left-hand menu
    </div>
</div>
</div>
@endif
<br><br>

<!-- MODALS HERE -->

<div class="modal fade" tabindex="-1" role="dialog" id="create_author_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Add a New Author Link</h4>
        </div>
        <div class="modal-body">

            <form action="#" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Choose Platform:</label>
					<select name="platform" id="platform" class="form-control">
						<option value="Author Central UK"> Author Central UK </option>
						<option value="Author Central US"> Author Central US </option>
						<option value="Author World Connect"> Author World Connect </option>
						<option value="Bookbub"> Bookbub </option>
						<option value="Facebook Page"> Facebook Page </option>
						<option value="Facebook Page 2"> Facebook Page 2 </option>
						<option value="Facebook Page 3"> Facebook Page 3 </option>
						<option value="LinkedIn"> LinkedIn </option>
						<option value="Twitter"> Twitter </option>
						<option value="Goodreads"> Goodreads </option>
						<option value="Website"> Website </option>
						<option value="Blog Page"> Blog Page </option>
						<option value="Other"> Other </option>
					</select>
                    <label>Enter Link Display Text:</label>
					<input type="text" class="form-control" name="link_title" maxlength="150" placeholder="Display Text - e.g. Click here to view my profile" required> 
                    <label>Enter Author Link URL:</label>
					<input type="text" class="form-control" name="link_url" maxlength="200" placeholder="Author Link URL - e.g. https://www.amazon.com/Rowan-Grey/e/B08HVJPSMC" required>				
                    <input type="hidden" name="author_id" id="bk_id">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-info btn-sm"> 
                        <i class="fa fa-plus fa-lg"> </i> Add Author Link 
                    </button>
                    <button class="pull-right btn btn-warning btn-sm" data-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function createAuthorLink(id){
                    var bid = id;
                    document.getElementById('bk_id').value = bid; 
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="delete_author_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Delete Author Link</h4>
        </div>
        <div class="modal-body">

            <form action="#" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Are you sure you want to permanently Delete this Link?</label> 
					<input type="hidden" name="id" id="bookid">
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
                    var bkid = id;
                    document.getElementById('bookid').value = bkid;  
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</div>

@endsection

</x-admin-master>