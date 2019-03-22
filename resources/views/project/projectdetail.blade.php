
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> Scoped </title>
 <!--  <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet"> -->
  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
 <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"> -->
    @include('layouts.include_css')

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"> -->
  <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
  
 
</head>

<!-- Body -->
<body>
  <div class="preloader-it">
    <div class="la-anim-1"></div>
    </div>
    <div class="wrapper theme-6-active pimary-color-pink">

    <!-- Top Menu Items -->
    @include('layouts.main_topheader')
    <!-- /Top Menu Items -->
    <!-- Left Sidebar Menu -->
    @include('layouts.main_sidebar')
    <!-- /Left Sidebar Menu -->
    <!-- Main Content -->
    <div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
    <div class="page-wrapper">
      <div class="container-fluid pt-20">
      <div class="container">
        <div class="intro-text">
          <div class="row">
            <div class="col-xs-12 col-sm-9 content">
              <div class="panel panel-success" style="text-align: left;">
                <div class="panel-heading">
                  <div class="panel-title">
                    <b>Project Details</b>
                  </div>
                  <div class="panel-options">
                    <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                    <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                    <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                  </div>
                </div>
                <div class="panel-body">
                  <header class="masthead dashbord-screen">
                    <div class="create-new-project">  
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="row" style="background-color: #E6E9ED;">
                            PROJECT INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <input type="hidden" name="project_id" id="project_id" value="{{ $project['project_id'] }}">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Name</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;">{{ $project->project_name }}</p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Identifier</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">#{{ $project->project_number }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">On Site Date</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;">{{ $onsitedate }}</p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Report Due From Field</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $reportdate }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">QAQC Date</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">{{ $qaqcDate }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Latitude</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;">{{ $project->latitude }}</p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Longitude</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->longitude }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Address</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">{{ $project->project_site_address }}</p>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Report Template</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">{{ $project->report_template }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Special Instruction</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">{{ $project->instructions }}</p>
                            </div>
                          </div>
                          <div class="row" style="background-color: #E6E9ED;">
                            PROPERTY INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Project Type</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">{{ $project->property_type }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Units</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->no_of_units }}</p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Sq. Footage</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->squareFootage }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Buildings</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->no_of_buildings }}</p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Land Area</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->land_area }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Stories</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->no_of_stories }}</p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Year Built</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">{{ $project->year_built }}</p>
                            </div>
                          </div>
                          @if(session('loginusertype') == 'admin')
                          <div class="row" style="background-color: #E6E9ED;">
                            BID INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Scope Budget</label>
                            </div>
                            <div class="col-md-9">
                               <?php 
                              $budget = number_format($project->budget, 2);
                              ?>
                              <p style="font-size: 15px;">${{ $budget }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px; text-align: left;" >Suggested Bid</label>
                            </div>
                            <div class="col-md-3">
                              <?php 
                              $suggestedbid = number_format($project->approx_bid, 2);
                              ?>
                              <p style="font-size: 15px;">${{ $suggestedbid }}</p>
                            </div>
                          </div>
                          @endif
                          <div class="row" style="background-color: #E6E9ED;">
                            NOTIFICATIONS
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                            <label style="font-size: 15px;">Scope</label>
                          </div>
                          <div class="col-md-9">
                            <?php
                            $temp = explode(",", $project['scope_performed_id']);
                            $count = count($temp);
                            $i = 1;
                            ?>
                            <p style="font-size: 15px;">
                            @foreach($scope as $value)
                              @if(in_array("$value->scope_performed_id", $temp))
                                {{ $value->scope_performed }}
                                @if($i == $count)
                              @else
                              ,&nbsp
                              @endif
                                 <?php $i++;?>

                              @endif
                            @endforeach
                          </p>
                        </div>
                      </div>
                      @if(isset($project->milesrange))
                      <div class="row">
                        <div class="col-md-2">
                          <label style="font-size: 15px;">Radius</label>
                        </div>

                        <div class="col-md-9">
                          <p style="font-size: 15px;">{{ $project->milesrange }} Miles</p>
                        </div>
                        </div>
                        @endif
                        @if(isset($project->employee_type_id))
                        <div class="row">
                          <div class="col-md-2">
                            <label style="font-size: 15px;">User Type</label>
                          </div>
                          <div class="col-md-9">
                          <?php
                            $temp = explode(",", $project['employee_type_id']);
                            $count = count($temp);
                            $i = 1;
                            ?>
                            <p style="font-size: 15px;">
                            @foreach($associateType as $value)
                              @if(in_array("$value->associate_type_id", $temp))
                                {{ $value->associate_type }}
                                @if($i == $count)
                              @else
                              ,&nbsp
                              @endif
                                 <?php $i++;?>

                              @endif
                            @endforeach
                          </p>
                          </div>
                          
                        </div>
                        @endif
                          @if($finalbid != 0)
                          <div class="row">
                          <div class="col-md-12">
                          <div class="edit-btn">
                                <center>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#associateprofile">Associate Profile</button>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>
                                </center>
                              </div>
                              @include('project.associate_profile')
                        </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </header>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if(session('loginusertype') == 'admin')
    @include('project.projectStatus')
  @else
    @if($holdstatus == 3)
      @include('project.addprojectstatus')
    @else
      @include('project.projectStatus')
    @endif
   @endif
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="{{asset('js/frontJs/jquery.validate.js')}}"></script>  
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>
  <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    });
  $('#view-status').click(function(){
      var projectid = document.getElementById("project_id").value;
      document.getElementById('status_pagenumber').value = 1;
      $("#statuslist").empty();
     
     $.ajax({
            type: 'GET',
              url: '<?php echo route('view-Status'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {

            if(msg.status != 0)
            {
              $('#project-status-list').show();
              $('#statuslist').show();
              document.getElementById('no_any_status').style.display='none'; 
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
              $('#statuslist').hide();
              $('#project-status-list').hide();
              document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });
   //pagination for progress status list

        $("#project-status-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('status_pagenumber').value;
        var pagenumber = ++pagenumber1;
        document.getElementById('status_pagenumber').value = '';
        document.getElementById('status_pagenumber').value = pagenumber;
        var projectid = document.getElementById("project_id").value;

        //var $results = $("#projectlist");
        //var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('status-Pagination'); ?>',
            data: {pagenumber:pagenumber,projectid:projectid},
            dataType: 'json',
       
        beforeSend: function(xhr) {
         /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
        },
        success: function(data) {
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#statuslist");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            //pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
    });
  </script>
  <script type="text/javascript">
    $('body').on('click','#add_status', function (event) {
    event.preventDefault(); 
    var projectid = document.getElementById("project_id").value;
    document.getElementById("project-id").value = projectid;
    $("#status-form").validate({

    rules: {
            statustxt: {
                required: true,
            },subjecttxt: { 
              required: true,
            },
          },messages:{
            subjecttxt: "Please Select Status",
            statustxt: "Please Enter Status Details",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
      

  });
     if($("#status-form").valid()) {
      
        $.ajax({
            type: 'POST',
              url: $("#status-form").attr("action"),
              data: $('form#status-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
            var status = document.getElementById("statustxt").value;
            var subject = document.getElementById("subjecttxt").value;
            document.getElementById('no_any_status').style.display='none'; 
            $('#project-status-list').show();
            $('#statuslist').show();
            var List = $('ul#statuslist');
             var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : status,
                 })
                  .appendTo(li);
          document.getElementById("statustxt").value = '';
          $('#subjecttxt').prop('selectedIndex',0);
          
        });

     }

    });
  </script>
</body>
</html>
                    
