
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
                              <label style="font-size: 15px;">Project No.</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;">#{{ $project['project_id'] }}</p>
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
                              <label class="required" style="font-size: 15px; text-align: left;" >Suggested Bid</label>
                            </div>
                            <div class="col-md-3">
                              <input type="text" id="bid-txt" name="bid-txt" style="margin-left: 18px;font-size: 15px;padding-bottom: 0px;">
                              <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0px;font-size: 15px;"></i>
                              <p style="color: #fe5f55;" id="biderr"></p>
                            </div>
                          </div>
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
                          <div class="row">
                            <div class="col-md-2">
                              <br>
                              <label style="font-size: 15px;" class="required">Radius</label>
                            </div>
                            <div class="col-md-9">
                              <output style="float: left;">Radius&nbsp</output>
                              <output name="miles" id="miles" style="float: left;">{{$minvalue}}
                              </output>
                              <output style="float: left;">&nbspMILES</output>
                              <input type="range" name="milesrange" id="milesrange" value="{{ $minvalue }}" min="{{ $minvalue }}" max="{{ $maxvalue }}" oninput="miles.value = milesrange.value">
                              <output name="minmiles" id="minmiles" style="float: left;">{{$minvalue}}MILES</output>
                              <output name="maxmiles" id="maxmiles" style="float: right;">{{$maxvalue}}MILES</output>
                            </div>
                          </div>
                          <div class="row">
                          <br>
                            <div class="col-md-2">
                              <br>
                              <label style="font-size: 15px;" class="required">User Type
                              </label>
                            </div>
                            <div class="col-md-9">
                            <input type="hidden" name="associate-type-ids" id="associate-type-ids">
                              @foreach($associateType as $value)
                                <label class="checkbox" style="color: grey;" >
                                  <input type="checkbox" value="{{ $value->associate_type_id }}" name="associatetypeid[]" id="associatetypeid[]">
                                    {{ $value->associate_type }} 
                                </label>
                              @endforeach
                              <p style="color: #fe5f55;" id="typeerr"></p>
                            </div>
                          </div>
                          <div class="row" id="userName-div">
                            <div class="col-md-2">
                             
                              <label style="font-size: 15px;">Live User List</label>
                            </div>
                            <div class="col-md-7">
                            <div class="table-responsive" style="max-height: 100px;overflow: auto;">
                              <table frame="box" rules="rows">
                                <tbody id="live-user-data">
                              </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-2">
                          </div>
                          <!-- select associate type -->
                          <div class="form-group col-md-9">
                            <a href="#associate-list" data-toggle="modal"><u style="color: #fe5f55;" id="add-individuals">+ Add Individual(s)</u>
                            </a>
                          </div>
                          @include('project.asscociatelist')
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="edit-btn">
                              <center>
                                <button type="button" class="btn red-btn" id="cancel-btn">Cancel</button>
                                <button type="button" class="btn red-btn" id="send-btn">Send</button>
                              </center>
                            </div>
                          </div>
                        </div>
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
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="{{asset('js/frontJs/jquery.validate.js')}}"></script>  
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>
  <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    });
  </script>
  <script type="text/javascript">
    $('#add-individuals').click(function(){
    document.getElementById('pagenumber').value = 1;
    var projectid = document.getElementById("project_id").value;
    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    document.getElementById("associate-ids").value = checks;
    var checks = document.getElementById("associate-ids").value;
    $.ajax({
            type: 'GET',
            url: '<?php echo route('searchAssociate'); ?>',
            data: {selectedAssociate:checks,pagenumber:1,limit:6,projectid:projectid},
            dataType: 'json',
          })

          .done(function(response) {
            if(response != '')
            {
              $('#usertable').html('');
              $('#no_any_user').hide();
              $('#div-button').show();
              $('#associatetable').show();
              $('#usertable').append(response);
            }
            else
            {
              $('#associatetable').hide();
              $('#div-button').hide();
              $('#no_any_user').show();
            }
        });
    }); 
   $('#add-individuals-users').click(function(){
    var projectid = document.getElementById("project_id").value;
    var idvalue = document.getElementById("associate-ids").value;
    $('#selectIdLabel').html('Selected Individuals').show();
    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    
    if(checks != "")
    {
      document.getElementById("associate-ids").value = checks;
    }
    var checks = document.getElementById("associate-ids").value;
    $.ajax({
            type: 'GET',
            url: '<?php echo route('getLiveUserList'); ?>',
            data: {selectedAssociate:checks,projectid:projectid},
            dataType: 'json',
          })
          .done(function(response) {
            if(response != '')
            {
              $('#userName-div').show();
              $('#live-user-data').html('');
              $('#live-user-data').append(response);
            }
      });
    }); 
    $("#search-user").keyup(function () {
    var idvalue = document.getElementById("associate-ids").value;
    var projectid = document.getElementById("project_id").value;
    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    
    if(idvalue === "")
    {
      document.getElementById("associate-ids").value = checks;
    }
    else
    {
      document.getElementById("associate-ids").value = idvalue + ',' + checks;
    }
      value = $(this).val();
      document.getElementById('pagenumber').value = 1;
      var idvalue = document.getElementById("associate-ids").value;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('searchAssociate'); ?>',
              data: {search_user:value,selectedAssociate:idvalue,pagenumber:1,limit:6,projectid:projectid},
              dataType: 'json',
          })
        .done(function(response) {
            if(response != '')
            {
              $('#no_any_user').hide();
              $('#associatetable').show();
              $('#div-button').show();
              $('#usertable').html('');
              $('#usertable').append(response);
            }
            else
            {
               $('#associatetable').hide();
               $('#div-button').hide();
               $('#no_any_user').show();
            }
        });
    });
      $("#associatetable").scroll(function() {
        var value = $('#search-user').val();
        var pagenumber1 = document.getElementById('pagenumber').value;
        var idvalue = document.getElementById("associate-ids").value;
        var pagenumber = ++pagenumber1;
        var projectid = document.getElementById("project_id").value;
        document.getElementById('pagenumber').value = pagenumber;
        $.ajax({
              type: 'GET',
              url: '<?php echo route('searchAssociate'); ?>',
              data: {search_user:value,selectedAssociate:idvalue,pagenumber:pagenumber,limit:6,projectid:projectid},
              dataType: 'json',
          success: function(response) {
          if(response === '')
          {
            //$pagenumber = --pagenumber1;
          }
          else
          {
            $('#usertable').append(response);
            pagenumber = pagenumber;
          }
        }
      });
    });
  </script>
  <script type="text/javascript">
    function rejectUser(id)
    {
      //alert(id);
      var projectid = document.getElementById("project_id").value;
      $.ajax({
          type: 'GET',
          url: '<?php echo route('rejectLiveUser'); ?>',
          data: {userId:id,projectId:projectid},
              dataType: 'json',
          success: function(response) {
          if(response === '')
          {
             $('#live-user-data').html('');
          }
          else
          {
            $('#live-user-data').html('');
            $('#live-user-data').append(response);
          }
      }
    });
    }
    $("#milesrange").change(function() {
        getNotifyUser();
    });
    $('input[name="associatetypeid[]"]').change(function() {
        $("#typeerr").text('');
        getNotifyUser();
    });
    function getNotifyUser()
    {
      document.getElementById("associate-type-ids").value = '';
      var checks = $('input[name="associatetypeid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
      //alert(checks);
      document.getElementById("associate-type-ids").value = checks;
      var checks = document.getElementById("associate-type-ids").value;

      var projectid = document.getElementById("project_id").value;
      var miles = document.getElementById('miles').value;
      
      //var pagenumber = ++pagenumber1;
      //document.getElementById('pagenumber').value = pagenumber;
      $.ajax({
          type: 'GET',
          url: '<?php echo route('schedulingNotification'); ?>',
          data: {associateTypeId:checks,miles:miles,projectId:projectid},
              dataType: 'json',
          success: function(response) {
          if(response === '')
          {
             
          }
          else
          {
            $('#live-user-data').html('');
            $('#live-user-data').append(response);
          }
        }
      });
    }
   
    $(document).on('change', '.usercheck', function() {
      userid = $(this).val();
      var projectid = document.getElementById("project_id").value;
      if(this.checked) {
        status = 1;
        $.ajax({
          type: 'GET',
          url: '<?php echo route('changeCheckStatus'); ?>',
          data: {userid:userid,status:status,projectid:projectid},
              dataType: 'json',
          success: function(response) {
          
        }
      });
    }
    else
    {
       status = 0;
        $.ajax({
          type: 'GET',
          url: '<?php echo route('changeCheckStatus'); ?>',
          data: {userid:userid,status:status,projectid:projectid},
              dataType: 'json',
          success: function(response) {
         
        }
      });
    }
});
  </script>
  <script type="text/javascript">
    $('#send-btn').click(function(){
      
      var bid = document.getElementById("bid-txt").value;
      if(bid == '')
      {
        $("#biderr").text('Please enter suggested bid value');
        $("#bid-txt").focus();
        return false;
      }
      var checks = $('input[name="associatetypeid[]"]:checked').map(function(){
          return $(this).val();
      }).get();
      if(checks == '')
      {
        $("#typeerr").text('Please select associate type');
        return false;
      }
      var projectid = document.getElementById("project_id").value;
      var checks = document.getElementById("associate-type-ids").value;
      var miles = document.getElementById('miles').value;
      $(".loader").fadeIn("slow");
      $.ajax({
                  type: 'GET',
                    url: '<?php echo route('sendProjectNotification'); ?>',
                    data: {projectid:projectid,miles:miles,associate_type_id:checks,bid:bid},
                    dataType: 'json',
              })
              .done(function(msg) {
                alert(msg.message);
                $(".loader").fadeOut("slow");
                url = '<?php echo route('dashboard'); ?>';
                window.location.replace(url);
              });
          });
    $('#cancel-btn').click(function(){
      url = '<?php echo route('dashboard'); ?>';
      window.location.replace(url);
    });
    $("#bid-txt").keypress(function (e) {
      $("#biderr").text('');
      $('#bid-txt').keyup(function(e) {
      if ($(this).val().indexOf('.') == 0 || $(this).val().indexOf('0') == 0) {
        $(this).val($(this).val().substring(1));
                  }
                });
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
  </script>
</body>
</html>
                    
