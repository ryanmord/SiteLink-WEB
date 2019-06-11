@include('frontlayouts.main_layout')


<body id="page-top">
  <!-- Navigation --> 
  @include('frontlayouts.login_topheader')
  <!-- Header -->
  <header class="masthead dashbord-screen">
     <div class="container">
        <div class="intro-text">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <!-- Nav content --> 
                <ul class="horizontal-tabs nav col-md-10" id="leftTabs">
                  <li id="active-bids" style="margin-left: 180px;">
                    <a href="#active_tab" class="active" data-toggle="tab"> 
                      <img src={{asset('img/front/icon1.png')}} alt="" />Active Bids
                    </a>     
                  </li>
                  <li id="history-bids">
                    <a href="#history_tab" data-toggle="tab">
                      <img src={{asset('img/front/icon3.png')}} alt="" />Bid History
                    </a>
                  </li>
                </ul>
                <div class="tab-content tab-detail col-md-12">
                  <div class="tab-pane active" id="active_tab">
                    <div class="my-bids">
                      @if($activeBidProject['status'] == 1)
                        <div class="row">
                          <input type="text" class="form-control m-input m-input--solid" placeholder="Search here" id="a_generalSearch"><br> <br>
                          <input type="hidden" name="active_pagenumber" id="active_pagenumber">
                          @if($activeBidProject['mybids'])
                             <!-- Nav tabs -->
                            <ul class="nav nav-tabs vertical-tabs col-md-3" id="active-projects">
                              <h4>Active Bid Jobs <!-- <i class="fa fa-refresh" aria-hidden="true"></i> --></h4> 
                              <div style="overflow-y: scroll;max-height: 430px; background: white;" id="active-project-list"> 
                                <?php $i = 1;?>
                                @foreach($activeBidProject['mybids'] as $value)
                                  @if($i == 1)
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#activeProjectDetail" class ="active odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                  @elseif($i %2 == 0)
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#history2" class ="even" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                  @else
                                    <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#history3" class ="odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                  @endif
                                  <?php ++$i;?>
                                @endforeach
                              </div>
                            </ul>
                          @endif
                          <!-- Nav tabs content -->
                          <div class="tab-content col-md-9" id="div-project">
                            <div id="activeProjectDetail" class="tab-pane active">
                              <div class="project-detail">
                                <div class="ls-project">
                                  <div class="ls-project-address">    
                                    <div class="ls-title">
                                      <h4 id="active-projectname">{{$activeProjectDetail['projectname']}}</h4>
                                      <span class="project-date" id="active-createddate">{{$activeProjectDetail['createddate']}}</span>
                                      <span class="project-id" id="active-projectid">{{$activeProjectDetail['projectid']}}</span>
                                      <input type="hidden" id="active-project-id" name="active-project-id" value="{{ $activeProjectDetail['project_id'] }}">
                                    </div> 
                                    <hr>
                                  <div class="ls-address">
                                    <div class="address">
                                      <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                      <strong id="active-siteaddress">
                                        {{$activeProjectDetail['siteaddress']}}</strong>
                                    </div>
                                    <br><br><br>
                                    <div class="report-date" style="float: left;">
                                      <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Field</h5>
                                      <strong id="active-reportduedate">{{$activeProjectDetail['reportduedate']}}</strong>
                                    </div>
                                    <div class="report-date">
                                      <h5><i class="fa fa-calendar" aria-hidden="true"></i>On site Date</h5>
                                      <strong id="active-onsitedate">{{$activeProjectDetail['onsitedate']}}</strong>
                                    </div>
                                    <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="active-propertyType">{{$activeProjectDetail['propertyType']}}</strong>
                                                      </div>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="active-noOfUnits">{{$activeProjectDetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="active-sqFootage">{{$activeProjectDetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="active-noBuildings">{{$activeProjectDetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="active-landArea">{{$activeProjectDetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="active-noOfStories">{{$activeProjectDetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="active-yearBuilt">{{$activeProjectDetail['yearBuilt']}}</strong>
                                                      </div>
                                  </div>
                                </div>
                                <div class="ls-scope">
                                  <h5>Scope(s)</h5>    
                                  <ul>
                                    <li id="active-scope">{{$activeProjectDetail['scope']}}</li>
                                  </ul> 
                                  <hr>   
                                  <h5>Report Template</h5>    
                                  <ul>
                                    <li id="active-template">{{$activeProjectDetail['template']}}</li>
                                  </ul>    
                                </div>
                                <div class="ls-instrucation">
                                  <h5>Special Instruction</h5>
                                  <p id="active-instructions">{{$activeProjectDetail['instructions']}}
                                  </p><hr> 
                                  <div class="ls-instructions">
                                  <h5>Suggested Bid</h5>
                                  <p id="active-approxbid" style="font-size: 15px;">{{$activeProjectDetail['approxbid']}}</p>  
                                   <h5>Job Reach</h5>
                                  <p id="active-jobReach" style="font-size: 15px;">
                                      {{$activeProjectDetail['jobReachCount']}}&nbsp People
                                  </p>    
                                </div>
                                
                                </div>   
                              </div>
                              <div class="rs-project">
                               <!--  <div class="rs-suggest-bid">
                                  <h4>Suggested Bid</h4>
                                  <font id="active-approxbid" style="font-size: 15px;">{{$activeProjectDetail['approxbid']}}</font>   
                                </div>
                                <div class="rs-suggest-bid">
                                  <h4>Job Reach</h4>
                                  <font id="jobReach" style="font-size: 15px;">
                                      {{$activeProjectDetail['jobReachCount']}}&nbsp People
                                  </font>   
                                </div>
                                <hr>  -->
                                @if($activeProjectDetail['associateTypeId'] == 1)
                                  <div class="rs-btn-bid">
                                    <a href="#" class="btn red-btn" id="acceptProject">Accept
                                    </a>
                                    <a href="#" class="btn red-btn" id="declineProject">Decline</a>
                                  </div>
                                @else
                                 <div class="rs-make-bid">
                                      <h4>Current Bid</h4> <label id="active-bidstatus" style="color: #fe5f55;">{{$activeProjectDetail['bidstatus']}}</label>
                                      <label id="active-applydate" style="margin-left: 0px;">{{$activeProjectDetail['applydate']}}</label><br>
                                      <font id="active-mybid" style="font-size: 15px;"> {{$activeProjectDetail['mybid']}}
                                      </font>   
                                    </div>
                                    <hr>  
                                  <div class="rs-make-bid">
                                    <h4>Make a Bid</h4>
                                    <i class="fa fa-usd" aria-hidden="true"
                                                          style="border-color: #fe5f55;
                                                                font-size: 200%;
                                                                color: #fe5f55;
                                                               ">
                                      <input type="text" name="bid" id="bid" style="width: 140px;">
                                    </i>
                                    <p style="color: #fe5f55;" id="biderr"></p>
                                  </div>
                                  <div class="rs-btn-bid">
                                    &nbsp &nbsp &nbsp
                                    <a href="#" class="btn red-btn" id="submitbid">Submit Bid
                                    </a>
                                  </div>
                                @endif
                                <div class="rs-mr-view-profile">
                                  <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="active-manager">View Project Manager Profile</button>
                                </div>        
                              </div>
                            </div>      
                          </div>
                        </div>  
                        <div class="tab-content col-md-12" id="div-no-project"></div>  
                      </div> 
                    @else
                      <br><br>
                      <h2 class="center-title">There are no any active bids available.
                      </h2>
                    @endif
                  </div>
                </div>
                <div class="tab-pane" id="history_tab">
                  <div class="my-bids">
                    @if($historyBidProject['status'] == 1)
                      <div class="row">
                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search here" id="b_generalSearch"><br> <br>
                        <input type="hidden" name="history_pagenumber" id="history_pagenumber">
                        @if($historyBidProject['mybids'])
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs vertical-tabs col-md-3" id="history-projects">
                            <h4>Bid History Jobs <!-- <i class="fa fa-refresh" aria-hidden="true"></i> --></h4> 
                            <div style="overflow-y: scroll;max-height: 430px; background: white;" id="history-project-list"> 
                            <?php $i = 1;?>
                              @foreach($historyBidProject['mybids'] as $value)
                                @if($i == 1)
                                  <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#historyProjectDetail" class ="odd active" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                  </li>
                                @elseif($i %2 == 0)
                                  <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#historyProjectDetail" class ="even" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                  </li>
                                @else
                                  <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#historyProjectDetail" class ="odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                @endif
                                <?php ++$i;?>
                              @endforeach
                            </div>
                          </ul>
                        @endif
                        <!-- Nav tabs content -->
                        <div class="tab-content col-md-9" id="div-project1">
                          <div id="historyProjectDetail" class="tab-pane active">
                            <div class="project-detail">
                              <div class="ls-project">
                                <div class="ls-project-address">    
                                  <div class="ls-title">
                                    <h4 id="history-projectname">{{$historyProjectDetail['projectname']}}</h4>
                                    <span class="project-date" id="history-createddate">{{$historyProjectDetail['createddate']}}</span>
                                    <span class="project-id" id="history-projectid">{{$historyProjectDetail['projectid']}}</span>
                                    <input type="hidden" id="history-project-id" name="history-projectid" value="{{ $historyProjectDetail['project_id'] }}">
                                  </div> 
                                  <hr>
                                  <div class="ls-address">
                                    <div class="address">
                                      <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                      <strong id="history-siteaddress">
                                        {{$historyProjectDetail['siteaddress']}}</strong>
                                      </div>
                                      <br><br><br>
                                      <div class="report-date" style="float: left;">
                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Field</h5>
                                        <strong id="history-reportduedate">{{$historyProjectDetail['reportduedate']}}</strong>
                                      </div>
                                      <div class="report-date">
                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>On site Date</h5>
                                        <strong id="history-onsitedate">{{$historyProjectDetail['onsitedate']}}</strong>
                                      </div>
                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="history-propertyType">{{$historyProjectDetail['propertyType']}}</strong>
                                                      </div>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="history-noOfUnits">{{$historyProjectDetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history-sqFootage">{{$historyProjectDetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history-noBuildings">{{$historyProjectDetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history-landArea">{{$historyProjectDetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history-noOfStories">{{$historyProjectDetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history-yearBuilt">{{$historyProjectDetail['yearBuilt']}}</strong>
                                                      </div>
                                    </div>
                                  </div>
                                  <div class="ls-scope">
                                    <h5>Scope(s)</h5>    
                                    <ul>
                                      <li id="history-scope">{{$historyProjectDetail['scope']}}</li>
                                    </ul> 
                                    <hr>   
                                    <h5>Report Template</h5>    
                                    <ul>
                                      <li id="history-template">{{$historyProjectDetail['template']}}</li>
                                    </ul>    
                                  </div>
                                  <div class="ls-instrucation">
                                    <h5>Special Instruction</h5>
                                    <p id="history-instructions">{{$historyProjectDetail['instructions']}}
                                    </p>
                                    <!-- <hr>  -->
                                 <!--  <div class="ls-instructions">
                                  <h5>Suggested Bid</h5>
                                  <p id="history-approxbid" style="font-size: 15px;">{{$activeProjectDetail['approxbid']}}</p>  
                                   <h5>Job Reach</h5>
                                  <p id="history-jobReach" style="font-size: 15px;">
                                      {{$activeProjectDetail['jobReachCount']}}&nbsp People
                                  </p>    
                                </div> -->  
                                  </div>   
                                </div>
                                <div class="rs-project">
                                  <div class="rs-suggest-bid">
                                    <h4>Suggested Bid</h4>
                                    <font id="history-approxbid">{{$historyProjectDetail['approxbid']}}</font>   
                                  </div>
                                  <div class="rs-suggest-bid">
                                    <h4>Job Reach</h4>
                                    <font id="jobReach" style="font-size: 15px;">
                                                          {{$historyProjectDetail['jobReachCount']}}&nbsp People</font>   
                                  </div>
                                  <hr> 
                                 <!--  @if($historyProjectDetail['associateTypeId'] == 1)
                                    <div class="rs-btn-bid">
                                      <a href="#" class="btn red-btn" id="acceptProject">Accept</a>
                                      <a href="#" class="btn red-btn" id="declineProject">Decline</a>
                                    </div>
                                  @else
                                   <div class="rs-make-bid">
                                      <h4>Current Bid</h4> <label id="history-bidstatus" style="color: #fe5f55;">{{$historyProjectDetail['bidstatus']}}</label>
                                      <label id="history-applydate" style="margin-left: 0px;">{{$historyProjectDetail['applydate']}}</label><br>
                                      <font id="history-mybid" style="font-size: 15px;"> {{$historyProjectDetail['mybid']}}
                                      </font>   
                                    </div>
                                    
                                    <hr> 

                                    <div class="rs-make-bid">
                                      <h4>Make a Bid</h4>
                                        <i class="fa fa-usd" aria-hidden="true"
                                                          style="border-color: #fe5f55;
                                                                font-size: 200%;
                                                                color: #fe5f55;
                                                               ">
                                          <input type="text" name="bid" id="bid" style="width: 140px;">
                                        </i>
                                        <p style="color: #fe5f55;" id="biderr"></p>
                                      </div>
                                      <div class="rs-btn-bid">
                                        &nbsp &nbsp &nbsp
                                        <a href="#" class="btn red-btn" id="submitbid">Submit Bid</a>
                                      </div>
                                    
                                    @endif -->
                                    <div class="rs-mr-view-profile">
                                      <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="history-manager">View Project Manager Profile</button>
                                    </div>        
                                  </div>
                                </div>      
                              </div>
                            </div>
                            <div class="tab-content col-md-12" id="div-no-project1"></div>      
                          </div> 
                        @else
                          <br><br>
                          <h2 class="center-title">There are no any bid history available.
                          </h2>
                        @endif
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>    
          </div>
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
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left">
        </i></button>
        <h4 class="modal-title">Project Manager Profile</h4>
      </div>
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="manager-picture">
          <img src={{asset('img/front/manager.jpg')}} alt="" title="" id="managerimage" style="height: 100%;width: 100%;">
        </div>
        <h4 id="managername">George Sabastian</h4>
        <div class="manager-contact">
          <ul>
            <li>
              <h5>Email</h5>
                <p id="manageremail">sabastian@gmail.com</p>
            </li>
            <li>
              <h5>Company</h5>
              <p id="managercompany">ABC</p>
            </li>
            <li>
              <h5>Phone Number</h5>
              <p id="managerphone">(123) 4567489</p>
            </li>
          </ul>
        </div>    
      </div>
    </div>
  </div>
</div>

  @include('frontlayouts.include_js')
  <script type="text/javascript">
     $(document).ready(function(){
      $("#login-menu").removeClass('active');
      $("#bids-menu").addClass('active');
    });

    /*----------------------------------------------------------------------*/
      
      //ON click of tab active bids details
      $(document).on("click", "#leftTabs li", function(event) {
        var tabSelected = $(this).attr('id');
        if (tabSelected == 'active-bids') {
              $('#history_tab').hide();
              $("#active_tab").show();
              
              //document.getElementById("publish_pagenumber").value = 1;
              // document.getElementById("a_generalSearch").value = '';
              //$("#publish-projects").show();
              //$("#publish-project-list").show();
              //$("#div-project").show();
              //$("#div-no-project").hide();

              //var projectid = document.getElementById("publish-project-id").value;
              /*("#project-name-list li a").removeClass('active');*/
              //$("#"+projectid).children('a').addClass("active");
          }
      });
       /*----------------------------------------------------------------------*/
      
      //ON click of tab active bids details
      $(document).on("click", "#leftTabs li", function(event) {
        var tabSelected = $(this).attr('id');
        if (tabSelected == 'history-bids') {
              $('#active_tab').hide();
              $("#history_tab").show();
              
              //document.getElementById("publish_pagenumber").value = 1;
              // document.getElementById("a_generalSearch").value = '';
              //$("#publish-projects").show();
              //$("#publish-project-list").show();
              //$("#div-project").show();
              //$("#div-no-project").hide();

              //var projectid = document.getElementById("publish-project-id").value;
              /*("#project-name-list li a").removeClass('active');*/
              //$("#"+projectid).children('a').addClass("active");
          }
      });
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
    $("#active-manager").click(function(){
      var projectid = document.getElementById("active-project-id").value;
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
  </script>
  <script type="text/javascript">
    $("#history-manager").click(function(){
      var projectid = document.getElementById("history-project-id").value;
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
  </script>
  <script type="text/javascript">

     function getActiveProjectDetails(id) {
            
            var projectid = id;
            $("#biderr").text('');
            document.getElementById("active-project-id").value = projectid;
          
            $.ajax({
              type: 'GET',
                url: '<?php echo route('projectDetails'); ?>',
                data: {projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
              $("#active-project-list li a.active").removeClass("active");
              $("#active-project-list #"+id).children('a').addClass("active");
              $("#active-projectid").text(msg.projectid);
              $("#active-projectname").text(msg.projectname);
              $("#active-createddate").text(msg.createddate);
              $("#active-siteaddress").text(msg.siteaddress);
              $("#active-reportduedate").text(msg.reportduedate);
              $("#active-propertyType").text(msg.propertyType);
              $("#active-noOfUnits").text(msg.noOfUnits);
              $("#active-noOfStories").text(msg.noOfStories);
              $("#active-sqFootage").text(msg.sqFootage);
              $("#active-noBuildings").text(msg.noBuildings);
              $("#active-landArea").text(msg.landArea);
              $("#active-yearBuilt").text(msg.yearBuilt);
              $("#active-instructions").text(msg.instructions);
              $("#active-template").text(msg.template);
              $("#active-scope").text(msg.scope);
              $("#active-approxbid").text(msg.approxbid);
              var jobReachCount = msg.jobReachCount;
              $("#active-jobReach").text(jobReachCount+' '+'People');
              $("#active-mybid").text(msg.mybid);
              $("#active-bidstatus").text(msg.bidstatus);
              $("#active-onsitedate").text(msg.onsitedate);
            });
        }
        $(document).on("click", "#active-project-list li", function(event) {
          var projectid = $(this).attr('id');
            getActiveProjectDetails(projectid);
        });
            $("#a_generalSearch").keyup(function () {
                value = $(this).val();
                  document.getElementById('active_pagenumber').value = 1;
                  $.ajax({
                    type: "GET",
                    url: '<?php echo route('searchActiveBids'); ?>',
                    data: {search_keyword:value},
                    dataType: 'json',
                    success: function(response){
                      if (response != "" && response['projectdetail'] != null) {
                        var projectData = response['projectdetail'];
                        $("#active-reportduedate").text(projectData['reportduedate']);
                        $("#active-instructions").text(projectData['instructions']);
                        $("#active-projectname").text(projectData['projectname']);
                        $("#active-createddate").text(projectData['createddate']);
                        $("#active-siteaddress").text(projectData['siteaddress']);
                        $("#active-onsitedate").text(projectData['onsitedate']);
                        $("#active-propertyType").text(projectData['propertyType']);
                        $("#active-noOfUnits").text(projectData['noOfUnits']);
                        $("#active-noOfStories").text(projectData['noOfStories']);
                        $("#active-sqFootage").text(projectData['sqFootage']);
                        $("#active-noBuildings").text(projectData['noBuildings']);
                        $("#active-landArea").text(projectData['landArea']);
                        $("#active-yearBuilt").text(projectData['yearBuilt']);
                        $("#active-projectid").text(projectData['projectid']);
                        $("#active-approxbid").text(projectData['approxbid']);
                        var jobReachCount = projectData['jobReachCount'];
                        $("#active-jobReach").text(jobReachCount +' '+'People');
                        $("#active-bidstatus").text(projectData['bidstatus']);
                        $("#active-template").text(projectData['template']);
                        $("#active-scope").text(projectData['scope']);
                        $("#active-mybid").text(projectData['mybid']);
                        $("#div-no-project").hide();
                        $("#div-project").show();
                        $("#active-project-list").show();
                        $("#activeProjectDetail").show();
                        $("#active-project-list").html("");
                        $("#active-project-list").html(response['appendLi']);
                      }
                      else{
                        $("#div-project").hide();
                        $("#active-project-list").hide();
                        $("#activeProjectDetail").hide();
                        $("#div-no-project").show();
                        $("#div-no-project").html("<br><br><h2>No data found.</h2>");
                      }
                    }
                  });
              });


  </script>
  <script type="text/javascript">

     function getHistoryProjectDetails(id) {
            
            var projectid = id;
            $("#biderr").text('');
            document.getElementById("history-project-id").value = projectid;

          
            $.ajax({
              type: 'GET',
                url: '<?php echo route('projectDetails'); ?>',
                data: {projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
              $("#history-project-list li a.active").removeClass("active");
              $("#history-project-list #"+id).children('a').addClass("active");
              $("#history-projectid").text(msg.projectid);
              $("#history-projectname").text(msg.projectname);
              $("#history-createddate").text(msg.createddate);
              $("#history-siteaddress").text(msg.siteaddress);
              $("#history-reportduedate").text(msg.reportduedate);
              $("#history-propertyType").text(msg.propertyType);
              $("#history-noOfUnits").text(msg.noOfUnits);
              $("#history-noOfStories").text(msg.noOfStories);
              $("#history-sqFootage").text(msg.sqFootage);
              $("#history-noBuildings").text(msg.noBuildings);
              $("#history-landArea").text(msg.landArea);
              $("#history-yearBuilt").text(msg.yearBuilt);
              $("#history-instructions").text(msg.instructions);
              $("#history-template").text(msg.template);
              $("#history-scope").text(msg.scope);
              $("#history-approxbid").text(msg.approxbid);
              var jobReachCount = msg.jobReachCount;
              $("#history-jobReach").text(jobReachCount+' '+'People');
              $("#history-mybid").text(msg.mybid);
              $("#history-bidstatus").text(msg.bidstatus);
              $("#history-onsitedate").text(msg.onsitedate);
            });
        }
        $(document).on("click", "#history-project-list li", function(event) {
          var projectid = $(this).attr('id');
            getHistoryProjectDetails(projectid);
        });

              $("#b_generalSearch").keyup(function () {

                  value = $(this).val();
                  document.getElementById('history_pagenumber').value = 1;
                  $.ajax({
                    type: "GET",
                    url: '<?php echo route('searchBidHistory'); ?>',
                    data: {search_keyword:value},
                    dataType: 'json',
                    success: function(response){
                      if (response != "" && response['projectdetail'] != null) {
                        var projectData = response['projectdetail'];
                        $("#history-reportduedate").text(projectData['reportduedate']);
                        $("#history-instructions").text(projectData['instructions']);
                        $("#history-projectname").text(projectData['projectname']);
                        $("#history-createddate").text(projectData['createddate']);
                        $("#history-siteaddress").text(projectData['siteaddress']);
                        $("#history-onsitedate").text(projectData['onsitedate']);
                        $("#history-propertyType").text(projectData['propertyType']);
                        $("#history-noOfUnits").text(projectData['noOfUnits']);
                        $("#history-noOfStories").text(projectData['noOfStories']);
                        $("#history-sqFootage").text(projectData['sqFootage']);
                        $("#history-noBuildings").text(projectData['noBuildings']);
                        $("#history-landArea").text(projectData['landArea']);
                        $("#history-yearBuilt").text(projectData['yearBuilt']);
                        $("#history-projectid").text(projectData['projectid']);
                        $("#history-approxbid").text(projectData['approxbid']);
                        var jobReachCount = projectData['jobReachCount'];
                        $("#history-jobReach").text(jobReachCount +' '+'People');
                        $("#history-bidstatus").text(projectData['bidstatus']);
                        $("#history-template").text(projectData['template']);
                        $("#history-scope").text(projectData['scope']);
                        $("#history-mybid").text(projectData['mybid']);
                        $("#div-no-project1").hide();
                        $("#history-projects").show();
                        $("#history-project-list").show();
                        $("#historyProjectDetail").show();
                        $("#history-project-list").html("");
                        $("#history-project-list").html(response['appendLi']);
                      }
                      else{
                        $("#history-projects").hide();
                        $("#history-project-list").hide();
                        $("#historyProjectDetail").hide();
                        $("#div-no-project1").show();
                        $("#div-no-project1").html("<br><br><h2>No data found.</h2>");
                      }
                    }
                  });
              });

  </script>
  <script type="text/javascript">
    $(document).ready(function(){
          $('#submitbid').click(function(){
              var projectid = document.getElementById("active-project-id").value;
              var bidvalue  = document.getElementById("bid").value;
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
                  $("#active-mybid").text('$ '+ bidvalue);
                  document.getElementById("bid").value = '';
                }
              });
          });
        });
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

  </script>
</body>
</html>