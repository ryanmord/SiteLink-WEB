@extends('layouts.main_layout')
@section('css')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
 <style type="text/css">
   .ui-datepicker-trigger{
    height: 30px;
   }
 </style>
@stop
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
 
    <div class="panel panel-success" style="text-align: left;">
      <div class="panel-heading">
        <div class="panel-title"><b>Scheduled & Remaining Projects</b>
        </div>
        <!-- <div class="panel-options">
          <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
          <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
          <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      <div class="content-row">
        <!-- <div class="row"> -->
          <!-- <ul id="myTab1" class="nav nav-tabs nav-justified">
            <li class="active"><a href="#home1" data-toggle="tab">Scheduled <span class="badge" style="background-color:#DB5A6B;" id="countscheduling">{{ $scheduledCount }}</span>
            </a></li>
            <li><a href="#remaining" data-toggle="tab">Remaining <span class="badge" style="background-color:#DB5A6B;" id="countremaining">{{ $remainingCount }}</span>
            </a></li>
          </ul> -->
          <!-- <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="home1"> -->
            <?php $date = date('m/d/Y'); ?>
              <div class="row">

              <form role="form" class="form-horizontal" method="GET" action="{{ route('exportProjects') }}">
                <div class="col-sm-3">
                <br>
                <div class="form-group">
                    <input type="text" id="datepicker" name="datepicker" value="{{ $date }}" style="margin-left: 30px;height: 30px;width: 200px;">
                 <!--  <div class='input-group date' id='datepicker'>
                      <input type='text' class="form-control" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div> -->
                
              </div>
               <!--  <i class="fa fa-calendar" id="datepickericon"></i> -->
                  <!-- <input type="text" name="datepicker" id="datepicker" value="{{ $date }}"  style="margin-top: 15px;"> -->
                 </div>
                 <div class="col-sm-3">
                   <button class="btn btn-info" type="button" id="view-btn" style="margin-top: 15px;float: left;">View</button>
                 </div>
                <div class="col-sm-6">
                <button class="btn btn-danger" type="submit" id="export-btn" style="margin-top: 15px;float: right;">Export</button>
                </div>
                </form>
                </div>
               <h5> Scheduled <span class="badge" style="background-color:#DB5A6B;" id="countscheduling">{{ $scheduledCount }}</span></h5>
               <div id="div-no-project">
                    <h6><center>No Data Found</center></h6> <br>
               </div>
                <input type="hidden" name="projectcount" id="projectcount" value="{{ $scheduledCount }}">
                <!--  <input type="date" name="select date" class="form-control"> -->
                <div class="table-responsive" id="table-div">
               
                <table class="table table-bordered" id="scheduledProject">
                    <thead>
                      <tr>
                        <th>Date Received</th>
                        <th>Date Scheduled</th>
                        <th>On-site Date</th>
                        <th>Project Number</th>
                        <th>Account Manager</th>
                        <th>Project Manager</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Scope</th>
                        <th>Employee</th>
                        <th>Associate</th>
                      </tr>
                    </thead>
                    <tbody id="projectData">
                  @if(isset($scheduledProjects) && !empty($scheduledProjects))
                  
                     @foreach($scheduledProjects as $project)
                      <tr class="content">
                        <td class="table-td-data">{{ $project['receivedDate'] }}</td>
                        <td class="table-td-data">{{ $project['schedulingDate'] }}</td>
                        <td class="table-td-data">{{ $project['onSiteDate'] }}</td>
                        <td class="table-td-data">{{ $project['projectNo'] }}</td>
                        <td class="table-td-data">{{ $project['accountManager'] }}</td>
                        <td class="table-td-data">{{ $project['projectManager'] }}</td>
                        <td class="table-td-data">{{ $project['state'] }}</td>
                        <td class="table-td-data">{{ $project['city'] }}</td>
                        <td class="table-td-data">{{ $project['scopeNames'] }}</td>
                        <td class="table-td-data">{{ $project['employeeName'] }}</td>
                        <td class="table-td-data">{{ $project['associateName'] }}</td>
                      </tr>
                     @endforeach
                     @endif
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
                  
              <h5>Scheduling In Progress <span class="badge" style="background-color:#DB5A6B;" id="countinprogress">{{ $inProgressCount }}</span></h5>
               <div id="div-no-inprogress">
                    <h6><center>No Data Found</center></h6> <br>
               </div>
                <input type="hidden" name="inprogresscount" id="inprogresscount" value="{{ $inProgressCount }}">

                <div class="table-responsive" id="table-div3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date Received</th>
                        <th>Date Scheduled</th>
                        <th>On-site Date</th>
                        <th>Project Number</th>
                        <th>Account Manager</th>
                        <th>Project Manager</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Scope</th>
                        <th>Employee</th>
                        <th>Associate</th>
                      </tr>
                    </thead>
                    <tbody id="inprogressprojectData">
                    @if(isset($inprogressProjects) && !empty($inprogressProjects))
                     @foreach($inprogressProjects as $project)
                      <tr class="content">
                        <td class="table-td-data">{{ $project['receivedDate'] }}</td>
                        <td class="table-td-data">{{ $project['schedulingDate'] }}</td>
                        <td class="table-td-data">{{ $project['onSiteDate'] }}</td>
                        <td class="table-td-data">{{ $project['projectNo'] }}</td>
                        <td class="table-td-data">{{ $project['accountManager'] }}</td>
                        <td class="table-td-data">{{ $project['projectManager'] }}</td>
                        <td class="table-td-data">{{ $project['state'] }}</td>
                        <td class="table-td-data">{{ $project['city'] }}</td>
                        <td class="table-td-data">{{ $project['scopeNames'] }}</td>
                        <td class="table-td-data">{{ $project['employeeName'] }}</td>
                        <td class="table-td-data">{{ $project['associateName'] }}</td>
                      </tr>
                     @endforeach
                     @endif
                    </tbody>
                  </table>
                  <div class="row content-row-pagination">
                      <br>
                        <div class="col-md-12">
                          <ul class="pagination" id="inprogress-pagination">
                           <!--  <li><a href="#">PREV</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li class="disabled"><a href="#">NEXT</a></li> -->
                          </ul>
                      </div>
                    </div>
                 </div>
               
               <h5>Remaining <span class="badge" style="background-color:#DB5A6B;" id="countremaining">{{ $remainingCount }}</span></h5>
               <div id="div-no-remaining">
                    <h6><center>No Data Found</center></h6> <br>
               </div>
                <input type="hidden" name="remainingcount" id="remainingcount" value="{{ $remainingCount }}">

                <div class="table-responsive" id="table-div2">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date Received</th>
                        <th>Date Scheduled</th>
                        <th>On-site Date</th>
                        <th>Project Number</th>
                        <th>Account Manager</th>
                        <th>Project Manager</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Scope</th>
                        <th>Employee</th>
                        <th>Associate</th>
                      </tr>
                    </thead>
                    <tbody id="remainingprojectData">
                    @if(isset($remainingProjects) && !empty($remainingProjects))
                     @foreach($remainingProjects as $project)
                      <tr class="content">
                        <td class="table-td-data">{{ $project['receivedDate'] }}</td>
                        <td class="table-td-data">{{ $project['schedulingDate'] }}</td>
                        <td class="table-td-data">{{ $project['onSiteDate'] }}</td>
                        <td class="table-td-data">{{ $project['projectNo'] }}</td>
                        <td class="table-td-data">{{ $project['accountManager'] }}</td>
                        <td class="table-td-data">{{ $project['projectManager'] }}</td>
                        <td class="table-td-data">{{ $project['state'] }}</td>
                        <td class="table-td-data">{{ $project['city'] }}</td>
                        <td class="table-td-data">{{ $project['scopeNames'] }}</td>
                        <td class="table-td-data">{{ $project['employeeName'] }}</td>
                        <td class="table-td-data">{{ $project['associateName'] }}</td>
                      </tr>
                     @endforeach
                     @endif
                    </tbody>
                  </table>
                  <div class="row content-row-pagination">
                      <br>
                        <div class="col-md-12">
                          <ul class="pagination" id="remaining-pagination">
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
     
   <!--  </div>
  </center>
