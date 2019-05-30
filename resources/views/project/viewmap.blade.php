<html lang="en">
<head>
  <meta charset="utf-8">
  <title> {{config('app.name')}} </title>
  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
 <link href="{{asset('/css/themeCss/viewmap.css')}}" rel="stylesheet">
</head>

<!-- Body -->
<body>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="pac-card" id="pac-card" style="height: 50px">
            <div id="title">
               Site Address
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
          </div>
          <div id="map"></div>
          <div id="place-div" style="height: 0px;display: none;">
            <input id="pac-input" type="text" name="pac-input" 
              placeholder="Enter a location" style="float: left;"> 
            <button type="button" style="float: left; margin-left: 50px;" data-dismiss="modal" id="ok-btn">OK</button>
          </div>
          <div id="infowindow-content">
            <input type="hidden" name="latitude" id="latitude" value="{{ $project->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $project->longitude }}">
            <span id="place-name"  class="title">{{$project->project_name}}</span><br>
            <span id="place-address">{{$project->project_site_address}}</span>
          </div>
        </div>
      </div>
    </div>
  </div> 
</body>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap"
        async defer></script>  
<script src="{{asset('/js/themeJs/map.js')}}"></script>
</html>