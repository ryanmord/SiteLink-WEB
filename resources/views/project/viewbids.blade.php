@extends('layouts.main_layout')
@section('main-content')
<div class="col-xs-12 col-sm-9 content">
<div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="{{ url()->previous() }}">Back</a>
               </a>Bids of {{ $projectname }}
            </h3>
        </div>
        <div class="content-row">
          <div class="row">
            <div class="panel panel-title">
            <input type="hidden" name="projectid" id="projectid" value="{{ $projectid }}">
              <ul id="myTab1" class="nav nav-tabs nav-justified">
               <li class="active"><a href="#home1" data-toggle="tab">Associate's Bids
               <span class="badge" style="background-color:#DB5A6B;" id="bid-count">
               </span>
                </a></li>
                <li><a href="#employee-tab" data-toggle="tab">Employee's Request
                <span class="badge" style="background-color:#DB5A6B;" id="employee-count">
                </span>
                </a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home1">
                <div id="div-no-bid">
                    <center><p style="font-size: 20px;">No data found</p></center><br>
                </div>
                <div class="table-responsive" id="bid-div-data">
            
           
                <table class="table table-bordered table-hover table-striped">
                   <thead>
                        <tr bgcolor="#EEEEEE">
                             <th class="table-td-th" data-id="1" id="associatename-th" onclick="bidsortTable(0,'associatename-th','associatename-th-asc','associatename-th-desc')" style="cursor: pointer;">Associate Name <i class='fa fa-arrow-down fa-icon-sort-desc' id="associatename-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="associatename-th-asc"></i></th>
                             <th class="table-td-th" data-id="1" id="bid-th" onclick="bidsortTable(1,'bid-th','bid-th-asc','bid-th-desc')" style="cursor: pointer;">Suggested Bid <i class='fa fa-arrow-down fa-icon-sort' id="bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="bid-th-asc"></i></th>
                            <th class="table-td-th" data-id="1" id="userbid-th" onclick="bidsortTable(2,'userbid-th','userbid-th-asc','userbid-th-desc')" style="cursor: pointer;">Associate Bid <i class='fa fa-arrow-down fa-icon-sort' id="userbid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="userbid-th-asc"></i></th>
                            <th class="table-td-th" data-id="1" id="requested-th" onclick="bidsortTable(3,'requested-th','requested-th-asc','requested-th-desc')" style="cursor: pointer;">Requested At<i class='fa fa-arrow-down fa-icon-sort' id="requested-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="requested-th-asc"></i></th>
                            
                            <th class="table-td-th">Action</th>
                        </tr>
                    </thead>
                    <tbody id="bid-data">
                        
                    </tbody>
                </table>
                <div class="row content-row-pagination">
                    <br>
                    <div class="col-md-12">
                        <ul class="pagination" id="bid-pagination">
                           <!--  <li><a href="#">PREV</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class="disabled"><a href="#">NEXT</a></li> -->
                        </ul>
                    </div>
                </div>
               
            </div>
        </div>
          <div class="tab-pane fade" id="employee-tab">
            <div id="div-no-request">
                <center><p style="font-size: 20px;">No data found</p></center><br>
            </div>
            <div class="table-responsive" id="request-div-data">
           
           
                <table class="table table-bordered table-hover table-striped">
                   <thead>
                        <tr bgcolor="#EEEEEE">
                            <th class="table-td-th" data-id="1" id="employeename-th" onclick="requestsortTable(0,'employeename-th','employeename-th-asc','employeename-th-desc')" style="cursor: pointer;">Employee Name <i class='fa fa-arrow-down fa-icon-sort-desc' id="employeename-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="employeename-th-asc"></i></th>

                             <th class="table-td-th" data-id="1" id="suggestbid-th" onclick="requestsortTable(1,'suggestbid-th','suggestbid-th-asc','suggestbid-th-desc')" style="cursor: pointer;">Suggested Bid <i class='fa fa-arrow-down fa-icon-sort' id="suggestbid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="suggestbid-th-asc"></i></th>
                            
                            <th class="table-td-th" data-id="1" id="accepted-th" onclick="requestsortTable(2,'accepted-th','accepted-th-asc','accepted-th-desc')" style="cursor: pointer;">Accepted On<i class='fa fa-arrow-down fa-icon-sort' id="accepted-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="accepted-th-asc"></i></th>
                            <th class="table-td-th">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee-data">
                        
                    </tbody>
                </table>
                <div class="row content-row-pagination">
                    <br>
                    <div class="col-md-12">
                        <ul class="pagination" id="employee-pagination">
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
</div>

       
@stop
@section('script')
  <script type="text/javascript">
  $(window).load(function() {

    
    projectid = document.getElementById('projectid').value;
    $.ajax({
                type: 'GET',
                url: '<?php echo route('bidsList'); ?>',
                data: {order_key:3,sortorder:2,projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-bid').hide();
                    $('#bid-div-data').show();
                    $('#bid-data').html('');
                    $('#bid-data').html(msg.appendtd);
                    $('#bid-count').text(msg.count);
                    setbidpagination();
                    $(".loader").fadeOut("slow");
                }
                else
                {
                    $('#bid-count').text(msg.count);
                    $('#bid-div-data').hide();
                    $('#div-no-bid').show();
                    $(".loader").fadeOut("slow");
                }
           });
            $.ajax({
                type: 'GET',
                url: '<?php echo route('employeeRequestList'); ?>',
                data: {order_key:2,sortorder:2,projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-request').hide();
                    $('#request-div-data').show();
                    $('#employee-data').html('');
                    $('#employee-data').html(msg.appendtd);
                    $('#employee-count').text(msg.count);
                    setrequestpagination();
                }
                else
                {
                    $('#employee-count').text(msg.count);
                    $('#request-div-data').hide();
                    $('#div-no-request').show();
                }
           });
    });
  function setbidpagination()
  {
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
    var bidcount = $('#bid-count').text();
    var limitPerPage = 5;
    var totalPages = (Math.ceil(bidcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#bid-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#bid-pagination li").slice(1, -1).remove();
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
    $("#bid-pagination").append(
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
    $("#bid-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#bid-pagination li.current-page:not(.active)", function () {
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
  </script>
  <script type="text/javascript">
  function setrequestpagination()
  {
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
    var employeeCount = $('#employee-count').text();
    var limitPerPage = 5;
    var totalPages = (Math.ceil(employeeCount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#employee-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#employee-pagination li").slice(1, -1).remove();
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
    $("#employee-pagination").append(
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
    $("#employee-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#employee-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page1").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page1").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
}
function bidsortTable(n,id,arrowup,arrowdown)
    {
        var sortorder = $('#'+id).attr("data-id"); 
        projectid = document.getElementById('projectid').value;
        $(".loader").fadeIn("slow");
        $.ajax({
                type: 'GET',
                url: '<?php echo route('bidsList'); ?>',
                data: {order_key:n,sortorder:sortorder,projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-bid').hide();
                    $('#bid-div-data').show();
                    $('#bid-data').html('');
                    $('#bid-data').html(msg.appendtd);
                    $('#bid-count').text(msg.count);
                    setbidpagination();
                }
                else
                {
                    $('#bid-count').text(msg.count);
                    $('#bid-div-data').hide();
                    $('#div-no-bid').show();
                }
                $(".loader").fadeOut("slow");
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc');
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
    function requestsortTable(n,id,arrowup,arrowdown)
    {
        var sortorder = $('#'+id).attr("data-id"); 
        projectid = document.getElementById('projectid').value;
        $(".loader").fadeIn("slow");
        $.ajax({
                type: 'GET',
                url: '<?php echo route('employeeRequestList'); ?>',
                data: {order_key:n,sortorder:sortorder,projectid:projectid},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-request').hide();
                    $('#request-div-data').show();
                    $('#employee-data').html('');
                    $('#employee-data').html(msg.appendtd);
                    $('#employee-count').text(msg.count);
                    setrequestpagination();
                }
                else
                {
                    $('#employee-count').text(msg.count);
                    $('#request-div-data').hide();
                    $('#request-no-bid').show();
                }
                $(".loader").fadeOut("slow");
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc');
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
    function bidacceptreject(projectid,userid,status)
    {
        if(status == 1)
        {
            if(confirm('Are you want to sure accept this request?'))
            {
                $(".loader").fadeIn("slow");
                $.ajax({
                    type: 'GET',
                    url: '<?php echo route('bidAcceptReject'); ?>',
                    data: {projectid:projectid,userid:userid,status:status},
                    dataType: 'json',
                })
                .done(function(msg) {
                    
                    url = '<?php echo route('allProjects'); ?>';
                    window.location.replace(url);
                    $(".loader").fadeOut("slow");
               });
                
            }
            else
            {
                return false;
            }
        }
        else
        {
            if(confirm('Are you want to sure reject this request?'))
            {
                $(".loader").fadeIn("slow");
                $.ajax({
                    type: 'GET',
                    url: '<?php echo route('bidAcceptReject'); ?>',
                    data: {projectid:projectid,userid:userid,status:status},
                    dataType: 'json',
                })
                .done(function(msg) {
                    
                    url = '<?php echo route('allProjects'); ?>';
                    window.location.replace(url);
                    $(".loader").fadeOut("slow");
               });
                
            }
            else
            {
                return false;
            }
        }
        
    }
  </script>
@endsection