</div> -->
@stop
@section('script')

<script type="text/javascript"> 

 $(document).ready(function () {
    $(".loader").fadeOut("slow");
     
    /*$("#div-no-project").hide();
    $("#div-no-remaining").hide();*/
    var remainingCount = document.getElementById('remainingcount').value;
    if(remainingCount > 0)
    {
      //document.getElementById('export2-btn').disabled = false;
      $("#table-div2").show();
      $("#div-no-remaining").hide();
      remainingProjectPagination();
    }
    else
    {
      $("#table-div2").hide();
      $("#div-no-remaining").show();
    }
    var schedulingCount = document.getElementById('projectcount').value;
    if(schedulingCount > 0)
    {
      $("#table-div").show();
      $("#div-no-project").hide();
      setpagination();
    }
    else
    {
     /* document.getElementById('export-btn').disabled = true;*/
      $("#table-div").hide();
      $("#div-no-project").show();
    }
    var inprogresscount = document.getElementById('inprogresscount').value;
    if(inprogresscount > 0)
    {
      $("#table-div3").show();
      $("#div-no-inprogress").hide();
      setinprogresspagination();
    }
    else
    {
     /* document.getElementById('export-btn').disabled = true;*/
      $("#table-div3").hide();
      $("#div-no-inprogress").show();
    }
    if(schedulingCount > 0 || remainingCount > 0 || inprogresscount > 0)
    {
      document.getElementById('export-btn').disabled = false;
    }
    else
    {
      document.getElementById('export-btn').disabled = true;
    }
    
  });
 /*$('#project-pagination').click(function()
 {
    var pagenumber = $('.current-page').val();
    //alert(pagenumber);
 });*/
 $('#view-btn').click(function(){
    var  date = new Date($('#datepicker').val());
    if(!isNaN(date))
    {
      day   = date.getDate();
      month = date.getMonth() + 1;
      year  = date.getFullYear();
      selecteddate = [year, month, day].join('-');
      $.ajax({
              type: "GET",
              url: '<?php echo route('getScheduledProjects'); ?>',
              data: {selectedDate:selecteddate},
              dataType: 'json',
              success: function(response){
                  if (response.appendtd != '') {
                      $("#div-no-project").hide();
                      $("#table-div").show();
                      $("#projectData").html("");
                      $("#projectData").html(response['appendtd']);
                      document.getElementById('projectcount').value = response.projectcount;
                      $('#countscheduling').text(response.projectcount);
                      setpagination();
                      setExportButton();
                  }
                  else
                  {
                      $("#table-div").hide();
                      $("#div-no-project").show(); 
                      $('#countscheduling').text(0);
                      document.getElementById('projectcount').value = 0;
                      setExportButton();
                  }
              }
          });
          $.ajax({
              type: "GET",
              url: '<?php echo route('getinprogressProjects'); ?>',
              data: {selectedDate:selecteddate},
              dataType: 'json',
              success: function(response){
                  if (response.appendtd != '') {
                      $("#div-no-inprogress").hide();
                      $("#table-div3").show();
                      $("#inprogressprojectData").html("");
                      $("#inprogressprojectData").html(response['appendtd']);
                      document.getElementById('inprogresscount').value = response.projectcount;
                      $('#countinprogress').text(response.projectcount);
                      remainingProjectPagination();
                      setExportButton();
                  }
                  else
                  {
                      
                      document.getElementById('inprogresscount').value = 0;
                      $("#table-div3").hide();
                      $("#div-no-inprogress").show();
                      $('#countinprogress').text(0); 
                      setExportButton();
                      
                  }
              }
          });
          $.ajax({
              type: "GET",
              url: '<?php echo route('getRemainingProjects'); ?>',
              data: {selectedDate:selecteddate},
              dataType: 'json',
              success: function(response){
                  if (response.appendtd != '') {
                      $("#div-no-remaining").hide();
                      $("#table-div2").show();
                      $("#remainingprojectData").html("");
                      $("#remainingprojectData").html(response['appendtd']);
                      document.getElementById('remainingcount').value = response.projectcount;
                      $('#countremaining').text(response.projectcount);
                      remainingProjectPagination();
                      setExportButton();
                  }
                  else
                  {
                      
                      document.getElementById('remainingcount').value = 0;
                      $("#table-div2").hide();
                      $("#div-no-remaining").show();
                      $('#countremaining').text(0); 
                      setExportButton();
                      
                  }
              }
          });
      }
      else
      {
        alert('Please select date');
      }
    });
 function setExportButton()
 {
    var remainingCount = document.getElementById('remainingcount').value;
    var schedulingCount = document.getElementById('projectcount').value;
    if(schedulingCount > 0 || remainingCount > 0)
    {
      document.getElementById('export-btn').disabled = false;
    }
    else
    {
      document.getElementById('export-btn').disabled = true;
    }
 }

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
    var projectcount = document.getElementById('projectcount').value;
    var limitPerPage = 8;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#projectData .content").hide()
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
            ).insertBefore("#next-page");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page").toggleClass("disabled", currentPage === 1);
        $("#next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#project-pagination").append(
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
    $(document).on("click", "#project-pagination li.current-page:not(.active)", function () {
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
function setinprogresspagination()
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
    var projectcount = document.getElementById('inprogresscount').value;
    var limitPerPage = 8;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#inprogressprojectData .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#inprogress-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page3");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page3").toggleClass("disabled", currentPage === 1);
        $("#next-page3").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#inprogress-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page3" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page3" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#inprogressprojectData").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#inprogress-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page3").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page3").on("click", function () {
        return showPage(currentPage-1);
    });
  });
}
</script>
<script type="text/javascript"> 
function exportTableToCSV(filename) {
    var csv = [];
    var  date = new Date($('#datepicker').val());
    if(!isNaN(date))
    {
      day   = date.getDate();
      month = date.getMonth() + 1;
      year  = date.getFullYear();
      selecteddate = [year, month, day].join('-');
      $.ajax({
          type: "GET",
          url: '<?php echo route('exportProjects'); ?>',
          data: {selectedDate:selecteddate},
                dataType: 'json',
          success: function(response){
              var filename = 'report';
              var blobData = new Blob([response.data], {type: "application/xlsx"})
              saveAs(blobData, filename+'.xlsx')
            }
      });
      //var rows = document.querySelectorAll("#scheduledProject tr");
  }
  else
  {
    alert('Please select date');
  }
    
}
/*function exportdataToCSV(filename) {
    var csv = [];
    var  date = new Date($('#datepicker2').val());
    if(!isNaN(date))
    {
      day   = date.getDate();
      month = date.getMonth() + 1;
      year  = date.getFullYear();
      selecteddate = [year, month, day].join('-');
      $.ajax({
          type: "GET",
          url: '<?php //echo route('exportremaining'); ?>',
          data: {selectedDate:selecteddate},
                dataType: 'json',
          success: function(response){
            if(response != '')
            {
              var rows = response;
              for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i];
                
                for (var j = 0; j < cols.length; j++) 
                    row.push(cols[j]);
                
                    csv.push(row.join(","));        
                }
                  // Download CSV file
                  downloadCSV(csv.join("\n"), filename);
                }
            }

      });
    //var rows = document.querySelectorAll("#scheduledProject tr");
  }
  else
  {
    alert('Please select date');
  }
    
}
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}*/

