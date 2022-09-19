@extends('layouts.app')

<?php
$uri = session()->get('uri');
?>

@section('content')

<div class="container">
    <div class="card">  
        <div class="card-body">  
            @if(count($book)>0)
            @foreach($book as $bk)
            <div class="row">
                <div class="col-xs-12">
                    <div class="card-title">
                        <h1>{{$bk->title}}</h1>
                            <span class="d-inline float-end"><a href="{{$uri}}" class="bk-info"><button>Go Back</button></a></span>
                            <small>Written By:</small>
                            <h5>{{$bk->authors->pen_name}}</h5>
                            <hr>  
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">  
                        <img src="{{asset($bk->c_image)}}" class="booksize2">
                    <div class="bk-info m-0">
                        <small>Available Formats:</small>
                        <h3>{{$bk->available_formats}}</h3>
                        <small>Series Name:</small>
                        <h3>{{$bk->series_name}}</h3>
                        <small>Genre:</small>
                        <h3>{{$bk->genre}}</h3>
                        <small>From Price:</small>
                        <h3 class="price">From {{$bk->pformat}}{{$bk->price}}</h3>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7">
                    @if(!Auth::guest())
                        @if(auth()->user()->id === $bk->user_id)
                                <a href="{{route('edit.book', $bk->id)}}" class="btn btn-warning btn-sm"> 
                                    <i class="fa fa-edit fa-lg"></i> Edit this Book Advert 
                                </a>
                            <br>
                        @endif
                    @endif
                    <div class="bk-info m-0">
                        <small>Blurb:</small>
                        <p class="blurb">{{$bk->blurb}}</p>
                        <hr>
                    </div>
                    <div class="bk-info mt-4">
                        @if($bk->status === 'Available Now!')
                            <h2>Available to buy now, via the link(s) below:</h2>
                        @elseif($bk->status === 'Coming Soon!')
                            <h2>Coming Soon! Please check again in a few days.</h2>
                        @endif
                        @if(!Auth::guest())
                            @if(auth()->user()->id === $bk->user_id)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#create_book_link" onclick="createBookLink({{$bk->id}})" class="btn btn-info btn-sm">
                                    <i class="fa fa-plus fa-lg"></i> Add a Book Purchase Link 
                                </a><br>
                            @endif
                        @endif	
                    
        <!-- List of Links Here -->
        @if(count($book_links)>0)
        @foreach($book_links as $bl)
			@if(!Auth::guest())
			@if(auth()->user()->id === $bk->user_id)
			<a href="" data-bs-toggle="modal" data-bs-target="#delete_purchase_link" onclick="delLinkId({{$bl->id}})" class="btn btn-danger btn-sm" style="color #eee; margin-top: 5px;">
				<i class="fa fa-trash fa-lg"></i> 
			</a>&nbsp;&nbsp;&nbsp;
			@endif
			@endif            
			<b>{{$bl->platform}}:</b>
            <?php if($bl->platform !== 'Look Inside'){?>
                <a href="{{$bl->book_link}}" target="_blank" class="m-2"> Buy now on {{$bl->platform}} </a>
            <?php } else { ?>
                <a href="{{$bl->book_link}}" target="_blank" class="m-2"> {{$bl->platform}} </a>            
            <?php } ?>

			<br>
        @endforeach
		@else 
			<p>No book links have been added yet - please check back later</p>
        @endif
        </div>
        </div>
                </div></div>

            @endforeach
            @endif

 <!-- =================  Audiobook ======================== -->
		<div class="container">
		<h2>Audiobook Preview</h2>
        @if(count($audiobook)> 0)
            @foreach($audiobook as $as) 
                        <div class="row">
                            <!-- <div class="col-xs-12 col-sm-12 col-md-3">
                                <img src="{{asset($as->thumb)}}" style="width: 150px; height: 200px;" class="p-2">
                            </div> -->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <h3 class="mb-4">Title: {{$as->title}}</h3>
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
                                        let music = document.getElementById("audio_player_" + el);
                                        let pp = document.getElementById("play_pause_" + el);
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
                                        let music = document.getElementById("audio_player_" + el);
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

                                <br>
                                <h6>Narrated by <a href="/narrator_page/{{$as->narrator_id}}" style="color: #1b95cd;">{{$as->narrators->name}}</a>
                                <span class="d-inline float-end"><a href="/narrator_page/{{$as->narrator_id}}" class="bk-info"><button>Read More</button></a></span></h6>


                                </div>
                            </div>
                       
                @endforeach
			@else
			@if(!Auth::guest())
				@if(auth()->user()->id === $bk->user_id)
				<a href="#" data-bs-toggle="modal" data-bs-target="#create_audiobook_preview" onclick="createAudiobookPreview({{$bk->id}})" class="btn btn-info btn-sm">
					<i class="fa fa-plus fa-lg"></i> Add an Audiobook Preview 
			</a><br>
				@endif
			@endif
			<p>There is currently no Audiobook Preview Available for this title.</p>
            @endif
		</div>
<br>

