
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title> Scoped </title>
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="fkMSpKSo6hiL4aMtehZ6vsKrITZzXRMTNqJcc08Vjbn4x2CqKYTaK9bADjir9ZlwWVCoNVE0zG0Bn_VUB-ywPA==">
    <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    @include('layouts.include_css')
    <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <style type="text/css">
    #first_name-error
    {
      color: #b70a0a;
    }
    #lastname-error
    {
      color: #b70a0a;
    }
    #customers_company-error
    {
      color: #b70a0a;
    }
    #customers_phone-error
    {
      color: #b70a0a;
    }
    #old_password-error
    {
      color: #b70a0a;
    }
    #new_password-error
    {
      color: #b70a0a;
    }
    #confirm_password-error
    {
      color: #b70a0a;
    }
   </style>
 
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
  
      <div class="page-wrapper">
        <div class="container-fluid pt-20">
        <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
        <div class="container">
            <div class="intro-text">
              <div class="row">
              @if($userreview != 0)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
              @else
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
              @endif
              <div class="manager-profile">
                <div class="profile-picture">
                  <img src="{{asset('img/users/'.$profileimage)}}" style="height: 100%;width: 100%;" />
                </div> 
              <center>
                <h4 class="manager-name">{{$username}}</h4> 
              </center>  
              <div class="row">
                <div class="col-md-3" style="float: center;">                            
                  <div class="manager-data">
                     <center>
                        <div class="number-data">
                          {{ $completeproject }}
                        </div> 
                        <div class="bids-status">
                            jobs Completed
                        </div> 
                      </center>   
                    </div>    
                  </div> 
                  <div class="col-md-3">                            
                    <div class="manager-data">
                      <center>
                        <div class="number-data">
                          {{ $inProgressCount }}
                        </div> 
                        <div class="bids-status">
                          Jobs In Progress
                        </div> 
                      </center>   
                    </div>    
                  </div> 
                  <div class="col-md-3">                            
                    <div class="manager-data">
                      <center>
                        <div class="number-data">
                          {{ $overdueprojectcount }}
                        </div>

                        <div class="bids-status">
                          Overdue Projects
                        </div> 
                      </center> 
                    </div>    
                  </div> 
                  <div class="col-md-3">                            
                    <div class="manager-data">
                      <center>
                        <div class="number-data">
                          {{$review}}
                        </div> 
                        <div class="bids-status">
                          &nbsp Rating
                          &nbsp  &nbsp &nbsp
                        </div> 
                      </center>  
                    </div>    
                  </div>    
                </div>

                <div class="edit-btn">
                  <center>
                    <button type="button" class="btn red-btn" data-toggle="modal" data-target="#edit-profile">Edit Profile</button>
                    <button type="button" class="btn red-btn" data-toggle="modal" data-target="#changepassword">Change Password</button>
                  </center>
                </div>
              </div>
                       
              @include('user.changepassword')
              @include('user.changeprofile')

            </div>
            @if($userreview != 0)
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                <div class="manger-review">
                  <div class="notification-list">
                        
                    <h4> &nbsp &nbsp &nbsp Associate Reviews</h4>
                      <ul>
                        @foreach($userreview as $rating)
                          <li>
                            <img src="{{asset('img/users/'.$rating['profileimage'])}}"  />  
                            <div class="name-rating">
                              <h5>{{ $rating['username'] }}</h5>  
                              <span><i class="fa fa-star"></i> {{ $rating['rating'] }}</span>
                            </div>
                            <p>{{ $rating['comment'] }}.</p>
                            <div class="notification-date">{{ $rating['commentdate'] }}</div>
                          </li>
                        @endforeach
                      </ul>
                         
                    </div>
                  </div>
                </div>
              @endif
            </div>    
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.0.0/jquery.caret.min.js">
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
</script>
 <script type="text/javascript">
  jQuery(document).ready(function(){
      $('form')
      .each(function() {
        $('#edit-form').data('serialized', $('#edit-form').serialize())
      })
      .on('change input', 'input, select, textarea, checkbox, file',function(e) {

          var $form = $(this).closest("form");
          var formData = new FormData($('#signup-form')[0]);//for image or file
          var state = $form.serialize() === formData; 
          $form.find('input:submit, button:submit').prop('disabled', state);
    
      //Do stuff when button is DISABLED
     
    //OR use shorthand as below
    //$("#demo").toggle(!state);
})
.find('input:submit, button:submit')
.prop('disabled', true);
});
</script>
<script type="text/javascript">
  document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

$(document).ready(function () {
 
    $(".loader").fadeOut("slow");

     
    $('body').on('click','#updateprofile', function (event) {
            event.preventDefault(); 
            
        $('#edit-form').validate({
          // initialize the plugin

          rules: {
            first_name: 
            {
              required: true,
              
              
            },
            lastname: 
            {
              required: true,
              
              
            },
            customers_company: 
            {
              required: true
            },
           
            
            customers_phone: 
            {
              required: true,
              minlength:17
              
            },
            
        }
       
    });

    if($("#edit-form").valid()) {
     $(".loader").fadeIn("slow");
     var formData = new FormData($('#edit-form')[0]);
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
            type: 'POST',
              url: $("#edit-form").attr("action"),
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false

          })

          .done(function(msg) {
              $(".loader").fadeOut("slow");
              if(msg.error)
              {
                $("#errormsg").html(msg.error).show();
              }
              else
              {
                alert(msg.success);
                url = '<?php echo route('editUser'); ?>';
                window.location.replace(url);
              }
          });
    }
    });
        $('body').on('click','#updatepassword', function (event) {
            event.preventDefault(); 
            
        $('#change-password').validate({
          // initialize the plugin

          rules: {
            old_password: 
            {
              required: true,
              minlength:6
              
              
            },
            new_password: 
            {
              required: true,
              minlength:6
            },
           
            
            confirm_password: 
            {
              required: true,
              minlength:6
              
            },
            
        }
       
    });

    if($("#change-password").valid()) {
     $(".loader").fadeIn("slow");
      $.ajax({
            type: 'POST',
              url: $("#change-password").attr("action"),
              data: $('form#change-password').serialize(),
              dataType: 'json',
             

          })

          .done(function(msg) {
              $(".loader").fadeOut("slow");
              if(msg.error)
              {
                $("#passworderr").html(msg.error).show();
              }
              else
              {
                alert(msg.success);
                url = '<?php echo route('editUser'); ?>';
                window.location.replace(url);
              }
          });
        }
    });
    $('#first_name').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z ]+$");
         var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
          if(e.keyCode === 8 || e.keyCode === 46)  
          return true;             
        if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
          if(!regex.test(key)){
         return false;      
      }
      function firstToUpperCase( str ) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
      }

      var name = document.getElementById("first_name").value;
      var name = firstToUpperCase( name );  
      document.getElementById("first_name").value = name;

   }

    });
 });
$('#customers_phone').focus(function () {
    document.getElementById("customers_phone").value = '+1 (';
   
});
$("#customers_phone").keypress(function (e) {
  var regex = new RegExp("^[0-9]*$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);     
     if(e.keyCode === 8 || e.keyCode === 46)  
      return true;      
      if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
      if(!regex.test(key)){
         return false;      

      } 
    }
    var phone = document.getElementById("customers_phone").value;
    if(!phone || phone.length < 4)
    {
      document.getElementById("customers_phone").value = '+1 (';
    }
    if(phone.length == 7)
    {
      document.getElementById("customers_phone").value = phone + ') ';
    }
    if(phone.length == 12)
    {
      document.getElementById("customers_phone").value = phone + ' ';
    }
   
  
});
</script>
  </body>
</html>
                  
