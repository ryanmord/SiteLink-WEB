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
    <div class="content-row">
      <div class="row">
        <div class="col-md-3">
          <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color: #19B5FE;text-align: center;">
                <br>
                <font size="5" color="white"><b>{{ $associate }}</b></font>
                <br>
              
                <font size="4" color="white"><b><i class="glyphicon glyphicon-user"></i>  Associates</b></font>
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-3">
        <div>
          <div>
            <div style=" height: 100px;width: 220px;background-color:#26A65B;text-align: center;">
              <br>
              <font size="5" color="white"><b>{{ $schedular }}</b></font>

              <br>
              <font size="4" color="white"><b><i class="glyphicon glyphicon-user"></i>  Project Managers</b></font>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div>
          <div>
            <div style=" height: 100px;width: 220px;background-color:#DB5A6B;text-align: center;">
                 <br>
                <font size="5" color="white"><b>{{$project}}</b></font>

                <br>
                <font size="4" color="white"><b><i class="fa fa-building-o"></i>  No. of Projects</b></font>
                </div>
                </div>
               </div>
              </div>
                <div class="col-md-3">
              <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color:#F5AB35;text-align: center;">
                <br>
                <font size="5" color="white"><b>{{$projectbid}}</b></font>

                <br>
                <font size="4" color="white"><b><span class="glyphicon glyphicon-briefcase"></span> Total Bids</b></font>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(session('loginusertype') == 'admin')
      <div class="panel panel-success">
        @if ($message = session('message'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
          </div>
        @endif
        <div class="panel-heading">
          <h3 class="panel-title">Unverified Users And Pending Bids</h3>
        </div>
        <div class="content-row">
          <div class="row">
            <div class="panel panel-title">
              <ul id="myTab1" class="nav nav-tabs nav-justified">
                <li class="active"><a href="#home1" data-toggle="tab">
                  Unverified Users <span class="badge" style="background-color:#DB5A6B;">{{ $users->count() }}</span>
                </a></li>
                <li><a href="#projectbids" data-toggle="tab"> Pending Bids <span class="badge" style="background-color:#DB5A6B;">{{ $bidsrequestcount }}</span>
                </a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home1">
                  <div class="table-responsive">
                    @if($users->count() > 0)
                      <table class="table table-bordered table-hover table-striped">
                          <thead>
                            <tr bgcolor="#EEEEEE">
                            
                              <th style="text-align: center;vertical-align: middle;">Image</th>
                              <th style="text-align: center;vertical-align: middle;">Name</th>
                              <th style="text-align: center;vertical-align: middle;">Company
                              </th>
                              <th style="text-align: center;vertical-align: middle;">Email</th>
                            
                              <th style="text-align: center;vertical-align: middle;">Address
                              </th>
                              <th style="text-align: center;vertical-align: middle;">Enrolled </th>
                              <th style="text-align: center;vertical-align: middle;">Status
                              </th>
                              <th style="text-align: center;vertical-align: middle;">Action
                              </th>
                            </tr>
                          </thead>
                          <tbody id="myTable">
                            @foreach ($users as $user)
                              <tr class="content">
                                <td style="text-align: center;vertical-align: middle;">
                                  @if(isset($user->users_profile_image))
                                  
                                    <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src= "{{asset('/img/users/'.$user['users_profile_image'])}}" />
                                  @else
                                    <img class="img-rounded" style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;" src="{{asset('/img/users/default.png')}}"/>
                                  @endif
                                </td>
                                <td style="text-align: left;vertical-align: middle;">{{ ucfirst($user->users_name) }}</td>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->users_company }}</td>
                                <td style="text-align: left;vertical-align: middle;">{{ $user->users_email }}<br>{{ $user->users_phone }}</td>
                    
                                <td style="text-align: left;vertical-align: middle;">
                                {{ $user->users_address }}              
                                </td>

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
                                    <span class="glyphicon glyphicon-ok"></span>
                                  </td>
                                @else
                                  <td style="text-align: center;vertical-align: middle;color: #DB5A6B;">
                                    <span class="glyphicon glyphicon-remove"></span>
                                  </td>
                                @endif
                                  <td style="text-align: center;vertical-align: middle;">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                      <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                        right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                                        <?php $userid = $user->users_id ?>

                                        <li><a href="#" id="approve" data-toggle="modal" data-target="#myModal" data-id="{{ $user['users_id'] }}" class="modalLink">Approve</a>
                    
                                        </li>

                                        <li><a href="{{url('dashboard/user/'.$user['users_id'].'/0')}}" onclick="return confirm('Are you want to sure reject this associate?')">Reject</a>
                                        </li>
                   
                                      </ul>
                                      @include('approveuser')
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                          @else
                            <h6><center>You do not have any associate to verify</center></h6>
                          @endif
                        </div>
                      </div>
                      <div class="tab-pane fade" id="projectbids">
                        <div class="table-responsive">
                          @if(isset($bids))
                            <table class="table table-bordered table-hover table-striped" > 
                              <thead>
                                <tr bgcolor="#EEEEEE">
                            
                                  <th style="text-align: center;vertical-align: middle;">       Project Name     </th>
                                  <th style="text-align: center;vertical-align: middle;">
                                    Manager Name
                                  </th>
                                  <th style="text-align: center;vertical-align: middle;">
                                    Associate Name
                                  </th>
                                  <th style="text-align: center;vertical-align: middle;">       Suggested Bid</th>
                                  <th style="text-align: center;vertical-align: middle;">       Associate bid</th>
                                  <th style="text-align: center;vertical-align: middle;">Action</th>
                                </tr>
                  
                              </thead>
                              <tbody id="myTable">
                                @foreach ($bids as $bid)
                                  <tr class="content">
                                    <td style="text-align: center;vertical-align: middle;">
                                      {{ $bid['projectname'] }}
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;">
                                      {{ $bid['managername'] }}
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;">
                                      {{ $bid['associatename'] }}
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;">
                                      <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['approx_bid'] }}</td>
                                    <td style="text-align: center;vertical-align: middle;">
                                      <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['suggestedbid'] }}</td>
                                    <td style="text-align: center;vertical-align: middle;">
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                      <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                        right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                                        <?php $userid = $bid['associateid'] ?>
                                          <li><a href="{{url('project/bid/'.$bid['projectid'].'/'.$bid['associateid'].'/1')}}" onclick="return confirm('Are you want to sure the accept this bid?')">Accept</a></li>
                                          <li><a href="{{url('project/bid/'.$bid['projectid'].'/'.$bid['associateid'].'/0')}}" onclick="return confirm('Are you want to sure  the reject this bid?')">Reject</a>
                                          </li>
                    
                                        </ul>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                             </tbody>
                            </table>
                            @else
                              <h6><center>You do not have any Pending Bids Request</center>
                              </h6>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        @stop
        @section('script') 
        <script type="text/javascript">
          $(window).load(function() {
          $(".loader").fadeOut("slow");
        });
   
        $(".modalLink").click(function () {
            var userid = $(this).attr('data-id');
          document.getElementById("userid").value = userid;
        })

        </script>

  @endsection