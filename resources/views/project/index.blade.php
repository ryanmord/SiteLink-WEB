@extends('layouts.main_layout')

@section('main-content')
 <div class="col-xs-12 col-sm-9 content">
    <!-- <a href="{{ url()->previous() }}">Back</a> -->
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                <a href="{{ url()->previous() }}">Back</a>
                <a href="javascript:void(0);" class="toggle-sidebar">
                <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>{{ ucfirst($user) }}'s Projects</h3>
            </div>
            <div class="table-responsive">
            @if($projects->count()>0)
           <table class="table table-bordered table-hover table-striped">
			<thead>
            <tr bgcolor="#EEEEEE">
            <th style="text-align: center;vertical-align: middle;">Project Name</th>
            <th style="text-align: center;vertical-align: middle;">Site Address</th>
            <th style="text-align: center;vertical-align: middle;">Scope Performed</th>
            <th style="text-align: center;vertical-align: middle;">Instruction</th>
            <th style="text-align: center;vertical-align: middle;">Approx Bid</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Created_at</th>
            <th style="text-align: center;vertical-align: middle;">Report
            Due Date</th>
            <th style="text-align: center;vertical-align: middle;">Updated_at</th>
           <!--  <th style="text-align: center;vertical-align: middle;">Action</th> -->
            </tr>
    		</thead>
    		<tbody id="myTable">
                @foreach ($projects as $project)
               		<tr class="content">
					<td style="text-align: center;vertical-align: middle;">
					{{ $project->project_name }}
					</td>
					<td style="text-align: center;vertical-align: middle;">
					<a href="#" data-toggle="tooltip" data-placement="top" title="{{ $project->project_site_address }}">
                  
                    <img style="max-width:30px;max-height:30px;min-width:30px;min-height:30px;" src="{{asset('/img/home.svg')}}"></a>
					</td>
					
                    <td style="text-align: center;vertical-align: middle;">
                  
                    <?php
                  
                    $temp = explode(",", $project->scope_performed_id);

                    foreach($temp as $scope)
                    {
                        foreach ($scopeperformed as $value) {
                            if($value->scope_performed_id==$scope)
                            {
                                echo $value->scope_performed;
                                echo ",<br>";
                            }
                        }
                       
                    }   
                    ?>
                    
                   
                 
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                    {{ $project->instructions }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                    <span class="glyphicon glyphicon-usd"></span>
                    {{ $project->approx_bid }}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                   
    				@foreach($project->projectstatustype as $projectstatus)
    				 <?php $status = $projectstatus->project_status; ?>
    				@endforeach
                    <span class="badge badge-success">{{ $status }}</span>
                    </td>
                    <?php
                    $date= date($project->project_created_date);
                    $datetime2 = new DateTime($date);
                    $date= $datetime2->format("m-d-Y");?>
					<td style="text-align: center;vertical-align: middle;">
                    {{$date}}
                    </td>
                    <?php $date1=date("Y-m-d H:i:s");
                    $date2= date($project->report_due_date);
                    $datetime1 = new DateTime($date1);
                    $datetime2 = new DateTime($date2);
                    $date= $datetime2->format("m-d-Y");
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format(' %a days ago');?>
                    <td style="text-align: center;vertical-align: middle;">
                    {{$date}}
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                    <?php $date = date($project->project_updated);
                    $date = new DateTime($date);
                    $date = $date->format("m-d-Y");
                    ?>
                    {{ $date }}
                    </td>
                   <!--  <td style="text-align: center;vertical-align: middle;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></button>
                        <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                      right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                          <li><a href="#">Update</a></li>
                          <li><a href="#">Delete</a></li>
                        </ul>
                      </div>
                   </td> -->

					</tr>
				@endforeach
    		</table>
            @else
            
    		 <h6><center>No Projects created</center></h6>
    		@endif
    		</div>
    		</div>
    		</div>
@endsection
