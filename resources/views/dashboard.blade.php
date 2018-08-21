@extends('layouts.main_layout')

@section('main-content')

        <div class="col-xs-12 col-sm-9 content">
     
       <!--  <div class="panel-body">
        <div class="content-row">
		<div class="row">
		<div class="col-md-4">
        <div class="pricing">
        <div class="clearfix">
		<ul>
        <li class="unit price-primary">
       <div class="price-title unit price-primary">
        <h4><i class="glyphicon glyphicon-user"></i>  Associates</h4>
                                               
       </div>
       <div class="price-body">
        <h5>550</h5>
         </div>
         </li>
         </ul>
         </div>
         </div>
         </div>
         <div class="col-md-4">
         <div class="pricing">
         <div class="clearfix">

                          <ul>
                            <li class="unit price-success">
                                              <div class="price-title">
                                               <h4><i class="glyphicon glyphicon-user"></i>  Associates</h4>
                                               
                                              </div>
                                              <div class="price-body">
                                               <h5>550</h5>
                        </div>
                        </li>
                        </ul>
                        </div>
                        </div>
                        </div>
                         <div class="col-md-4">
         <div class="pricing">
         <div class="clearfix">

                          <ul>
                            <li class="unit price-warning">
                                              <div class="price-title">
                                               <h4><i class="glyphicon glyphicon-user"></i>  Associates</h4>
                                               
                                              </div>
                                              <div class="price-body">
                                               <h5>550</h5>
                        </div>
                        </li>
                        </ul>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

 -->

                  <div class="content-row">
                    
                    <div class="row">
                      <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color: #19B5FE;text-align: center;">
                <br>
                <font size="4" color="white"><b><i class="fa fa-male"></i>  Associates</b></font>
                <br>
                <font size="4" color="white"><b>({{ $associate }})</b></font>

                         
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#26A65B;text-align: center;">
                <br>
                <font size="4" color="white"><b><i class="glyphicon glyphicon-user"></i>  Schedulers</b></font>
                <br>
                <font size="4" color="white"><b>({{ $schedular }})</b></font>

                         
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#DB5A6B;text-align: center;">
                <br>
                <font size="4" color="white"><b><i class="fa fa-building-o"></i>  No. of Projects</b></font>
                <br>
                <font size="4" color="white"><b>(550)</b></font>

                         
                            </div>
                          </div>
                        </div>
                      </div>
                             <div class="col-md-3">
                        <div>
                          <div >
                            
                <div style=" height: 100px;width: 220px;background-color:#F5AB35;text-align: center;">
                <br>
                <font size="4" color="white"><b><span class="glyphicon glyphicon-briefcase"></span> Total Bids</b></font>
                <br>
                <font size="4" color="white"><b>(550)</b></font>

                         
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                   
                  </div>
            <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Unverified Associate Users ({{ $users->count() }})</h3>
              </div>
             
               <div class="table-responsive" style="overflow-x:auto;">
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
                            <th style="text-align: center;vertical-align: middle;">Approval status</th>
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
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_name }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_company }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_email }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $user->users_phone }}</td>
                  	<td style="text-align: center;vertical-align: middle;">
                    @if(isset($user->users_address))                   
                    <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $user->users_address }}">
                    @else
                     <a href="#" data-toggle="tooltip" data-placement="top" title="-">
                     @endif
                    <img style="max-width:35px;max-height:35px;min-width:35px;min-height:35px;" src="{{asset('/img/address.jpeg')}}"></a></td>

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
                    
                   <td style="text-align: center;vertical-align: middle;">
                   <label class="toggle">
                   <a href="{{url('dashboard/user/'.$user['users_id'].'/1')}}" onclick="return confirm('Do you want to approve this associates?')">
  				   <input type="checkbox">
                   <span class="handle" style="background-color:  #E6E9ED;"></span>
                   </a>
                      </label>
                   </td>
                  

                </tr>
                @endforeach
              
                
                         </tbody>
                        </table>
                        @else
                        <h6><center>No Pending Request</center></h6>
                        @endif

                      </div>
                        
                      </div>
                     
                       {!! $users->links() !!}
                         
                      
                      </div>
            
                  

                      
                      


@endsection