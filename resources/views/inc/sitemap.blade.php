</div>
<br><br><br>
<img src="{{asset('images/book_footer_gs.png')}}" style="margin-bottom: -160px; opacity: 0.6; width: 1920px !important; height: 150px;">
<div class="sitemap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 p-4">
                    <br><br>
                    <img src="{{asset('images/bookiwrote.png')}}" class="mb-2" height="30px;">
					<h6><a href="/home" alt="home" title="home"> <i class="fa fa-home fa-lg"></i> Home </a></h6>
					<h6><a href="/all_authors" alt="Authors" title="Authors"> <i class="fa fa-book fa-lg"></i> Authors </a></h6>
					<h6><a href="/all_narrators" alt="Narrators" title="Narrators"> <i class="fa fa-comment fa-lg"></i> Narrators </a></h6>
					<h6><a href="/shortstories" alt="stories and poems" title="stories and poems"> <i class="fa fa-pencil fa-lg"></i> Stories/Poems </a></h6>
					<h6><a href="/contact" alt="Contact US" title="Contact Us"> <i class="fa fa-envelope fa-lg"></i> Contact Us </a></h6>
					<br><br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 p-4">
                    <br><br>
                    <img src="{{asset('images/bookiwrote.png')}}" class="mb-2" height="30px;">
					@if(!Auth::guest())
					<h6><a href="/admin" alt="Administration" title="Administration"> <i class="fa fa-pencil fa-lg"></i> Administration </a></h6>
					@else
					<h6 class="text-muted"><i class="fa fa-pencil fa-lg"></i> Administration</h6>
					@endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 p-4">
                    <br><br>
                    <img src="{{asset('images/bookiwrote.png')}}" class="mb-2" height="30px;">
					<h6><a href="/article/15" alt="Terms and Conditions" title="BOOKiWROTE Terms and Conditions"> <i class="fa fa-file fa-lg"></i> Terms and Conditions </a></h6>
					<h6><a href="/privacy" alt="Privacy Policy" title="Privacy Policy"> <i class="fa fa-file fa-lg"></i> Privacy Policy </a></h6>
					<h6><a href="/articles" alt="home" title="home"> <i class="fa fa-info fa-lg"></i> Self-Help Articles </a></h6>
					@if(!Auth::guest())
					<h6><a href="/admin/account/{{auth()->user()->id}}" alt="Account Settings" title="Account Settings"> <i class="fa fa-cog fa-lg"></i> Account Settings </a></h6>
					@else
						<h6 class="text-muted"><i class="fa fa-cog fa-lg"></i> Account Settings </h6>
					@endif
                </div>
            </div>
        </div>
</div>

<br><br>