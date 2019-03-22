@extends('layouts.main_layout')
@section('main-content')
<div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-success">
        @if ($message = session('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="panel-heading" style="height: 50px;">
            <h3 class="panel-title">
                Scoped Projects 
                @if(session('loginusertype') == 'admin')
                    <a href="{{ url('/createProject') }}"><button type="button" class="btn btn-danger" style="float: right;text-align: center;">Create Project</button></a>
                @endif
            </h3>
        </div> 
        <div class="content-row">
            <div class="row">
                <div>
                    <ul id="myTab1" class="nav nav-tabs nav-justified">
                        @if(isset($nonallocatedproject))
                            <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Scheduling <span class="badge" style="background-color:#DB5A6B;" id="open-count">{{ count($nonallocatedproject) }}</span></a></li>
                        @else
                            <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Open </a></li>
                        @endif
                        @if(isset($projects))
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress <span class="badge" style="background-color:#DB5A6B;" id="allocated-count">{{ count($projects) }}</span></a></li>
                        @else
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress</a></li>
                        @endif
                        @if(isset($completedproject))
                            <li><a href="#completedproject" data-toggle="tab">Complete <span class="badge" style="background-color:#DB5A6B;" id="complete-count">{{ count($completedproject) }}</span></a></li>
                        @else
                            <li><a href="#completedproject" data-toggle="tab">Complete</a></li>
                        @endif
                        @if(isset($cancelledproject))
                            <li><a href="#cancelledproject" data-toggle="tab">Cancelled 
                            <span class="badge" style="background-color:#DB5A6B;" id="cancel-count">{{ count($cancelledproject) }}</span></a></li>
                        @else
                            <li><a href="#cancelledproject" data-toggle="tab">Cancelled</a></li>
                        @endif
                        @if(isset($onholdprojects))
                            <li><a href="#onholdproject" data-toggle="tab">On Hold <span class="badge" style="background-color:#DB5A6B;" id="onhold-count">{{ count($onholdprojects) }}</span></a></li>
                        @else
                            <li><a href="#onholdproject" data-toggle="tab">On Hold</a></li>
                        @endif
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="allocatedprojects">
                            
                            <div class="table-responsive">
                                @if(isset($projects))
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr bgcolor="#EEEEEE">
                                                <th class="table-td-th">Project Identifier</th>
                                                <th class="table-td-th">Project Name</th>
                                                <th class="table-td-th">Site Address</th>
                                                <th  width="10%" class="table-td-th">Final Bid</th>
                                                <th class="table-td-th">Scope</th>
                                                @if(session('loginusertype') == 'admin')
                                                 <th class="table-td-th">Project Manager</th>
                                                @endif
                                                <th class="table-td-th">Assigned To</th>
                                                <th class="table-td-th">Created</th>
                                               
                                                <th class="table-td-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="allocated-data">
                                            @foreach ($projects as $project)
                                                <tr class="content">
                                                    <td style="vertical-align: left; text-align: center;">
                                                        {{ $project['identifier'] }}
                                                    </td>
                                                    <td style="text-align: left;vertical-align: middle;">
                                                        {{ $project['project_name'] }}
                                                    </td>
                                                    <td style="text-align: left;vertical-align: middle;">
                                                    {{ $project['project_site_address'] }}
                                                       <!--  <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $project['project_site_address'] }}">
                  
                                                            <img style="max-width:30px;max-height:30px;min-width:30px;min-height:30px;" src="{{asset('/img/home.svg')}}">
                                                        </a> -->
                                                    </td>
                                                    <td style="text-align: left;vertical-align:middle; ">
                                                        <span class="glyphicon glyphicon-usd"></span>
                                                        {{ $project['approx_bid'] }}
                                                    </td>
                                                    <td style="text-align: left;vertical-align:middle; ">
                                                        
                                                        {{ $project['scopevalue'] }}
                                                    </td>
                                                     @if(session('loginusertype') == 'admin')
                                                        <td style="text-align: left;vertical-align: middle;">
                                                        {{ $project['managername'] }}
                                                    </td>
                                                    @endif
                                                    <td style="text-align: left;vertical-align: middle;">
                                                        {{ $project['associatename'] }}
                                                    </td>
                 
                                                    <?php
                                                        $date= date($project['created_at']);
                                                        $datetime2 = new DateTime($date);
                                                        $date= $datetime2->format("m/d/Y");
                                                    ?>
                                                    <td style="text-align: center;vertical-align: middle;">
                                                        {{$date}}
                                                    </td>
                                                   
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                            <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                            right: 100% !important;text-align: left !important;transform: translate(-75%, 0) !important;">
                                                            @if(session('loginusertype') == 'admin')
                                                                <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                            @else
                                                            <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                            <!-- <li id="complete-menu" data-id="{{ $project['project_id'] }}"><a href="#" data-toggle="modal" data-target="#rating-project">Complete</a></li> -->
                                                            <li><a href="{{url('/allProejcts/projectComplete/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure complete this project?')">Complete</a></li>
                                                            <li><a href="{{url('/allProejcts/projectCancel/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure cancel this project?')">Cancel</a></li>
                                                            <li><a href="{{url('/allProejcts/projectOnHold/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure hold this project?')">On Hold </a></li>
                                                            @endif
                                                           <!--  @if($project['statuscount'] != 0)
                                                             <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">View Notes</a></li>
                                                            @endif -->
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="allocated-pagination">
                                            <!--  <li><a href="#">PREV</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li class="disabled"><a href="#">NEXT</a></li> -->
                                        </ul>
                                    </div>
                                    </div>
                                    @else
                                        <h6><center>No any project in progress</center></h6>
                                    @endif
                                </div>
                                @if(session('loginusertype') != 'admin')
                                    @include('project.rating')
                                @endif
                            </div>
                            <div class="tab-pane fade" id="completedproject">
                                <div class="table-responsive">
                                    @if(isset($completedproject))
                                    <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th">Project Identifier</th>
                                        <th class="table-td-th">Project Name</th>
                                        <th class="table-td-th">Site Address</th>
            
                                        <th class="table-td-th" width="10%">Final Bid</th>
                                        <th class="table-td-th">Scope</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th class="table-td-th">Project Manager</th>
                                        @endif
                                        <th class="table-td-th">Assigned To</th>
                                        <th class="table-td-th">Created</th>
                                        <th class="table-td-th">Completed</th>
            
                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="complete-data">
                                    @foreach ($completedproject as $project)
                                    <tr class="content">
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['identifier'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_site_address'] }}
                   
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['approx_bid'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            
                                            {{ $project['scopevalue'] }}
                                        </td>
                                        @if(session('loginusertype') == 'admin')
                                            <td style="text-align: left;vertical-align: middle;">
                                                {{ $project['managername'] }}
                                            </td>
                                        @endif
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['associatename'] }}
                                        </td>
                 
                                        <?php
                                            $date= date($project['created_at']);
                                            $datetime2 = new DateTime($date);
                                            $date= $datetime2->format("m/d/Y");?>
                                        <td class="table-td-th">
                                            {{$date}}
                                        </td>
                   
                                        <?php $date1=date("Y-m-d H:i:s");
                                            $date2= date($project['completeddate']);
                                            $datetime1 = new DateTime($date1);
                                            $datetime2 = new DateTime($date2);
                                            $date= $datetime2->format("m/d/Y");
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format(' %a days ago');?>
                                        <td class="table-td-th">
                                            {{$date}}
                                        </td>
                                        <td class="table-td-th">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                <!-- @if($project['statuscount'] != 0)
                                                    <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">View Notes</a></li>
                                                @endif -->
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="complete-pagination">
                                           
                                        </ul>
                                    </div>
                            </div>
                            @else
                                <h6><center>No any projects completed</center></h6>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cancelledproject">
                        <div class="table-responsive">
                            @if(isset($cancelledproject))
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#EEEEEE">
                                            <th sclass="table-td-th">Project Identifier</th>
                                            <th class="table-td-th">Project Name</th>
                                            <th class="table-td-th">Site Address</th>
          
                                            <th class="table-td-th" width="10%">Final Bid</th>
                                            <th class="table-td-th">Scope</th>
                                            @if(session('loginusertype') == 'admin')
                                            <th class="table-td-th">Project Manager</th>
                                            @endif
                                            <th class="table-td-th">Assigned To</th>
            
                                            <th class="table-td-th">Created</th>
            
                                            <th class="table-td-th">Cancelled</th>
                                            <th class="table-td-th">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cancel-data">
                                        @foreach ($cancelledproject as $project)
                                        <tr class="content">
                                            <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['identifier'] }}
                                            </td>
                                            <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                            </td>
                                            <td style="text-align: left;vertical-align: middle;">
                                                {{ $project['project_site_address'] }}
                                            </td>
                                            <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['approx_bid'] }}
                                            </td>
                                            <td style="text-align: left;vertical-align: middle;">
                                           
                                            {{ $project['scopevalue'] }}
                                            </td>
                                            @if(session('loginusertype') == 'admin')
                                            <td style="text-align: left;vertical-align: middle;">
                                                {{ $project['managername'] }}
                                            </td>
                                            @endif
                                            <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['associatename'] }}
                                            </td>
                 
                                            <?php
                                                $date= date($project['createddate']);
                                                $datetime2 = new DateTime($date);
                                                $date= $datetime2->format("m/d/Y");?>
                                            <td class="table-td-th">
                                                {{$date}}
                                            </td>
                   
                                            <?php $date1=date("Y-m-d H:i:s");
                                                $date2= date($project['cancelleddate']);
                                                $datetime1 = new DateTime($date1);
                                                $datetime2 = new DateTime($date2);
                                                $date= $datetime2->format("m/d/Y");
                                                $interval = $datetime1->diff($datetime2);
                                                $days = $interval->format(' %a days ago');?>
                                            <td class="table-td-th">
                                                {{$date}}
                                            </td>
                                            <td class="table-td-th">
                                                <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                   <!--  @if($project['statuscount'] != 0)
                                                    <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">View Noes</a></li>
                                                    @endif -->
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="cancel-pagination">
                                           
                                        </ul>
                                    </div>
                             </div>
                        @else
                            <h6><center>No any projects cancelled</center></h6>
                        @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="onholdproject">
                        <div class="table-responsive">
                        @if(isset($onholdprojects))
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th">Project Identifier</th>
                                        <th class="table-td-th">Project Name</th>
                                        <th class="table-td-th">Site Address</th>
                                        <th class="table-td-th" width="10%">Final Bid</th>
                                        <th class="table-td-th">Scope</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th class="table-td-th">Project Manager</th>
                                        @endif
                                        <th class="table-td-th">Assigned To</th>
            
                                        <th class="table-td-th">Created</th>
                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="onhold-data">
                                    @foreach ($onholdprojects as $project)
                                    <tr class="content">
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['identifier'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_site_address'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['approx_bid'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            
                                            {{ $project['scopevalue'] }}
                                        </td>
                                        @if(session('loginusertype') == 'admin')
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['managername'] }}
                                        </td>
                                        @endif
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['associatename'] }}
                                        </td>
                 
                                        <?php
                                            $date= date($project['createddate']);
                                            $datetime2 = new DateTime($date);
                                            $date= $datetime2->format("m/d/Y");?>
                                        <td class="table-td-th">
                                            {{$date}}
                                        </td>
                                        <td class="table-td-th">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                    right: 100% !important;text-align: left; !important;transform: translate(-75%, 0) !important;">
                    
                                                    @if(session('loginusertype') == 'admin')
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                    @else
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                       
                                                    <li><a href="{{url('/allProejcts/projectInProgress/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure In progress this project?')">In Progress</a></li>
                                                    @endif
                                                  <!--   @if($project['statuscount'] != 0)
                                                    <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">View Notes</a></li>
                                                    @endif -->
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="onhold-pagination">
                                
                                </ul>
                                </div>
                            </div>
                            @else
                            <h6><center>No any projects on hold</center></h6>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="nonallocatedproject">
                        <div class="table-responsive">
                            @if(isset($nonallocatedproject))
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                    <th class="table-td-th">Project Identifier</th>
                                    <th class="table-td-th">Project Name</th>
                                    <th class="table-td-th">Total Bids</th>
                                    <th class="table-td-th">Site Address</th>
                                    <th class="table-td-th" width="10%">Suggested Bid</th>
                                    <th class="table-td-th">Scope</th>
                                    @if(session('loginusertype') == 'admin')
                                    <th class="table-td-th">Project Manager</th>
                                    @endif
                                    <th class="table-td-th"> Created </th>
                                    <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="open-data">

                                @foreach ($nonallocatedproject as $project)
                                    <tr class="content">
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['identifier'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['bidcount'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_site_address'] }}
                
                                        </td>
                    
                   
                                        <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['approx_bid'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            
                                            {{ $project['scopevalue'] }}
                                        </td>
                                        @if(session('loginusertype') == 'admin')
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['managername'] }}
                                        </td>
                                        @endif
                                        <?php
                                            $date= date($project['created_at']);
                                            $datetime2 = new DateTime($date);
                                            $date= $datetime2->format("m/d/Y");?>
                                        <td class="table-td-th">
                                            {{$date}}
                                        </td>
                    
                                        <td class="table-td-th">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                    @if(session('loginusertype') == 'admin')
                                                        @if($project['createdBy'] == 2)
                                                    <li><a href="{{url('editProject/'.$project['project_id'])}}">Edit</a></li>
                                                        @endif
                                                    @endif
                                                    @if($project['bidcount'] != 0)
                                                    <li><a href="{{url('projectBid/'.$project['project_id'])}}">Show Bids</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="open-pagination">
                                
                                </ul>
                                </div>
                            </div>
                            @else
                            <h6><center>No any Open Projects</center></h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
</div>
@stop
@section('script') 

<script type="text/javascript">

$(window).load(function() {

    $(".loader").fadeOut("slow");
});
/*$('body').on('click','#complete-menu', function (event) {
    $('#star-rating').starRating('setRating', 0.0);
    $('#ratingNumber').html('0.0');
    document.getElementById("projectreview").value = '';
    var projectid = $(this).attr("data-id");
   
   $("#reviewerror").text('');
    document.getElementById('review-project-id').value = projectid;
    $.ajax({
            type: 'GET',
              url: '<?php //echo route('projectAssociate'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            $("#associate-name").text(msg.associatename);
            $("#associate-email").text(msg.associateemail);
            $("#associate-company").text(msg.associatecompany);
            $("#associate-phone").text(msg.associatephone);
            $('#associate-profile').attr('src',msg.associateimage );
          });

});*/
// fill rating star on mouse hover 

/*$("#star-rating").click(function() {
    var rating = $('#star-rating').starRating('getRating');
    var rating = rating.toFixed(1);
    $('#ratingNumber').html(rating);
});

//store user reviews 
$('#submit-review').click(function(){
    $(".loader").fadeIn("slow");
        var projectid = document.getElementById("review-project-id").value;
       
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
              url: '<?php //echo route('projectComplete'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            
          });
        $.ajax({
            type: 'GET',
            url: '<?php //echo route('managerReviewStore'); ?>',
            data: {projectid:projectid,rating:rating,comment:comment},
            dataType: 'json',
        })
        .done(function(msg) {
            $(".loader").fadeOut("slow");
            if(msg.status == 1)
            {
                alert(msg.message);
                location.reload();
            }
    });
});*/
</script>
<script type="text/javascript">
$(function() {

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
</script>

<script type="text/javascript">
//pagination for allocated projects
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#allocated-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#allocated-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#allocated-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page").toggleClass("disabled", currentPage === 1);
        $("#next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#allocated-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#allocated-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#allocated-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
<script type="text/javascript">
//pagination for completed projects
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#complete-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#complete-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#complete-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#complete-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#complete-previous-page").toggleClass("disabled", currentPage === 1);
        $("#complete-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#complete-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "complete-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "complete-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#complete-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#complete-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#complete-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#complete-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
<script type="text/javascript">
//pagination for open projects
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#open-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#open-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#open-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#open-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#open-previous-page").toggleClass("disabled", currentPage === 1);
        $("#open-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#open-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "open-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "open-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#open-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#open-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#open-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#open-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
<script type="text/javascript">
//pagination for onhold projects
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#onhold-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#onhold-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#onhold-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#onhold-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#onhold-previous-page").toggleClass("disabled", currentPage === 1);
        $("#onhold-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#onhold-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "onhold-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "onhold-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#onhold-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#onhold-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#onhold-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#onhold-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
<script type="text/javascript">
//pagination for onhold projects
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#cancel-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#cancel-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#cancel-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#cancel-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#cancel-previous-page").toggleClass("disabled", currentPage === 1);
        $("#cancel-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#cancel-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "cancel-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "cancel-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#cancel-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#cancel-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#cancel-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#cancel-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>

@endsection
