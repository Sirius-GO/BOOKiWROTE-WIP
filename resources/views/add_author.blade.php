<x-admin-master>

@section('content')
<h1 class="m-4">Add a new Author Page</h1>

@if(count($author_check) > 0)
<br>
<div class="container">
    <br>
    <div class="card p-4">
        <h3>You cannot add another author page. Only one author page is allowed per account. Choose 'Edit My Author Page' from the left-hand menu to update your existing page.</h3>
        <br>
        <h3><a href="/admin/author/{{auth()->user()->id}}" class="btn btn-info btn-sm">Click here to view your author page</a></h3>
    </div>
</div>
@else
<br>
<div class="container">
    <br>
    <div class="card p-4">
        <form action="{{ route('store.author')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label class="fw-bold"> Pen Name:</label>
            <input type="text" name="pen_name" class="form-control" placeholder="Max 200 Characters" required>

            <label class="fw-bold"> My Photo: </label> (For best results use a portrait image 300 pixels wide by 450 pixels tall in jpeg or png format)
            <input type="file" class="form-control" name="author_image">          

            <label  class="fw-bold"> Bio: </label>
            <textarea name="bio" class="form-control" placeholder="Max 5000 Characters" required></textarea>

            <label  class="fw-bold"> Search Keywords: </label>
            <input type="text" name="keywords" class="form-control" placeholder="Keyword search terms to help people find you. Max 1000 Characters. Please separate values with a comma (,)" required>

            <label  class="fw-bold"> My Genres - Select All That Apply: </label><br>
            <div class="row">
                @if(count($genres)>0)
                @foreach($genres as $g)
                <div class="col-sm-12 col-md-6">
                    <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="{{$g->genre}}"> <label class="fw-bold">{{$g->genre}}</label><br>
                </div>
                @endforeach
                @else 
                 No Genres Found - Please contact the Web Master.
                @endif
            </div>
            <br>
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-pencil"></i> Create New Author 
            </button> 
        </form>
    </div>

</div>
</div>
<br>



</div>
@endif


@endsection
</x-admin-master>