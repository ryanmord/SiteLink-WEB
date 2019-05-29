@include('frontlayouts.main_layout')
<body id="page-top">


    <!-- Navigation -->
 @if(session('associateId'))
    @include('frontlayouts.login_topheader')
@else
@include('frontlayouts.topheader')
@endif
    <!--start how it work-->
    <header class="masthead contact-us-screen">
        <div class="container">
            <h2 class="section-heading text-uppercase">HOW IT WORKS</h2>
			
			

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 offset-lg-4">

				<div class="works-part">
				
				<br><br>
					<img src="{{secure_asset('img/front/Associate.png')}}">
					<h3>Associates</h3>
					<center>
					<ul>
						<li><span>1</span>Receive Project list depending on your location.</li>
						<li><span>2</span>View Project details and Bid accordingly.</li>
						<li><span>3</span>Once your Bid is selected, you can start with the work.</li>
						<li><span>4</span>Share Live Updates to the Project Manager.</li>
						<li><span>5</span>Receive Payment after job completion. Thats it!</li>
					</ul>
					</center>
				</div>		

			
			</div>	


        </div>
    </header>


    <!--end how it work-->
    <!-- Services -->
    <!-- Footer -->
    @include('frontlayouts.footer')
    @include('frontlayouts.include_js')

</body>

</html>