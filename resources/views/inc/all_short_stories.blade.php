<div><h3>Short Stories &amp; Poetry</h3></div>
<div class="row">
@foreach($stories as $story)
<div class="col-sm-12 col-md-6">
    <div class="card mt-4">
        <div class="card-img-top">
        <a href="/stories/{{$story->id}}" class="storylink" title="View {{$story->title}}">
            <img src="{{asset('stories/'.$story->img)}}" class="top_img" height="250px"/>
        </a>
        </div>
        <div class="card-body" style="min-height: 110px;">
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