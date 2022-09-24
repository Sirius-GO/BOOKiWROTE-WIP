<div class="card">
<div class="card-header">{{ __('Administration Panel') }}</div>
    <div class="card-body">
        <!-- <a href="/api/bookresponse" class="btn btn-primary"> Developer API JSON Reponse </a> -->
        @if(Auth::check())
            <a href="/admin" class="btn btn-outline-success my-2 my-sm-0 d-flex justify-content-center">  Open Administration Panel </a>
        @else 
            <a href="/login" class="btn btn-outline-success my-2 my-sm-0 d-flex justify-content-center">Please log in to access admin functions</a>
        @endif
    </div>  
</div>