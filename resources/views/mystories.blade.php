<x-admin-master>

@section('content')

<h1 class="m-4">My Stories &amp; Poems</h1>
<div class="container">
@foreach($my_stories as $story)
<div class="col-sm-12 col-md-3 m-4">
<div class="card mt-4">
        <div class="card-img-top">
            <img src="{{asset('stories/'.$story->img)}}" class="top_img" />
        </div>
        <div class="card-body">
            <h3>{{$story->title}}</h3>
            <!-- Description:<br>{{$story->content}} -->
        </div>
        <div class="card-footer">
            Added: {{$story->created_at->diffForHumans()}}<br>
            <a href="#" class="btn btn-success btn-sm"> Edit </a>
            <a href="#" class="btn btn-danger btn-sm d-inline float-end"> Delete </a>
        </div>
    </div>
</div>
@endforeach
</div>

@endsection

</x-admin-master>