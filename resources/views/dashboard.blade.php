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
          <div class="alert alert-success alert-block" id="">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
          </div>
        @endif
       
        <div class="panel-heading">
          <h3 class="panel-title">Pre-Scheduling & Unverified Users</h3>
        </div>
        <div class="content-row">
          <div class="row">
            <div class="panel panel-title">
              <ul id="myTab1" class="nav nav-tabs nav-justified">
               <li class="active"><a href="#schedulingProjects" data-toggle="tab">Pre-Scheduling <span class="badge" style="background-color:#DB5A6B;" id="scheduling-Project-Count">{{ $schedulingProjectCount }}</span>
                </a></li>
                <li><a href="#home1" data-toggle="tab">
                  Unverified Users <span class="badge" style="background-color:#DB5A6B;" id="pending-user-count">{{ $users->count() }}</span>
                </a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade" id="home1">
                  <div id="div-no-user">
                    <center><p style="font-size: 20px;">No data found</p></center><br>
                  </div>
                  <div class="table-responsive" id="user-div-data">
                      <input type="hidden" name="user-count" id="user-count" value="">
                      <table class="table table-bordered table-hover table-striped">
                          <thead>
                            <tr bgcolor="#EEEEEE">
                              <th class="table-td-th" data-id="1" id="userid-th" onclick="usersortTable(0,'userid-th')" style="cursor: pointer;">Id</th>
                              <th class="table-td-th" width="50px;">Image</th>
                              <th class="table-td-th"  data-id="1" id="username-th" onclick="usersortTable(1,'uername-th')" style="cursor: pointer;">Name</th>
                              <th class="table-td-th"  data-id="1" id="usercompany-th" onclick="usersortTable(2,'usercompany-th')" style="cursor: pointer;">Company
                              </th>
                              <th class="table-td-th"  data-id="1" id="useremail-th" onclick="usersortTable(3,'useremail-th')" style="cursor: pointer;">Email</th>
                            
                              <th class="table-td-th" data-id="1" id="useraddress-th" onclick="usersortTable(4,'useraddress-th')" style="cursor: pointer;">Address
                              </th>
                               <th class="table-td-th">Scope(s)
                              </th>
                              <th class="table-td-th" data-id="1" id="enrolled-th" onclick="usersortTable(5,'enrolled-th')" style="cursor: pointer;">Enrolled </th>
                              <th class="table-td-th">Action
                              </th>
                            </tr>
                          </thead>
                          <tbody id="user-data">
                            
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
                         
                        </div>
                      </div>
                      
                        <div class="tab-pane fade active in" id="schedulingProjects">
                        <div id="div-no-scheduling">
                          <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="row" id="div-scheduling-button">
                          <div class="col-md-6">

                           <!--  <div class="form-search search-only" style="width: 70%;margin-left: 5px;">

                                  <i class="search-icon glyphicon glyphicon-search"></i>
                                  <input type="text" class="form-control search-query" placeholder="Search here" id="searchUser">
                              </div> -->
                              <input type="hidden" name="pagenumber" id="pagenumber">
                              
                          </div>
                          
                          <div class="col-md-6">

                              <div style="float: right;">
                                  <button class="btn btn-danger" type="button" id="archive-btn" disabled style="margin-top: 15px;">
                                  <!-- <i class="glyphicon glyphicon-remove-circle"></i> -->
                                  &nbsp;Archive</button>      
                                  <!-- <button class="btn btn-info" type="button" id="unblock-btn"><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;Unblock</button> -->
                                  <input type="hidden" name="projectids" id="projectids">
                                  &nbsp     
                              </div>
                          </div>
                          
                      </div>
                      
                        <div class="table-responsive" id="div-scheduling-table">
                          <input type="hidden" name="scheduling-count" id="scheduling-count" value="">
                          <table class="table table-bordered table-hover table-striped" > 
                              <thead>
                               <tr bgcolor="#EEEEEE">
                                  <th class="table-td-th" width="50">
                                      <!-- <input type="checkbox" id="allChecks"> -->
                                  </th>
                                    <th class="table-td-th" data-id="1" id="identifier-th" onclick="sortTable(0,'identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                    <th class="table-td-th" data-id="1" id="projectname-th" onclick="sortTable(1,'projectname-th')" style="cursor: pointer;">Project Name</th>
                                    <th class="table-td-th" data-id="1" id="siteaddress-th" onclick="sortTable(2,'siteaddress-th')" style="cursor: pointer;">Site Address</th>
                                    <th class="table-td-th" width="10%" data-id="1" id="budget-th" onclick="sortTable(3,'budget-th')" style="cursor: pointer;">Budget</th>
                                    <th class="table-td-th">Scope</th>
                                    <th class="table-td-th" data-id="1" id="manager-th" onclick="sortTable(4,'manager-th')" style="cursor: pointer;">Project Manager</th>
                                    <th class="table-td-th" data-id="1" id="created-th" onclick="sortTable(5,'created-th')" style="cursor: pointer;">Created</th>
                                    <th class="table-td-th">Action</th>
                                </tr>
                              </thead>
                              <tbody id="scheduling-data">
                                
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
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
          @if(isset($users) && !empty($users))
          @include('approveuser')
          @endif
        @stop
        @section('script') 
        <script type="text/javascript">
          $(window).load(function() {
          $(".loader").fadeOut("slow");
          $.ajax({
                  type: 'GET',
                  url: '<?php echo route('schedulingProjectList'); ?>',
                  data: {order_key:6,sortorder:2},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.count > 0)
                 {
                    $('#div-no-scheduling').hide();
                    $('#div-scheduling-button').show();
                    $('#div-scheduling-table').show();
                    $('#scheduling-data').html('');
                    $('#scheduling-data').html(msg.appendtd);
                    document.getElementById('scheduling-count').value = msg.count;
                    setSchedulingPagination();
                 }
                 else
                 {
                    $('#div-scheduling-button').hide();
                    $('#div-scheduling-table').hide();
                    $('#div-no-scheduling').show();
                 }
           });
            $.ajax({
                  type: 'GET',
                  url: '<?php echo route('pendingAssociateList'); ?>',
                  data: {order_key:0,sortorder:2},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.count > 0)
                 {
                    $('#div-no-user').hide();
                    $('#user-div-data').show();
                    $('#user-data').html('');
                    $('#user-data').html(msg.appendtd);
                    document.getElementById('user-count').value = msg.count;
                    setUserPagination();
                 }
                 else
                 {
                    $('#user-div-data').hide();
                    $('#div-no-user').show();
                 }
           });
          
        });
        function confirmMsg(id)
        {
          if(confirm('Are you want to sure reject this associate?'))
          {
              $(".loader").fadeIn("slow");
              $.ajax({
                  type: 'GET',
                  url: '<?php echo route('authenticateUser'); ?>',
                  data: {status:0,userid:id},
                  dataType: 'json',
              })
              .done(function(msg) {
                $(".loader").fadeOut("slow");
                 location.reload();
           });
              $(".loader").fadeOut("slow");
          }
          else
          {
            return false;
          }
        }
        function setuserid(id) {
         /* var userid = $(this).attr('data-id');*/
          document.getElementById("userid").value = id;
          //alert(id);
         /* $("#completed-project").modal("hide");*/
        }

        </script>
  <script type="text/javascript">
  function setUserPagination(){
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
var usercount = document.getElementById('user-count').value;
if(usercount > 0)
{
  $(function () {
    // Number of items and limits the number of items per page
    var usercount = document.getElementById('user-count').value;
    var limitPerPage = 15;
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
}
}
  </script>
  
 <script type="text/javascript">
    function setSchedulingPagination(){
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
    var limitPerPage = 15;
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
}
  </script>
  <script type="text/javascript">
    $('body').on('click','#checkProject', function (event) {
        var checks = $('input[name="checkProject"]:checked').map(function(){
            return $(this).val();
        }).get();
        if(checks == '')
        {
            document.getElementById("archive-btn").disabled = true;
        }
        else
        {
          document.getElementById("archive-btn").disabled = false;
        }
      });
    $('body').on('click','#archive-btn', function (event) {
       var checks = $('input[name="checkProject"]:checked').map(function(){
            return $(this).val();
        }).get();
        if(checks != '')
        {
              $(".loader").fadeIn("slow");
              document.getElementById("projectids").value = checks;
              var projectid = document.getElementById('projectids').value;
              $.ajax({
                  type: 'GET',
                  url: '<?php echo route('batchArchive'); ?>',
                  data: {projectid:projectid},
                   dataType: 'json',
              })
              .done(function(msg) {
                  $(".loader").fadeOut("slow");
              if(msg.status == '1')
              {
                  alert(msg.message);
                  url = '<?php echo route('archiveProjects'); ?>';
                  window.location.replace(url);
              }      
          });
        }
    });
  </script>
   <script type="text/javascript">
      function sortTable(n,id) {

       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('schedulingProjectList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#scheduling-data').html('');
                    $('#scheduling-data').html(msg.appendtd);
                    document.getElementById('scheduling-count').value = msg.count;
                    setSchedulingPagination();
                 }
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
        }
        else
        {
            $('#'+id).attr('data-id' , '1'); 
        }
    }
    function usersortTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('pendingAssociateList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#user-data').html('');
                    $('#user-data').html(msg.appendtd);
                    document.getElementById('user-count').value = msg.count;
                    setUserPagination();
                 }
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
        }
        else
        {
            $('#'+id).attr('data-id' , '1'); 
        }
    }
  </script>

  @endsection