@extends('layouts.main_layout')
@section('main-content')
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="{{ url()->previous() }}">Back</a>
               </a>  &nbsp Status of {{ $projectname }}
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
		        <thead>
                    <tr bgcolor="#EEEEEE">
                        <th style="text-align: center;vertical-align: middle;">Sr.No</th>
                        <th style="text-align: center;vertical-align: middle;">Subject</th>
                        <th style="text-align: center;vertical-align: middle;">Status</th>
                        <th style="text-align: center;vertical-align: middle;">Created</th>
                          
                    </tr>
    	        </thead>
    	        <tbody id="myTable">
                <?php $count = 0; ?>
                    @foreach($status as $value)
               	        <tr class="content">
                            <td style="text-align: center;vertical-align: middle;">
                                {{ ++$count }}
                            </td>
					        <td style="text-align: center;vertical-align: middle;">
                  
					           {{ $value->project_progress_status_subject}}
                       
					        </td>
					
                            <td style="text-align: center;vertical-align: middle;">
                                   
                                {{ $value->project_progress_status }}
                            </td>
                               
                            <?php $date1=date("Y-m-d H:i:s");
                                    $date2= date($value['created_at']);
                                    $datetime1 = new DateTime($date1);
                                    $datetime2 = new DateTime($date2);
                                    $date= $datetime2->format("m-d-Y");
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format(' %a days ago');
                            ?>
                            <td style="text-align: center;vertical-align: middle;">
                                   
                                {{ $date }}
                            </td>
                               
                    
                        </tr>
				    @endforeach
                </tbody>
    		</table>
              
    	</div>
    </div>
</div>
@endsection
