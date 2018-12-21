@include('frontlayouts.main_layout')
<body id="page-top">
  <!-- Navigation -->
    @include('frontlayouts.login_topheader')
  <!-- Header -->
  <header class="masthead dashbord-screen">
    <div class="container">
      <div class="intro-text">
        <div class="row">
          <div class="col-md-7">
            <!-- <div class="owl-carousel owl-theme"> -->
              <div class="item">
                <div class="progress" data-percentage={{ $percentage }}>
                  <span class="progress-left">
                    <span class="progress-bar"></span>
                  </span>
                  <span class="progress-right">
                    <span class="progress-bar"></span>
                  </span>
                  <div class="progress-value project-data">
                    <div>
                      <span>{{ $user['totalproject'] }}</span>
                      <h3>Total</h3>
                    </div>
                  </div>
                </div>
                <div class="project-data">
                  <div class="col-md-4">
                    <h4>{{ $user['completedprojectcount'] }}</h4>
                    <h3>Jobs <br/> completed</h3>
                  </div>
                  <div class="col-md-4">
                    <h4>{{ $user['bidmadecount'] }}</h4>
                    <h3>Total <br/> Bids made</h3>
                  </div>
                  <div class="col-md-4">
                    <h4>{{ $user['overdueprojectcount'] }}</h4>
                    <h3>Overdue <br/> Projects</h3>
                  </div>
                </div>
              </div>
            <!-- </div> -->
          </div>
          <div class="col-md-5">
            <input type="hidden" name="pagenumber" id="pagenumber">
            <div class="notification-list">
              <h4>Notifications</h4>
              @if($datastatus != 0)
               <ul id="notofication-list">
                <?php $i=1;?>
                @foreach($notification['notification'] as $value)
                  @if($i % 2 == 0)
                    <li class="even">
                  @else
                    <li class="odd">
                  @endif 
                    @if($value['readflag'] == 0)
                      <span>
                      <i class="fa fa-circle" style="color: #fe5f55;float: left;"> 
                      </i><h5>&nbsp {{ $value['projectname'] }}</h5> 
                        <div class="notification-date">{{ $value['createddate'] }}
                        </div>
                      </span>
                    @else
                      <span><h5>&nbsp {{ $value['projectname'] }}</h5>
                        <div class="notification-date">{{ $value['createddate'] }}
                        </div>
                      </span>
                    @endif
                    <p> &nbsp {{ $value['notificationtext'] }}</p>

                    <!--  1 for when new project is created nearby associate area then he can add bid for new project -->

                    @if($value['notificationflag'] == 1)
                      @if($value['statusflag'] == 1)
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="{{ $value['notificationid'] }}">
                        @else
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid']}})" class="noti-btn" value="Add Bid">
                      @endif

                    <!--  3 for when bid is accepted then associate can enter the status -->

                    @elseif($value['notificationflag'] == 3)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid']}})" class="noti-btn" value="Add status">
                      
                       <!--  4 for reject bid then associate can apply bid again -->

                    @elseif($value['notificationflag'] == 4)
                      @if($value['statusflag'] == 1)
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="{{ $value['notificationid'] }}">
                        @else
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid']}})" class="noti-btn" value="Add Bid">
                      @endif
                     <!--  6 for Schedular updated project details and asscoiate can add new bid -->

                    @elseif($value['notificationflag'] == 6)
                      @if($value['statusflag'] == 1)
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="{{ $value['notificationid'] }}">
                        @else
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid']}})" class="noti-btn" value="View Project">
                      @endif

                       <!--  7 for when project manager complete the project -->

                    @elseif($value['notificationflag'] == 7)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid'] }})" class="noti-btn" value="View Project"> 

                      <!--  8 for when project manager cancelled the project -->

                    @elseif($value['notificationflag'] == 8)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid'] }})" class="noti-btn" value="View Project"> 

                      <!--  11 for when project manager gives rating and review to associate -->


                    @elseif($value['notificationflag'] == 11)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid'] }})" class="noti-btn" value="View Rating"> 

                     <!--  13 for when project manager do project is on hold -->
                       
                    @elseif($value['notificationflag'] == 13)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid'] }})" class="noti-btn" value="View Project" data-id="{{ $value['projectid'] }}" notification-id="{{ $value['notificationid'] }}"> 

                       <!--  14 for when project manager do project is in progress-->

                    @elseif($value['notificationflag'] == 14)
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail({{ $value['projectid'] }},{{ $value['notificationid'] }})" class="noti-btn" value="View Project" data-id="{{ $value['projectid'] }}" notification-id="{{ $value['notificationid'] }}"> 
                    @endif
                  </li>
                  <?php $i++;?>
                @endforeach
              </ul>
              @else
                <p>There are no Notification available</p>
              @endif
            </div>
          </div>    
        </div>    
      </div>
    </div>
  </header>
    <!-- Footer -->
  @include('frontlayouts.footer')
  @include('frontlayouts.include_js')
	<script type="text/javascript">
  $(document).ready(function(){
      $("#login-menu").removeClass('active');
      $("#dashboard-menu").addClass('active');
      document.getElementById('pagenumber').value = 1;
    });
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            items:1,
            navigation:true,
            navigationText: [
                              "<i class='fa fa-chevron-left'></i>",
                              "<i class='fa fa-chevron-right'></i>"
                            ]
        })
    </script>
    
    <script>
  function alertfunction() {
  
  var projectid = $(this).attr('data-id');
    var notificationid = $(this).attr('notification-id');
     $.ajax({
            type: 'GET',
              url: '<?php echo route('readNotification'); ?>',
              data: {notificationid:notificationid},
              dataType: 'json',
          })

          .done(function(msg) {
         
              alert("Sorry!! This project is allocated so now you cannot send bid for this project.");
    });
  }
  function viewprojectdetail(projectid,notificationid)
  {
  
    
     $.ajax({
            type: 'GET',
              url: '<?php echo route('readNotification'); ?>',
              data: {notificationid:notificationid},
              dataType: 'json',
          })

          .done(function(msg) {
    });
    if(projectid != '')
    {
      
      url = '<?php echo url('/home/projects?projectid=') ?>';
      window.location.replace(url+projectid);
      
    }
   }
   $(".notification-list ul").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('pagenumber').value;
        var pagenumber = ++pagenumber1;
        

        //var $results = $("#projectlist");
        //var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('notificationPagination'); ?>',
            data: {pagenumber:pagenumber},
            dataType: 'json',
       
        beforeSend: function(xhr) {
         /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
        },
        success: function(data) {
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#notofication-list");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          else
          {
            pagenumber = --pagenumber1;;
            
          }
          document.getElementById('pagenumber').value = '';
          document.getElementById('pagenumber').value = pagenumber;

            
        }
      });
    });

  
    </script>

  </body>
</html>
