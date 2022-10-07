<div><h3>Book Selection</h3></div>
    <br>
    @if(count($books)>0)
    <div class="row">
        <div class="main">
            <ul id="bk-list" class="bk-list clearfix">
                @foreach($books as $book)
                    <li class="box col-sm-6 col-md-6" style="margin-left: -40px; margin-right: 70px;">
                        <!-- {{$book->id}}<br> -->
                        <div class="bk-book book-1 bk-bookdefault" style="margin-left: 25px;">
                            <div class="bk-front">
                            <div class="bk-cover-back"></div>
                                <div class="bk-cover">
                                    <a href="book_details/{{$book->id}}">
                                        <img src="{{asset($book->c_image)}}" class="booksize">
                                    </a>
                                </div> 
                            </div>
                            <div class="bk-page"><!-- Internal page content -->
                                <div class="bk-content bk-content-current">
                                    <h5>{{$book->title}}</h5><br>
                                    <h5>written by<br>{{$book->pen_name}}</h5>
                                    <h5>PTO...</h5>
                                </div>
                                <div class="bk-content">
                                    <p><?php echo substr($book->blurb, 0, 430); ?>...</p>
                                </div>
                            </div>
                            <div class="bk-back">
                                <p><?php echo substr($book->blurb, 0, 350); ?>...</p>
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
                        <div class="bk-info">
                            <div class="text-center">
                                <button class="bk-bookback">Blurb</button>
                                <button class="bk-bookview">Preview</button>
                                <a href="book_details/{{$book->id}}"><button class="bk-view">More</button></a>
                            </div>
                            <h3>
                                <span>{{$book->pen_name}} - <b class="price">from {{$book->pformat}}{{$book->price}}</b></span>
                                <span>{{$book->title}}</span>
                            </h3>
                            <p><?php echo substr($book->blurb, 0, 430); ?>...<br><a href="book_details/{{$book->id}}">(read more)</a></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    @else
        <p class="fs-4">No books have been found for your search term(s)<br>
        Clear the search or search for an alternative keyword or phrase</p>
        <strong>TIP! Single words or parts of words will render more results</strong>
    @endif