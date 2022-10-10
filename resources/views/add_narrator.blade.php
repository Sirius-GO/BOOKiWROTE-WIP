<x-admin-master>
@section('content')

    <h1 class="m-4">Create a new Narrator Page</h1>


@if(count($narrator_check) > 0)
<br>
<div class="container">
    <br>
    <div class="card p-4">
        <h3>You cannot add another narratorr page. Only one narrator page is allowed per account. Choose 'Edit My Narrator Page' from the left-hand menu to update your existing page.</h3>
        <br>
        <h3><a href="/admin/narrator/{{auth()->user()->id}}" class="btn btn-info btn-sm">Click here to view your narrator page</a></h3>
    </div>
</div>
@else
<div class="container">    
    <div class="boxes_form">
        <p class="fw-bold">All fields are required</p>
        <form action="{{ route('add.narrator')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label class="fw-bold"> Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Max 200 Characters" required>            
			<label class="fw-bold"> My Photo: </label> (For best results use a square or portrait image 300 x 450 pixels in jpg or png format)
            <input type="file" class="form-control" name="narrator_image"> 
            <label class="fw-bold"> Voice Character:</label>
            <input type="text" name="voice_character" class="form-control" placeholder="Max 200 Characters - e.g. Assured" required>
			<label class="fw-bold"> Voice Quality:</label>
            <input type="text" name="voice_quality" class="form-control" placeholder="Max 200 Characters - e.g. Warm" required>
			<label class="fw-bold"> Nationality:</label>
            <input type="text" name="nationality" class="form-control" placeholder="Max 200 Characters - e.g. British" required>
			<label class="fw-bold"> Appearance:</label>
            <input type="text" name="appearance" class="form-control" placeholder="Max 200 Characters - e.g. White" required>
			<label class="fw-bold"> Voice Age:</label>
            <input type="text" name="voice_age" class="form-control" placeholder="Max 200 Characters - e.g. - 45-60" required>
			<label class="fw-bold"> Singing Voice:</label>
            <input type="text" name="singing_voice" class="form-control" placeholder="Max 200 Characters - e.g. Base" required>
			<label class="fw-bold"> Voice Accent:</label>
            <input type="text" name="voice_accent" class="form-control" placeholder="Max 200 Characters - e.g. American Standard, Cockney, London, Manchester" required>
            <label  class="fw-bold"> Bio: </label>
            <textarea name="bio" class="form-control" placeholder="Max 5000 Characters" required></textarea>

            <label  class="fw-bold"> Search Keywords: </label>
            <input type="text" name="keywords" class="form-control" placeholder="Keyword search terms to help people find you. Max 1000 Characters. Please separate values with a comma (,)" required>
            <br>
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-pencil"></i> Create New Narrator 
            </button> 
        </form>
    </div>

</div>
</div>
<br>
@endif


</div></div>
@endsection

</x-admin-master>
