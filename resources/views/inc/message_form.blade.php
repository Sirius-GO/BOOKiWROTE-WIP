<div class="mx-4">
    <div class="row">
            <br>
        <h1><i class="fa fa-envelope"></i> Message Another User</h1><br>
<div class="container">
    <div class="col-12">
        <br>
        <div class="card">
            <div class="card card-header fw-700"><b>Message Form</b></div>
            <div class="card card-body">
              <form action="{{ route('store.message') }}" method="post">
                {{ csrf_field()}}
                    <textarea class="form-control bg-light" name="message" placeholder="Please enter your message" rows="10"></textarea><br>
				    <div class="row">
                    <div class="col-sm-12 col-md-6">
                    @if(count($recipient)>0)
                        <select name="recipient_id" class="form-select bg-light">
                        <option value="" selected>Please Select a Recipient</option>
                    @foreach($recipient as $rec)
                        <option value="{{$rec->id}}">{{$rec->id}} - {{$rec->name}}</option>
                    @endforeach
                        </select><br>
                    @else 
                        No Recipients Found - Please Log in
                    @endif
                    </div>
                    <div class="col-sm-12 col-md-6">
                    <input type="text" class="form-control bg-light" name="antispam" placeholder="Spam Filter: What is 5 + 9?"><br>
                    </div></div>
                    
                    
                    
                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-envelope"></i> Send
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

