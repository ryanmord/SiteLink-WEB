
@extends('layouts.main_layout')

@section('main-content')
 <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar">
                @if(isset($admin))
                <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Admin Users</h3>
                @else
                <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Associate And Schedular Users</h3>
                @endif
                
              </div>
             
             <!--  <input id="myInput" type="text" placeholder="Search.."> -->
            
               <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-bordered table-hover table-striped">

                          <thead>
                           <tr bgcolor="#EEEEEE">
                            
                            <th style="text-align: center;vertical-align: middle;">Image</th>
                            <th style="text-align: center;vertical-align: middle;">User Name</th>
                            <th style="text-align: center;vertical-align: middle;">Company</th>
                            <th style="text-align: center;vertical-align: middle;">Email</th>
                            <th style="text-align: center;vertical-align: middle;" width="20%">Phone</th>
                            <th style="text-align: center;vertical-align: middle;">Address</th>
                            <th style="text-align: center;vertical-align: middle;">Type</th>
                            @if(!isset($admin))
                            <th style="text-align: center;vertical-align: middle;">Scope Performed</th>
                            @endif
                            <th style="text-align: center;vertical-align: middle;"
                            width="15%">Enrolled </th>
                            <th style="text-align: center;vertical-align: middle;">Status</th>
                            @if(!isset($admin))
                            <th style="text-align: center;vertical-align: middle;">Approval status</th>
                            <th style="text-align: center;vertical-align: middle;">Approved By</th>
                            @endif
                          <th style="text-align: center;vertical-align: middle;">Action</th>
                            </tr>
                            @if(!isset($admin))
                            <tr>
                            
                            <th style="text-align: center;vertical-align: middle;"></th>
                            <th style="text-align: center;vertical-align: middle;">
                            <!-- <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search"> -->
                            </th>
                            
                            <th style="text-align: center;vertical-align: middle;">
                              <!-- <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search"> -->
                            </th>
                            <th style="text-align: center;vertical-align: middle;">
                           <!--  <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search"> -->
                            </th>
                            <th style="text-align: center;vertical-align: middle;">
                            </th>
                            <th style="text-align: center;vertical-align: middle;"></th>
                            <th style="text-align: center;vertical-align: middle;">
                            @if(!isset($admin))
                            <select  class="form-control" id="usertype" onchange='filterText()'>

                                  <option value="">Any</option>
                                  <option value="Associate">Associate</option>
                                  <option value="Scheduler">Scheduler</option>
                            </select>
                            @endif
                            </th>
                            @if(!isset($admin))
                            <th style="text-align: center;vertical-align: middle;"></th>
                            @endif
                            <th style="text-align: center;vertical-align: middle;"></th>
                            <th style="text-align: center;vertical-align: middle;">
                            <!-- <select class="form-control" onchange='filteruserstatus()' id="userstatus">
                            <option value="">Any</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            </select> -->
                            </th>
                            @if(!isset($admin))
                            <th style="text-align: center;vertical-align: middle;">
                            <select class="form-control" id="approvalstatus" onchange='filterstatus()'>
                            <option value="">Any</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Pending">Pending</option>
                            <option value="Blocked">Blocked</option>
                            </select>
                            </th>
                            <th style="text-align: center;vertical-align: middle;"><!-- <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search"> --></th>
                            @endif
                             <th style="text-align: center;vertical-align: middle;"></th>
                            </tr> 
                            @endif
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
                    <td style="text-align: center;vertical-align: middle;">
                    @if($user->user_types_id == 1)
                    <a class="text-primary" href="{{url('projects/'.$user['users_id'])}}">
                    {{ ucfirst($user->users_name) }}</a>
                    @else
                    {{ ucfirst($user->users_name) }}
                    @endif
                    </td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_company }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_email }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_phone }}</td>
                  <td style="text-align: center;vertical-align: middle;">
                                           
                    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $user->users_address }}">
                    <img style="max-width:30px;max-height:30px;min-width:30px;min-height:30px;" src="{{asset('/img/home.svg')}}"></a></td>
                    
                    <td style="text-align: center;vertical-align: middle;">
                    {{ $user->usertype->user_types }}</td>
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
                    @endif
                    <?php $date1=date("Y-m-d H:i:s");
                    $date2= date($user->created_at);
                    $datetime1 = new DateTime($date1);
                    $datetime2 = new DateTime($date2);
                    $date= $datetime2->format("m/d/Y");
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format(' %a days ago');?>
                    <td style="text-align: center;vertical-align: middle;">
                   
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
                   <td style="text-align: center;vertical-align: middle;">
                   <span class="badge badge-success">Approved</span> </td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>

                   @elseif($user->users_approval_status == 0)
                   <td style="text-align: center;vertical-align: middle;">
                   <span class="badge badge-danger">Rejected</span> </td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>
                    @elseif($user->users_approval_status == 2)
                   <td style="text-align: center;vertical-align: middle;">
                  
                  <span class="badge badge-warning">Pending</span> </td>
                   <td style="text-align: center;vertical-align: middle;">-</td>
                    @else
                   <td style="text-align: center;vertical-align: middle;">
                  
                  <span class="badge badge-danger">Blocked</span> </td>
                  <td style="text-align: center;vertical-align: middle;">{{ $user->adminuser->admin_users_name }}</td>

                   @endif
                   @endif
                   <td style="text-align: center;vertical-align: middle;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                        <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                      right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                          <li><a href="#">Update</a></li>
                          <li><a href="#">Delete</a></li>
                        </ul>
                      </div>
                   </td>
              </tr>
                @endforeach
                         </tbody>
                        </table>
                      </div>
                    </div>
                      {!! $users->appends(\Request::except('page'))->render() !!}
                      </div>
                      @stop
                      @section('script') 
                     <!--  <script>
 
