<x-admin-master>

@section('content')

<div class="mx-4">
    <div class="row">
            <br>
        <h1><i class="fa fa-envelope"></i> Reply to Message</h1><br>
<div class="container">
    <div class="col-12">
        <br>
        <div class="card">
            <div class="card card-header fw-700"><b>Reply Message Form</b></div>
            <div class="card card-body">
              <form action="{{ route('reply') }}" method="get">
                {{ csrf_field()}}
                    <textarea class="form-control bg-light" id="textString" name="message" placeholder="Please enter your reply" rows="10">
                        @if(strlen($original_message)>0)
                            {{$original_message}}
                            >>>>> Reply:
                        @endif
                    </textarea><br>  
                    <input type="hidden" name="original_message" value="{{$original_message}}">         
                    <input type="hidden" name="rid" value="{{$rid}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    
                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-envelope"></i> Reply
                    </button>
                </form>
                <br>
<small class="fw-bold">(Your message will be available for the user the next time they log in, via Admin. All users can choose whether or not they wish to be notified via email.)</small>
            </div>
        </div>
        <br>
    </div>
</div>
</div>
</div>
</div></div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script language="javascript" type="text/javascript">

	s = document.getElementById("textString").value;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	document.getElementById("textString").value = s;
    t = document.getElementById("textString");
    t.selectionStart = t.selectionEnd = t.value.length;
    t.blur();
    t.focus();


</script>
@endsection
</x-admin-master>