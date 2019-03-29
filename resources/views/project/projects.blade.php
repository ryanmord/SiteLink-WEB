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
        @if ($message = session('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="panel-heading" style="height: 50px;">
            <h3 class="panel-title">
                Scoped Projects 
                @if(session('loginusertype') == 'admin')
                    <a href="{{ url('/createProject') }}"><button type="button" class="btn btn-danger" style="float: right;text-align: center;">Create Project</button></a>
                @endif
            </h3>
        </div> 
        <div class="content-row">
            <div class="row">
                <div>
                    <ul id="myTab1" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Scheduling <span class="badge" style="background-color:#DB5A6B;" id="open-count"></span></a></li>
                        
                        @if(isset($projects))
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress <span class="badge" style="background-color:#DB5A6B;" id="allocated-count">{{ count($projects) }}</span></a></li>
                        @else
                            <li><a href="#allocatedprojects" data-toggle="tab">In Progress</a></li>
                        @endif
                       <li><a href="#completedproject" data-toggle="tab">Complete <span class="badge" style="background-color:#DB5A6B;" id="complete-count">}</span></a></li>
                       <li><a href="#cancelledproject" data-toggle="tab">Cancelled 
                            <span class="badge" style="background-color:#DB5A6B;" id="cancel-count"></span></a></li>
                        
                        @if(isset($onholdprojects))
                            <li><a href="#onholdproject" data-toggle="tab">On Hold <span class="badge" style="background-color:#DB5A6B;" id="onhold-count">{{ count($onholdprojects) }}</span></a></li>
                        @else
                            <li><a href="#onholdproject" data-toggle="tab">On Hold</a></li>
                        @endif
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="allocatedprojects">
                            <div id="div-no-allocated">
                                <center><p style="font-size: 20px;">No data found</p></center><br>
                              </div>
                            <div class="table-responsive" id="allocated-div-data">
                                
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr bgcolor="#EEEEEE">
                                                <th class="table-td-th" data-id="1" id="allocated-identifier-th" onclick="sortallocatedTable(0,'allocated-identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                                <th class="table-td-th" data-id="1" id="allocated-name-th" onclick="sortallocatedTable(1,'allocated-name-th')" style="cursor: pointer;">Project Name</th>
                                                <th class="table-td-th" data-id="1" id="allocated-address-th" onclick="sortallocatedTable(2,'allocated-address-th')" style="cursor: pointer;">Site Address</th>
                                                <th  width="10%" class="table-td-th" data-id="1" id="allocated-bid-th" onclick="sortallocatedTable(3,'allocated-bid-th')" style="cursor: pointer;">Final Bid</th>
                                                <th class="table-td-th">Scope</th>
                                                @if(session('loginusertype') == 'admin')
                                                 <th class="table-td-th" data-id="1" id="allocated-pmname-th" onclick="sortallocatedTable(4,'allocated-pmname-th')" style="cursor: pointer;">Project Manager</th>
                                                @endif
                                                <th class="table-td-th">Assigned To</th>
                                                <th class="table-td-th" data-id="1" id="allocated-created-th" onclick="sortallocatedTable(5,'allocated-created-th')" style="cursor: pointer;">Created</th>
                                               
                                                <th class="table-td-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="allocated-data">
                                           
                                        </tbody>
                                    </table>
                                    <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="allocated-pagination">
                                            <!--  <li><a href="#">PREV</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li class="disabled"><a href="#">NEXT</a></li> -->
                                        </ul>
                                    </div>
                                    </div>
                                   
                                </div>
                                @if(session('loginusertype') != 'admin')
                                    @include('project.rating')
                                @endif
                            </div>
                            <div class="tab-pane fade" id="completedproject">
                                <div id="div-no-complete">
                                <center><p style="font-size: 20px;">No data found</p></center><br>
                              </div>
                                <div class="table-responsive" id="complete-div-projects">
                                 <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th" data-id="1" id="complete-identifier-th" onclick="completesortTable(0,'complete-identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                        <th class="table-td-th" data-id="1" id="complete-name-th" onclick="completesortTable(1,'complete-name-th')" style="cursor: pointer;">Project Name</th>
                                        <th class="table-td-th" data-id="1" id="complete-address-th" onclick="completesortTable(2,'complete-address-th')" style="cursor: pointer;">Site Address</th>
            
                                        <th class="table-td-th" width="10%" data-id="1" id="complete-bid-th" onclick="completesortTable(3,'complete-bid-th')" style="cursor: pointer;">Final Bid
                                        </th>
                                        <th class="table-td-th">Scope</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th class="table-td-th" data-id="1" id="complete-pm-th" onclick="completesortTable(4,'complete-pm-th')" style="cursor: pointer;">Project Manager</th>
                                        @endif
                                        <th class="table-td-th">Assigned To</th>
                                        <th class="table-td-th" data-id="1" id="complete-created-th" onclick="completesortTable(5,'complete-created-th')" style="cursor: pointer;">Created</th>
                                        <th class="table-td-th" data-id="1" id="complete-completed-th" onclick="completesortTable(6,'complete-completed-th')" style="cursor: pointer;">Completed</th>
            
                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="complete-data">
                                   
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="complete-pagination">
                                           
                                        </ul>
                                    </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cancelledproject">
                        <div id="div-no-cancel">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="cancel-div-data">
                            
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#EEEEEE">
                                            <th sclass="table-td-th" data-id="1" id="cancel-identifier-th" onclick="cancelsortTable(0,'cancel-identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                            <th class="table-td-th" data-id="1" id="cancel-name-th" onclick="cancelsortTable(1,'cancel-name-th')" style="cursor: pointer;">Project Name</th>
                                            <th class="table-td-th" data-id="1" id="cancel-address-th" onclick="cancelsortTable(2,'cancel-address-th')" style="cursor: pointer;">Site Address</th>
          
                                            <th class="table-td-th" width="10%" data-id="1" id="cancel-bid-th" onclick="cancelsortTable(3,'cancel-bid-th')" style="cursor: pointer;">Final Bid</th>
                                            <th class="table-td-th">Scope</th>
                                            @if(session('loginusertype') == 'admin')
                                            <th class="table-td-th" data-id="1" id="cancel-pmname-th" onclick="cancelsortTable(4,'cancel-pmname-th')" style="cursor: pointer;">Project Manager</th>
                                            @endif
                                            <th class="table-td-th">Assigned To</th>
            
                                            <th class="table-td-th" data-id="1" id="cancel-created-th" onclick="cancelsortTable(5,'cancel-created-th')" style="cursor: pointer;">Created</th>
            
                                            <th class="table-td-th" data-id="1" id="cancel-canceldate-th" onclick="cancelsortTable(6,'cancel-canceldate-th')" style="cursor: pointer;">Cancelled</th>
                                            <th class="table-td-th">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cancel-data">
                                        
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="cancel-pagination">
                                           
                                        </ul>
                                    </div>
                             </div>
                      
                        </div>
                    </div>
                    <div class="tab-pane fade" id="onholdproject">
                        <div id="div-no-onhold">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="onhold-div-data">
                      
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th" data-id="1" id="onhold-identifier-th" onclick="onholdsortTable(0,'onhold-identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                        <th class="table-td-th" data-id="1" id="onhold-name-th" onclick="onholdsortTable(1,'onhold-name-th')" style="cursor: pointer;">Project Name</th>
                                        <th class="table-td-th" data-id="1" id="onhold-address-th" onclick="onholdsortTable(2,'onhold-address-th')" style="cursor: pointer;">Site Address</th>
                                        <th class="table-td-th" width="10%" data-id="1" id="onhold-bid-th" onclick="onholdsortTable(3,'onhold-bid-th')" style="cursor: pointer;">Final Bid</th>
                                        <th class="table-td-th">Scope</th>
                                        @if(session('loginusertype') == 'admin')
                                        <th class="table-td-th" data-id="1" id="onhold-pmname-th" onclick="onholdsortTable(4,'onhold-pmname-th')" style="cursor: pointer;">Project Manager</th>
                                        @endif
                                        <th class="table-td-th">Assigned To</th>
            
                                        <th class="table-td-th" data-id="1" id="onhold-created-th" onclick="onholdsortTable(5,'onhold-created-th')" style="cursor: pointer;">Created</th>
                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="onhold-data">
                                    
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="onhold-pagination">
                                
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="nonallocatedproject">
                        <div id="div-no-open">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="open-div-project">
                           
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                    <th class="table-td-th" data-id="1" id="open-identifier-th" onclick="opensortTable(0,'open-identifier-th')" style="cursor: pointer;">Project Identifier</th>
                                    <th class="table-td-th" data-id="1" id="open-name-th" onclick="opensortTable(1,'open-name-th')" style="cursor: pointer;">Project Name</th>
                                    <th class="table-td-th">Total Bids</th>
                                    <th class="table-td-th" data-id="1" id="open-address-th" onclick="opensortTable(2,'open-address-th')" style="cursor: pointer;">Site Address</th>
                                    <th class="table-td-th" width="10%" id="open-bid-th" onclick="opensortTable(3,'open-bid-th')" style="cursor: pointer;">Suggested Bid</th>
                                    <th class="table-td-th">Scope</th>
                                    @if(session('loginusertype') == 'admin')
                                    <th class="table-td-th" id="open-manager-th" onclick="opensortTable(4,'open-manager-th')" style="cursor: pointer;">Project Manager</th>
                                    @endif
                                    <th class="table-td-th" id="open-created-th" onclick="opensortTable(5,'open-created-th')" style="cursor: pointer;"> Created </th>
                                    <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="open-data">

                               
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="open-pagination">
                                
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
                url: '<?php echo route('openProjectList'); ?>',
                data: {order_key:6,sortorder:2},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-open').hide();
                    $('#open-div-project').show();
                    $('#open-data').html('');
                    $('#open-data').html(msg.appendtd);
                    $('#open-count').text(msg.count);
                    setopenprojectpagination();
                }
                else
                {
                    $('#open-div-project').hide();
                    $('#div-no-open').show();
                }
           });
    $.ajax({
                type: 'GET',
                url: '<?php echo route('completeProjectList'); ?>',
                data: {order_key:6,sortorder:2},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-complete').hide();
                    $('#complete-div-project').show();
                    $('#complete-data').html('');
                    $('#complete-data').html(msg.appendtd);
                    $('#complete-count').text(msg.count);
                    setcompletedpagination();
                }
                else
                {
                    $('#complete-div-project').hide();
                    $('#div-no-complete').show();
                }
           });
        $.ajax({
            type: 'GET',
            url: '<?php echo route('cancelProjectList'); ?>',
            data: {order_key:6,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-cancel').hide();
                $('#cancel-div-data').show();
                $('#cancel-data').html('');
                $('#cancel-data').html(msg.appendtd);
                $('#cancel-count').text(msg.count);
                setcancelpagination();
            }
            else
            {
                $('#cancel-div-data').hide();
                $('#div-no-cancel').show();
            }
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo route('onHoldProjectList'); ?>',
            data: {order_key:6,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-onhold').hide();
                $('#onhold-div-data').show();
                $('#onhold-data').html('');
                $('#onhold-data').html(msg.appendtd);
                $('#onhold-count').text(msg.count);
                setonholdpagination();
            }
            else
            {
                $('#onhold-div-data').hide();
                $('#div-no-onhold').show();
            }
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo route('inProgressList'); ?>',
            data: {order_key:5,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-allocated').hide();
                $('#allocated-div-data').show();
                $('#allocated-data').html('');
                $('#allocated-data').html(msg.appendtd);
                $('#allocated-count').text(msg.count);
                setallocatedpagination();
            }
            else
            {
                $('#allocated-div-data').hide();
                $('#div-no-allocated').show();
            }
        });
    
});
/*$('body').on('click','#complete-menu', function (event) {
    $('#star-rating').starRating('setRating', 0.0);
    $('#ratingNumber').html('0.0');
    document.getElementById("projectreview").value = '';
    var projectid = $(this).attr("data-id");
   
   $("#reviewerror").text('');
    document.getElementById('review-project-id').value = projectid;
    $.ajax({
            type: 'GET',
              url: '<?php //echo route('projectAssociate'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            $("#associate-name").text(msg.associatename);
            $("#associate-email").text(msg.associateemail);
            $("#associate-company").text(msg.associatecompany);
            $("#associate-phone").text(msg.associatephone);
            $('#associate-profile').attr('src',msg.associateimage );
          });

});*/
// fill rating star on mouse hover 

