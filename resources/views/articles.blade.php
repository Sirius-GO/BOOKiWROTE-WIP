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

        <!-- ============ ARTICLES =============== -->

        @include('inc.all_articles')

        </div>
    </div>


        <!-- ============ SIDEBAR ADMIN ACCESS =============== -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxl-4 mt-4">

        @include('inc.admin_panel_access')
       
        <br>
        @include('inc.access_all_books')

        <br>
        <div class="m-4">
            @include('inc.book_selection')
        </div>

    </div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#articles").addClass("active");
});
</script>
@endsection