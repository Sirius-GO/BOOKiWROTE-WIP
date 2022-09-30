@extends('layouts.app2')

@section('content')

@include('inc.contact_form')

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
   $(".active").removeClass("active");
   $("#contact").addClass("active");
});
</script>

@endsection