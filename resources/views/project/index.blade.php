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

            {{ ucfirst($username) }}'s Projects</h3>
        </div>
        <input type="hidden" name="pagenumber" id="pagenumber">
        <input type="hidden" name="projectcount" value="" id="projectcount">
        <input type="hidden" name="userid" id="userid" value="{{ $userid }}">
        <div id="div-no-project">
                <center><p style="font-size: 20px;">No data found</p></center><br>
            </div>
        <div class="table-responsive" id="table-div">
           
            <table class="table table-bordered table-hover table-striped">
		        <thead>
                    <tr bgcolor="#EEEEEE">
                        <th class="table-td-th" width="100" data-id="1" id="identifier-th" onclick="sortTable(0,'identifier-th','identifier-th-asc','identifier-th-desc')" style="cursor: pointer;text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="identifier-th-asc"></i></th>

                        <th class="table-td-th" width="120" data-id="1" id="name-th" onclick="sortTable(1,'name-th','name-th-asc','name-th-desc')" style="cursor: pointer;">Project Name  <i class='fa fa-arrow-down fa-icon-sort' id="name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="name-th-asc"></i></th>

                        <th class="table-td-th"  data-id="1" id="address-th" onclick="sortTable(2,'address-th','address-th-asc','address-th-desc')" style="cursor: pointer;">Site Address  <i class='fa fa-arrow-down fa-icon-sort' id="address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="address-th-asc"></i></th>

                        <th class="table-td-th" width="120" data-id="1" id="budget-th" onclick="sortTable(3,'budget-th','budget-th-asc','budget-th-desc')" style="cursor: pointer;">Approx Bid <i class='fa fa-arrow-down fa-icon-sort' id="budget-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="budget-th-asc"></i></th>
                        
                        <th class="table-td-th">Status</th>

                        <th class="table-td-th" width="100" data-id="1" id="created-th" onclick="sortTable(4,'created-th','created-th-asc','created-th-desc')" style="cursor: pointer;">Created <i class='fa fa-arrow-down fa-icon-sort' id="created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="created-th-asc"></i></th>
                        <th class="table-td-th">Action</th>
                    </tr>
    	        </thead>
    	        <tbody id="projectData">
                    
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
           
    	</div>
    </div>
   
</div>
@stop
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
       $('#div-no-project').hide();
        document.getElementById('pagenumber').value = 1;
        userid = document.getElementById('userid').value;
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('usersProject'); ?>',
                  data: {order_key:4,sortorder:2,userid:userid},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.count > 0)
                 {
                    $('#div-no-project').hide();
                    $('#table-div').show();
                    $('#projectData').html('');
                    $('#projectData').html(msg.appendtd);
                    document.getElementById('projectcount').value = msg.count;
                    setpagination();
                    $(".loader").fadeOut("slow");
                 }
                 else
                 {
                    $('#div-no-project').show();
                    $('#table-div').hide();
                    $(".loader").fadeOut("slow");
                 }
           });
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
        $("#projectData .content").hide()
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
    $("#projectData").show();
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
      function sortTable(n,id,arrowup,arrowdown) {

       var sortorder = $('#'+id).attr("data-id"); 
       userid = document.getElementById('userid').value;
       $(".loader").fadeIn("slow");
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('usersProject'); ?>',
                  data: {order_key:n,sortorder:sortorder,userid:userid},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#projectData').html('');
                    $('#projectData').html(msg.appendtd);
                    document.getElementById('projectcount').value = msg.count;
                    setpagination();
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
  </script>
@endsection