@if(count($book)>0)
@foreach($book as $f)
<div class="container">
    <div class="row">
        <h2>Share this page</h2>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4 text-center sb">
            <!-- Load Facebook SDK for JavaScript -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <!-- Your share button code -->
            <?php 
                $social_title = $f->title;
                $social_blurb = addslashes($f->blurb);
                $social_image = 'https://bookiwrote.co.uk/storage/'. $f->image;
                $social_url = 'https://bookiwrote.co.uk/book_ad/'. $f->id;
            ?>
            <div class="fb-share-button" data-href="{{$social_url}}" data-layout="button_count"></div>      
        </div>
        <div class="col-sm-12 col-md-4 text-center sb">
                <!-- LinkedIn -->
                <script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                <script type="IN/Share" data-url="{{$social_url}}"></script>  
        </div> 
        <div class="col-sm-12 col-md-4  text-center sb">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-hashtags="<?php echo str_replace(' ', '', $social_title); ?>,bookiwrote,authorworldconnect" data-show-count="false">Tweet</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
</div>
@endforeach
@endif
<br>


<!-- close div  -->
</div>
</div>


<!-- MODALS HERE -->

<div class="modal fade" tabindex="-1" role="dialog" id="create_book_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-default">
          <h4 class="modal-title">Add a Buy Now Link</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('booklink.create') }}" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Choose Platform:</label>
					<select name="platform" id="platform" class="form-select">
						<option value="Amazon"> Amazon </option>
						<option value="Audible"> Audible </option>
						<option value="Kobo"> Kobo </option>
						<option value="Barnes and Noble"> Barnes and Noble </option>
						<option value="Smashwords"> Smashwords </option>
						<option value="Website"> Website </option>
						<option value="Look Inside"> Amazon - Look Inside </option>
						<option value="Waterstones"> Waterstones </option>
						<option value="Other"> Other </option>
					</select>
                    <label>Enter Book Purchase URL:</label>
					<input type="text" class="form-control" name="book_link" maxlength="200" placeholder="Book Link URL - e.g. https://www.amazon.com/gp/product/B08412HSJ9" required>				
                    <input type="hidden" name="book_id" id="bk_id">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-info btn-sm"> 
                        <i class="fa fa-plus fa-lg"> </i> Add Buy Now Link 
                    </button>
                    <button class="pull-right btn btn-warning btn-sm" data-bs-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function createBookLink(id){
                    var bid = id;
                    document.getElementById('bk_id').value = bid; 
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="create_audiobook_preview">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add a New Audiobook</h4>
        </div>
        <div class="modal-body">

            <form action="{{ route('audiopreview.create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<?php
						$narrator_selection = [];
					?>
					<label>Choose Narrator:</label>
					@if(count($narrator_selection) > 0)
					<select name="narrator_id" id="narrator_id" class="form-control">
						@foreach($narrator_selection as $nsel)
						<option value="{{$nsel->id}}"> {{$nsel->name}} </option>
						@endforeach
						<option value="0"> Not Listed </option>
					</select>
					@endif
                    <label>Choose Audiobook Preview File:</label>
					<input type="file" class="form-control" name="audio_link" required> 				
                    <input type="hidden" name="book_id" id="abk_id">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-info btn-sm"> 
                        <i class="fa fa-plus fa-lg"> </i> Add Audiobook Preview 
                    </button>
                    <button class="pull-right btn btn-warning btn-sm" data-bs-dismiss="modal"> 
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


<div class="modal fade" tabindex="-1" role="dialog" id="delete_purchase_link">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Delete Book Purchase Link</h4>
        </div>
        <div class="modal-body">

            <form action="{{ route('booklink.delete') }}" method="post">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Are you sure you want to permanently Delete this Purchase Link?</label> 
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



@endsection

@section('sidebar')
<div class="card">
<h3 class="px-4 pt-2">All Books by this Author</h3>
<div class="container">	
{{ $other_books->withQueryString()->onEachSide(0)->links("pagination::bootstrap-5") }}
    <div class="main">
        <ul id="bk-list" class="bk-list clearfix justify-content-center">
            @foreach($other_books as $book)
                <li style="margin-bottom: -5px;">
                    <div class="bk-book book-1 bk-bookdefault">
                            <div class="bk-front">
                            <div class="bk-cover-back"></div>
                                <div class="bk-cover">
                                    <a href="/book_details/{{$book->id}}">
                                        <img src="{{asset($book->c_image)}}" class="booksize">
                                    </a>
                                </div> 
                            </div>
                        <div class="bk-right"></div>
                        <div class="bk-left">
                            <h2><!-- spine text -->
                                <span>{{$book->authors->pen_name}}</span>
                                <span>{{$book->title}}...</span>
                            </h2>
                        </div>
                        <div class="bk-top"></div>
                        <div class="bk-bottom"></div>
                    </div>
                    <div class="bk-info">
                        <h3>
                            <span style="margin-top: -50px;"><b class="price">from {{$book->pformat}}{{$book->price}}</b></span>
                            <span>{{$book->title}}</span>
                        </h3>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="d-flex justify-content-center">
    {{ $other_books->withQueryString()->onEachSide(0)->links("pagination::bootstrap-5") }}
    </div>
</div>
</div>
@endsection