/*$("#star-rating").click(function() {
    var rating = $('#star-rating').starRating('getRating');
    var rating = rating.toFixed(1);
    $('#ratingNumber').html(rating);
});

//store user reviews 
$('#submit-review').click(function(){
    $(".loader").fadeIn("slow");
        var projectid = document.getElementById("review-project-id").value;
       
        var rating = $('#ratingNumber').html();
        var comment  = document.getElementById("projectreview").value;
        if(comment == '')
        {
            $(".loader").fadeOut("slow");
            $("#reviewerror").text('Please give comment');
            $("#projectreview").focus();
            return false;
        }
        $.ajax({
            type: 'GET',
              url: '<?php //echo route('projectComplete'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            
          });
        $.ajax({
            type: 'GET',
            url: '<?php //echo route('managerReviewStore'); ?>',
            data: {projectid:projectid,rating:rating,comment:comment},
            dataType: 'json',
        })
        .done(function(msg) {
            $(".loader").fadeOut("slow");
            if(msg.status == 1)
            {
                alert(msg.message);
                location.reload();
            }
    });
});*/
</script>
<script type="text/javascript">
$(function() {

 $(".svg-star-rating").starRating({
    totalStars: 5,
    starShape: 'rounded',
    starSize: 20,
    emptyColor: '#D8D8D8',
    hoverColor: '#efce4a',
    activeColor: '#efce4a',
    ratedColor:'#efce4a',
    useGradient: false,
    disableAfterRate:false
  });



});
</script>

