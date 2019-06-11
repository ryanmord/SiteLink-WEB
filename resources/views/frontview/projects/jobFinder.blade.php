@include('frontlayouts.main_layout')
<link href="{{asset('/css/frontCss/webmap.css')}}" rel="stylesheet">

<body id="page-top">
  <!-- Navigation -->
    @include('frontlayouts.login_topheader')
  <!-- Header -->
    <!-- Header -->
    <header class="masthead dashbord-screen">
      <div class="container">
        
            <div class="intro-text">
              @if($availableProject['status'] == 1)
                <div id="div-project">

                  <div class="col-md-12">
                    <div class="row">
                      <div class="row">
                      <div id="div-mapAvailableProject"></div>
                      <div id="div-userData"></div>

                        <div class="pac-card" id="pac-card">            
                          <div id="title">
                            Job Finder <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                          </div>
                        </div>
                        <div id="map"></div>
                          <div id="infowindow-content">
                            <div id="marker-id"></div>
                            <img src="" width="16" height="16" id="place-icon">
                            <span id="place-name"  class="title"></span><br>
                            <span id="place-address"></span>
                        </div>
                      </div>
                  </div>
                  </div>

                  <br><br><br>

                  <div class="col-md-12">
                    <div class="row">
                              
                      <!-- Nav content --> 
                      <div class="tab-content tab-detail col-md-12">
                        <div class="my-bids">
                          
                          <!-- row -->
                          <div class="row">
                            
                            <input type="text" class="form-control m-input m-input--solid" placeholder="Search here" id="generalSearch"><br> <br>
                            <input type="hidden" name="pagenumber" id="pagenumber">
                          
                            <ul class="vertical-tabs nav nav-tabs col-md-3" id="projectlist">
                              <h4>Available Jobs</h4>  
                               <div style="overflow-y: scroll;max-height: 430px; background: white;" id="project-name-list">
                              <?php $i = 1;?>
                                @foreach($availableProject['publishprojects'] as $value)
                                  @if($i == 1)
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#history1" class ="active odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                  @elseif($i %2 == 0)
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}"><a href="#history2" class ="even" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                  @else
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}"><a href="#history1" class ="odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                  @endif
                                  <?php ++$i;?>
                                @endforeach
                               
                               </div>
                               </ul>
                               
                              <!-- Nav tabs content -->
                            <div class="tab-content col-md-9" id="project_details">
                              <div id="history1" class="tab-pane active">
                                <div class="project-detail"> 
                                  
                                  <!-- ls-project -->
                                  <div class="ls-project">

                                    <!-- ls-project-address -->
                                    <div class="ls-project-address">    
                                      <div class="ls-title">
                                        <h4 id="projectname">{{ $projectdetail['projectname'] }}</h4>
                                          <span class="project-date" id="createddate">{{ $projectdetail['createddate'] }}</span>
                                          <span class="project-id" id= "projectid">{{ $projectdetail['projectid'] }}</span>
                                          <input type="hidden" name="project_id" id="project_id" value="{{ $projectdetail['project_id'] }}">
                                      </div> 
                                      <hr>
                                      <div class="ls-address">
                                        <div class="address">
                                          <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                          <strong id="siteaddress">{{$projectdetail['siteaddress']}}</strong>
                                        </div>
                                        <br><br><br>
                                        <div class="report-date" style="float: left;">
                                          <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Field</h5>
                                          <strong id="reportduedate">{{$projectdetail['reportduedate']}}</strong>
                                        </div>
                                        <div class="report-date" >
                                          <h5><i class="fa fa-calendar" aria-hidden="true"></i>On Site Date</h5>
                                          <strong id="onsitedate">{{$projectdetail['onsitedate']}}</strong>
                                        </div>
                                        <br><br><br>
                                                     <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="propertyType">{{$projectdetail['propertyType']}}</strong>
                                                      </div>
                                        <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="noOfUnits">{{$projectdetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="sqFootage">{{$projectdetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="noBuildings">{{$projectdetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="landArea">{{$projectdetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="noOfStories">{{$projectdetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="yearBuilt">{{$projectdetail['yearBuilt']}}</strong>
                                                      </div>
                                      </div>
                                    </div>
                                    <!-- ls-project-address -->

                                    <div class="ls-scope">
                                      <h5>Scope(s)</h5>    
                                      <ul><li id="scope">{{$projectdetail['scope']}}</li></ul> 
                                      <hr>   
                                      <h5>Report Template</h5>    
                                      <ul><li id="template">{{$projectdetail['template']}}</li></ul>    
                                    </div>
                                                       
                                    <div class="ls-instrucation">
                                      <h5>Special Instruction</h5>
                                      <p id="instructions">{{$projectdetail['instructions']}}</p>  
                                    </div>   
                                  
                                  </div>
                                  <!-- ls-project -->
                                  
                                  <!-- rs-project rs-history -->
                                  <div class="rs-project rs-history">
                                  @if(session('associateTypeId') != 1)
                                    <div class="rs-suggest-bid">
                                      <h4>Suggest Bid</h4>
                                      <font id="approxbid"> {{$projectdetail['approxbid']}}</font>   
                                    </div>
                                    <div class="rs-suggest-bid">
                                      <h4>Job Reach</h4>
                                        <font id="jobReach" style="font-size: 15px;">
                                          {{$projectdetail['jobReachCount']}}&nbsp People</font>   
                                       </div>
                                    <hr> 
                                    @endif 
                                     @if($projectdetail['associateTypeId'] == 1)
                                        <div class="rs-btn-bid">
                                          <a href="#" class="btn red-btn" id="acceptProject">Accept</a>
                                          <a href="#" class="btn red-btn" id="declineProject">Decline</a>
                                        </div>
                                    @else
                                    <div class="rs-make-bid">
                                      <h4>Current Bid</h4> <label id="bidstatus" style="color: #fe5f55;">{{$projectdetail['bidstatus']}}</label><br>
                                      <label>{{$projectdetail['applydate']}}</label><br>
                                      <font id="mybid"> {{$projectdetail['mybid']}}</font>   
                                    </div>
                                    <hr>  
                                    <div class="rs-make-bid">
                                      <h4>Make New Bid</h4>
                                      <i class="fa fa-usd" aria-hidden="true" style="border-color: #fe5f55; font-size: 35px;color: #fe5f55;">
                                        <input type="text" name="bid" id="bid" style="width: 140px;">
                                      </i>
                                      <p style="color: #fe5f55;" id="biderr"></p>
                                    </div>
                                                      
                                    <div class="rs-btn-bid">
                                      &nbsp;&nbsp;&nbsp;
                                      <button type="button" class="btn red-btn" id="submitbid">Submit Bid</button>
                                    </div>
                                    @endif                 
                                    <div class="rs-mr-view-profile">
                                      <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="managerprofile">View Project Manager Profile</button>
                                    </div>        
                                  </div>
                                  <!-- rs-project rs-history -->
                                
                                </div>
                              </div>
                            </div>   
                            <!-- Nav tabs content --> 
                           <div class="tab-content col-md-12" id="div-no-project"></div>
                          </div>   
                          <!-- row -->

                        </div>
                      </div>

                    </div>
                  </div>
                
                </div>
              @else
                <div class="tab-content col-md-12" >
                  <br><br><br><br><br>
                  <h2>There are no any projects available.</h2>
                </div>
              @endif
             
            </div>    
            
      </div>
    </header>


    <!-- Footer -->
    @include('frontlayouts.footer')


<!-- Manager Profile Popup -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
        <h4 class="modal-title">Project Manager Profile</h4>
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <div class="manager-picture">
        <img src="" alt="" title="" id="managerimage" style="height: 100%;width: 100%;">
        </div>
        <h4 id="managername"></h4>
        <div class="manager-contact">
            <ul>
                <li>
                    <h5>Email</h5>
                   <!--  <a href="mailto:sabastian@gmail.com">sabastian@gmail.com</a> -->
                   <p id="manageremail"></p>
                 </li>

                 <li>
                     <h5>Company</h5>
                     <p id="managercompany"></p>
                 </li>
                 <li>
                     <h5>Phone Number</h5>
                     <p id="managerphone"></p>
                 </li>
            </ul>
        </div>    
      </div>
    </div>
  </div>
</div>
   @include('frontlayouts.include_js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap" async defer></script>  
    <!-- <script src="{{asset('/js/frontJs/map.js')}}"></script> -->

    <script type="text/javascript">
      function initMap() {

        var UserLat  = '<?php echo $userData['latitude']; ?>';
        var UserLong = '<?php echo $userData['longitude']; ?>';

        var mapLayer = document.getElementById("map");
        var centerCoordinates = new google.maps.LatLng(UserLat, UserLong);
        var defaultOptions = { center: centerCoordinates, zoom: 13 }

        map = new google.maps.Map(mapLayer, defaultOptions);
        geocoder = new google.maps.Geocoder();
         
        var prev_infowindow =false; 

        <?php
          if(!empty($mapAvailableProject)) 
          {
            foreach($mapAvailableProject as $k=>$v)
            {   
        ?>  
              geocoder.geocode( { 'address': '<?php echo $mapAvailableProject[$k]["siteaddress"]; ?>' }, function(LocationResult, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  var latitude  = '<?php echo $mapAvailableProject[$k]["latitude"]; ?>';
                  var longitude = '<?php echo $mapAvailableProject[$k]["longitude"]; ?>';
                } 
                var newmarker = new google.maps.Marker({
                  position: new google.maps.LatLng(latitude, longitude),
                  map: map,
                  title: '<?php echo $mapAvailableProject[$k]["siteaddress"]; ?>'
                });
                          
                var name      = '<?php echo $mapAvailableProject[$k]['projectname'] ?>';
                var address   = '<?php echo $mapAvailableProject[$k]['siteaddress'] ?>';
                var image     = '<?php echo $mapAvailableProject[$k]['managerimage'] ?>';
                var projectid = '<?php echo $mapAvailableProject[$k]['projectid'] ?>';

                google.maps.event.addListener(newmarker, 'mouseover', function() {
                  var infoWindow = new google.maps.InfoWindow();
                  var infowindowContent = document.getElementById('infowindow-content');
                  infoWindow.setContent(infowindowContent);
                  $("#marker-id").val(projectid);
                  
                  if( prev_infowindow ) {
                    prev_infowindow.close();
                  }
                  prev_infowindow = infoWindow;
              
                  infowindowContent.children['place-icon'].src = image;
                  infowindowContent.children['place-name'].textContent    = name;
                  infowindowContent.children['place-address'].textContent = address;
                  infoWindow.open(map, this);
                });

                google.maps.event.addListener(newmarker, 'click', function(event) {
                    var id = $('#marker-id').val();
                    getProjectDetails(id);
                });
              });
        <?php
            }
          }
        ?>    
      }

    </script>

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
    </script>

    <script type="text/javascript">
      // $("#projectlist li").click(function() {
      //     var projectid = $(this).attr('id')
      //     getProjectDetails(projectid);
      //     // $("#biderr").text('');
      //     // document.getElementById("project_id").value = projectid;
        
      //     // $.ajax({
      //     //   type: 'GET',
      //     //     url: '<?php echo route('projectDetails'); ?>',
      //     //     data: {projectid:projectid},
      //     //     dataType: 'json',
      //     // })

      //     // .done(function(msg) {
      //     //  $("#projectid").text(msg.projectid);
      //     //  $("#projectname").text(msg.projectname);
      //     //  $("#createddate").text(msg.createddate);
      //     //  $("#siteaddress").text(msg.siteaddress);
      //     //  $("#reportduedate").text(msg.reportduedate);
      //     //  $("#instructions").text(msg.instructions);
      //     //  $("#template").text(msg.template);
      //     //  $("#scope").text(msg.scope);
      //     //  $("#approxbid").text(msg.approxbid);
      //     //  $("#mybid").text(msg.mybid);
      //     //  $("#onsitedate").text(msg.onsitedate);
      //   // });
      // });

        $(document).ready(function(){
          $("#login-menu").removeClass('active');
          $("#myBids-menu").addClass('active');
          document.getElementById('pagenumber').value = 1;
          $('#managerprofile').click(function(){
              var projectid = document.getElementById("project_id").value;
              $.ajax({
                  type: 'GET',
                    url: '<?php echo route('viewManagerProfile'); ?>',
                    data: {projectid:projectid},
                    dataType: 'json',
              })
              .done(function(msg) {
                 $("#managername").text(msg.managername);
                 $("#manageremail").text(msg.manageremail);
                 $("#managercompany").text(msg.managercompany);
                 $("#managerphone").text(msg.managerphone);
                 $('#managerimage').attr('src',msg.managerimage );
              });
          });
        });

        $(document).ready(function(){
          $('#submitbid').click(function(){
              var projectid = document.getElementById("project_id").value;
              var bidvalue = document.getElementById("bid").value;
              if(bidvalue == '')
              {
                $("#biderr").text('Please Enter Bid');
                $("#bid").focus();
                return false;
              }
              $.ajax({
                type: 'GET',
                  url: '<?php echo route('applyBid'); ?>',
                  data: {projectid:projectid,bidvalue:bidvalue},
                  dataType: 'json',
              })
              .done(function(msg) {
                if(msg.status == 1)
                {
                  alert(msg.message);
                  $("#mybid").text('$ '+ bidvalue);
                  document.getElementById("bid").value = '';
                }
              });
          });
        });

        $(document).ready(function () {
            //called when key is pressed in textbox
            $("#bid").keypress(function (e) {
                $("#biderr").text('');

                $('#bid').keyup(function(e) {
                  if ($(this).val().indexOf('.') == 0 || $(this).val().indexOf('0') == 0) {
                    $(this).val($(this).val().substring(1));
                  }
                });
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });

              $("#generalSearch").keyup(function () {

                  value = $(this).val();
                  document.getElementById('pagenumber').value = 1;
                  $.ajax({
                    type: "GET",
                    url: '<?php echo route('searchProject'); ?>',
                    data: {search_keyword:value},
                    dataType: 'json',
                    success: function(response){
                      if (response != "" && response['projectdetail'] != null) {
                        var projectData = response['projectdetail'];
                        $("#reportduedate").text(projectData['reportduedate']);
                        $("#instructions").text(projectData['instructions']);
                        $("#projectname").text(projectData['projectname']);
                        $("#createddate").text(projectData['createddate']);
                        $("#siteaddress").text(projectData['siteaddress']);
                        $("#onsitedate").text(projectData['onsitedate']);
                        $("#propertyType").text(projectData['propertyType)']);
                        $("#noOfUnits").text(projectData['noOfUnits']);
                        $("#noOfStories").text(projectData['noOfStories']);
                        $("#sqFootage").text(projectData['sqFootage']);
                        $("#noBuildings").text(projectData['noBuildings']);
                        $("#landArea").text(projectData['landArea']);
                        $("#yearBuilt").text(projectData['yearBuilt']);
                        $("#projectid").text(projectData['projectid']);
                        $("#approxbid").text(projectData['approxbid']);
                        var jobReachCount = projectData['jobReachCount'];
                        $("#jobReach").text(jobReachCount +' '+'People');
                        $("#bidstatus").text(projectData['bidstatus']);
                        $("#template").text(projectData['template']);
                        $("#scope").text(projectData['scope']);
                        $("#mybid").text(projectData['mybid']);

                        refreshMap(response['mapAvailableProject'],response['userData']);
                         $("#div-no-project").hide();
                        $("#projectlist").show();
                        $("#project_details").show();
                        $("#project-name-list").html("");
                        $("#project-name-list").html(response['appendLi']);
                      }
                      else{
                        $("#projectlist").hide();
                        $("#project_details").hide();
                        $("#div-no-project").show();
                        $("#div-no-project").html("<br><br><h2>No data found.</h2>");
                      }
                    }
                  });
              });
        });

        function getProjectDetails(id) {
            
            var projectid = id;
            $("#biderr").text('');
            document.getElementById("project_id").value = projectid;
          
            $.ajax({
              type: 'GET',
                url: '<?php echo route('projectDetails'); ?>',
                data: {projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
              $("li a.active").removeClass("active");
              $("#"+id).children('a').addClass("active");

              $("#projectid").text(msg.projectid);
              $("#projectname").text(msg.projectname);
              $("#createddate").text(msg.createddate);
              $("#siteaddress").text(msg.siteaddress);
              $("#reportduedate").text(msg.reportduedate);
              $("#propertyType").text(msg.propertyType);
              $("#noOfUnits").text(msg.noOfUnits);
              $("#noOfStories").text(msg.noOfStories);
              $("#sqFootage").text(msg.sqFootage);
              $("#noBuildings").text(msg.noBuildings);
              $("#landArea").text(msg.landArea);
              $("#yearBuilt").text(msg.yearBuilt);
              $("#instructions").text(msg.instructions);
              $("#template").text(msg.template);
              $("#scope").text(msg.scope);
              $("#approxbid").text(msg.approxbid);
              var jobReachCount = msg.jobReachCount;
              $("#jobReach").text(jobReachCount+' '+'People');
              $("#mybid").text(msg.mybid);
              $("#bidstatus").text(msg.bidstatus);
              $("#onsitedate").text(msg.onsitedate);
            });
        }

        $(document).on("click", "#projectlist li", function(event) {
          var projectid = $(this).attr('id');
            getProjectDetails(projectid);
        });

      function refreshMap(mapAvailableProject,userData) {

        // var userData = $("#div-userData").val();
        // var mapAvailableProject = $("#div-mapAvailableProject").val();

        console.log(mapAvailableProject);

        var UserLat  = userData['latitude'];        
        var UserLong = userData['longitude'];

        var mapLayer = document.getElementById("map");
        var centerCoordinates = new google.maps.LatLng(UserLat, UserLong);
        var defaultOptions = { center: centerCoordinates, zoom: 13 }

        map = new google.maps.Map(mapLayer, defaultOptions);
        geocoder = new google.maps.Geocoder();
         
        var prev_infowindow =false; 

            // for (var i = 0; i < mapAvailableProject.length; i++) {
              var i = 0;
              jQuery.each(mapAvailableProject, function(i, item) {

                // alert(mapAvailableProject[i]["latitude"]);

                geocoder.geocode( { 'address': mapAvailableProject[i]["siteaddress"] }, function(LocationResult, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                      var latitude  = mapAvailableProject[i]["latitude"];
                      var longitude = mapAvailableProject[i]["longitude"];
                    } 
                    
                    var newmarker = new google.maps.Marker({
                      position: new google.maps.LatLng(latitude, longitude),
                      map: map,
                      title: mapAvailableProject[i]["siteaddress"]
                    });
                          
                    var name      = mapAvailableProject[i]['projectname'];
                    var address   = mapAvailableProject[i]['siteaddress'];
                    var image     = mapAvailableProject[i]['managerimage'];
                    var projectid = mapAvailableProject[i]['projectid'];

                    google.maps.event.addListener(newmarker, 'mouseover', function() {
                      var infoWindow = new google.maps.InfoWindow();
                      var infowindowContent = document.getElementById('infowindow-content');
                      infoWindow.setContent(infowindowContent);
                      $("#marker-id").val(projectid);
                      
                      if( prev_infowindow ) {
                        prev_infowindow.close();
                      }
                      prev_infowindow = infoWindow;
                  
                      infowindowContent.children['place-icon'].src = image;
                      infowindowContent.children['place-name'].textContent    = name;
                      infowindowContent.children['place-address'].textContent = address;
                      infoWindow.open(map, this);
                    });

                    google.maps.event.addListener(newmarker, 'click', function(event) {
                        var id = $('#marker-id').val();
                        getProjectDetails(id);
                    });
                });

                // i++;
              });
            // }
      }

  </script>
  <script type="text/javascript">
      /*function loadResults() {
       var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('projectPagination'); ?>',
            data: {pagenumber:pagenumber},
            dataType: 'json',
       
        beforeSend: function(xhr) {
          $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);
        },
        success: function(data) {
            var $results = $("#projectlist");
            $(".loading").fadeOut('fast', function() {
                $(this).remove();

            });
            //var $data = $(data);
            //$data.hide();
            $("#projectlist").append(data);
            //$data.fadeIn();
            $results.removeData("loading");
        }
    });
};*/


    

    $("#project-name-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('pagenumber').value;
        var search = document.getElementById('generalSearch').value;
        var pagenumber = ++pagenumber1;
        document.getElementById('pagenumber').value = '';
        document.getElementById('pagenumber').value = pagenumber;

          //var $results = $("#projectlist");
          //var pagenumber = 1;
          $.ajax({
            type: 'GET',
            url: '<?php echo route('projectPagination'); ?>',
            data: {pagenumber:pagenumber,search_keyword:search},
            dataType: 'json',
       
              beforeSend: function(xhr) {
              /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
            },
          success: function(data) {
          if(data.status == 1)
          {
            var results = $("#project-name-list");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            /*pagenumber = pagenumber;*/
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }
          document.getElementById('pagenumber').value = '';
          document.getElementById('pagenumber').value = pagenumber;*/
            }
          });
        
       
    });

    </script>
    <script type="text/javascript">
      $('#acceptProject').click(function(){
      var projectid = document.getElementById("project_id").value;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('acceptProject'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
            if(msg.status == 1)
            {
              alert(msg.message);
              window.location.reload();
            }
            if(msg.status == 0)
            {
              alert(msg.message);
            }
        });
    }); 
     $('#declineProject').click(function(){
     var projectid = document.getElementById("project_id").value;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('declineProject'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
            if(msg.status == 1)
            {
              alert(msg.message);
              window.location.reload();
            }
            if(msg.status == 0)
            {
              alert(msg.message);
            }
        });
    }); 
    </script>
</body>
</html>