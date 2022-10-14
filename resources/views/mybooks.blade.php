<x-admin-master>
<?php
if(isset($_SERVER['REQUEST_URI'])){
    session()->put('uri', $_SERVER['REQUEST_URI']);
}
?>

@section('content')

<h1 class="m-4">My Books</h1>
    <ul class="bk-list justify-content-center">
        @foreach($my_books as $book)
            <li class="box3 col-sm-12 col-md-4 col-lg-3" style="margin-left: -15px;">
                <a href="/book_details/{{$book->id}}">
                    @if($book->deleted_at === NULL)
                        <img src="{{asset($book->c_image)}}" class="booksize3">
                    @else 
                        <img src="{{asset($book->c_image)}}" class="booksize3" style="filter: grayscale(1);">
                    @endif
                </a>
                <div class="d-flex justify-content-evenly mt-4">
                    @if($book->deleted_at === NULL)
                        <a href="{{route('edit.book', $book->id)}}" class="btn btn-success btn-sm">Edit</a>
                        <a href="/book_details/{{$book->id}}" class="btn btn-info btn-sm" >View</a>
                    @endif
                    @if($book->deleted_at === NULL)
                    <form method="POST" action="{{route('delete.book', $book->id)}}">
                        @csrf 
                        @method('delete')
                        <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                    @else 
                        <a href="{{route('book.undelete', $book->id)}}" class="btn btn-warning btn-sm">Restore</a>
                    @endif 
                </div>
                <br>
            </li>
        @endforeach
    </ul>
</div>
</div>
@endsection

</x-admin-master>