<script type="text/javascript">
//pagination for allocated projects
    function setallocatedpagination(){
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
    var projectcount = $('#allocated-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#allocated-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#allocated-pagination li").slice(1, -1).remove();
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
    $("#allocated-pagination").append(
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
    $("#allocated-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#allocated-pagination li.current-page:not(.active)", function () {
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
//pagination for completed projects
function setcompletedpagination(){
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
    var projectcount = $('#complete-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#complete-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#complete-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#complete-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#complete-previous-page").toggleClass("disabled", currentPage === 1);
        $("#complete-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#complete-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "complete-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "complete-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#complete-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#complete-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#complete-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#complete-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
}
</script>
<script type="text/javascript">
//pagination for open projects
    function setopenprojectpagination(){
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
    var projectcount = $('#open-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#open-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#open-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#open-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#open-previous-page").toggleClass("disabled", currentPage === 1);
        $("#open-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#open-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "open-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "open-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#open-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#open-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#open-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#open-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
} 
</script>
<script type="text/javascript">
//pagination for onhold projects
function setonholdpagination(){
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
    var projectcount = $('#onhold-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#onhold-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#onhold-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#onhold-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#onhold-previous-page").toggleClass("disabled", currentPage === 1);
        $("#onhold-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#onhold-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "onhold-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "onhold-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#onhold-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#onhold-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#onhold-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#onhold-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
}
</script>
<script type="text/javascript">
//pagination for cancel projects
function setcancelpagination(){
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
    var projectcount = $('#cancel-count').text();
    var limitPerPage = 9;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#cancel-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#cancel-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#cancel-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#cancel-previous-page").toggleClass("disabled", currentPage === 1);
        $("#cancel-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#cancel-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "cancel-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "cancel-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#cancel-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#cancel-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#cancel-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#cancel-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
} 
</script>
<script type="text/javascript">
//sorting for open projects
    function opensortTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('openProjectList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#open-data').html('');
                    $('#open-data').html(msg.appendtd);
                    $('#open-count').text(msg.count);
                    setopenprojectpagination();
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
//sorting for completed projects
    function completesortTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('completeProjectList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#complete-data').html('');
                    $('#complete-data').html(msg.appendtd);
                    $('#complete-count').text(msg.count);
                    setcompletedpagination();
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
    //sorting for cancelled projects
    function cancelsortTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
            type: 'GET',
            url: '<?php echo route('cancelProjectList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#cancel-data').html('');
                $('#cancel-data').html(msg.appendtd);
                $('#cancel-count').text(msg.count);
                setcancelpagination();
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
    //sorting for onhold projects
    function onholdsortTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
            type: 'GET',
            url: '<?php echo route('onHoldProjectList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#onhold-data').html('');
                $('#onhold-data').html(msg.appendtd);
                $('#onhold-count').text(msg.count);
                setonholdpagination();
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
     //sorting for Inprogress projects
    function sortallocatedTable(n,id)
    {
       var sortorder = $('#'+id).attr("data-id"); 
        $.ajax({
            type: 'GET',
            url: '<?php echo route('inProgressList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#allocated-data').html('');
                $('#allocated-data').html(msg.appendtd);
                $('#allocated-count').text(msg.count);
                setonholdpagination();
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
    function projectInProgress(id)
    {
        if(confirm('Are you want to sure in progress this project?'))
        {
            $(".loader").fadeIn("slow");
            $.ajax({
                type: 'GET',
                url: '<?php echo route('projectInProgress'); ?>',
                data: {projectid:id},
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
        
</script>

@endsection
