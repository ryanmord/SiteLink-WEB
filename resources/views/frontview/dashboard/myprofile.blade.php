@include('frontlayouts.main_layout')
 <link href="{{secure_asset('/css/frontCss/map.css')}}" rel="stylesheet">
<body id="page-top">
  <!-- Navigation -->
    @include('frontlayouts.login_topheader')
  <!-- Header -->
  <header class="masthead dashbord-screen">
    <div class="container">
    <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ secure_asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>

      <div class="intro-text">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="manager-profile">
              <div class="profile-picture">
                <img src="{{ $profile['profileimage'] }}" style="height: 100%;width: 100%;" />
              </div> 
              <h4 class="manager-name">{{ $profile['username'] }}</h4>
              <h5 class="manager-name" style="color: #586b6f8a;">{{ $profile['associateType'] }}  </h5> 
              <div class="row">
                <div class="col-md-4">                            
                  <div class="manager-data">
                    <div class="number-data">
                      {{ $profile['completedprojectcount'] }}
                    </div> 
                    <div class="bids-status">
                      jobs Completed
                    </div> 
                  </div>    
                </div> 
                <div class="col-md-4">                            
                  <div class="manager-data">
                    <div class="number-data">
                      {{ $profile['bidmadecount'] }}
                    </div> 
                    <div class="bids-status">
                      Total Bids Made
                    </div> 
                  </div>    
                </div> 
                <div class="col-md-4">                            
                  <div class="manager-data">
                    <div class="number-data">
                      {{ $profile['overdueprojectcount'] }}
                    </div> 
                    <div class="bids-status">
                      Overdue Projects
                    </div> 
                  </div>    
                </div> 
               <!--  <div class="col-md-3">                            
                  <div class="manager-data">
                    <div class="number-data">
                      {{ $profile['review'] }}
                    </div> 
                    <div class="bids-status">
                      Average Rating
                    </div> 
                  </div>    
                </div>    --> 
              </div>
              <div class="edit-btn">
                <button type="button" class="btn red-btn" data-toggle="modal" data-target="#editprofile" id="show-edit-madal">
                Edit Profile</button>
                <button type="button" class="btn red-btn" data-toggle="modal" data-target="#changepassword">
                Change Password</button>
              </div>
            </div>
          </div>
          <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
            <div class="manger-review">
              <div class="notification-list">
              <input type="hidden" name="pagenumber" id="pagenumber">
                <h4>Project Manager Reviews</h4>
                @if($reviews['status'] != 0)
                  <ul id="userreviewlist">
                    @foreach($reviews['userreview'] as $value)
                      <li>
                        <img src="{{ $value['profileimage'] }}"/>  
                        <div class="name-rating">
                          <h5>{{ $value['username'] }}</h5>  
                          <span><i class="fa fa-star"></i>{{ $value['rating'] }}</span>
                        </div>
                        <p>{{ $value['comment'] }}</p>
                        <div class="notification-date">{{ $value['commentdate'] }}</div>
                      </li>
                    @endforeach
                   </ul>
                @else
                  <p>There are no review available</p><br>
                @endif
              </div>
            </div>
          </div>  -->   
        </div>    
      </div>
    </div>
  </header>
  <!-- Footer -->
  @include('frontlayouts.footer')
  @include('frontview.myMapModal')
  <!-- Change Password Popup -->
  <div class="modal fade" id="changepassword">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
          <h4 class="modal-title">Change Password</h4>
        
        </div>
        
        <!-- Modal body -->  
        <div class="modal-body">
          <div class="change-password">
            <form method="post" action="{{route('update_password')}}" id="change-password">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Old Password</label>
                <input type="Password" name="old_password" id="old_password" placeholder="Old Password">
                 <div class="error">{{ $errors->first('old_password') }}</div>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="Password" name="new_password" id="new_password" placeholder="New Password">
                 <div class="error">{{ $errors->first('new_password') }}</div> 
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="Password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                <div class="error">{{ $errors->first('confirm_password') }}</div>
                <label id="errormsg" class="error" style="color: #b70a0a;"></label>
              </div>  
              <div class="form-group">
                <button type="submit" class="btn red-btn" id="update_password">Update</button>
              </div> 
            </form>   
          </div>    
        </div>
      </div>
    </div>
  </div>

