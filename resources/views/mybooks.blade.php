<x-admin-master>
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>
@section('content')

<h1 class="m-4">My Books</h1>
<br>
<div>
<div class="d-flex">	
    <div class="main">
        <ul id="bk-list" class="bk-list clearfix justify-content-center">
            @foreach($my_books as $book)
                <li class="box2">
                    <div class="bk-book book-1 bk-bookdefault">
                        <div class="bk-front">
                        <div class="bk-cover-back"></div>
                            <div class="bk-cover">
                                <a href="/book_details/{{$book->id}}">
                                    @if($book->deleted_at === NULL)
                                        <img src="{{asset($book->c_image)}}" class="booksize">
                                    @else 
                                        <img src="{{asset($book->c_image)}}" class="booksize" style="filter: grayscale(1);">
                                    @endif
                                </a>
                            </div> 
                        </div>
                        <div class="bk-right"></div>
                        <div class="bk-left">
                            <h2><!-- spine text -->
                                <span>{{$book->pen_name}}</span>
                                <span>{{$book->title}}...</span>
                            </h2>
                        </div>
                        <div class="bk-top"></div>
                        <div class="bk-bottom"></div>
                    </div>
                    <div class="bk-info d-flex justify-content-evenly">
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
</div>
@endsection

</x-admin-master>

