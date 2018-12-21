
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
      <div class="panel-heading">
        <h3 class="panel-title">
          @if(isset($admin))
            Admin Users
          @else
            Associate And Project Manager Users
          @endif
      </h3>
    </div>
    <div class="table-responsive">
      @if($count > 0)
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr bgcolor="#EEEEEE">
              <th style="text-align: center;vertical-align: middle;">Image</th>
              <th style="text-align: center;vertical-align: middle;">User Name</th>
              @if(!isset($admin))
                <th style="text-align: center;vertical-align: middle;">Company</th>
              @endif
              <th style="text-align: center;vertical-align: middle;">Email</th>
              @if(!isset($admin))
                <th style="text-align: center;vertical-align: middle;">Address</th>
              @endif
              @if(!isset($admin))
                <th style="text-align: center;vertical-align: middle;">Type</th>
              @endif
              @if(!isset($admin))
                <th style="text-align: center;vertical-align: middle;">Scope Performed</th>
              @endif
              <th style="text-align: center;vertical-align: middle;" width="15%">Enrolled </th>
              <th style="text-align: center;vertical-align: middle;">Status</th>
              @if(!isset($admin))
                <th style="text-align: center;vertical-align: middle;">Approved By</th>
              @endif
              <th style="text-align: center;vertical-align: middle;">Action</th>
            </tr>
          </thead>
          <tbody id="usertable">
            @foreach ($users as $user)
              <tr class="content">
                <td style="text-align: center;vertical-align: middle;">
                  @if(isset($user->users_profile_image))
                    <?php $user['users_profile_image'] = asset("/img/users/" . $user['users_profile_image']); ?>
                    <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "{{ $user['users_profile_image'] }}" />
                  @else
                    <img style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src='{{asset('/img/users/default.png')}}'/>
                  @endif
                  </td>
                  <td style="text-align: center;vertical-align: middle;">
                  @if(!isset($admin))
                    {{ ucfirst($user->users_name) }}<br><br>
                    <a class="text-primary" href="{{url('projects/'.$user['users_id'])}}">
                    <span class="badge badge-danger">Projects</span></a>
                  @else
                    {{ ucfirst($user->users_name) }}<br>

                  @endif
                </td>
                @if(!isset($admin))
                  <td style="text-align: center;vertical-align: middle;">{{ $user->users_company }}</td>
                @endif
                <td style="text-align: center;vertical-align: middle;">{{ $user->users_email }}<br>
                  {{ $user->users_phone }}
                </td>
                @if(!isset($admin))
                  <td style="text-align: center;vertical-align: middle;">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $user->users_address }}">
                    <img style="max-width:30px;max-height:30px;min-width:30px;min-height:30px;" src="{{asset('/img/home.svg')}}"></a></td>
                @endif
                @if(!isset($admin))
                  <td style="text-align: center;vertical-align: middle;">
                    {{ $user->usertype->user_types }}</td>
                @endif
                @if(!isset($admin))
                  <td style="text-align: center;vertical-align: middle;">
                    @if($user->user_types_id == 2)
                      @foreach($user->scopeperformed as $scopeperform)
                        {{ $scopeperform->scope_performed }},
                      @endforeach
                      <?php
                        $temp = explode(",", $user->scopeperformed);
                        foreach($temp as $scope)
                        {
                          foreach ($scopeperformed as $value) 
                          {
                            if($value->scope_performed_id==$scope)
                            {
                                echo $value->scope_performed;
                                echo ",<br>";
                            }
                        }
                       
                        }  
                      ?> 
                    
                    @else
                      -
                    @endif
                  </td>
                @endif
                <?php $date1=date("Y-m-d H:i:s");
                  $date2= date($user->created_at);
                  $datetime1 = new DateTime($date1);
                  $datetime2 = new DateTime($date2);
                  $date= $datetime2->format("m-d-Y");
                  $interval = $datetime1->diff($datetime2);
                  $days = $interval->format(' %a days ago');?>
                    <td style="text-align: center;vertical-align: middle;">
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
                    @if(!isset($admin))
                    @if($user->users_approval_status == 1 )
                   
                    <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>

                   @elseif($user->users_approval_status == 0)
                 
                    <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>
                    @elseif($user->users_approval_status == 2)
                  
                   <td style="text-align: center;vertical-align: middle;">-</td>
                    @else
              
                  <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>

                   @endif
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
                          
                        </ul>
                      </div>
                   </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        else
          <h6><center>No user available</center></h6>
          <br>
        @endif
      </div>
    </div>
    {!! $users->appends(\Request::except('page'))->render() !!}
  </div>
@stop
@section('script') 



<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

@endsection
                       
                     
                    
                     
   

                     
                    