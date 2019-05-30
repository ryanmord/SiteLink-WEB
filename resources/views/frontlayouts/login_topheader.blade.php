<nav class="navbar navbar-expand-lg navbar-dark fixed-top " id="mainNav">
        <div class="container">
            <!-- #page-top -->
            <a class="navbar-brand js-scroll-trigger" href="{{route('home')}}"><img src="{{asset('img/front/logo.png')}}"></a>
           <!--  <ul class="navbar-nav text-uppercase ml-auto head-left">

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('aboutus')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('howitworks')}}">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('contactus')}}">Contact Us</a>
                </li>
            </ul> -->

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          MENU          <i class="fa fa-bars"></i>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto" id="login-menu">

                   <!--  <li class="nav-item responsive-1" id="aboutus-menu">
                        <a class="nav-link js-scroll-trigger" href="{{route('aboutus')}}"> About Us</a>
                    </li>

                    <li class="nav-item responsive-1" id="howitworks-menu">
                        <a class="nav-link js-scroll-trigger" href="{{route('howitworks')}}">How It Works</a>
                    </li>

                    <li class="nav-item responsive-1" id="contctus-menu">
                        <a class="nav-link js-scroll-trigger" href="{{route('contactus')}}">Contact Us</a>
                    </li> -->

                    <li class="nav-item" id="dashboard-menu">
                        <a class="nav-link js-scroll-trigger" href="{{route('associateDashboard')}}">Home</a>
                    </li>
                    <li class="nav-item" id="projects-menu">
                        <a class="nav-link js-scroll-trigger" href="{{url('/home/projects')}}">Projects</a>
                    </li>
                    <li class="nav-item" id="myBids-menu">
                        <a class="nav-link js-scroll-trigger" href="{{route('jobFinder')}}">Job Finder</a>
                    </li>
                    @if(session('associateTypeId') != 1)
                    <li class="nav-item" id="bids-menu">
                        <a class="nav-link js-scroll-trigger" href="{{ route('myBids') }}">My Bids</a>
                    </li>
                    @endif
                     <li class="nav-item" id="setting-menu">
                        <a class="nav-link js-scroll-trigger" href="#" id="a-settings">Settings</a>
                    </li>
                    <li class="nav-item" id="myProfile-menu">
                        <a class="nav-link js-scroll-trigger" href="{{url('/home/myProfile')}}">{{ucfirst(session('associateName'))}}<img src="{{asset('img/users/'.session('profileImage'))}}"></a>
                        
                    </li>
                    <li class="nav-item">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{url('/home/logout')}}">  Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
