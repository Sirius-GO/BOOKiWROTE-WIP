<x-admin-master>

@section('content')
<h1 class="m-4">Edit My Author Page</h1>

<br>
@if(count($author) > 0)
@foreach($author as $a)
<div class="container">
    <br>
    <div class="card p-4">
        <form action="{{ route('update.author', $a->author_id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label class="fw-bold"> Pen Name:</label>
            <input type="text" name="pen_name" class="form-control" placeholder="Max 200 Characters" value="{{$a->pen_name}}" required>
            <label class="fw-bold"> Current Image:</label><br>
            <img src="{{asset($a->image)}}" height="100px"><br>
            <label class="fw-bold"> My Photo: </label> (For best results use a portrait image 300 pixels wide by 450 pixels tall in jpeg or png format)
            <input type="file" class="form-control" name="author_image">          

            <label  class="fw-bold"> Bio: </label>
            <textarea name="bio" class="form-control" rows="6" placeholder="Max 5000 Characters" required>{{$a->bio}}</textarea>

            <label  class="fw-bold"> Search Keywords: </label>
            <input type="text" name="keywords" class="form-control" placeholder="Keyword search terms to help people find you. Max 1000 Characters. Please separate values with a comma (,)" value="{{$a->keywords}}" required>

            <label  class="fw-bold"> My Genres - Select All That Apply: </label><br>
            <div class="row">
                @if(count($genres)>0)
                @foreach($genres as $g)
                <div class="col-sm-12 col-md-6">
                    <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="{{$g->genre}}"
                    <?php if(strpos($a->genres, $g->genre) !== false){ ?> checked<?php } ?> > <label class="fw-bold">{{$g->genre}}</label><br>
                </div>
                @endforeach
                @else 
                 No Genres Found - Please contact the Web Master.
                @endif
            </div>
            <br>
            <input type="hidden" name="id" value="{{$a->author_id}}">
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-pencil"></i> Update Author Details
            </button> 
        </form>
    </div>

</div>
</div>
<br>
@endforeach
@else
<div class="container">
    <br>
    <div class="card p-4">
        No Author Found
    </div>
</div>
@endif

</div>



@endsection
</x-admin-master>