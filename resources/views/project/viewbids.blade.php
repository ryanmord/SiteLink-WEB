@extends('layouts.main_layout')
@section('main-content')
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="{{ url()->previous() }}">Back</a>
               </a>Bids of {{ $projectname }}
            </h3>
        </div>
        <div class="table-responsive">
            @if(isset($bids))
                <table class="table table-bordered table-hover table-striped">
		           <thead>
                        <tr bgcolor="#EEEEEE">
                            <th style="text-align: center;vertical-align: middle;">Associate Name</th>
                            <th style="text-align: center;vertical-align: middle;">Suggested Bid</th>
                            <th style="text-align: center;vertical-align: middle;">Associate Bid</th>
                            <th style="text-align: center;vertical-align: middle;">Created</th>
                            @if(session('loginusertype') == 'admin')
                                @if($bidstatus == 0)
                                    <th style="text-align: center;vertical-align: middle;">Action</th>
                                @endif
                            @endif
                        </tr>
    	            </thead>
    	            <tbody id="myTable">
                        @foreach($bids as $bid)
               	            <tr class="content">
					           <td style="text-align: center;vertical-align: middle;">
                  
					           {{ $bid['associatename'] }}
                       
					           </td>
					
                                <td style="text-align: center;vertical-align: middle;">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['suggestedbid'] }}
                                </td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['associatebid'] }}
                                </td>
                                <?php $date1=date("Y-m-d H:i:s");
                                    $date2= date($bid['createddate']);
                                    $datetime1 = new DateTime($date1);
                                    $datetime2 = new DateTime($date2);
                                    $date= $datetime2->format("m-d-Y");
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format(' %a days ago');
                                ?>
                                <td style="text-align: center;vertical-align: middle;">
                                    {{ $days }} <br>
                                    {{ $date }}
                                </td>
                                @if(session('loginusertype') == 'admin')
                                    @if($bidstatus == 0)
                                        <td style="text-align: center;vertical-align: middle;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                                                    <?php $userid = $bid['associateid'] ?>
                                                    <li><a href="{{url('allProejcts/bid/'.$bid['projectid'].'/'.$bid['associateid'].'/1')}}" onclick="return confirm('Are you want to sure the accept this bid?')">Accept</a></li>
                                                    <li><a href="{{url('allProejcts/bid/'.$bid['projectid'].'/'.$bid['associateid'].'/0')}}" onclick="return confirm('Are you want to sure  the reject this bid?')">Reject</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                @endif

                    
                            </tr>
				        @endforeach
                    </tbody>
    		    </table>
                @else
                    <br>
                    <h6><center>No any bids available</center></h6>
                    <br>
    		    @endif
    	    </div>
        </div>
    </div>
@endsection
