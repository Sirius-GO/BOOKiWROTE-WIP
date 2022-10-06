@extends('layouts.app2')

@section('content')


<br>
    <h1><i class="fa fa-book"></i> Authors</h1><br>
    <div class="row">
        @if(count($authors)>0)
        @foreach($authors as $atr)
        <div class="col-xs-12 col-md-4 col-lg-3 d-flex justify-content-center">  
            <div class="card" style="height: 490px; width: 270px; margin: 10px;">  
                <div class="card-top-img">
                <a href="/ind_author/{{$atr->user_id}}">
                    <img src="{{asset($atr->image)}}" alt="{{$atr->pen_name}}" title="{{$atr->pen_name}}" class="top_img" style="height: 350px; border-bottom: 1px #ddd solid;">
                </a>
                </div>
                <div class="card-body p-4">
                    <small><b>Pen Name: </b></small><p>{{$atr->pen_name}}</p>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a href="/ind_author/{{$atr->user_id}}" class="btn btn-info btn-sm">
                        View My Author Page 
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @else
		<p>No Authors Found</p>
        @endif


</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#authors").addClass("active");
});
</script>
@endsection