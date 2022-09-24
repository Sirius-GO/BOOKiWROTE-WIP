<div><h3>Self-Help Articles</h3></div>
<div class="row">
@foreach($articles as $art)
    <div class="col-md-6">
        <div class="card mt-4">
            <div class="card-body" style="min-height: 180px;">
                <h3><a href="/article/{{$art->id}}" class="storylink" title="View {{$art->title}}">{{$art->title}}</a></h3>
            </div>
            <div class="card-footer">
                Added: {{$art->created_at->diffForHumans()}}<br>
                by {{$art->users->name}}
            </div>
        </div>
    </div>
@endforeach
</div>