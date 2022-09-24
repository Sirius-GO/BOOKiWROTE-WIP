<x-admin-master>

@section('content')
<h1 class="m-4">Add a new Author Page</h1>

@if(count($author_check) > 0)
<br>
<div class="container">
    <br>
    <div class="card p-4">
        <h3>You cannot add another author page. Only one author page is allowed per account. Choose 'Edit Author Profile' from the menu to update your existing page.</h3>
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

            <label class="fw-bold"> My Photo: </label> (For best results use a square or portrait image of at least 350 pixels wide and max 500 pixels wide in jpeg or png format)
            <input type="file" class="form-control" name="author_image">          

            <label  class="fw-bold"> Bio: </label>
            <textarea name="bio" class="form-control" placeholder="Max 5000 Characters" required></textarea>

            <label  class="fw-bold"> Search Keywords: </label>
            <input type="text" name="keywords" class="form-control" placeholder="Keyword search terms to help people find you. Max 1000 Characters. Please separate values with a comma (,)" required>

            <label  class="fw-bold"> My Genres - Select All That Apply: </label><br>
            <div class="row">
            <div class="col-sm-12 col-md-6">
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Arts & Photography"> <label class="fw-bold"> Arts & Photography </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Biography"> <label class="fw-bold"> Biography </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Business, Finance & Law"> <label class="fw-bold"> Business, Finance & Law </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Children's Books"> <label class="fw-bold"> Children's Books </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Comics & Graphic Novels"> <label class="fw-bold"> Comics & Graphic Novels </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Computing & Internet"> <label class="fw-bold"> Computing & Internet </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Crafts & Hobbies"> <label class="fw-bold"> Crafts & Hobbies </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Crime, Thrillers & Mystery"> <label class="fw-bold"> Crime, Thrillers & Mystery </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Education Studies & Teaching"> <label class="fw-bold"> Education Studies & Teaching </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Erotica"> <label class="fw-bold"> Erotica </label><br>
				<input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Family Saga"> <label class="fw-bold"> Family Saga </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Fiction"> <label class="fw-bold"> Fiction </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Food & Drink"> <label class="fw-bold"> Food & Drink </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Foreign Language Study & Reference"> <label class="fw-bold"> Foreign Language Study & Reference </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Health, Family & Lifestyle"> <label class="fw-bold"> Health, Family & Lifestyle </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="History"> <label class="fw-bold"> History </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Horror"> <label class="fw-bold"> Horror </label><br>
				<input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Humour"> <label class="fw-bold"> Humour</label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Lesbian, Gay, Bisexual & Transgender"> <label class="fw-bold"> Lesbian, Gay, Bisexual & Transgender </label><br>            
				</div>
				
				
            <div class="col-sm-12 col-md-6">
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Mind, Body & Spirit"> <label class="fw-bold"> Mind, Body & Spirit </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Music, Stage & Screen"> <label class="fw-bold"> Music, Stage & Screen </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Poetry, Drama & Criticism"> <label class="fw-bold"> Poetry, Drama & Criticism </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Politics, Philosophy & Social Sciences"> <label class="fw-bold"> Politics, Philosophy & Social Sciences </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Reference"> <label class="fw-bold"> Reference </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Religion & Spirituality"> <label class="fw-bold"> Religion & Spirituality </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Romance"> <label class="fw-bold"> Romance </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="School Books"> <label class="fw-bold"> School Books </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Science Fiction & Fantasy"> <label class="fw-bold"> Science Fiction & Fantasy </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Science, Nature & Math"> <label class="fw-bold"> Science, Nature & Math </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Scientific, Technical & Medical"> <label class="fw-bold"> Scientific, Technical & Medical </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Sports, Hobbies & Games"> <label class="fw-bold"> Sports, Hobbies & Games </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Travel & Holiday"> <label class="fw-bold"> Travel & Holiday </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="University Textbooks"> <label class="fw-bold"> University Textbooks </label><br>
                <input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Young Adult"> <label class="fw-bold"> Young Adult </label><br>
				<hr>
				<input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Notebooks / Journals / Diaries / Planners"> <label class="fw-bold"> Notebooks / Journals / Diaries / Planners </label><br>
				<input type="checkbox" class="cb mx-2" name="genre_check_list[]" value="Various - Anthology"> <label class="fw-bold"> Various - Anthology </label><br>
            </div>
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