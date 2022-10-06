<x-admin-master>

<script>
	document.title = "Change your settings or Password - BOOKiWROTE - My Account";
</script>
@section('content')
        <h1 class="m-4">My Account</h1>
    <div class="container">
	<br>
    <div class="row">

    </div>    
    <br><br>
	<div class="card">
		<div class="card_header bg-light">
			<h3 style="padding: 10px;">Edit User Account</h3>
		</div>
		<div class="card_body" style="padding: 20px;">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><span class="fw-700">Name: </span></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><h4>{{ auth()->user()->name }}</h4></div>
		</div>
		<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><span class="fw-700">Registered Email Address: </span></div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><h4>{{ auth()->user()->email }}</h4> </div>
		</div>	
		</div>
		<div class="card_footer d-flex justify-content-evenly m-4">
		<button
				class="btn btn-primary m-2"
				data-toggle="modal"
				data-target="#UpdateDetails"
				type="button"
				name="button"> <i class="fa fa-edit"></i> Edit Account Details  
		</button>

		<button
				class="btn btn-warning pull-right m-2"
				data-toggle="modal"
				data-target="#ChangePassword"
				type="button"
				name="button"> <i class="fa fa-edit"></i> Change Password  
		</button>
		</div>
	</div>
		<br>

</div>
<br><br>

<div class="modal fade" tabindex="-1" role="dialogue" id="UpdateDetails">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
			<div class="modal-header bg-primary">
			  <h4 class="modal-title" style="color: #eee;">Update Account Holder Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('UpdateDetails.account') }}" method="post">
					{{ csrf_field()}}
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" maxlength="50" value="{{ auth()->user()->name }}" >
						<label>Email Address</label>
						<input type="email" class="form-control" name="email"  maxlength="100" value="{{ auth()->user()->email }}" >
						<input type="hidden" name="id" value="<?php echo auth()->user()->id; ?>">
						<br>
					</div>
					<input type="submit" name="submit" value="Update Account Details" class="btn btn-success">
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialogue" id="ChangePassword">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
			<div class="modal-header bg-warning">
			  <h4 class="modal-title" style="color: #333;">Permanently Change Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('ChangePassword.account') }}" method="post">
					{{ csrf_field()}}
					<div class="form-group">
						<label>Password</label>
						<input type="password" id="pass1" class="form-control" name="password" maxlength="30">
						<input type="checkbox" onclick="myFunction1()"> Show<br><br>
						<label>Confirm Password</label>
						<input type="password" id="pass2" class="form-control" name="confirm_password"  maxlength="30">
						<input type="checkbox" onclick="myFunction2()"> Show
						<input type="hidden" name="id" value="<?php echo auth()->user()->id; ?>">
						<br>
					</div>
					<input type="submit" name="submit" value="Change Password" class="btn btn-warning">
				</form>
				<script>
				function myFunction1() {
				  var x = document.getElementById("pass1");
				  if (x.type === "password") {
					x.type = "text";
				  } else {
					x.type = "password";
				  }
				}
				function myFunction2() {
				  var x = document.getElementById("pass2");
				  if (x.type === "password") {
					x.type = "text";
				  } else {
					x.type = "password";
				  }
				}
				</script>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


</x-admin-master>