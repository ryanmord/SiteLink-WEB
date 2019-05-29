@include('frontlayouts.main_layout')
<body id="page-top">
<!-- Navigation -->
@if(session('associateId'))
    @include('frontlayouts.login_topheader')
@else
@include('frontlayouts.topheader')
@endif

 <!-- Header -->
    <header class="masthead contact-us-screen">
        <div class="container">
            <div class="intro-text">
      
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

                        <div class="about-us">
                            <div class="about-icon">
                             <img src="{{secure_asset('img/front/phone.jpg')}}" />
                            </div>
                            <div class="contact-content">
                                <h2>Contact us @</h2>
                                <ul>
                                    <li>+1 9154361324</li>
                                    <li>+1 9154361324</li>        
                                </ul>
                            </div>        
                        </div>                        

                    </div>
                    
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

                        <div class="about-us">
                            <div class="about-icon">
                             <img src="{{secure_asset('img/front/map.jpg')}}" />
                            </div>
                            <div class="contact-content">
                                <h2>Our Office Address </h2>
                                <ul>
                                    <li>123 Main Street, Chaska MN, 55318 Main Street</li>
                                </ul>
                            </div>        
                        </div>                        

                    </div>
                 
                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">

                        <div class="about-us">
                            <div class="about-icon">
                                <img src="{{secure_asset('img/front/mail.jpg')}}" />
                            </div>
                            <div class="contact-content">
                                <h2>Our Email Address </h2>
                                <ul>
                                    <li><a href="mailto:www.project@bidding.com">www.project@bidding.com</a></li>
                                    <li><a href="mailto:www.associate@manager.com">www.associate@manager.com</a></li>
                                </ul>
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
        $('.owl-carousel').owlCarousel(
        {
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
        $("#contactus-menu").addClass('active');
    });
    </script>
</body>
</html>