@include('frontlayouts.main_layout')
<body id="page-top">


    <!-- Navigation -->
 @if(session('associateId'))
    @include('frontlayouts.login_topheader')
@else
@include('frontlayouts.topheader')
@endif
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text home-text">
                <div class="intro-heading text-uppercase">BUILD YOUR DREAM HOME</div>
                <div class="intro-lead-in">Professionals, here to help</div>
               
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="{{ route('AssociateLogin') }}">Signin as Associate</a>
                <div class="download-here">Download The App Here</div>
                <div class="col-sm-6 qr-code qr-left">
                     <a href="javascript:void(0);"><img src="{{asset('img/front/android.png')}}"></a>
                 
                </div>
                <div class="col-sm-6  qr-code">
                    <a href="javascript:void(0);"> <img src="{{asset('img/front/ios.png')}}">
                    </a>
                
                </div>
            </div>
        </div>
    </header>
    <!-- Services -->
    <!-- Footer -->
    @include('frontlayouts.footer')
    @include('frontlayouts.include_js')

</body>

</html>