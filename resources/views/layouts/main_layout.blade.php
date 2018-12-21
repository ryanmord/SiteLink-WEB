<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> Scoped </title>

  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
    @include('layouts.include_css')
</head>

<!-- Body -->
<body>
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper theme-6-active pimary-color-pink">

    <!-- Top Menu Items -->
    @include('layouts.main_topheader')
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    @include('layouts.main_sidebar')
    <!-- /Left Sidebar Menu -->
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid pt-20">

            @yield('main-content')

            <!-- Footer -->
        
            <!-- /Footer -->

        </div>
    </div>
    <!-- /Main Content -->

   @include('layouts.include_js')
   @yield('script')
</body>
<!-- /Body -->

</html>
