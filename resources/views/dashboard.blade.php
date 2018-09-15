@extends('layouts.main_layout')

@section('main-content')

        <div class="col-xs-12 col-sm-9 content">
                  <div class="content-row">
                    
                    <div class="row">
                      <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color: #19B5FE;text-align: center;">
                <br>
                <font size="4" color="white"><b>{{ $associate }}</b></font>
                <br>
              
                <font size="4" color="white"><b><i class="glyphicon glyphicon-user"></i>  Associates</b></font>
                </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#26A65B;text-align: center;">
                <br>
                <font size="4" color="white"><b>{{ $schedular }}</b></font>

                <br>
                <font size="4" color="white"><b><i class="glyphicon glyphicon-user"></i>  Schedulers</b></font>
                
                         
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#DB5A6B;text-align: center;">
                 <br>
                <font size="4" color="white"><b>550</b></font>

                <br>
                <font size="4" color="white"><b><i class="fa fa-building-o"></i>  No. of Projects</b></font>
               
                         
                            </div>
                          </div>
                        </div>
                      </div>
                             <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#F5AB35;text-align: center;">
                <br>
                <font size="4" color="white"><b>550</b></font>

                <br>
                <font size="4" color="white"><b><span class="glyphicon glyphicon-briefcase"></span> Total Bids</b></font>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="panel panel-success">
                  @if ($message = session('message'))
                  <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                  </div>
                  @endif
                  <div class="panel-heading">
                  <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Unverified Associate Users <span class="badge" style="background-color:#DB5A6B;">{{ $users->count() }}</span></h3>
                  </div>
                  <div class="table-responsive">
                      @if($users->count()>0)
                        <table class="table table-bordered table-hover table-striped">

                          <thead>
                           <tr bgcolor="#EEEEEE">
                            
                            <th style="text-align: center;vertical-align: middle;">Image</th>
                            <th style="text-align: center;vertical-align: middle;">Name</th>
                            <th style="text-align: center;vertical-align: middle;">Company</th>
                            <th style="text-align: center;vertical-align: middle;">Email</th>
                            <th style="text-align: center;vertical-align: middle;">Phone</th>
                            <th style="text-align: center;vertical-align: middle;">Address</th>
                            <th style="text-align: center;vertical-align: middle;">Enrolled </th>
                            <th style="text-align: center;vertical-align: middle;">Status</th>
                            <th style="text-align: center;vertical-align: middle;">Action</th>
                            </tr>
                    </thead>
                    <tbody id="myTable">
                      @foreach ($users as $user)
               			<tr class="content">
                    <td style="text-align: center;vertical-align: middle;">
                    @if(isset($user->users_profile_image))
                      <?php $user['users_profile_image'] = asset("/img/users/" . $user['users_profile_image']); ?>
                      <img style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "{{ $user['users_profile_image'] }}" />
                    @else
                      <img style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src='{{asset('/img/users/default.png')}}'/>
                    @endif
                    </td>
                    <td style="text-align: center;vertical-align: middle;">{{ ucfirst($user->users_name) }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_company }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_email }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_phone }}</td>
                  	<td style="text-align: center;vertical-align: middle;">
                                      
                    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $user->users_address }}">
                  
                    <img style="max-width:30px;max-height:30px;min-width:30px;min-height:30px;" src="{{asset('/img/home.svg')}}"></a></td>

                    <?php $date1=date("Y-m-d H:i:s");
                    $date2= date($user->users_enrolled);
                    $datetime1 = new DateTime($date1);
                    $datetime2 = new DateTime($date2);
                    $date= $datetime2->format("m-d-Y");
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format(' %a days ago');?>
                    <td style="text-align: center;vertical-align: middle;">
                    {{$days}}<br>
                    {{$date}}
                    </td>
                    @if($user->users_status == 1 )
                    <td style="text-align: center;vertical-align: middle;color: #5B8930;">
                    <span class="glyphicon glyphicon-ok"></span></td>
                    @else
                    <td style="text-align: center;vertical-align: middle;color: #DB5A6B;">
                    <span class="glyphicon glyphicon-remove"></span></td>
                    @endif
                    <td style="text-align: center;vertical-align: middle;">
                    <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                    <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                        right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                    <li><a href="{{url('dashboard/user/'.$user['users_id'].'/1')}}" onclick="return confirm('Do you want to approve this associates?')">Approve</a></li>
                    <li><a href="{{url('dashboard/user/'.$user['users_id'].'/0')}}" onclick="return confirm('Do you want to Reject this associates?')">Reject</a>
                    </li>
                    </ul>
                    </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
                @else
                  <h6><center>No Pending Request</center></h6>
                @endif
              </div>
                {!! $users->links() !!}
          </div>
@endsection