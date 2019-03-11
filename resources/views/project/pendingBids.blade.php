@extends('layouts.main_layout')
@section('main-content')
<div class="col-xs-12 col-sm-9 content">
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
              <ul id="myTab1" class="nav nav-tabs nav-justified">
               <li class="active"><a href="#home1" data-toggle="tab">Associate's Bids
               <span class="badge" style="background-color:#DB5A6B;">{{ $bidCount }}
               </span>
                </a></li>
                <li><a href="#employee-tab" data-toggle="tab">Employee's Request
                <span class="badge" style="background-color:#DB5A6B;">{{ $employeeCount }}
                </span>
                </a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home1">
                <div class="table-responsive">
            @if($bidCount != 0)
            <input type="hidden" name="bid-count" id="bid-count" value="{{ $bidCount }}">
                <table class="table table-bordered table-hover table-striped">
		           <thead>
                        <tr bgcolor="#EEEEEE">
                            <th class="table-td-th">Associate Name</th>
                            <th class="table-td-th">Suggested Bid</th>
                            <th class="table-td-th">Associate Bid</th>
                            <th class="table-td-th">Requested At</th>
                            <th class="table-td-th">Action</th>
                        </tr>
    	            </thead>
    	            <tbody id="bid-data">
                        @foreach($bids as $bid)

               	            <tr class="content">
					           <td class="table-td-th">
                  
					           {{ $bid['associatename'] }}
                       
					           </td>
					
                                <td class="table-td-th">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['suggestedbid'] }}
                                </td>
                                <td class="table-td-th">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    {{ $bid['associatebid'] }}
                                </td>
                                <?php $date1=date("Y-m-d H:i:s");
                                    $date2= date($bid['createddate']);
                                    $datetime1 = new DateTime($date1);
                                    $datetime2 = new DateTime($date2);
                                    $date= $datetime2->format("m-d-Y");
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format(' %a days ago');
                                ?>
                                <td class="table-td-th">
                                    {{ $days }} <br>
                                    {{ $date }}
                                </td>
                                
                                        <td class="table-td-th">
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
                @else
                    <br>
                    <h6><center>No any bids available</center></h6>
                    <br>
    		    @endif
    	    </div>
        </div>
          <div class="tab-pane fade" id="employee-tab">
            <div class="table-responsive">
            @if($employeeCount != 0)
            <input type="hidden" name="employee-count" id="employee-count" value="{{ $employeeCount }}">
                <table class="table table-bordered table-hover table-striped">
                   <thead>
                        <tr bgcolor="#EEEEEE">
                            <th class="table-td-th">Employee Name</th>
                            <th class="table-td-th">Suggested Bid</th>
                            <th class="table-td-th">Accepted On</th>
                            <th class="table-td-th">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee-data">
                        @foreach($employee as $value)

                            <tr class="content">
                               <td class="table-td-th">
                  
                               {{ $value['associatename'] }}
                       
                               </td>
                    
                                <td class="table-td-th">
                                    <span class="glyphicon glyphicon-usd"></span>
                                    {{ $value['suggestedbid'] }}
                                </td>
                               
                                <?php $date1=date("Y-m-d H:i:s");
                                    $date2= date($value['createddate']);
                                    $datetime1 = new DateTime($date1);
                                    $datetime2 = new DateTime($date2);
                                    $date= $datetime2->format("m-d-Y");
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format(' %a days ago');
                                ?>
                                <td class="table-td-th">
                                    {{ $days }} <br>
                                    {{ $date }}
                                </td>
                                
                                        <td class="table-td-th">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><center><span class="glyphicon glyphicon-cog"></span></center></button>
                                                <ul class="dropdown-menu" role="menu" style="left: 0% !important;
                                                right: 100% !important;text-align: center !important;transform: translate(-75%, 0) !important;">
                                                    <?php $userid = $value['associateid'] ?>
                                                    <li><a href="{{url('project/bid/'.$value['projectid'].'/'.$value['associateid'].'/1')}}" onclick="return confirm('Are you want to sure the accept this request?')">Accept</a></li>
                                                    <li><a href="{{url('project/bid/'.$value['projectid'].'/'.$value['associateid'].'/0')}}" onclick="return confirm('Are you want to sure  the reject this request?')">Reject</a>
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
                        <ul class="pagination" id="employee-pagination">
                           <!--  <li><a href="#">PREV</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class="disabled"><a href="#">NEXT</a></li> -->
                        </ul>
                    </div>
                </div>
                @else
                    <br>
                    <h6><center>No any employee request available</center></h6>
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
    var bidcount = document.getElementById('bid-count').value;
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
    var employeeCount = document.getElementById('employee-count').value;
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
  </script>
@endsection
