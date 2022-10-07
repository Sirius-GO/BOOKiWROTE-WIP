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
            <figcaption>Click to read - {{ Str::limit($story->title, 30) }}</figcaption>
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