$("body").on('change', '#approvalstatus', function() {
    //get the selected value
    var selectedValue = $(this).val();

    //make the ajax call
    $.ajax({
        url: 'user/{status}',
        data: {status : selectedValue},
        success: function(response) {
       /*window.location.replace(response.html);*/
       $('#myTable').html(response);
            
        }
    });
});
    
</script> -->
                     
  <!--  <script>
    $(function(){
       $('#approvalstatus').change(function() {
            $.ajax({
                url: 'testUrl/{id}',
                type: 'GET',
                data: { id: 1 },
                success: function(response)
                {
                    $('#something').html(response);
                }
            });
       });
    });    
</script>
 -->
<script>
function filterText()
  {  
    var rex = new RegExp($('#usertype').val());
    if(rex =="/all/"){clearFilter()}else{
      $('.content').hide();
      $('.content').filter(function() {
      return rex.test($(this).text());
      }).show();
  }
  }
  
function clearFilter()
  {
    $('.usertype').val('');
    $('.content').show();
  }
  function filterstatus()
  {  
    var rex = new RegExp($('#approvalstatus').val());
    if(rex =="/all/"){clearFilter()}else{
      $('.content').hide();
      $('.content').filter(function() {
      return rex.test($(this).text());
      }).show();
  }
  }
  
function clearFilter()
  {
    $('.approvalstatus').val('');
    $('.content').show();
  }
  function filteruserstatus()
  {  
    var rex = new RegExp($('#userstatus').val());
    if(rex =="/all/"){clearFilter()}else{
      $('.content').hide();
      $('.content').filter(function() {
      return rex.test($(this).text());
      }).show();
  }
  }
  
function clearFilter()
  {
    $('.userstatus').val('');
    $('.content').show();
  }


</script> 
                     
                    <!-- <script>
                    $(document).ready(function(){
                    $("#myInput").on("keyup", function() {
                    var value = $(this).val();
                    $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().indexOf(value) > -1)
                  });
                  });
                });
</script> -->
@endsection
                       
                     
                    
                     
   

                     
                    