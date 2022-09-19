<x-admin-master>

@section('content')

<h1 class="m-4">Add a New Book</h1>
<div class="container">
<br>
    <div class="card p-4">
        <div class="row">

        <strong>All fields are required<br>
		NB! No Special characters should be used in any part of this form.</strong><br>

        <form action="{{ route('add.book')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12 mt-4">
                    <label class="fw-bold"> Front Cover Book Image(ONLY): </label><br>
                    <small class="fw-bold">(Choose an image no greater than 500px wide in jpeg or png format.)</small>
                    <input type="file" class="form-control" name="book_image"> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-9 mt-4">
                    <label class="fw-bold"> Title: </label>
                    <input type="text" class="form-control" placeholder="Max 200 Characters - Alphanumeric Characters Only" name="title" maxlength="200" required> 
                </div>

                <div class="col-sm-12 col-md-3 mt-4">
                    <label class="fw-bold"> Genre: </label>
                    @if(count($genres) > 0)
                    @foreach($genres as $g)
                        <?php $gen = explode(",", $g->genres); ?>
                    @endforeach
                    @endif
                    <select class="form-select" name="genre" required> 
                        <option value="" selected> Please Choose</option>
                        <?php $i = 0; for($i=0;$i<count($gen);$i++) { ?> 
                        <option value="<?php echo $gen[$i]; ?>"> <?php echo $gen[$i]; ?> </option>
                        <?php } ?>
                    </select>				
                </div>
			

            <div class="col-sm-12 mt-4">
                <label class="fw-bold"> Blurb: </label>
                <textarea name="blurb" class="form-control" placeholder="Max 5000 Characters" maxlength="5000" required></textarea>
            </div>

            <div class="col-sm-12">
			    <label class="fw-bold mt-4"> Available Formats: </label>
            </div>

            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Kindle: </label><input type="checkbox" class="form-check-input m-4 cb" name="Kindle" value="Kindle">
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Paperback: </label><input type="checkbox" class="form-check-input m-4 cb" name="Paperback" value="Paperback">
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Hardback: </label><input type="checkbox" class="form-check-input m-4 cb" name="Hardback" value="Hardback">
            </div>
            <div class="col-sm-12 col-md-3">
            <label class="fw-bold">Audiobook: </label><input type="checkbox" class="form-check-input m-4 cb" name="Audiobook" value="Audiobook">
            </div>
            <div class="col-sm-12 mt-4"></div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Series Name: </label>			
                <input type="text" class="form-control" placeholder="Doesn't apply? State 'None'" name="sname" maxlength="200" required>
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Status: </label>
                <select class="form-select" name="status" required> 
                    <option value="" selected> Please Choose </option>
                    <option value="Available Now!"> Available Now! </option>
                    <option value="Coming Soon!"> Coming Soon! </option>
                </select>	
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> From Price: </label>
                <input type="text" class="form-control" name="price" placeholder="Numbers only - E.g. 4.99" maxlength="20" required> 			
            </div>
            <div class="col-sm-12 col-md-3">
                <label class="fw-bold"> Price Format: </label>
                <select class="form-select" name="pformat" required> 
                    <option value="" selected> Please choose </option>
                    <option value="£"> £ - Pounds GBP</option>
                    <option value="$"> $ - US Dollars</option>
                </select>	
            </div>	
            </div>
			
            <br>
            <button class="btn btn-info btn-sm mt-4" type="submit">
                <i class="fa fa-book"></i> Create Book Advert
            </button> 
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