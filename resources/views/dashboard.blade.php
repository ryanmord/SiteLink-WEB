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
                  Unverified Users <span class="badge" style="background-color:#DB5A6B;" id="user-count">{{ $users->count() }}</span>
                </a></li>
                <li><a href="#projectbids" data-toggle="tab"> Pending Bids <span class="badge" style="background-color:#DB5A6B;">{{ $bidsrequestcount }}</span>
                </a></li>
                <li><a href="#schedulingProjects" data-toggle="tab">Awaiting Scheduling <span class="badge" style="background-color:#DB5A6B;">{{ $schedulingProjectCount }}</span>
                </a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home1">
                  <div class="table-responsive">
                    @if($users->count() > 0)
                      <table class="table table-bordered table-hover table-striped">
                          <thead>
                            <tr bgcolor="#EEEEEE">
                              <th style="text-align: center;vertical-align: middle;" width="50px;">Image</th>
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
                          <tbody id="user-data">
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
                                      
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                           <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="user-pagination">
                                <!--  <li><a href="#">PREV</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li class="disabled"><a href="#">NEXT</a></li> -->
                                </ul>
                                </div>
                            </div>
                          @else
                            <h6><center>You do not have any associate to verify</center></h6>
                          @endif
                        </div>
                      </div>
                      <div class="tab-pane fade" id="projectbids">
                      
                        <div class="table-responsive">
                        <input type="hidden" name="project-count" id="project-count" value="{{ count($nonallocatedproject) }}">
                          @if(isset($nonallocatedproject))
                            <table class="table table-bordered table-hover table-striped" > 
                              <thead>
                               <tr bgcolor="#EEEEEE">
                                    <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center;vertical-align: middle;">Total Bids</th>
                                    <th style="text-align: center;vertical-align: middle;">Site Address</th>
                                    <th style="text-align: center;vertical-align: middle;" width="10%">Suggested Bid</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                    <th style="text-align: center;vertical-align: middle;">Action</th>
                                    </tr>
                  
                              </thead>
                              <tbody id="project-data">
                                 @foreach ($nonallocatedproject as $project)
                                    <tr class="content">
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['bidcount'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_site_address'] }}
                
                                        </td>
                    
                   
                                        <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['approx_bid'] }}
                                        </td>
                                        @if(session('loginusertype') == 'admin')
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['managername'] }}
                                        </td>
                                        @endif
                                        <td style="text-align: center;vertical-align: middle;">
                                            <div class="btn-group">
                                            <a href="{{url('/pendingBids/'.$project['project_id'])}}">
                                                <button type="button" class="btn btn-success">
                                                <center>Bids</center></button></a>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                             </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="project-pagination">
                                <!--  <li><a href="#">PREV</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li class="disabled"><a href="#">NEXT</a></li> -->
                                </ul>
                                </div>
                            </div>
                            @else
                              <h6><center>You do not have any Pending Bids Request</center>
                              </h6>
                            @endif
                          </div>
                        </div>
                        <div class="tab-pane fade" id="schedulingProjects">
                      
                        <div class="table-responsive">
                        <input type="hidden" name="project-count" id="scheduling-count" value="{{ count($schedulingProject) }}">
                          @if(isset($schedulingProject))
                            <table class="table table-bordered table-hover table-striped" > 
                              <thead>
                               <tr bgcolor="#EEEEEE">
                                    <th style="text-align: center;vertical-align: middle;">Project ID</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Name</th>
                                   
                                    <th style="text-align: center;vertical-align: middle;">Site Address</th>
                                    <th style="text-align: center;vertical-align: middle;" width="10%">Budget</th>
                                    <th style="text-align: center;vertical-align: middle;">Project Manager</th>
                                    <th style="text-align: center;vertical-align: middle;">Action</th>
                                    </tr>
                  
                              </thead>
                              <tbody id="scheduling-data">
                                 @foreach ($schedulingProject as $project)
                                    <tr class="content">
                                        <td style="text-align: center;vertical-align: middle;">
                                            {{ $project['project_id'] }}
                                        </td>
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_name'] }}
                                        </td>
                                        
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['project_site_address'] }}
                
                                        </td>
                    
                   
                                        <td style="text-align: left;vertical-align: middle;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['budget'] }}
                                        </td>
                                        @if(session('loginusertype') == 'admin')
                                        <td style="text-align: left;vertical-align: middle;">
                                            {{ $project['managername'] }}
                                        </td>
                                        @endif
                                        <td style="text-align: center;vertical-align: middle;">
                                          <div class="btn-group">
                                            <a href="{{url('/schedulingProject/'.$project['project_id'])}}">
                                                <button type="button" class="btn btn-success">
                                                <center>View</center></button></a>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                             </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="scheduling-pagination">
                                <!--  <li><a href="#">PREV</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li class="disabled"><a href="#">NEXT</a></li> -->
                                </ul>
                                </div>
                            </div>
                            @else
                              <h6><center>You do not have any Pending Scheduling Request</center>
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
          @include('approveuser')
        @stop
        @section('script') 
        <script type="text/javascript">
          $(window).load(function() {
          $(".loader").fadeOut("slow");
        });
   
        $(".modalLink").click(function () {
          var userid = $(this).attr('data-id');
          document.getElementById("userid").value = userid;
          //alert(userid);
         /* $("#completed-project").modal("hide");*/
        })

        </script>
  <script type="text/javascript">
       function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var usercount = $('#user-count').text();
    var limitPerPage = 5;
    var totalPages = (Math.ceil(usercount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#user-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#user-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page").toggleClass("disabled", currentPage === 1);
        $("#next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#user-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#user-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#user-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
  </script>
  
    <script type="text/javascript">
       function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = document.getElementById("project-count").value;
    var limitPerPage = 7;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#project-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#project-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page1");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page1").toggleClass("disabled", currentPage === 1);
        $("#next-page1").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#project-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page1" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page1" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#project-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#project-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page1").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page1").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
  </script>
 <script type="text/javascript">
       function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = document.getElementById("scheduling-count").value;
    var limitPerPage = 7;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#scheduling-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#scheduling-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page2");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page2").toggleClass("disabled", currentPage === 1);
        $("#next-page2").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#scheduling-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page2" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page2" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#scheduling-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#scheduling-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page2").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page2").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
  </script>

  @endsection