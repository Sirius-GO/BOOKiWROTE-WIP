<x-admin-master>

@section('content')

<h1 class="m-4">My Articles</h1>
<div class="row">

@foreach($my_articles as $art)
<div class="col-sm-12 col-md-3 m-4">
    <div class="card mt-4" style="min-height: 220px;">
        <div class="card-body">
            <h3>{{$art->title}}</h3>
        </div>
        <div class="card-footer">
            Added: {{$art->created_at->diffForHumans()}}<br>
            <a href="#" class="btn btn-success btn-sm"> Edit </a>
            <a href="#" class="btn btn-danger btn-sm d-inline float-end"> Delete </a>
        </div>
    </div>
</div>
@endforeach
</div>

@endsection

</x-admin-master>