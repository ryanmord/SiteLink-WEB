
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
                <a href="{{ url()->previous() }}">Back</a>
                      &nbsp &nbsp
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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                     
                        {{csrf_field()}}
                        <div class="row">
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project['project_id'] }}">
                          <div class="form-group col-md-3">
                            <br>
                            <label>Project Name</label>
                          </div>
                          <div class="form-group col-md-9 ">
                            <input type="text" value="{{ $project->project_name }}" placeholder="Project Name" readonly>
                              
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                            <br>
                            <label>Site Address</label>
                          </div>
                          <div class="form-group col-md-9">
                            <input type="text" readonly="" value="{{ $project->project_site_address }}" placeholder="site Address">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                            
                            <label>Report Due From Field</label>
                          </div>
                          <div class="form-group col-md-9">
                            <input type="text" value="{{ $reportdate }}" placeholder="Report Due Date" readonly>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                          </div>
                          </div>
                          <div class="row">
                          <div class="form-group col-md-3">
                            <label>On Site Date</label>
                          </div>
                          <div class="form-group col-md-9">
                              <input type="text" value="{{ $onsitedate }}" placeholder="On Site Date" readonly>
                              <i class="fa fa-calendar" id="datepickericon"></i>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                            
                            <label>Report Template</label>
                          </div>
                          <div class="form-group col-md-9">
                            <input type="text" value="{{ $project->report_template }}" placeholder="Report template" readonly>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                           
                            <label>Special Instructions</label>
                          </div>
                          <div class="form-group col-md-9">
                            <input type="text" value="{{ $project->instructions }}" placeholder="Special instruction" readonly>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Suggested Bid</label>
                          </div>
                          <div class="form-group col-md-9">
                          <?php 
                          $suggestedbid = number_format($project->approx_bid, 2);
                          ?>
                            <input type="text" value="{{ $suggestedbid }}" style="padding-left: 12px;" readonly>
                            <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                          </div>
                        </div>
                        @if($finalbid > 0)
                          <div class="row">
                            <div class="form-group col-md-3">
                              
                              <label>Final Bid</label>
                            </div>
                            <div class="form-group col-md-9">
                            <?php 
                          $associatebid = number_format($finalbid, 2);
                          ?>
                              <input type="text" name="projectbid" id="projectbid" value="{{ $associatebid }}" placeholder="Suggest a bid" style="padding-left: 12px;" readonly>
                                 <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                            </div>
                          </div>
                        @endif
                        <?php
                          $temp = explode(",", $project['scope_performed_id']);
                        ?>
                        <div class="row">
                          <div class="form-group col-md-3">
                            <br><br><br>
                            <label>Scope(s)</label>
                          </div>
                          <div class="form-group col-md-9">
                            @foreach($scope as $value)
                              @if(in_array("$value->scope_performed_id", $temp))
                                <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="{{ $value->scope_performed_id }}" name="scopeperformedid[]" checked disabled>
                                        {{ $value->scope_performed }} 
                                </label>
                              @else 
                                <label class="checkbox" style="color: grey;">
                                  <input type="checkbox" value="{{ $value->scope_performed_id }}" name="scopeperformedid[]" disabled>
                                      {{ $value->scope_performed }} 
                                </label>
                              @endif
                            @endforeach
                          </div>
                            @if($finalbid != 0)
                              <div class="edit-btn">
                                <center>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#associateprofile">Associate Profile</button>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>
                                </center>
                              </div>
                             @include('project.associate_profile')
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
                    
