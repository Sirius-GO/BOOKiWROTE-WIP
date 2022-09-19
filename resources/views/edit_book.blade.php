<x-admin-master>

@section('content')

<h1 class="m-4">Edit Book Advert</h1>
<div class="container">
<br>
    <div class="card p-4">
        <div class="row">

        <strong>All fields are required except Cover Image<br>
		NB! No Special characters should be used in any part of this form.</strong>
        <span class="bk-info">
            <button onclick="javascript:history.go(-1)" class="d-inline float-end">
                Go Back
            </button>
        </span>
        <form action="{{ route('store.book')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                @if(count($book) > 0)
                @foreach($book as $bk)
                <div class="col-sm-12 col-md-3 mt-4">
                    <label class="fw-bold"> Current Image: </label><br>
                    <img src="{{asset($bk->c_image)}}" height="100px">
                </div>
                <div class="col-sm-12 col-md-9 mt-4">
                    <label class="fw-bold"> Front Cover Book Image(ONLY): </label><br>
                    <small class="fw-bold">(Choose an image no greater than 500px wide in jpeg or png format.)</small>
                    <input type="file" class="form-control" name="book_image"> 
                    <input type="hidden" name="current_image" value="{{$bk->c_image}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 mt-4">
                    <label class="fw-bold"> Title: </label>
                    <input type="text" class="form-control" placeholder="Max 200 Characters - Alphanumeric Characters Only" name="title" maxlength="200" value="{{$bk->title}}" required> 
                </div>

                <div class="col-sm-12 col-md-4 mt-4">
                    <label class="fw-bold"> Genre: </label>
                    @if(count($genres) > 0)
                    @foreach($genres as $g)
                        <?php $gen = explode(",", $g->genres); ?>
                    @endforeach
                    @endif
                    <select class="form-select" name="genre" required> 
                        <option value="{{$bk->genre}}" selected>{{$bk->genre}}</option>
                        <?php $i = 0; for($i=0;$i<count($gen);$i++) { ?> 
                        <option value="<?php echo $gen[$i]; ?>"> <?php echo $gen[$i]; ?> </option>
                        <?php } ?>
                    </select>				
                </div>
			

            <div class="col-sm-12 mt-4">
                <label class="fw-bold"> Blurb: </label>
                <textarea name="blurb" class="form-control" placeholder="Max 5000 Characters" rows="6" maxlength="5000" required>{{$bk->blurb}}</textarea>
            </div>

            <div class="col-sm-12">
			    <label class="fw-bold mt-4"> Available Formats: </label>
            </div>

            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Kindle: </label><input type="checkbox" class="form-check-input m-4 cb" name="Kindle" value="Kindle"
            <?php echo (strpos($bk->available_formats, "Kindle")); if(strpos($bk->available_formats, "Kindle") !== false){ ?> checked <?php } ?> 
            >
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Paperback: </label><input type="checkbox" class="form-check-input m-4 cb" name="Paperback" value="Paperback"
            <?php echo (strpos($bk->available_formats, "Kindle")); if(strpos($bk->available_formats, "Paperback") !== false){ ?> checked <?php } ?> 
            >
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Hardback: </label><input type="checkbox" class="form-check-input m-4 cb" name="Hardback" value="Hardback"
            <?php echo (strpos($bk->available_formats, "Kindle")); if(strpos($bk->available_formats, "Hardback") !== false){ ?> checked <?php } ?> 
            >
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Audiobook: </label><input type="checkbox" class="form-check-input m-4 cb" name="Audiobook" value="Audiobook"
            <?php echo (strpos($bk->available_formats, "Kindle")); if(strpos($bk->available_formats, "Audiobook") !== false){ ?> checked <?php } ?> 
            >
            </div>
            <div class="col-sm-12 mt-4"></div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Series Name: </label>			
                <input type="text" class="form-control" placeholder="Doesn't apply? State 'None'" name="sname" maxlength="200" value="{{$bk->series_name}}" required>
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Status: </label>
                <select class="form-select" name="status" required> 
                    <option value="{{$bk->status}}" selected>{{$bk->status}}</option>
                    <option value="Available Now!"> Available Now! </option>
                    <option value="Coming Soon!"> Coming Soon! </option>
                </select>	
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> From Price: (E.g. 4.99)</label>
                <input type="text" class="form-control" name="price" placeholder="Numbers only - E.g. 4.99" maxlength="20" value="{{$bk->price}}" required> 			
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Price Format: </label>
                <select class="form-select" name="pformat" required> 
                    <option value="{{$bk->pformat}}" selected>{{$bk->pformat}}</option>
                    <option value="£"> £ - Pounds GBP</option>
                    <option value="$"> $ - US Dollars</option>
                </select>	
            </div>	
            </div>
			
            <input type="hidden" name="id" value="{{$bk->id}}">
            <br>
            <button class="btn btn-info btn-sm mt-4" type="submit">
                <i class="fa fa-book"></i> Update Book Advert
            </button> 

            @endforeach
            @endif
        </form>
    </div>
</div>

</div>
</div>
<br>



</div>
</div>

@endsection

</x-admin-master>