</script>

<script type="text/javascript">
  function remainingProjectPagination()
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
    var projectcount = document.getElementById('remainingcount').value;
    var limitPerPage = 8;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#remainingprojectData .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#remaining-pagination li").slice(1, -1).remove();
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
    $("#remaining-pagination").append(
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
    $("#remainingprojectData").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#remaining-pagination li.current-page:not(.active)", function () {
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

/*$('#view-btn2').click(function(){
    var  date = new Date($('#datepicker2').val());
    if(!isNaN(date))
    {
      day   = date.getDate();
      month = date.getMonth() + 1;
      year  = date.getFullYear();
      selecteddate = [year, month, day].join('-');
      $.ajax({
              type: "GET",
              url: '<?php //echo route('getRemainingProjects'); ?>',
              data: {selectedDate:selecteddate},
              dataType: 'json',
              success: function(response){
                  if (response.appendtd != '') {
                      $("#div-no-remaining").hide();
                      $("#table-div2").show();
                      $("#remainingprojectData").html("");
                      $("#remainingprojectData").html(response['appendtd']);
                      document.getElementById('remainingcount').value = response.projectcount;
                      $('#countremaining').text(response.projectcount);
                      document.getElementById("export2-btn").disabled = false;
                      remainingProjectPagination();
                  }
                  else
                  {
                      $("#table-div2").hide();
                      $("#div-no-remaining").show();
                      $('#countremaining').text(0); 
                      document.getElementById("export2-btn").disabled = true;
                  }
              }
          });
      }
      else
      {
        alert('Please select date');
      }
    });*/
</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 <script type="text/javascript">
  /*  $(function() {

      $( "#datepicker" ).datepicker({
         maxDate: 0 
      });
    
    });*/
 </script>
<script>
  $( function() {
   /* var image = "{{ asset('images/calender.gif') }}";
    alert(image);*/
    $( "#datepicker" ).datepicker({
      showOn: "both",
      buttonImage:"{{ asset('images/calendar.gif') }}",
      buttonImageOnly: true,
      buttonText: "Select date",
      maxDate: 0 
    });
  } );
  </script>


@endsection
