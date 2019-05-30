@include('frontlayouts.main_layout')
<body id="page-top">
<!-- Navigation -->
@if(session('associateId'))
    @include('frontlayouts.login_topheader')
@else
@include('frontlayouts.topheader')
@endif
<!-- Header -->
    <header class="masthead about-us-screen">
        <div class="container">
            <div class="intro-text">
      
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 offset-lg-3">

                        <div class="about-us">  
                            <div class="about-icon">
                                <img src="{{asset('/img/brick-wall.png')}}" />
                            </div>
                            <div class="about-content">
                                <h2>SCOPED</h2>
                                <h4>About us</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500</p>
                            </div>        
                        </div>                      
                    </div>
                </div>    
            </div>
        </div>
    </header>
    @include('frontlayouts.footer')
    @include('frontlayouts.include_js')
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            margin:10,
            nav:true,
           navigation:true,
            items :1,
          itemsDesktop : [1199,1],
          itemsDesktopSmall : [979,1],
          itemsTablet : [768,1],
          itemsMobile: [479,1],

           navigationText: [
             "<i class='fa fa-chevron-left'></i>",
             "<i class='fa fa-chevron-right'></i>"
            ]

        })
        $(document).ready(function() {
        $("#login-menu").removeClass('active');
        $("#aboutus-menu").addClass('active');
    });
    </script>
</body>
</html>
	