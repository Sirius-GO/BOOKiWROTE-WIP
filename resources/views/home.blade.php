@extends('layouts.app2')
<?php
session()->put('uri', $_SERVER['REQUEST_URI']);
?>
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-7 col-xxl-8 mt-4">
        <div class="container">

        <!-- ============ SEARCH BOOKS =============== -->
            @include('inc.search_books')
            <br>

        <!-- ============ BOOK LISTINGS =============== -->

            @include('inc.book_listings')


        </div>
    </div>
</div>
        <!-- ============ SIDEBAR ADMIN ACCESS =============== -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxl-4 mt-4">

        @include('inc.admin_panel_access')
       
        <br>
        @include('inc.contribute')

        <br>
        @include('inc.short_stories_selection')

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#home").addClass("active");
});
</script>
@endsection