<!-- Edit Profile Popup -->
<div class="modal fade" id="editprofile">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
       <form action="{{route('updateProfile')}}" id="update-form" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="edit-profile row">
          <div class="col-md-3">
            <input type="file" name="image" id ="image">
              <div class="user-profile-edit">
                <img src="{{ $user['profileimage'] }}" id="imageShow" style="height: 100%;width: 100%;">   
                </div>
                 <i class="fa fa-camera"></i>
              </div>   
            <div class="col-md-9">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="name" id="txt_name" value="{{ $user['name'] }}">
                <div class="error">{{ $errors->first('name') }}</div>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname" value="{{ $user['lastname'] }}">
                <div class="error">{{ $errors->first('lastname') }}</div>
              </div> 
              <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company" id="txt_company" value="{{ $user['company'] }}">
                <div class="error">{{ $errors->first('company') }}</div>
              </div>    
            </div> 
            <div class="col-md-6">
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" id="txt_email" value="{{ $user['email'] }}" readonly="">
                <div class="error">{{ $errors->first('email') }}</div>
              </div> 
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" id="txt_phone" value="{{ $user['phone'] }}" maxlength="17">
                <div class="error">{{ $errors->first('phone') }}</div>
              </div> 
            </div>
            <div class="form-group col-md-10">
              <label>Home Address</label>
                <input type="text" name="address" value="{{ $user['address'] }}" autocomplete="off" id="address">
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                  <br>
                <a href="#" data-toggle="modal" data-dismiss="modal"><label id="set-address" style="color: #fe5f55;">set address</label></a>
                <input type="hidden" id="latitude" name="latitude" value="{{ $user['latitude'] }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ $user['longitude'] }}">
                
                <div class="error">{{ $errors->first('address') }}</div>
              </div>
            </div>
            <div class="col-md-6">
            <label>Scope(s)</label>
              <div class="form-group field-multi-edit-scope">
                <select id="ddl_scope_performed" multiple="multiple" name="scope_performed[]">
                  @foreach($scope as $value)
                    <?php $flag = 0;?>
                    @foreach($user['scopeperformed'] as $scopeid)
                      @if($value->scope_performed_id == $scopeid['scope_performed_id'])
                        <?php $flag = 1;?>
                      @endif
                    @endforeach
                      @if($flag == 1)
                      <option value="{{ $value->scope_performed_id }}" selected="">
                      {{ $value->scope_performed }} 
                    </option>
                    @else
                     <option value="{{ $value->scope_performed_id }}">
                      {{ $value->scope_performed }} 
                    </option>
                    @endif
                  @endforeach
                </select>
                 <div class="error">{{ $errors->first('scope_performed[]') }}</div>
              </div>
            </div>
            <div class="form-group-data">
              <button type="button" id="update-user" class="btn red-btn">Update</button>  
            </div>
            </div>  
          </form>  
        </div>
      </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap" async defer></script>  
<script src="{{secure_asset('/js/frontJs/map.js')}}"></script>
  @include('frontlayouts.include_js')
  <script type="text/javascript">
  
$(document).ready(function() {
 $("#login-menu").removeClass('active');
 $("#myProfile-menu").addClass('active');
 //document.getElementById('pagenumber').value = 1;
$(".loader").fadeOut("slow");
$('body').on('click','#update-user', function (event) {
    event.preventDefault(); 
  $("#update-form").validate({
    rules: {
            name: {
                required: true,
            },lastname: {
                required: true,
            },company: { 
              required: true,
            },email: { 
                required: true,
                email: true,
            },phone:{
              required: true,
              minlength:17,
              maxlength:17,
            },address:{
              required:true
            },
            "scope_performed[]": "required"
        },messages:{
            name: "Please Enter Name",
            lastname: "Please Enter Last Name",
            company: "Please Enter Company",
            email:{
              required : "Please Enter Email Address",
              email :"Please Enter valid email Address"
            },
             phone:{
              required : "Please Enter Phone number",
              minlength :"Please Enter valid Phone number",
              maxlength :"Please Enter valid Phone number"
            },
            address:"Please set Address",
            "scope_performed[]": "Please select scope performed"
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }

  });
   if($("#update-form").valid()) {
    $(".loader").fadeIn("slow");
      var formData = new FormData($('#update-form')[0]);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $.ajax({
            type: 'POST',
              url: $("#update-form").attr("action"),
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
            
          if(msg.status == '1')
          {
            alert(msg.message);
            location.reload();
          }
          else
          {
            $("#errormsg").text(msg.message).show();
          }
          
        });

     }

});
    $('body').on('click','#set-address', function (event) {
     /* var button = $(this);
  
      //var id = button.val();

      button.closest(".modal").modal('hide');*/
    $("#editprofile").modal("hide");
    //$('#editprofile').modal("close");
    $("#myMapModal").modal("show");
   
  });
  $('#close_mapbtn').on('click', function () {
   // alert('hi');
    // Load up a new modal...
    $('#editprofile').modal('show');
  })
  $('#close_map').on('click', function () {
   // alert('hi');
    // Load up a new modal...
    $('#editprofile').modal('show');
  })

    $('#ddl_scope_performed').multiselect({
        buttonContainer: '<div id="ddl_scope_performed-container"></div>',
        onChange: function(options, selected) {
          // Get checkbox corresponding to option:
          var value = $(options).val();
          var $input = $('#ddl_scope_performed-container input[value="' + value + '"]');
          // Adapt label class:
          if (selected) {
              $input.closest('label').addClass('active');
          }
          else {
              $input.closest('label').removeClass('active');
          }
      }
    });
});

