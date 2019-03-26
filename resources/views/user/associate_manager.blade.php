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
                <input type="hidden" name="associate-count" id="associate-count" value="{{ $associatecount }}">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr bgcolor="#EEEEEE">
                        <th width="50px;">ID</th>
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
                          <th width="15%"> Scope(s) </th>
                        @endif
                        <th width="10%">Enrolled </th>
                        <th>Status</th>
                        
                        <th>Action</th>
                      </tr>
                            
                    </thead>
                      <tbody id="associate-data">
                        @foreach ($associate as $user)
                          <tr class="content">
                            <td>{{ $user->users_id }}</td>
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
                      <div class="row content-row-pagination">
                        <br>
                        <div class="col-md-12">
                          <ul class="pagination" id="associate-pagination">
                          </ul>
                        </div>
                      </div>
                      @else

                    <h6><center>No Associate Available</center></h6>
                    <br>
                    @endif
                  </div>
                 
                </div>
                <div class="tab-pane fade" id="managers">
                  <div class="table-responsive">
                    @if($managercount > 0)
                    <input type="hidden" name="manager-count" id="manager-count" value="{{ $managercount }}">
                    <table class="table table-bordered table-hover table-striped">
                      <thead>
                        <tr bgcolor="#EEEEEE">
                          <th width="50px;">ID</th>
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
                      <tbody id="manager-data">
                      @foreach ($manager as $user)
                        <tr class="content">
                        <td>{{ $user->users_id }}</td>
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
            <div class="row content-row-pagination">
              <br>
              <div class="col-md-12">
                <ul class="pagination" id="manager-pagination">
                 </ul>
              </div>
            </div>
            @else
              <h6><center>No Project Manager Available</center></h6>
              <br>
            @endif
          </div>
            
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
<script type="text/javascript">
//pagination for onhold projects
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
    var projectcount = document.getElementById('associate-count').value;
    var limitPerPage = 10;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#associate-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#associate-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#associate-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#associate-previous-page").toggleClass("disabled", currentPage === 1);
        $("#associate-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#associate-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "associate-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "associate-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#associate-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#associate-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#associate-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#associate-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
<script type="text/javascript">
//pagination for onhold projects
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
    var projectcount = document.getElementById('manager-count').value;
    var limitPerPage = 10;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#manager-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#manager-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#manager-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#manager-previous-page").toggleClass("disabled", currentPage === 1);
        $("#manager-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#manager-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "manager-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "manager-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#manager-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#manager-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#manager-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#manager-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
</script>
@endsection
