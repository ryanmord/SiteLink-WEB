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
            @if ($message = session('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
            @endif
           <!--  @if($message = session('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif -->

            <div class="panel-heading">
                <h3 class="panel-title">
                   <!--  <a href="{{ url()->previous() }}">Back</a> -->
                   <!-- </a> -->Archive Projects
                </h3>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-search search-only" style="width: 70%;margin-left: 5px;">

                        <!-- <i class="search-icon glyphicon glyphicon-search"></i>
                        <input type="text" class="form-control search-query" placeholder="Search here" id="searchUser"> -->
                    </div>
                    <input type="hidden" name="pagenumber" id="pagenumber">
                    <input type="hidden" name="projectcount" value="{{ $projectCount}}" id="projectcount">
                </div>
                <div class="col-md-6">

                    <div class="form-group" style="float: right;">
                        <button class="btn btn-danger" type="button" id="schedule-btn" disabled>
                        <!-- <i class="glyphicon glyphicon-remove-circle"></i> -->
                        &nbsp;Un-Archive</button>      
                        <!-- <button class="btn btn-info" type="button" id="unblock-btn"><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;Unblock</button> -->
                        <input type="hidden" name="projectids" id="projectids">
                        &nbsp     
                    </div>
                </div>
            </div>
           <!--  <div id="div-no-project">
                <center><p style="font-size: 20px;">No data found</p></center>
            </div> -->
            <div class="table-responsive" id="table-div">
                @if(isset($archiveProject) && !empty($archiveProject))
                <table class="table table-bordered table-hover table-striped">
    		        <thead>
                        <tr bgcolor="#EEEEEE">
                            <th class="table-td-th" width="50">
                                <!-- <input type="checkbox" id="allChecks"> -->
                            </th>
                            <th class="table-td-th"">Project Identifier</th>
                            <th class="table-td-th">Project Name</th>
                            <th class="table-td-th">Site Address</th>
                            <th class="table-td-th" width="10%">Budget</th>
                            <th class="table-td-th">Project Manager</th>
                            <th class="table-td-th">CreatedOn</th>
                            <th class="table-td-th">Action</th>
                        </tr>
                    </thead>
        	        <tbody id="userData">
                         @foreach ($archiveProject as $project)
                            <tr class="content">
                                <td class="table-td-th">
                                    <input type="checkbox" name="checkProject" id="checkProject" value="{{ $project['project_id'] }}"></td>
                                        <td class="table-td-th">
                                            {{ $project['identifier'] }}
                                        </td>
                                        <td class="table-td-th" style="text-align: left;">
                                            {{ $project['project_name'] }}
                                        </td>
                                         <td class="table-td-th" style="text-align: left;">
                                                {{ $project['project_site_address'] }}
                    
                                        </td>
                                        <td class="table-td-th" style="text-align: left;">
                                            <span class="glyphicon glyphicon-usd"></span>
                                            {{ $project['budget'] }}
                                        </td>
                                        <td class="table-td-th" style="text-align: left;">
                                            {{ $project['managername'] }}
                                        </td>
                                        <td class="table-td-th" style="text-align: left;">
                                            {{ $project['created_at'] }}
                                        </td>
                                            <!-- <td class="table-td-th">
                                              <div class="btn-group">
                                                <a href="{{url('/schedulingProject/'.$project['project_id'])}}">
                                                    <button type="button" class="btn btn-success">
                                                    <center>View</center></button></a>
                                              </div>
                                            </td> -->

                                        <td class="table-td-th">
                                          <div class="btn-group">
                                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                          <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                            right: 100% !important;text-align: left !important;transform: translate(-75%, 0) !important;">
                                            <?php $projectid = $project['project_id'] ?>

                                            <li>
                                              <a href="{{url('/allProejcts/projectDetail/'.$project['project_id'])}}">
                                             View</a>
                                            </li>
                                            <li><a href="{{url('/dashboard/scheduled/'.$project['project_id'])}}">Un-Archive</a>
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
                        <ul class="pagination" id="project-pagination">
                                <!--  <li><a href="#">PREV</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li class="disabled"><a href="#">NEXT</a></li> -->
                        </ul>
                    </div>
                </div>
                @else
                    <h6><center>There are no archive projects available</center>
                    </h6><br><br>
                @endif
            </div>
        </div>

    </div>
@stop
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".loader").fadeOut("slow");
        document.getElementById('pagenumber').value = 1;
        //$("#div-no-project").hide();
      
    });

 

</script>
<script type="text/javascript">
    setpagination();
 function setpagination()
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
    var usercount = document.getElementById('projectcount').value;
    var limitPerPage = 10;
    var totalPages = (Math.ceil(usercount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#userData .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $(".pagination li").slice(1, -1).remove();
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
    $(".pagination").append(
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
    $("#userData").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", ".pagination li.current-page:not(.active)", function () {
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
    $('body').on('click','#checkProject', function (event) {
        var checks = $('input[name="checkProject"]:checked').map(function(){
            return $(this).val();
        }).get();
        if(checks == '')
        {
            document.getElementById("schedule-btn").disabled = true;
        }
        else
        {
          document.getElementById("schedule-btn").disabled = false;
        }
      });
    $('body').on('click','#schedule-btn', function (event) {
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
                  url: '<?php echo route('batchScheduled'); ?>',
                  data: {projectid:projectid},
                   dataType: 'json',
              })
              .done(function(msg) {
                  $(".loader").fadeOut("slow");
              if(msg.status == '1')
              {
                  alert(msg.message);
                  url = '<?php echo route('dashboard'); ?>';
                  window.location.replace(url);
              }      
          });
        }
    });
  </script>
@endsection
