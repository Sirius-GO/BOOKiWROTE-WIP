<x-admin-master>
@section('content')

    <h1 class="m-4">Edit My Narrator Page</h1>

@if(count($narrator)>0 && request('id') != false)
@foreach($narrator as $n)
<div class="container">    
    <div class="boxes_form">
        <p class="fw-bold">All fields are required</p>
        <form action="{{ route('update.narrator', $n->narrator_id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label class="fw-bold"> Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Max 200 Characters" value="{{$n->name}}" required>   
            <label class="fw-bold"> Current Image:</label><br>
            <img src="{{asset($n->image)}}" height="100px"><br>         
			<label class="fw-bold"> My Photo: </label> (For best results use a square or portrait image 300 x 450 pixels in jpg or png format)
            <input type="file" class="form-control" name="narrator_image"> 
            <label class="fw-bold"> Voice Character:</label>
            <input type="text" name="voice_character" class="form-control" placeholder="Max 200 Characters - e.g. Assured" value="{{$n->voice_character}}" required>
			<label class="fw-bold"> Voice Quality:</label>
            <input type="text" name="voice_quality" class="form-control" placeholder="Max 200 Characters - e.g. Warm" value="{{$n->voice_quality}}" required>
			<label class="fw-bold"> Nationality:</label>
            <input type="text" name="nationality" class="form-control" placeholder="Max 200 Characters - e.g. British" value="{{$n->nationality}}" required>
			<label class="fw-bold"> Appearance:</label>
            <input type="text" name="appearance" class="form-control" placeholder="Max 200 Characters - e.g. White" value="{{$n->appearance}}" required>
			<label class="fw-bold"> Voice Age:</label>
            <input type="text" name="voice_age" class="form-control" placeholder="Max 200 Characters - e.g. - 45-60" value="{{$n->voice_age}}" required>
			<label class="fw-bold"> Singing Voice:</label>
            <input type="text" name="singing_voice" class="form-control" placeholder="Max 200 Characters - e.g. Base" value="{{$n->singing_voice}}" required>
			<label class="fw-bold"> Voice Accent:</label>
            <input type="text" name="voice_accent" class="form-control" placeholder="Max 200 Characters - e.g. American Standard, Cockney, London, Manchester" value="{{$n->voice_accent}}" required>
            <label  class="fw-bold"> Bio: </label>
            <textarea name="bio" class="form-control" placeholder="Max 5000 Characters" required>{{$n->bio}}</textarea>

            <label  class="fw-bold"> Search Keywords: </label>
            <input type="text" name="keywords" class="form-control" placeholder="Keyword search terms to help people find you. Max 1000 Characters. Please separate values with a comma (,)" value="{{$n->keywords}}" required>
            <br>
            <input type="hidden" name="id" value="{{$n->narrator_id}}">
            <input type="hidden" name="current_image" value="{{$n->image}}">
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-pencil"></i> Update Narrator Page
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
        No Narrator Page Found - To create one choose Add Narrator Page from the left-hand menu
    </div>
</div>
</div>
@endif


</div></div>
@endsection

</x-admin-master>
