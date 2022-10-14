<x-admin-master>
<?php
if(isset($_SERVER['REQUEST_URI'])){
    session()->put('uri', $_SERVER['REQUEST_URI']);
}
?>

@section('content')

<h1 class="m-4">My Stories &amp; Poems</h1>
<div class="container">
<div class="row">
@foreach($my_stories as $story)
<div class="col-sm-12 col-md-3 m-4">
<div class="card mt-4" style="margin-left: -35px;">
        @if($story->deleted_at === NULL)
        <div class="card-img-top">
            <a href="/stories/{{$story->id}}" class="storylink" title="View {{$story->title}}">
                <img src="{{asset('stories/'.$story->img)}}" class="top_img" height="200px"/>
                <figcaption>Click to read - {{ Str::limit($story->title, 30) }}</figcaption>
            </a>
        </div>
        @else 
        <div class="card-img-top">
            <img src="{{asset('stories/'.$story->img)}}" class="top_img" height="200px" style="filter: grayscale(1);"/>
        </div>
        @endif
        <div class="card-body" style="min-height: 100px;">
            <h5>{{ Str::limit($story->title, 50) }}</h5>
            <!-- Description:<br>{{$story->content}} -->
        </div>
        <span class="mx-4">
            Added: {{$story->created_at->diffForHumans()}}<br>
        </span>
        <!-- <div class="card-footer d-flex justify-content-evenly">
            
            <a href="/admin/edit_story/{{$story->id}}" class="btn btn-success btn-sm"> Edit </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#changeImage" onclick="changeImageId({{$story->id}}, `{{$story->img}}`)" class="btn btn-warning btn-sm">
                <i class="fa fa-image fa-lg"></i> Edit Image
            </a>
            <a href="#" class="btn btn-danger btn-sm d-inline float-end"> Delete </a>
        </div> -->

        <div class="card-footer d-flex justify-content-evenly">
            @if($story->deleted_at === NULL)
                <a href="/admin/edit_story/{{$story->id}}" class="btn btn-success btn-sm"> Edit </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#changeImage" onclick="changeImageId({{$story->id}}, `{{$story->img}}`)" class="btn btn-warning btn-sm">
                    <i class="fa fa-image fa-lg"></i> Edit Image
                </a>
            @endif
            @if($story->deleted_at === NULL)
            <form method="POST" action="{{route('delete.story', $story->id)}}">
                @csrf 
                @method('delete')
                <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm">
            </form>
            @else 
                <a href="{{route('story.undelete', $story->id)}}" class="btn btn-warning btn-sm">Restore</a>
            @endif 
        </div>
    </div>
</div>
@endforeach
</div></div>




<!-- MODALS HERE -->
<div class="modal fade" id="changeImage" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px; top: 5px;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: #eee; text-align: center;">Change Cover Image</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('cover.change') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <label>Change Short Story or Poem Cover Image. (Image size: 300px by 200px recommended). <br><br>Choose File:</label> 
					<input type="file" name="img" id="imgs">
					<input type="hidden" name="id" id="storyid">
                    <input type="hidden" name="current_image" id="storyimage">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <br>
                    <button class="btn btn-success"> 
                        <i class="fa fa-pencil"> </i> Confirm
                    </button>
                    <button class="pull-right btn btn-info" data-bs-dismiss="modal"> 
                        <i class="fa fa-close"> </i> Cancel 
                    </button>
                </div>
            </div>
            <script>
                function changeImageId(id, simg){
                    var stid = id;
                    var stimg = simg;
                    document.getElementById('storyid').value = stid;  
                    document.getElementById('storyimage').value = stimg;
                }
            </script>
            </form>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





@endsection



</x-admin-master>