$('#txt_phone').focus(function () {
    document.getElementById("txt_phone").value = '+1 (';
});

$("#txt_phone").keypress(function (e) {
    var regex = new RegExp("^[0-9]*$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);     
    if(e.keyCode === 8 || e.keyCode === 46)  
        return true;      
        if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
          if(!regex.test(key)){
            return false;      
          } 
        var phone = document.getElementById("txt_phone").value;
        if(!phone || phone.length < 4){
          document.getElementById("txt_phone").value = '+1 (';
        }
        if(phone.length == 7){
          document.getElementById("txt_phone").value = phone + ') ';
        }
        if(phone.length == 12){
          document.getElementById("txt_phone").value = phone + ' ';
        }
      }
});

$('#txt_name').keypress(function (e) {
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
        var name = document.getElementById("txt_name").value;
        var name = firstToUpperCase( name );  
        document.getElementById("txt_name").value = name;
   }
});

</script> 


 
  <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
            margin:10,
            nav:true,
           navigation:true,
            items :1,
          itemsDesktop : [1199,1],
          itemsDesktopSmall : [979,1],
          itemsTablet : [768,1],
          itemsMobile: [479,1],

           navigationText: [
             "<i class='fa fa-chevron-left'></i>",
             "<i class='fa fa-chevron-right'></i>"
            ]

        })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $(".loader").fadeOut("slow");
    $('body').on('click','#update_password', function (event) {
    event.preventDefault(); 
    $("#change-password").validate({
    rules: {
            old_password: {
                required: true,
            },new_password: { 
              required: true,
              minlength:6,
            },confirm_password: { 
                required: true,
                minlength:6,
                equalTo :"#new_password"
            },
          },
            messages:{
            old_password: "Please Enter Old Password",
            
            new_password:{
              required : "Please Enter New Password",
              minlength :"Please Enter atleast 6 lenght of password"
            },
            confirm_password:{
              required : "Please Enter Confirm Password",
              minlength :"Please Enter atleast 6 lenght of password",
              equalTo :"Please Enter the same password as above"
            },
           
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
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
          if(msg.status == '1')
          {

            alert(msg.message);
            document.getElementById("old_password").value = '';
            document.getElementById("new_password").value = '';
            document.getElementById("confirm_password").value = '';
            $("#changepassword").modal("hide");

          }
          else
          {
            $("#errormsg").text(msg.message).show();
          }
          
        });

     }

});

   
});
    document.getElementById("image").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("imageShow").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};



 /* $('body').on('click','#set-address', function (event) {
    $("#editprofile").modal("hide");
    $("#myMapModal").modal("show");
   
  });*/
 /*$('#editprofile').on('hidden', function () {
    // Load up a new modal...
    $('#myMapModal').modal('show');
  })*/
  </script>
  <!-- <script type="text/javascript">
  $('#show-edit-madal').on('click', function (){
      $('form')
      .each(function() {
        $('#update-form').data('serialized', $('#update-form').serialize())
      })
      .on('change input', 'input, select, textarea,checkbox,file', function(e) {
          var $form = $("#update-form");
          var state = $form.serialize() === $form.data('serialized');    
          $form.find('input:submit, button:submit').prop('disabled', state);
    
      //Do stuff when button is DISABLED
     
    //OR use shorthand as below
    //$("#demo").toggle(!state);
})
.find('input:submit, button:button')
.prop('disabled', true);
});
</script> -->
</body>
</html>