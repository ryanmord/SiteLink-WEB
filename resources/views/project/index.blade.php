@extends('layouts.main_layout')
@section('main-content')
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">

            {{ ucfirst($user) }}'s Projects</h3>
        </div>
        <div class="table-responsive">
            @if(isset($projects))
            <table class="table table-bordered table-hover table-striped">
		        <thead>
                    <tr bgcolor="#EEEEEE">
                        <th style="text-align: center;vertical-align: middle;">Project ID</th>
                        <th style="text-align: center;vertical-align: middle;">Project Name</th>
                        <th style="text-align: center;vertical-align: middle;">Site Address</th>
                        <th style="text-align: center;vertical-align: middle;" width="10%">Approx Bid</th>
                        <th style="text-align: center;vertical-align: middle;">Status</th>
                        <th style="text-align: center;vertical-align: middle;">Created</th>
                        <th style="text-align: center;vertical-align: middle;">Action</th>
                    </tr>
    	        </thead>
    	        <tbody id="myTable">
                    @foreach ($projects as $project)
               	        <tr class="content">
                            <td style="text-align: center;vertical-align: middle;">
                                {{ $project['project_id'] }}
                            </td>
					       <td style="text-align: left;vertical-align: middle;">
					           {{ $project['project_name'] }}
                                <br>
                                
					        </td>
					        <td style="text-align: left;vertical-align: middle;">
                            {{ $project['project_site_address'] }}
					       
					        </td>
					
                            
                            <td style="text-align: left;vertical-align: middle;">
                                <span class="glyphicon glyphicon-usd"></span>
                                {{ $project['approx_bid'] }}
                            </td>

                            <td style="text-align: center;vertical-align: middle;">
                                @if($project['status'] == 5)
                                    <span class="badge badge-danger">Cancelled</span>
                                @elseif($project['status'] == 4)
                                    <span class="badge badge-success">Complete</span>
                                @elseif($project['status'] == 3)
                                    <span class="badge badge-warning">In Progress</span>
                                @elseif($project['status'] == 6)
                                    <span class="badge badge-primary">Onhold</span>
                                @else
                                    <span class="badge badge-info">Open</span>
                                @endif
                            </td>
                            <?php
                                $date= date($project['created_at']);
                                $datetime2 = new DateTime($date);
                                $date= $datetime2->format("m/d/Y");
                            ?>
					        <td style="text-align: center;vertical-align: middle;">
                                {{$date}}
                            </td>
                            
                            <td style="text-align: center;vertical-align: middle;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                    <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                    right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                   
                                
                                        <li><a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">View</a></li>
                                        @if($project['usertype'] == 1)
                                        <li><a href="{{url('projectBid/'.$project['project_id'])}}">Bids</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
				    @endforeach
                </tbody>
    		</table>
            @else
                <br>
                <h6><center>No Projects created</center></h6>
                <br>

    		@endif
    	</div>
    </div>
   
</div>
@endsection
