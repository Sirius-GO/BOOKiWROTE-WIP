<div class="break-container">
<div class="mx-4">
    <div class="row">
    
    <div class="col-12 col-md-4 col-lg-4">
        <br>
        <h1><i class="fa fa-envelope"></i>Contact Us</h1>
        <br>
        <h4>Correspondence:</h4>
        <div style="line-height: 30px;"><i style="color: #444;" class="fa fa-map-marker"></i> <p style="font-size: 15px; display: inline;"> London House | Newport | UK  </p><br></div>
        <div style="line-height: 30px;"><i style="color: #444;" class="fa fa-envelope"></i> <p style="font-size: 15px; display: inline;"> contactus@bookiwrote.co.uk</p></div>
        <br>
    </div>
    <br>
    <div class="col-12 col-md-8 col-lg-8">
        <br>
        <div class="card">
            <div class="card card-header fw-700"><b>Contact Form</b></div>
            <div class="card card-body">
              <form action="{{ route('contact.form') }}" method="post">
                {{ csrf_field()}}
                    <input type="text" class="form-control bg-light" name="name" placeholder="Please enter your Name"><br>
                    <input type="email" class="form-control bg-light" name="email" placeholder="Please enter your Email Address"><br>
                    <textarea class="form-control bg-light" name="message" placeholder="Please enter your message"></textarea><br>
				  <input type="text" class="form-control bg-light" name="antispam" placeholder="Spam Filter: What is 5 + 9?"><br>
                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-envelope"></i> Send
                    </button>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
</div>
<div class="mx-2">
<div class="row" style="margin: -19px 5px 0px 5px; border: solid 10px rgba(0, 0, 0, 0);">
    <!-- Google Maps -->
    <div id="googleMap" style="width:100%;height:420px;"></div>
    <script>
    function myMap()
    {
    myCenter=new google.maps.LatLng(51.6721558,-3.179337);
    var mapOptions= {
        center:myCenter,
        zoom:3, scrollwheel: false, draggable: false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

    var marker = new google.maps.Marker({
        position: myCenter,
    });
    marker.setMap(map);
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM0ERWi_9VlGshhy902l6opsLkwYDWGBo&callback=myMap"></script>
</div>
</div>
</div>