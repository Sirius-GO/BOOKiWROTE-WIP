<div class="card">
<div class="card-header">{{ __('Search Books') }}</div>
    <div class="card-body">
        <form class="d-flex" method="post" action="{{route('search.books')}}">
            @csrf 
            <input class="form-control me-2" type="search" name="search_books" placeholder="Search Books by Author, Genre or Book Title" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <button class="btn btn-outline-danger my-2 my-sm-0 m-2" type="submit">Clear</button>
        </form>
    </div>  
</div>