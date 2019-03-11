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
                            <!-- Nav left -->
                            <ul class="horizontal-tabs nav col-md-12" id="leftTabs">
                              <li id="job_finder">
                                <a href="#a_tab" class="active" data-toggle="tab">
                                  <img src={{asset('img/front/icon1.png')}} alt="" /> Job Finder
                                </a>     
                              </li>
                              <li id="my-jobs">
                                <a href="#b_tab" data-toggle="tab">
                                   <img src={{asset('img/front/icon2.png')}} alt="" />  My Jobs
                                </a>
                              </li>
                              <li id="project-History">
                                <a href="#c_tab" data-toggle="tab">
                                  <img src={{asset('img/front/icon3.png')}} alt="" />  Job History
                                </a>
                              </li>
                            </ul>
                            <!-- Nav content --> 
                            <div class="tab-content tab-detail col-md-12">
                              <div class="tab-pane active" id="a_tab">
                              <div>
                                @if($availableProject['status'] == 1)
                                  <div class="row">

                                  <input type="text" class="form-control m-input m-input--solid" placeholder="Search here" id="a_generalSearch"><br> <br>
                                 <input type="hidden" name="publish_pagenumber" id="publish_pagenumber">
                                  @if($availableProject['publishprojects'])
                                  

                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs vertical-tabs col-md-3" id="publish-projects">
                                    <h4>Available Jobs <!-- <i class="fa fa-refresh" aria-hidden="true"></i> --></h4> 
                                    <div style="overflow-y: scroll;max-height: 430px; background: white;" id="publish-project-list"> 
                                     <?php $i = 1;?>
                                    @foreach($availableProject['publishprojects'] as $value)
                                      @if($i == 1)
                                      <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#project1" class ="active odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                      @elseif($i %2 == 0)
                                      <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#project1" class ="even" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                     @else
                                      <li value="{{$value['projectid']}}" id="{{$value['projectid']}}" ><a href="#project1" class ="odd" data-toggle="tab">{{$value['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                      @endif
                                      <?php ++$i;?>
                                    @endforeach
                                     
                                    </div>
                                  </ul>
                                  @endif
                                 <!--  <ul class="nav nav-tabs vertical-tabs col-md-3" id="searched-publish-projects">
                                  </ul> -->
                                 
                                  <!-- Nav tabs content -->
                                  <div class="tab-content col-md-9" id="div-project">
                                    <div id="project1" class="tab-pane active">
                                      <div class="project-detail">
                                           <div class="ls-project">
                                              <div class="ls-project-address">    
                                                  <div class="ls-title">
                                                      <h4 id="publish-projectname">{{$publish_projectdetail['projectname']}}</h4>
                                                      <span class="project-date" id="publish-createddate">{{$publish_projectdetail['createddate']}}</span>
                                                      <span class="project-id" id="publish-projectid">{{$publish_projectdetail['projectid']}}</span>
                                                      <input type="hidden" id="publish-project-id" name="publish-projectid" value="{{ $publish_projectdetail['project_id'] }}">
                                                  </div> 
                                                  <hr>
                                                  <div class="ls-address">
                                                      <div class="address">
                                                          <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                                          <strong id="publish-siteaddress">{{$publish_projectdetail['siteaddress']}}</strong>
                                                      </div>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Field</h5>
                                                          <strong id="publish-reportduedate">{{$publish_projectdetail['reportduedate']}}</strong>
                                                      </div>
                                                      <div class="report-date">
                                                          <h5><i class="fa fa-calendar" aria-hidden="true"></i>On site Date</h5>
                                                          <strong id="publish-onsitedate">{{$publish_projectdetail['onsitedate']}}</strong>
                                                      </div><br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="publish-propertyType">{{$publish_projectdetail['propertyType']}}</strong>
                                                      </div>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="publish-noOfUnits">{{$publish_projectdetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="publish-sqFootage">{{$publish_projectdetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="publish-noBuildings">{{$publish_projectdetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="publish-landArea">{{$publish_projectdetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="publish-noOfStories">{{$publish_projectdetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="publish-yearBuilt">{{$publish_projectdetail['yearBuilt']}}</strong>
                                                      </div>
                                                  </div>
                                              </div>

                                                   <div class="ls-scope">
                                                      <h5>Scope(s)</h5>    
                                                      <ul>
                                                          <li id="publish-scope">{{$publish_projectdetail['scope']}}</li>
                                                         
                                                      </ul> 
                                                       <hr>   
                                                      <h5>Report Template</h5>    
                                                      <ul>
                                                          <li id="publish-template">{{$publish_projectdetail['template']}}</li>
                                                      </ul>    
                                                   </div>
                                                   
                                                   <div class="ls-instrucation">
                                                       <h5>Special Instruction</h5>
                                                        <p id="publish-instructions">{{$publish_projectdetail['instructions']}}
                                                        </p>  
                                                   </div>   
                                                </div>

                                              <div class="rs-project">

                                                      <div class="rs-suggest-bid">
                                                          <h4>Suggested Bid</h4>
                                                          <font id="publish-approxbid">{{$publish_projectdetail['approxbid']}}</font>   
                                                      </div>
                                                       <div class="rs-suggest-bid">
                                                          <h4>Job Reach</h4>
                                                          <font id="jobReach" style="font-size: 15px;">
                                                          {{$publish_projectdetail['jobReachCount']}}&nbsp People</font>   
                                                      </div>
                                                        <hr> 
                                                         @if($publish_projectdetail['associateTypeId'] == 1)
                                                         <div class="rs-btn-bid">
                                                           
                                                          <a href="#" class="btn red-btn" id="acceptProject">Accept</a>
                                                          <a href="#" class="btn red-btn" id="declineProject">Decline</a>
                                                      </div>
                                                      
                                                        @else
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
                                                      @endif
                                                      <div class="rs-mr-view-profile">
                                                          <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="publish-manger">View Project Manager Profile</button>
                                                      </div>        
                                                </div>
                                            </div>      
                                          </div>
                                        </div>    
                                      </div> 
                                  @else
                                  <br><br>
                                  <h2 class="center-title">There are no any projects available.
                                  </h2>
                                @endif
                              </div>

                              <div class="tab-content col-md-12" id="div-no-project"></div>
                            </div>
                            <div class="tab-pane" id="b_tab">
                             <input type="hidden" name="pagenumber" id="pagenumber">
                               @if($inprogressproject['status'] == 1)
                                <div class="row">

                                <!-- Nav tabs -->
                                
                                <ul class="nav nav-tabs vertical-tabs col-md-3" id="progressProjectList">
                                  <h4>Job In Progress <!-- <i class="fa fa-refresh" aria-hidden="true"> -->
                                    
                                  </h4> 
                                  <div style="overflow-y: scroll;max-height: 430px; background: white;" id="project-name-list"> 
                                  <?php $i = 1;?>
                                  @foreach($inprogressproject['inprogressproject'] as $progressProject)
                                    @if($i == 1)
                                   <li value="{{$progressProject['projectid']}}" id="{{$progressProject['projectid']}}" data-id = "{{ $progressProject['onholdflag']}}"><a href="#progress1" class ="active odd" data-toggle="tab">{{ $progressProject['projectname'] }} <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    @if($progressProject['onholdflag'] == 1)

                                    <span style="color: #fe5f55;">&nbspOnHold</span>
                                    @endif
                                   </a>
                                   
                                  
                                   </li>
                                    @elseif($i %2 == 0)
                                       <li value="{{$progressProject['projectid']}}" id="{{$progressProject['projectid']}}" data-id = "{{$progressProject['onholdflag']}}"><a href="#progress1" class ="even" data-toggle="tab">{{ $progressProject['projectname'] }} <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       @if($progressProject['onholdflag'] == 1)
                                       
                                        <span style="color: #fe5f55;">&nbspOnHold</span>
                                        @endif</a>
                                        
                                    </li>
                                    @else
                                     <li value="{{$progressProject['projectid']}}" id="{{$progressProject['projectid']}}" data-id = "{{$progressProject['onholdflag']}}"><a href="#progress1" class ="odd" data-toggle="tab">{{ $progressProject['projectname'] }} <i class="fa fa-angle-right" aria-hidden="true"></i>
                                      @if($progressProject['onholdflag'] == 1)
                                       <span style="color: #fe5f55;">&nbspOnHold</span>
                                      @endif
                                     </a>
                                     </li>
                                    @endif
                                    <?php ++$i;?>
                                  @endforeach
                                  
                                  </div>
                                </ul>
                                <!-- Nav tabs content -->
                                <div class="tab-content col-md-9">
                                  <div id="progress1" class="tab-pane active">
                                    <div class="project-detail">

                                            <div class="ls-project">
                                              <div class="ls-project-address">    
                                                <div class="ls-title">
                                                    <h4 id="projectname">{{$progresProjecDetail['projectname']}}
                                                    </h4>
                                                    <span class="project-date" id="createddate">{{$progresProjecDetail['createddate']}}</span>
                                                    <span class="project-id" id="projectid">{{$progresProjecDetail['projectid']}}
                                                    </span>
                                                    <input type="hidden" name="project_id" id="project_id" value="{{ $progresProjecDetail['project_id'] }}">
                                                    
                                                </div> 
                                                <hr>
                                                <div class="ls-address">
                                                    <div class="address">
                                                        <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                                        <strong id="siteaddress">{{$progresProjecDetail['siteaddress']}}</strong>

                                                    </div>
                                                    <br><br><br>
                                                    <div class="report-date" style="float: left;">
                                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Field</h5>
                                                        <strong id="reportduedate">{{$progresProjecDetail['reportduedate']}}</strong>
                                                    </div>
                                                    <div class="report-date">
                                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>On Site Date
                                                        </h5>
                                                        <strong id="onsitedate">{{$progresProjecDetail['onsitedate']}}</strong>
                                                    </div><br><br><br>
                                                     <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="propertyType">{{$progresProjecDetail['propertyType']}}</strong>
                                                      </div>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="noOfUnits">{{$progresProjecDetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="sqFootage">{{$progresProjecDetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="noBuildings">{{$progresProjecDetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="landArea">{{$progresProjecDetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="noOfStories">{{$progresProjecDetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="yearBuilt">{{$progresProjecDetail['yearBuilt']}}</strong>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="ls-scope">
                                              <h5>Scope(s)</h5>    
                                                <ul>
                                                  <li id="scope">{{$progresProjecDetail['scope']}}</li>
                                                </ul> 
                                                <hr>   
                                                <h5>Report Template</h5>    
                                                <ul>
                                                  <li id="template">{{$progresProjecDetail['template']}}</li>
                                                </ul>    
                                                 </div>
                                                 <div class="ls-instrucation">
                                                     <h5>Special Instruction</h5>
                                                      <p id="instructions">{{$progresProjecDetail['instructions']}}</p>  
                                                 </div>   
                                              </div>
                                              <div class="rs-project">
                                                <div class="rs-suggest-bid">
                                                  <h4>Suggested Bid</h4>
                                                    <font id="approxbid">{{$progresProjecDetail['approxbid']}}</font>   
                                                </div>
                                                <hr>  
                                                <div class="rs-make-bid">
                                                  <h4>Final Bid</h4>
                                                  <font id="mybid"> {{$progresProjecDetail['mybid']}}</font>  
                                                </div>
                                                <div class="rs-btn-bid"> 
                                                 &nbsp&nbsp &nbsp
                                                        <button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="addstatus">Add Notes</button>
                                                    </div>

                                                    <div class="rs-mr-view-profile">
                                                        <button type="button" class="btn"  id="managerprofile" data-toggle="modal" data-target="#myModal">View Project Manager Profile</button>

                                                    </div>        

                                                </div>
                                            </div>      
                                        </div>
                                      </div>    
                                 </div> 
                                 @else
                                  <br><br>
                                  <h2 class="center-title">There are no any projects available In Progress.
                                  
                                  </h2>
                                
                              @endif
                              </div>
                              
                              <div class="tab-pane" id="c_tab">
                              <div id="div-historyProject">
                              <input type="hidden" name="history_pagenumber" id="history_pagenumber">
                              @if($projecthistorylist['status'] == 1)
                                <div class="row">
                                <!-- Nav tabs -->
                                
                                <input type="text" class="form-control m-input m-input--solid" placeholder="Search here" id="c_generalSearch"><br> <br>
                                
                                <ul class="nav nav-tabs vertical-tabs col-md-3" id="project_history">
                                  <h4>Jobs <!-- <i class="fa fa-refresh" aria-hidden="true"></i> --></h4> 
                                  <div style="overflow-y: scroll;max-height: 430px; background: white;" id="project-history-list">  
                                 <!--  <select class="project-hs">
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                  </select> -->
                                  <?php $i = 1;?>
                                  @foreach($projecthistorylist['projects'] as $projectHistory)
                                  @if($i == 1)

                                  <li id="{{$projectHistory['projectid']}}" value="{{$projectHistory['projectid']}}"><a href="#history1" class ="active odd" data-toggle="tab">{{$projectHistory['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i>
                                  @if($projectHistory['flag'] == 0)

                                    <span style="color: #fe5f55;">&nbsp CANCELLED</span>
                                    @endif</a></li>
                                  @elseif($i %2 == 0)

                                  <li id="{{$projectHistory['projectid']}}" value="{{$projectHistory['projectid']}}"><a href="#history1" class ="even" data-toggle="tab">{{$projectHistory['projectname']}} 
                                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                                  @if($projectHistory['flag'] == 0)

                                    <span style="color: #fe5f55;">&nbsp CANCELLED</span>
                                    @endif</a></li>
                                  @else
                                  <li id="{{$projectHistory['projectid']}}" id="{{$projectHistory['projectid']}}"><a href="#history1" class ="odd" data-toggle="tab">{{$projectHistory['projectname']}} <i class="fa fa-angle-right" aria-hidden="true"></i>
                                  @if($projectHistory['flag'] == 0)

                                    <span style="color: #fe5f55;">&nbsp CANCELLED</span>
                                    @endif</a></li>
                                  @endif
                                  <?php ++$i;?>
                                  @endforeach
                                 </div> 
                                </ul>


                               <!--  <ul class="nav nav-tabs vertical-tabs col-md-3" id="searched-project-history">
                                  </ul> -->
                                <!-- Nav tabs content -->
                                <div class="tab-content col-md-9" id="historyProjectDetail">
                                  <div id="history1" class="tab-pane active">
                                      
                                      <div class="project-detail">

                                            <div class="ls-project">
                                            <div class="ls-project-address">    
                                                <div class="ls-title">

                                                    <h4 id="history_projectname" name="history_projectname">{{$history_projectdetail['projectname']}}</h4>
                                                    <span class="project-date" id="history_createdate" name="history_createdate">{{ $history_projectdetail['createddate'] }}
                                                    </span>
                                                    <span class="project-id" id="history_projectid" name="history_projectid">
                                                    {{ $history_projectdetail['projectid'] }}
                                                    </span>
                                                    <input type="hidden" name="project_history_id" id="project_history_id" value=" {{ $history_projectdetail['project_id'] }}">
                                                </div> 
                                                <hr>
                                                <div class="ls-address">
                                                    <div class="address">
                                                        <h5><i class="fa fa-map-marker" aria-hidden="true"></i> Site Address</h5>
                                                        <strong id="history_siteaddress" name="history_siteaddress"> 
                                                      {{ $history_projectdetail['siteaddress'] }}</strong>
                                                    </div>
                                                    <br><br><br>
                                                    <div class="report-date" style="float: left;">
                                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>Report Due From Feild</h5>
                                                        <strong id="history_reportduedate" name="history_reportduedate">{{ $history_projectdetail['reportduedate'] }}</strong>
                                                    </div>
                                                    <div class="report-date" >
                                                        <h5><i class="fa fa-calendar" aria-hidden="true"></i>On Site Date
                                                        </h5>
                                                        <strong id="history_onsitedate">{{ $history_projectdetail['onsitedate']}}</strong>
                                                    </div><br><br><br>
                                                     <div class="report-date" style="float: left;">
                                                          <h5>Property Type</h5>
                                                          <strong id="history_propertyType">{{$history_projectdetail['propertyType']}}</strong>
                                                      </div>
                                                      <br>
                                                      <br><br><br>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>  
                                                          <strong id="history_noOfUnits">{{$history_projectdetail['noOfUnits']}}</strong>

                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>Sq. Footage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history_sqFootage">{{$history_projectdetail['sqFootage']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Buildings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history_noBuildings">{{$history_projectdetail['noBuildings']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Land Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history_landArea">{{$history_projectdetail['landArea']}}</strong>
                                                      </div>
                                                      <div class="report-date" style="float: left;">
                                                          <h5>No. Stories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history_noOfStories">{{$history_projectdetail['noOfStories']}}</strong>
                                                      </div>
                                                       <div class="report-date" style="float: left;">
                                                          <h5>Year Built&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                          <strong id="history_yearBuilt">{{$history_projectdetail['yearBuilt']}}</strong>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="ls-scope">
                                              <h5>Scope(s)</h5>    
                                              <ul>
                                                <li id="history_scope" name="history_scope">{{ $history_projectdetail['scope'] }}</li>
                                              </ul> 
                                              <hr>   
                                              <h5>Report Template</h5>    
                                              <ul>
                                                <li id="history_template" name="history_template">{{ $history_projectdetail['template'] }}</li>
                                              </ul>    
                                              </div>
                                                 
                                                 <div class="ls-instrucation">
                                                     <h5>Special Instruction</h5>
                                                      <p id="history_instructions" name="history_instructions">{{ $history_projectdetail['instructions'] }}</p>  
                                                 </div>   
                                             </div>
 
                                            <div class="rs-project rs-history">
                                                <div class="rs-suggest-bid">
                                                        <h4>Suggested Bid</h4>
                                                        <font id="history_approxbid" name="history_approxbid"> {{ $history_projectdetail['approxbid'] }}</font>   
                                                    </div>
                                                      <hr>  
                                                     <div class="rs-make-bid">
                                                        <h4>Final Bid</h4>
                                                        <font id="history_mybid" name="history_mybid">{{ $history_projectdetail['mybid'] }}</font>   
                                                    </div>
                                                      <hr> 

                                                    <!--  <div class="rs-rating">
                                                        <h4>Rating Received</h4>
                                                        <mark id="history_rating" name="history_rating">{{ $history_projectdetail['rating'] }}</mark>

                                                        <div class="star-rating" id="ratingstar">

                                                       </div>   
                                                    </div> -->
                                                   <!--  <hr>
                                                      <div class="rs-review">
                                                        <h4>Manager Review</h4>
                                                        <p id="history_comment" name="history_comment">{{ $history_projectdetail['comment'] }}
                                                        </p>
                                                    </div>
                                                    <hr>   -->
                                                     <div class="rs-btn-bid" id="button-div"> 
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>
                                                       <!--  @if($history_projectdetail['ratingflag'] == 0)
                                                        <button type="button" class="btn red-btn" data-toggle="modal" data-target="#completed-project" id="rating-btn">Add Rating</button>
                                                      @endif -->
                                                    </div>
                                                    
                                                    <div class="rs-mr-view-profile">
                                                      <button type="button" class="btn" data-toggle="modal" data-target="#myModal" name="project_history_manager" id="project_history_manager">View Project Manager Profile</button>
                                                    </div>        
                                                 </div>
                                              </div>      
                                            </div>
                                          </div>    
                                      </div>  
                                    @else
                                    <br><br>
                                    <h2 class="center-title">There are no any projects available In History.
                                  
                                    </h2>
                                
                                  @endif 
                                </div>
                               <div class="tab-content col-md-12" id="div-history-no-project">
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
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
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

<!-- Project Status Popup -->
<div class="modal fade" id="project-status">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
        <h4 class="modal-title">Project Notes</h4>
        
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <div class="project-level">
          <div id="no_any_status">
            <p style= "margin-left: 250px;"> There are no any notes available</p>
          </div>
          <input type="hidden" name="status_pagenumber" id="status_pagenumber">
          <div style="overflow-y: scroll;max-height: 350px; background: white;" id="project-status-list">
            <ul id="statuslist">
             </ul>
          </div>                                                                         
                 <div class="add-comment" id="add_project_status">                                                                                                           <form action="{{route('addStatus')}}" id="status-form" method="POST">
                    {{csrf_field()}}
                    <div class="form-group {{ $errors->has('subjecttxt') ? 'has-error' : '' }}">
                    <input type="hidden" name="project-id" id="project-id">
                        <select  name="subjecttxt" id="subjecttxt" class="form-control">
                        <option value="">--Please select status type--</option>
                          @foreach($progressStatus as $value)
                          <option value="{{ $value['progress_status_type'] }}">{{ $value['progress_status_type'] }}</option>
                          @endforeach
                        </select>
                        
                         <span class="text-danger">{{ $errors->first('subjecttxt') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('statustxt') ? 'has-error' : '' }}">
                       <textarea  name="statustxt" id="statustxt" placeholder="Add New Status..." maxlength="255"></textarea>
                       <span class="text-danger">{{ $errors->first('statustxt') }}</span>
                    </div>
                     <div class="form-group">
                      <button type="button" id="add_status" class="btn red-btn">Add Notes</button>
                    </div>
                    </form>
                 </div>                                                                 
            </div>    
          </div>
       </div>
  </div>
</div>


<!-- Project Status Popup -->
<!-- <div class="modal fade" id="completed-project">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> -->

      <!-- Modal Header -->
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
        <h4 class="modal-title">Project Complete</h4>
      </div>
      <span style="text-align: center;font-size: 16px;letter-spacing: 2px; color: #4b5f5f;font-weight: 300;">Rate&Review the Project Manager</span> -->
      <!-- Modal body -->  
      <!-- <div class="modal-body">
        
        <div class="associate-manager-profile">
            <div class="manager-profile">
              <img alt="" title="" id="review-manager-profile">
            </div> 
            <div class="manager-data row">
              <div class="col-md-12">
                <h4 id="review-manager-name">George Sabastain</h4>
              </div>
              <div class="col-md-12">
                <h5>Email</h5>
                <p id="review-manager-email">sabastina@gmail.com</p>
              </div>
              <div class="col-md-6">
                <h5>Phone Number</h5>
                <p id="review-manager-phone">(123)123456</p>
              </div>
              <div class="col-md-6">
               <h5>Company</h5>
                <p id="review-manager-company">ABC</p>
              </div>
            </div>  
        </div>
       
        <div class="rating-message">
          <div class="rating-label"><br>
            <label>Your Rating</label>
            <div class="svg-star-rating" data-rating="0.0" id="rating-star"></div>
            <h5 class="rating-number" id="ratingNumber">0.0</h5>
          </div>
          <textarea name="projectreview" placeholder="Please Type Your Review..." id="projectreview"></textarea>
           <p style="color: #fe5f55;" id="reviewerror"></p>
          <div class="rs-btn-bid">
            <button type="button" class="btn red-btn" id="submit-review" style="margin-left: 300px;">Submit</button>
          </div>
        </div>    
      </div> -->
  <!--   </div>
  </div>
</div> -->
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
    </script>
  <script>
    $(document).ready(function(){
      $("#login-menu").removeClass('active');
      $("#projects-menu").addClass('active');
      document.getElementById('pagenumber').value = 1;
      document.getElementById('status_pagenumber').value = 1;
      document.getElementById('publish_pagenumber').value = 1;
      document.getElementById('history_pagenumber').value = 1;
      /*var rating = $("#history_rating").text();
      if(rating)
      {
         if(rating == '0.0')
        {
          document.getElementById('ratingstar').innerHTML = "";
          $("#ratingstar").append('<i class="fa fa-star-o"></i>');
          $("#ratingstar").append('<i class="fa fa-star-o"></i>');
          $("#ratingstar").append('<i class="fa fa-star-o"></i>');
          $("#ratingstar").append('<i class="fa fa-star-o"></i>');
          $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            
        }
        else
        {
          var pointvalue = rating.toString().split(".")[1];
          document.getElementById('ratingstar').innerHTML = "";
          for(var i = 1; i <= rating; i++) {

            $("#ratingstar").append('<i class="fa fa-star"></i>');
          }
          if(pointvalue != 0)
          {
            $("#ratingstar").append('<i class="fa fa-star-half"></i>');
          }
        }
      }*/
      var url=window.location.href;
      var arr=url.split('=');
      var id = arr[1];
      if(id != null)
      {
        $.ajax({
            type: 'GET',
              url: '<?php echo route('projectInfo'); ?>',
              data: {projectid:id},
              dataType: 'json',
          })

          .done(function(msg) {

            if(msg.status == 4 || msg.status == 5)
            {
              $("li a.active").removeClass("active");
              $("#project-History").children('a').addClass("active");
              $("#a_tab").hide();
              $("#c_tab").show();
              $("#project_history li a").removeClass('active');
              if($("#project_history #"+id).length)
              {
                $("#"+id).children('a').addClass("active");
                getHistoryProjectDetails(id);
              }
              else
              {
                  if(msg.status == 5)
                  {
                      var appendLi = '<li value="'+id+'" id="'+id+'"><a href="#history1" class ="even" data-toggle="tab">'+msg.projectname+'<i class="fa fa-angle-right" aria-hidden="true"></i><span style="color: #fe5f55;">&nbsp CANCELLED</span>';
                  }
                  else
                  {
                     var appendLi = '<li value="'+id+'" id="'+id+'"><a href="#history1" class ="even" data-toggle="tab">'+msg.projectname+'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                  }
                 
                  $('#project-history-list').prepend(appendLi);
                  $("#"+id).children('a').addClass("active");
                  getHistoryProjectDetails(id);
              }

              
            }
            if(msg.status == 3 || msg.status == 6)
            {
              $("li a.active").removeClass("active");
              $("#my-jobs").children('a').addClass("active");
              $("#a_tab").hide();
              $("#b_tab").show();
              $("#progressProjectList li a").removeClass('active');
              if($("#progressProjectList #"+id).length)
              {
                $("#"+id).children('a').addClass("active");
                getProgressProjectDetails(id);
              }
              else
              {
                
                if(msg.status == 6)
                {
                    var appendLi = '<li value="'+id+'" id="'+id+'" data-id = "1"><a href="#history1" class ="even" data-toggle="tab">'+msg.projectname+'<i class="fa fa-angle-right" aria-hidden="true"></i><span style="color: #fe5f55;">&nbspOnHold</span>';
                }
                else
                {
                  var appendLi = '<li value="'+id+'" id="'+id+'" data-id = "0"><a href="#history1" class ="even" data-toggle="tab">'+msg.projectname+'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                }
                $('#project-name-list').prepend(appendLi);
                $("#"+id).children('a').addClass("active");
                getProgressProjectDetails(id);
              }
              var onholdflag = $("#"+id).attr("data-id");
              $("#"+id).children('a').addClass("active");
              getProgressProjectDetails(id,onholdflag);
            }
            if(msg.status == 1)
            {
              $("li a.active").removeClass("active");
              $("#job_finder").children('a').addClass("active");
              $("#a_tab").show();
              $("#job_finder li a").removeClass('active');
              if($("#publish-project-list #"+id).length)
              {
                $("#"+id).children('a').addClass("active");
                getPublishProjectDetails(id);
              }
              else
              {
                var appendLi = '<li value="'+id+'" id="'+id+'"><a href="#history1" class ="even" data-toggle="tab">'+msg.projectname+'<i class="fa fa-angle-right" aria-hidden="true"></i>';
                $('#publish-project-list').prepend(appendLi);
                $("#"+id).children('a').addClass("active");
                getPublishProjectDetails(id);
              }
              
            }
        });
      }
    });
  </script>
  <script type="text/javascript">
    $("#managerprofile").click(function(){
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
  </script>
  <script>
    $(document).ready(function(){
    $('#addstatus').click(function(){
      $('#subjecttxt').prop('selectedIndex',0);
      var projectid = document.getElementById("project_id").value;
      document.getElementById('status_pagenumber').value = 1;
      $("#statuslist").empty();
      $.ajax({
            type: 'GET',
              url: '<?php echo route('viewStatus'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
            if(msg.status != 0)
            {
              document.getElementById('no_any_status').style.display='none'; 
              $('#statuslist').show();
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
                $('#statuslist').hide();
                document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });
    $('body').on('click','#add_status', function (event) {
    event.preventDefault(); 

    var projectid = document.getElementById("project_id").value;
    document.getElementById("project-id").value = projectid;
    $("#status-form").validate({
    rules: {
            statustxt: {
                required: true,
            },subjecttxt: { 
              required: true,
            },
          },messages:{
            subjecttxt: "Please Select Status",
            statustxt: "Please Enter Status Details",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
      

  });
     if($("#status-form").valid()) {
      
        $.ajax({
            type: 'POST',
              url: $("#status-form").attr("action"),
              data: $('form#status-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
            var status = document.getElementById("statustxt").value;

            var subject = document.getElementById("subjecttxt").value;
           
            document.getElementById('no_any_status').style.display='none'; 
            $('#statuslist').show();
            var List = $('ul#statuslist');
             var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : status,
                 })
                  .appendTo(li);
                

          document.getElementById("statustxt").value = '';
          $('#subjecttxt').prop('selectedIndex',0);
          
        });

     }

    });
  });
  </script>
  <script type="text/javascript">

      // FOR MY JOB
      $("#searched-publish-projects").hide();
      $("#searched-project-history").hide();
      //display project details on click od project
      $(document).on("click", "#progressProjectList li", function(event) {
          var projectid = $(this).attr('id');
          var onholdflag = $(this).attr("data-id");
          $("#progressProjectList li a").removeClass('active');
          $("#"+projectid).children('a').addClass("active");
         
          getProgressProjectDetails(projectid,onholdflag);
          
      });

      function getProgressProjectDetails(projectid,onholdflag) {
          
          if(onholdflag == 1)
          {
            $("#addstatus").text('View Notes');
            //document.getElementById("addstatus").value="View Status";
            document.getElementById('add_project_status').style.display='none'; 
          }
          else
          {
            $("#addstatus").text('Add Notes');
            document.getElementById('add_project_status').style.display='block'; 
          }
          document.getElementById("project_id").value = projectid;
          
           $.ajax({
              type: 'GET',
                url: '<?php echo route('projectDetails'); ?>',
                data: {projectid:projectid},
                dataType: 'json',
            })

            .done(function(msg) {
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
             $("#mybid").text(msg.mybid);
             $("#onsitedate").text(msg.onsitedate);
            
          });
      }

  </script>

    <script>
      
      
    $('#project_history_manager').click(function(){
      var projectid = document.getElementById("project_history_id").value;
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

   /* $('#rating-btn').click(function(){

      var projectid = document.getElementById("project_history_id").value;
      $('#rating-star').starRating('setRating', 0.0);
      $('#ratingNumber').html('0.0');
      document.getElementById("projectreview").value = '';
      $.ajax({
            type: 'GET',
              url: '<?php //echo route('viewManagerProfile'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
           $("#review-manager-name").text(msg.managername);
           $("#review-manager-email").text(msg.manageremail);
           $("#review-manager-company").text(msg.managercompany);
           $("#review-manager-phone").text(msg.managerphone);
           $('#review-manager-profile').attr('src',msg.managerimage );
        });
    });*/
   
    $('#view-status').click(function(){
      var projectid = document.getElementById("project_history_id").value;
    $("#statuslist").empty();
      document.getElementById('add_project_status').style.display='none'; 
     $.ajax({
            type: 'GET',
              url: '<?php echo route('viewStatus'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {

            if(msg.status != 0)
            {
              $('#statuslist').show();
              document.getElementById('no_any_status').style.display='none'; 
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
              $('#statuslist').hide();
                document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });

    </script>
     <script type="text/javascript">

      //-----------------------------------------------------------------------------------------------------
      // FOR JOB FINDER TAB
      $(document).on("click", "#publish-projects li", function(event) {
          var projectid = $(this).attr('id');
          $("#publish-projects li a").removeClass('active');
          $("#"+projectid).children('a').addClass("active");
          getPublishProjectDetails(projectid);
      });

     
      function getPublishProjectDetails(projectid) {
          $("#biderr").text('');
          document.getElementById("publish-project-id").value = projectid;
          
          $.ajax({
              type: 'GET',
              url: '<?php echo route('projectDetails'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
          .done(function(msg) {
              $("#publish-projectid").text(msg.projectid);
              $("#publish-projectname").text(msg.projectname);
              $("#publish-createddate").text(msg.createddate);
              $("#publish-siteaddress").text(msg.siteaddress);
              $("#publish-reportduedate").text(msg.reportduedate);
              $("#publish-propertyType").text(msg.propertyType);
              $("#publish-noOfUnits").text(msg.noOfUnits);
              $("#publish-noOfStories").text(msg.noOfStories);
              $("#publish-sqFootage").text(msg.sqFootage);
              $("#publish-noBuildings").text(msg.noBuildings);
              $("#publish-landArea").text(msg.landArea);
              $("#publish-yearBuilt").text(msg.yearBuilt);
              $("#publish-instructions").text(msg.instructions);
              $("#publish-template").text(msg.template);
              $("#publish-scope").text(msg.scope);
              $("#publish-approxbid").text(msg.approxbid);
              var jobReachCount = msg.jobReachCount;

              $("#jobReach").text(jobReachCount+' '+'People');
              $("#publish-onsitedate").text(msg.onsitedate);
          });
      }

      $("#a_generalSearch").keyup(function () {
        document.getElementById("publish_pagenumber").value = 1;
        value = $(this).val();
        $.ajax({
            type: "GET",
            url: '<?php echo route('searchProject'); ?>',
            data: {search_keyword:value},
            dataType: 'json',
            success: function(response){
              if (response != "" && response['projectdetail'] != null) {
                  
                  var projectData = response['projectdetail'];
                  $("#publish-reportduedate").text(projectData['reportduedate']);
                  $("#publish-instructions").text(projectData['instructions']);
                  $("#publish-projectname").text(projectData['projectname']);
                  $("#publish-createddate").text(projectData['createddate']);
                  $("#publish-siteaddress").text(projectData['siteaddress']);
                  $("#publish-onsitedate").text(projectData['onsitedate']);
                  $("#publish-propertyType").text(projectData['propertyType']);
                  $("#publish-noOfUnits").text(projectData['noOfUnits']);
                  $("#publish-noOfStories").text(projectData['noOfStories']);
                  $("#publish-sqFootage").text(projectData['sqFootage']);
                  $("#publish-noBuildings").text(projectData['noBuildings']);
                  $("#publish-landArea").text(projectData['landArea']);
                  $("#publish-yearBuilt").text(projectData['yearBuilt']);
                  $("#publish-projectid").text(projectData['projectid']);
                  $("#publish-approxbid").text(projectData['approxbid']);
                  $("#approxbid").text(projectData['approxbid']);
                  var jobReachCount = projectData['jobReachCount'];
                  $("#jobReach").text(jobReachCount+' '+'People');
                  $("#publish-bidstatus").text(projectData['bidstatus']);
                  $("#publish-template").text(projectData['template']);
                  $("#publish-scope").text(projectData['scope']);
                  $("#publish-mybid").text(projectData['mybid']);
                  //$("#publish-projects").hide();
                  $("#div-no-project").hide();
                  $("#div-project").show();
                  $("#publish-projects").show();
                  $("#publish-project-list").show();
                  $("#publish-project-list").html('');
                  $("#publish-project-list").html(response['appendLi']);
              }
              else{
                  $("#div-project").hide();
                  $("#publish-project-list").hide();
                  $("#publish-projects").hide();
                  $("#div-no-project").show();
                  $("#div-no-project").html("<br><br><h2>No data found.</h2>");
              }
            }
        });
      });

      //-----------------------------------------------------------------------------------------------------
      
      //ON click of tab update project details
      $(document).on("click", "#leftTabs li", function(event) {
        var tabSelected = $(this).attr('id');
        if (tabSelected == 'job_finder') {
              $('#b_tab').hide();
              $("#c_tab").hide();
              $("#a_tab").show();
              
              //document.getElementById("publish_pagenumber").value = 1;
              document.getElementById("a_generalSearch").value = '';
              $("#publish-projects").show();
              $("#publish-project-list").show();
              $("#div-project").show();
              $("#div-no-project").hide();

              var projectid = document.getElementById("publish-project-id").value;
              /*("#project-name-list li a").removeClass('active');*/
              $("#"+projectid).children('a').addClass("active");
          }
      });
      $(document).on("click", "#leftTabs li", function(event) {
          var tabSelected = $(this).attr('id');
          if (tabSelected == 'my-jobs') {
              $('#a_tab').hide();
              $("#c_tab").hide();
              $("#b_tab").show();
              
              //document.getElementById("pagenumber").value = 1;
              var projectid = document.getElementById("project_id").value;
              /*("#project-name-list li a").removeClass('active');*/
              $("#"+projectid).children('a').addClass("active");
             /* $("#publish-projects").show();
              //$("#searched-publish-projects").hide();
              $("#div-project").show();
              $("#div-no-project").hide();*/
          }
      });

      //-----------------------------------------------------------------------------------------------------
      // FOR JOB HISTORY TAB

      
      $(document).on("click", "#project_history li", function(event) {
          var projectid = $(this).attr('id');
          $("#project_history li a").removeClass('active');
          $("#"+projectid).children('a').addClass("active");
          getHistoryProjectDetails(projectid);
      });

     
      function getHistoryProjectDetails(projectid) {
         
          document.getElementById("project_history_id").value = projectid;
          
          $.ajax({
              type: 'GET',
              url: '<?php echo route('projectDetails'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
          .done(function(msg) {
                $("#history_projectid").text(msg.projectid);
                $("#history_projectname").text(msg.projectname);
                $("#history_createddate").text(msg.createddate);
                $("#history_siteaddress").text(msg.siteaddress);
                $("#history_reportduedate").text(msg.reportduedate);
                $("#history_propertyType").text(msg.propertyType);
                $("#history_noOfUnits").text(msg.noOfUnits);
                $("#history_noOfStories").text(msg.noOfStories);
                $("#history_sqFootage").text(msg.sqFootage);
                $("#history_noBuildings").text(msg.noBuildings);
                $("#history_landArea").text(msg.landArea);
                $("#history_yearBuilt").text(msg.yearBuilt);
                $("#history_instructions").text(msg.instructions);
                $("#history_template").text(msg.template);
                $("#history_scope").text(msg.scope);
                $("#history_approxbid").text(msg.approxbid);
                $("#history_mybid").text(msg.mybid);
                $("#history_onsitedate").text(msg.onsitedate);
                //$("#history_rating").text(msg.rating);
                /*var rating = msg.rating;
                if(rating == '0.0')
                {
                  document.getElementById('ratingstar').innerHTML = "";
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            
                }
                else
                {
                  var pointvalue = rating.toString().split(".")[1];
                  document.getElementById('ratingstar').innerHTML = "";
                  for(var i = 1; i <= rating; i++) {

                    $("#ratingstar").append('<i class="fa fa-star"></i>');
                  }
                  if(pointvalue != 0)
                  {
                    $("#ratingstar").append('<i class="fa fa-star-half"></i>');
                  }
                }
                $("#history_comment").text(msg.comment);*/
                /*if(msg.ratingflag == 0)
                {
                  $('#button-div').html('');
                  $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>');
                  $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#completed-project" id="rating-btn">Add Rating</button>');
                }
                else
                {
                  $('#button-div').html('');
                  $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>');

                }
           */
          });
      }

      //---------------------------------------------------------------------------------------
      $("#c_generalSearch").keyup(function () {
        value = $(this).val();
        document.getElementById("history_pagenumber").value = 1;
        $.ajax({
            type: "GET",
            url: '<?php echo route('searchProjectHistory'); ?>',
            data: {search_keyword:value},
            dataType: 'json',
            success: function(response){
              if (response.appendLi != "") {
                var projectData = response['history_projectdetail'];
                $("#history_projectid").text(projectData['projectid']);
                $("#history_projectname").text(projectData['projectname']);
                $("#history_createddate").text(projectData['createddate']);
                $("#history_siteaddress").text(projectData['siteaddress']);
                $("#history_reportduedate").text(projectData['reportduedate']);
                $("#history_propertyType").text(projectData['propertyType']);
                $("#history_noOfUnits").text(projectData['noOfUnits']);
                $("#history_noOfStories").text(projectData['noOfStories']);
                $("#history_sqFootage").text(projectData['sqFootage']);
                $("#history_noBuildings").text(projectData['noBuildings']);
                $("#history_landArea").text(projectData['landArea']);
                $("#history_yearBuilt").text(projectData['yearBuilt']);
                $("#history_instructions").text(projectData['instructions']);
                $("#history_template").text(projectData['template']);
                $("#history_scope").text(projectData['scope']);
                $("#history_approxbid").text(projectData['approxbid']);
                $("#history_mybid").text(projectData['mybid']);
                $("#history_onsitedate").text(projectData['onsitedate']);
                /*$("#history_rating").text(projectData['rating']);
                var rating = projectData['rating'];
                if(rating == '0.0')
                {
                  document.getElementById('ratingstar').innerHTML = "";
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
                  $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            
                }
                else
                {
                  var pointvalue = rating.toString().split(".")[1];
                  document.getElementById('ratingstar').innerHTML = "";
                  for(var i = 1; i <= rating; i++) {

                    $("#ratingstar").append('<i class="fa fa-star"></i>');
                  }
                  if(pointvalue != 0)
                  {
                    $("#ratingstar").append('<i class="fa fa-star-half"></i>');
                  }
              }*/

             /* if(projectData['ratingflag'] == 0)
              {
                $('#button-div').html('');
                $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>');
                $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#completed-project" id="rating-btn">Add Rating</button>');
              }
              else
              {
                $('#button-div').html('');
                $('#button-div').append('<button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>');

              }*/
           
             // $("#history_comment").text(projectData['comment']);
                  
                  $("#historyProjectDetail").show();
                  $("#project_history").show();
                  $("#project-history-list").show();
                  $("#project-history-list").html('');
                  $("#project-history-list").html(response['appendLi']);
                  $("#div-history-no-project").hide();

              }
              else{
                  // $("#publish-projects").html("");
                  $("#historyProjectDetail").hide();
                  $("#project-history-list").hide();
                  $("#project_history").hide();
                  $("#div-history-no-project").show();
                  $("#div-history-no-project").html("<br><br><h2>No data found.</h2>");
              }
            }
        });
      });

      //-----------------------------------------------------------------------------------------------------
       //-----------------------------------------------------------------------------------------------------
      
      //ON click of tab update project details
      $(document).on("click", "#leftTabs li", function(event) {
          var tabSelected = $(this).attr('id');
          if (tabSelected == 'project-History') {

            //document.getElementById("history_pagenumber").value = 1;
             $('#b_tab').hide();
              $("#a_tab").hide();
              $("#c_tab").show();
              document.getElementById("history_pagenumber").value = 1;
              var projectid = document.getElementById("project_history_id").value;
             //$("#project-history-list li a").removeClass('active');
              //alert(projectid);
              //$("#3").children('a').addClass("active");
              $("#c_generalSearch").val("");
              $("#div-historyProject").show();
              $("#historyProjectDetail").show();
              $("#project_history").show();
              $("#project-history-list").show();
              $("#div-history-no-project").hide();
          }
      });

      //-----------------------------------------------------------------------------------------------------

      $('#publish-manger').click(function(){
          var projectid = document.getElementById("publish-project-id").value;
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

     $('#submitbid').click(function(){
      var projectid = document.getElementById("publish-project-id").value;
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
              document.getElementById("bid").value = '';
            }
        });
    }); 
     $('#acceptProject').click(function(){
      var projectid = document.getElementById("publish-project-id").value;
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
     var projectid = document.getElementById("publish-project-id").value;
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


    <script type="text/javascript">
    //pagination for in progress projects list

      $("#project-name-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('pagenumber').value;
        var pagenumber = ++pagenumber1;
        document.getElementById('pagenumber').value = '';
        document.getElementById('pagenumber').value = pagenumber;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('loadInProgressProject'); ?>',
            data: {pagenumber:pagenumber},
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
           // pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
    });

      //pagination for progress status list

        $("#project-status-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('status_pagenumber').value;
        var pagenumber = ++pagenumber1;
        var projectid = document.getElementById("project_id").value;
        document.getElementById('status_pagenumber').value = '';
        document.getElementById('status_pagenumber').value = pagenumber;
        //var $results = $("#projectlist");
        //var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('statusPagination'); ?>',
            data: {pagenumber:pagenumber,projectid:projectid},
            dataType: 'json',
       
        beforeSend: function(xhr) {
         /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
        },
        success: function(data) {
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#statuslist");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            //pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
    });

         //pagination for Job finder list

        $("#publish-project-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('publish_pagenumber').value;
        var search = document.getElementById('a_generalSearch').value;
      
        var pagenumber = ++pagenumber1;
        document.getElementById('status_pagenumber').value = '';
        document.getElementById('status_pagenumber').value = pagenumber;
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
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#publish-project-list");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            //pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
     
    });

    
     //pagination for Job history list

        $("#project-history-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('history_pagenumber').value;
        var search = document.getElementById('c_generalSearch').value;
        
        var pagenumber = ++pagenumber1;
        document.getElementById('status_pagenumber').value = '';
        document.getElementById('status_pagenumber').value = pagenumber;
       //var $results = $("#projectlist");
        //var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('historyPagination'); ?>',
            data: {pagenumber:pagenumber,search_keyword:search},
            dataType: 'json',
       
        beforeSend: function(xhr) {
         /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
        },
        success: function(data) {
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#project-history-list");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            //pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
         /* else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
      
    });
    </script>
    <script type="text/javascript">
   /* $(function() {

      $(".svg-star-rating").starRating({
        totalStars: 5,
        starShape: 'rounded',
        starSize: 20,
        emptyColor: '#D8D8D8',
        hoverColor: '#efce4a',
        activeColor: '#efce4a',
        ratedColor:'#efce4a',
        useGradient: false,
        disableAfterRate:false
      });
    });
    $("#rating-star").click(function() {
    var rating = $('#rating-star').starRating('getRating');
    var rating = rating.toFixed(1);
    $('#ratingNumber').html(rating);
});*/

//store user reviews 
/*$('#submit-review').click(function(){
    $(".loader").fadeIn("slow");
        var projectid = document.getElementById("project_history_id").value;
       
        var rating = $('#ratingNumber').html();
        var comment  = document.getElementById("projectreview").value;
        if(comment == '')
        {
            $(".loader").fadeOut("slow");
            $("#reviewerror").text('Please give comment');
            $("#projectreview").focus();
            return false;
        }
        $.ajax({
            type: 'GET',
            url: '<?php //echo route('associateReviewStore'); ?>',
            data: {projectid:projectid,rating:rating,comment:comment},
            dataType: 'json',
        })
        .done(function(msg) {
            $(".loader").fadeOut("slow");
            if(msg.status == 1)
            {
                alert(msg.message);
                $("#completed-project").modal("hide");
            }
    });
});*/
  </script>
</body>

</html>