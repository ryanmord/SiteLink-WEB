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
    @if($message = session('message'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="panel-heading">
      <h3 class="panel-title">
        Associate And Project Manager Users 
      </h3>
    </div>
    <div class="content-row">
      <div class="row">
        <div>
          <ul id="myTab1" class="nav nav-tabs nav-justified">
            <li class="active"><a href="#associates" data-toggle="tab">
              Associates & Employees</a></li>
            <li><a href="#managers" data-toggle="tab">Project Managers</a></li>
          </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active in" id="associates">
              <div class="table-responsive">
                @if($associatecount > 0)
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr bgcolor="#EEEEEE">
                        <th width="50px;">Image</th>
                        <th>User Name</th>
                        @if(!isset($admin))
                          <th>Company</th>
                        @endif
                        <th>Email</th>
                        @if(!isset($admin))
                          <th>Address</th>
                        @endif
                        @if(!isset($admin))
                          <th>Scope(s)</th>
                        @endif
                        <th width="10%">Enrolled </th>
                        <th>Status</th>
                        
                        <th>Action</th>
                      </tr>
                            
                    </thead>
                      <tbody id="usertable">
                        @foreach ($associate as $user)
                          <tr class="content">
                            <td>
                            @if(isset($user->users_profile_image))
                            <?php $user['users_profile_image'] = asset("/img/users/" . $user['users_profile_image']); ?>
                            <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "{{ $user['users_profile_image'] }}" />
                            @else
                              <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src='{{asset('/img/users/default.png')}}'/>
                                
                            @endif
                          </td>
                          <td style="text-align: left;">
                            {{ ucfirst($user->users_name) }}<br>{{ ucfirst($user->last_name) }}
                          </td>
                          <td style="text-align: left;">{{ $user->users_company }} </td>
                          <td style="text-align: left;">{{ $user->users_email }}<br>
                            {{ $user->users_phone }}
                          </td>
                          @if(!isset($admin))
                            <td style="text-align: left;">
                            {{ $user->users_address }}
                            </td>
                          @endif
                          <td style="text-align: left;">
                            @if($user->user_types_id == 2)
                              @foreach($user->scopeperformed as $scopeperform)
                                {{ $scopeperform->scope_performed }},
                              @endforeach
                            <?php
                              $temp = explode(",", $user->scopeperformed);
                              foreach($temp as $scope)
                              {
                                foreach ($scopeperformed as $value) {
                                  if($value->scope_performed_id==$scope)
                                  {
                                    echo $value->scope_performed;
                                    echo ",<br>";
                                  }
                                }
                       
                              }  ?> 
                    
                              @else
                                -
                               @endif
                              </td>
                    
                              <?php $date1=date("Y-m-d H:i:s");
                              $date2= date($user->created_at);
                              $datetime1 = new DateTime($date1);
                              $datetime2 = new DateTime($date2);
                              $date= $datetime2->format("m-d-Y");
                              $interval = $datetime1->diff($datetime2);
                              $days = $interval->format(' %a days ago');?>
                              <td style="text-align: left;">
                                {{ $days }}<br>
                                {{$date}}
                              </td>
                              @if($user->users_status == 1 )
                                <td style="color: #5B8930;">
                                <span class="glyphicon glyphicon-ok"></span></td>
                              @else
                                <td style="color: #DB5A6B;">
                                <span class="glyphicon glyphicon-remove"></span></td>
                              @endif
                              <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                  <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                    right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                                    @if($user->users_approval_status == 3)
                                      <li><a href="{{url('users/user/'.$user['users_id'].'/1')}}" onclick="return confirm('Are you want to sure unblock this user?')">Unblock
                                      </a>
                                      </li>
                                    @else

                                      <li><a href="{{url('users/user/'.$user['users_id'].'/3')}}" onclick="return confirm('Are you want to sure block this user?')">Block</a>
                                      </li>
                                    @endif
                     
                                      <li><a href="{{url('projects/'.$user['users_id'])}}">Projects</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else

                    <h6><center>No Associate Available</center></h6>
                    <br>
                    @endif
                  </div>
                  {!! $associate->appends(\Request::except('page'))->render() !!}
                </div>
                <div class="tab-pane fade" id="managers">
                  <div class="table-responsive">
                    @if($managercount > 0)
                    <table class="table table-bordered table-hover table-striped">
                      <thead>
                        <tr bgcolor="#EEEEEE">
                          <th width="50px;">Image</th>
                          <th>User Name
                          </th>
                          <th>Company</th>
                          <th>Email</th>
                          <th width="10%">Enrolled </th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="usertable">
                      @foreach ($manager as $user)
                        <tr class="content">
                          <td style="text-align: center;vertical-align: middle;">
                            @if(isset($user->users_profile_image))
                            <?php $user['users_profile_image'] = asset("/img/users/" . $user['users_profile_image']); ?>
                            <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "{{ $user['users_profile_image'] }}" />
                            @else
                              <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src='{{asset('/img/users/default.png')}}'/>
                            @endif
                          </td>
                          <td style="text-align: left;vertical-align: middle;">
                            {{ ucfirst($user->users_name) }}&nbsp{{ ucfirst($user->last_name) }}
                          </td>
                          <td style="text-align: left;vertical-align: middle;">
                            {{ $user->users_company }}</td>
                          <td style="text-align: left;vertical-align: middle;">
                            {{ $user->users_email }}<br>
                            {{ $user->users_phone }}
                          </td>
                          <?php $date1=date("Y-m-d H:i:s");
                          $date2= date($user->created_at);
                          $datetime1 = new DateTime($date1);
                          $datetime2 = new DateTime($date2);
                          $date= $datetime2->format("m-d-Y");
                          $interval = $datetime1->diff($datetime2);
                          $days = $interval->format(' %a days ago');?>
                          <td style="text-align: left;vertical-align: middle;">
                            {{ $days }}<br>
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
                            @if($user->users_approval_status == 3)
                              <li><a href="{{url('users/user/'.$user['users_id'].'/1')}}" onclick="return confirm('Are you want to sure unblock this user?')">Unblock</a>
                              </li>
                            @else

                              <li><a href="{{url('users/user/'.$user['users_id'].'/3')}}" onclick="return confirm('Are you want to sure block this user?')">Block</a>
                            @endif
                            <li><a href="{{url('projects/'.$user['users_id'])}}">Projects</a>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            @else
              <h6><center>No Project Manager Available</center></h6>
              <br>
            @endif
          </div>
            {!! $manager->appends(\Request::except('page'))->render() !!}
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
