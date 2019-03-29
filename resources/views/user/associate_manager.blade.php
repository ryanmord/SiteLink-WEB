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
             <div id="div-no-associate">
                <center><p style="font-size: 20px;">No data found</p></center><br>
            </div>
              <div class="table-responsive" id="associate-table-div">
                
                <input type="hidden" name="associate-count" id="associate-count" value="">
                  <table class="table table-bordered table-hover table-striped" id="associateTable">
                    <thead>
                      <tr bgcolor="#EEEEEE">
                        <th width="80" data-id="1" id="id-th" onclick="sortTable(0,'id-th','id-th-asc','id-th-desc')" style="cursor: pointer;">ID <i class='fa fa-arrow-up fa-icon-sort' id="id-th-asc"></i><i class='fa fa-arrow-down fa-icon-sort' id="id-th-desc"></th>
                        <th width="50px;">Image</th>
                        <th data-id="1" width="130" id="name-th" onclick="sortTable(1,'name-th','name-th-asc','name-th-desc')" style="cursor: pointer;">User Name <i class='fa fa-arrow-down fa-icon-sort' id="name-th-desc"><i class='fa fa-arrow-up fa-icon-sort' id="name-th-asc">
                          </i></th>
                        <th data-id="1" width="150" id="company-th" onclick="sortTable(2,'company-th','company-th-asc','company-th-desc')" style="cursor: pointer;">Company <i class='fa fa-arrow-down fa-icon-sort' id="company-th-desc"><i class='fa fa-arrow-up fa-icon-sort' id="company-th-asc">
                          </i></th>
                        <th data-id="1" id="email-th" onclick="sortTable(3,'email-th','email-th-asc','email-th-desc')" style="cursor: pointer;">Email <i class='fa fa-arrow-up fa-icon-sort' id="email-th-asc">
                          </i><i class='fa fa-arrow-down fa-icon-sort' id="email-th-desc"></th>
                        <th data-id="1" width="200" id="address-th" onclick="sortTable(4,'address-th','address-th-asc','address-th-desc')" style="cursor: pointer;">Address <i class='fa fa-arrow-up fa-icon-sort' id="address-th-asc">
                          </i><i class='fa fa-arrow-down fa-icon-sort' id="address-th-desc"></th>
                        <th width="100"> Scope(s) </th>
                        <th width="100" data-id="1" id="created-th" onclick="sortTable(5,'created-th','created-th-asc','created-th-desc')" style="cursor: pointer;">Enrolled <i class='fa fa-arrow-up fa-icon-sort' id="created-th-asc">
                          </i><i class='fa fa-arrow-down fa-icon-sort' id="created-th-desc"></th>
                        <th data-id="1" width="100" id="status-th" onclick="sortTable(6,'status-th','status-th-asc','status-th-desc')" style="cursor: pointer;">Status <i class='fa fa-arrow-up fa-icon-sort' id="status-th-asc">
                          </i><i class='fa fa-arrow-down fa-icon-sort' id="status-th-desc"></th>
                        <th>Action</th>
                      </tr>
                            
                    </thead>
                      <tbody id="associate-data">
                       
                        </tbody>
                      </table>
                      <div class="row content-row-pagination">
                        <br>
                        <div class="col-md-12">
                          <ul class="pagination" id="associate-pagination">
                          </ul>
                        </div>
                      </div>
                     
                  </div>
                 
                </div>
                <div class="tab-pane fade" id="managers">
                  <div id="div-no-manager">
                    <center><p style="font-size: 20px;">No data found</p></center><br>
                  </div>
                  <div class="table-responsive" id="manager-table-div">
                   
                    <input type="hidden" name="manager-count" id="manager-count" value="">
                    <table class="table table-bordered table-hover table-striped">
                      <thead>
                        <tr bgcolor="#EEEEEE">
                          <th width="50;" data-id="1" id="pmid-th" onclick="pmsortTable(0,'pmid-th')" style="cursor: pointer;">ID</th>
                          <th width="50;">Image</th>
                          <th data-id="1" id="pmname-th" onclick="pmsortTable(1,'pmname-th')" style="cursor: pointer;">User Name
                          </th>
                          <th data-id="1" id="pmcompany-th" onclick="pmsortTable(2,'pmcompany-th')" style="cursor: pointer;">Company</th>
                          <th data-id="1" id="pmemail-th" onclick="pmsortTable(3,'pmemail-th')" style="cursor: pointer;">Email</th>
                          <th width="10%" data-id="1" id="pmcreated-th" onclick="pmsortTable(4,'pmcreated-th')" style="cursor: pointer;">Enrolled </th>
                          <th data-id="1" id="pmstatus-th" onclick="pmsortTable(5,'pmstatus-th')" style="cursor: pointer;">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="manager-data">
                     
                </tbody>
            </table>
            <div class="row content-row-pagination">
              <br>
              <div class="col-md-12">
                <ul class="pagination" id="manager-pagination">
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
    $(".loader").fadeOut("slow");
    $.ajax({
                  type: 'GET',
                  url: '<?php echo route('associateList'); ?>',
                  data: {order_key:0,sortorder:2},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.count > 0)
                 {
                    $('#div-no-associate').hide();
                    $('#associate-table-div').show();
                    $('#associate-data').html('');
                    $('#associate-data').html(msg.appendtd);
                    document.getElementById('associate-count').value = msg.count;
                    setassociatePagination();
                 }
                 else
                 {
                    $('#div-no-associate').show();
                    $('#associate-table-div').hide();
                 }
           });
    
    $.ajax({
                  type: 'GET',
                  url: '<?php echo route('managerList'); ?>',
                  data: {order_key:0,sortorder:2},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.count > 0)
                 {
                    $('#div-no-manager').hide();
                    $('#manager-table-div').show();
                    $('#manager-data').html('');
                    $('#manager-data').html(msg.appendtd);
                    document.getElementById('manager-count').value = msg.count;
                    setmanagerpagination();
                 }
                 else
                 {
                    $('#div-no-manager').show();
                    $('#manager-table-div').hide();
                 }
           });
    
});
</script>
<script type="text/javascript">
function setassociatePagination()
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
} 
</script>
<script type="text/javascript">
//pagination for onhold projects
  function setmanagerpagination()
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
}
</script>
<script type="text/javascript">
      function sortTable(n,id,arrowup,arrowdown) {

       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('associateList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#associate-data').html('');
                    $('#associate-data').html(msg.appendtd);
                    document.getElementById('associate-count').value = msg.count;
                    setassociatePagination();
                 }
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
  <script type="text/javascript">
      function pmsortTable(n,id) {

       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('managerList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#manager-data').html('');
                    $('#manager-data').html(msg.appendtd);
                    document.getElementById('manager-count').value = msg.count;
                    setmanagerpagination();
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
