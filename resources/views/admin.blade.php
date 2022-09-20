<x-admin-master>

@section('content')

<h1 class="m-4">Admin Panel</h1>

<div class="container">
    <div class="row">
        <h3>Site Stats:</h3>
        <div class="col-sm-12 col-md-4">
            <div class="card p-3 mt-4 admin">
                NUMBER OF BOOKS:<hr>
                <h3>{{$books}}</h3>
            </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF STORIES & PEOMS:<hr>
                    <h3>{{$stories}}</h3>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF ARTICLES:<hr>
                    <h3>{{$articles}}</h3>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
            <div class="card p-3 mt-4 admin">
                NUMBER OF USERS:<hr>
                <h3>{{$users}}</h3>
            </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF AUTHORS:<hr>
                    <h3>{{$authors}}</h3>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF NARRATORS:<hr>
                    <h3>{{$narrators}}</h3>
                </div>
            </div>
            <h3 class="mt-4">My Stats:</h3>
            <div class="col-sm-12 col-md-4">
            <div class="card p-3 mt-4 admin">
                NUMBER OF BOOKS:<hr>
                <h3>{{$mybooks}}</h3>
            </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF STORIES & PEOMS:<hr>
                    <h3>{{$mystories}}</h3>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card p-3 mt-4 admin">
                    NUMBER OF ARTICLES:<hr>
                    <h3>{{$myarticles}}</h3>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#admin").addClass("active");
});
</script>
@endsection

</x-admin-master>