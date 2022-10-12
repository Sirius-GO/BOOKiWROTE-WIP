@extends('layouts.app2')

@section('content')


<br>
    <h1><i class="fa fa-comment"></i> Narrators</h1><br>
    <div class="row">
        @if(count($narrators)>0)
        @foreach($narrators as $n)
        <div class="col-xs-12 col-md-4 col-lg-3 d-flex justify-content-center">  
            <div class="card" style="height: 490px; width: 270px; margin: 10px;">  
                <div class="card-top-img">
                <a href="/ind_narrator/{{$n->narrator_id}}">
                    <img src="{{asset($n->image)}}" alt="{{$n->name}}" title="{{$n->name}}" class="top_img" style="height: 350px; border-bottom: 1px #ddd solid;">
                </a>
                </div>
                <div class="card-body p-4">
                    <small><b>Name: </b></small><p>{{$n->name}}</p>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a href="/ind_narrator/{{$n->narrator_id}}" class="btn btn-info btn-sm">
                        View My Narrator Page 
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @else
		<p>No Narrators Found</p>
        @endif


</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#narrators").addClass("active");
});
</script>
@endsection