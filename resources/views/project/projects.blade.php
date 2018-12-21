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
                            <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Open <span class="badge" style="background-color:#DB5A6B;">{{ count($nonallocatedproject) }}</span></a></li>
                        @else
                            <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Open </a></li>
                        @endif
                        @if(isset($projects))
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress <span class="badge" style="background-color:#DB5A6B;">{{ count($projects) }}</span></a></li>
                        @else
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress</a></li>
                        @endif
                        @if(isset($completedproject))
                            <li><a href="#completedproject" data-toggle="tab">Complete <span class="badge" style="background-color:#DB5A6B;">{{ count($completedproject) }}</span></a></li>
                        @else
                            <li><a href="#completedproject" data-toggle="tab">Complete</a></li>
                        @endif
                        @if(isset($cancelledproject))
                            <li><a href="#cancelledproject" data-toggle="tab">Cancelled 
                            <span class="badge" style="background-color:#DB5A6B;">{{ count($cancelledproject) }}</span></a></li>
                        @else
                            <li><a href="#cancelledproject" data-toggle="tab">Cancelled</a></li>
                        @endif
                        @if(isset($onholdprojects))
                            <li><a href="#onholdproject" data-toggle="tab">On Hold <span class="badge" style="background-color:#DB5A6B;">{{ count($onholdprojects) }}</span></a></li>
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
                                                <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                                <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                                <th style="text-align: center;vertical-align: middle;">Site Address</th>
                                                <th  width="10%" style="text-align: center;vertical-align: middle;">Final Bid</th>
                                                @if(session('loginusertype') == 'admin')
                                                 <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                                @endif
                                                <th style="text-align: center;vertical-align: middle;">Allocated</th>
                                                <th style="text-align: center;vertical-align: middle;">Created</th>
                                               
                                                <th style="text-align: center;vertical-align: middle;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach ($projects as $project)
                                                <tr class="content">
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        {{ $project['project_id'] }}
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
                                                            <li><a href="{{url('/allProejcts/projectComplete/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure complete this project?')">Complete</a></li>
                                                            <li><a href="{{url('/allProejcts/projectCancel/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure cancel this project?')">Cancel</a></li>
                                                            <li><a href="{{url('/allProejcts/projectOnHold/'.$project['project_id'])}}" onclick="return confirm('Are you want to sure hold this project?')">On Hold </a></li>
                                                            @endif
                                                            @if($project['statuscount'] != 0)
                                                             <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">Status</a></li>
                                                            @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <h6><center>No any project in progress</center></h6>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="completedproject">
                                <div class="table-responsive">
                                    @if(isset($completedproject))
                                    <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                        <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                        <th style="text-align: center;vertical-align: middle;">Site Address</th>
            
                                        <th style="text-align: center;vertical-align: middle;" width="10%">Final Bid</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                        @endif
                                        <th style="text-align: center;vertical-align: middle;">Allocated</th>
                                        <th style="text-align: center;vertical-align: middle;">Created</th>
                                        <th style="text-align: center;vertical-align: middle;">Completed</th>
            
                                        <th style="text-align: center;vertical-align: middle;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($completedproject as $project)
                                    <tr class="content">
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
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
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{$date}}
                                        </td>
                   
                                        <?php $date1=date("Y-m-d H:i:s");
                                            $date2= date($project['completeddate']);
                                            $datetime1 = new DateTime($date1);
                                            $datetime2 = new DateTime($date2);
                                            $date= $datetime2->format("m/d/Y");
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format(' %a days ago');?>
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{$date}}
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                @if($project['statuscount'] != 0)
                                                    <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">Status</a></li>
                                                @endif
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                            <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                            <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                            <th style="text-align: center;vertical-align: middle;">Site Address</th>
          
                                            <th style="text-align: center;vertical-align: middle;" width="10%">Final Bid</th>
                                            @if(session('loginusertype') == 'admin')
                                            <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                            @endif
                                            <th style="text-align: center;vertical-align: middle;">Allocated</th>
            
                                            <th style="text-align: center;vertical-align: middle;">Created</th>
            
                                            <th style="text-align: center;vertical-align: middle;">Cancelled</th>
                                            <th style="text-align: center;vertical-align: middle;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @foreach ($cancelledproject as $project)
                                        <tr class="content">
                                            <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
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
                                            <td style="text-align: center;vertical-align: middle;">
                                                {{$date}}
                                            </td>
                   
                                            <?php $date1=date("Y-m-d H:i:s");
                                                $date2= date($project['cancelleddate']);
                                                $datetime1 = new DateTime($date1);
                                                $datetime2 = new DateTime($date2);
                                                $date= $datetime2->format("m/d/Y");
                                                $interval = $datetime1->diff($datetime2);
                                                $days = $interval->format(' %a days ago');?>
                                            <td style="text-align: center;vertical-align: middle;">
                                                {{$date}}
                                            </td>
                                            <td style="text-align: center;vertical-align: middle;">
                                                <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                    @if($project['statuscount'] != 0)
                                                    <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">Status</a></li>
                                                    @endif
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                        <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                        <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                        <th style="text-align: center;vertical-align: middle;">Site Address</th>
                                        <th style="text-align: center;vertical-align: middle;" width="10%">Final Bid</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                        @endif
                                        <th style="text-align: center;vertical-align: middle;">Allocated</th>
            
                                        <th style="text-align: center;vertical-align: middle;">Created</th>
                                        <th style="text-align: center;vertical-align: middle;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($onholdprojects as $project)
                                    <tr class="content">
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
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
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{$date}}
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
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
                                                    @if($project['statuscount'] != 0)
                                                        <li><a href="{{url('/projectStatus/'.$project['project_id'])}}">Status</a></li>
                                                    @endif
                   
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                    <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center;vertical-align: middle;">Total Bids</th>
                                    <th style="text-align: center;vertical-align: middle;">Site Address</th>
                                    <th style="text-align: center;vertical-align: middle;" width="10%">Suggested Bid</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                    <th style="text-align: center;vertical-align: middle;"> Created </th>
                                    <th style="text-align: center;vertical-align: middle;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">

                                @foreach ($nonallocatedproject as $project)
                                    <tr class="content">
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
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
                                            {{ $project['managername'] }}
                                        </td>
                                        <?php
                                            $date= date($project['created_at']);
                                            $datetime2 = new DateTime($date);
                                            $date= $datetime2->format("m/d/Y");?>
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{$date}}
                                        </td>
                    
                                        <td style="text-align: center;vertical-align: middle;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    
                                                    <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                                    @if(session('loginusertype') == 'admin')
                                                    @if($project['bidcount'] == 0)
                                                    <li><a href="{{url('editProject/'.$project['project_id'])}}">Edit</a></li>
                                                    @else
                                                    <li><a href="{{url('projectBid/'.$project['project_id'])}}">Bids</a></li>
                                                    @endif
                                                    @else
                                                    @if($project['bidcount'] != 0)
                                                    <li><a href="{{url('projectBid/'.$project['project_id'])}}">Bids</a></li>
                                                    @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
</script>

@endsection
