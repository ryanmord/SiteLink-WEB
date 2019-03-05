<!-- <div class="modal fade" id="editpassword">
  <div class="modal-dialog">
    <div class="modal-content">
 -->
      <!-- Modal Header -->
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="float: left;"><i class="fa fa-angle-left"></i></button>
        <h4 class="modal-title">Edit Profile</h4>
        
      </div> -->

      <!-- Modal body -->  
     <!--  <div class="modal-body">
        <div class="edit-profile row">
          <form id="edit-form" action="{{ url('/updateUser') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-4">
              <input type="file" name="files" id="files" class="form-group">
              <div class="user-profile-edit">
                <img src="{{asset('img/users/'.$profileimage)}}" id="image" style="height: 100%;width: 100%;">   
              </div>
              <i class="fa fa-camera"></i>
            </div> 
            <div class="col-md-10">
              <div class="form-group">
                <label>Name</label>
                  <input type="text" name="first_name" id="first_name" value="{{ $user->users_name}}">
              </div> 
              <div class="form-group">
                <label>Last Name</label>
                  <input type="text" name="lastname" id="lastname" value="{{ $user->last_name}}">
              </div>
              <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="customers_company" id="customers_company" value="{{ $user->users_company}}">
              </div>    
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="customers_email" id="customers_email" value="{{ $user->users_email}}" readonly="">
              </div> 
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="customers_phone" maxlength="17" id="customers_phone" value="{{ $user->users_phone}}" >
              </div> 
              <div class="form-group-data">
                <button type="submit" class="btn red-btn" id="updateprofile">Update</button>  
              </div>
            </div> 
          </form>
        </div>    
      </div>
    </div>
  </div>
</div>
 -->

 <div class="modal fade" id="edit-profile">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <form id="edit-form" action="{{ url('/updateUser') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="edit-profile row">
          <div class="col-md-3" style="padding-left: 50px;">
            <input type="file" name="files" id ="files">
              <div class="user-profile-edit">
                <img src="{{asset('img/users/'.$profileimage)}}" id="image" style="height: 100%;width: 100%;">  
                <i class="fa fa-camera"></i> 
                </div>
                 
              </div>   
            <div class="col-md-9">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $user->users_name}}" autocomplete="off">
                <div class="error">{{ $errors->first('first_name') }}</div>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname" value="{{ $user->last_name}}" autocomplete="off">
                <div class="error">{{ $errors->first('lastname') }}</div>
              </div> 
              </div>
              <div class="col-md-12">
              <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="customers_company" id="customers_company" value="{{ $user->users_company}}" autocomplete="off">
                <div class="error">{{ $errors->first('customers_company') }}</div>
              </div>    
            </div> 

            <div class="col-md-6">
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="customers_email" id="customers_email" value="{{ $user->users_email}}" readonly="">
                <div class="error">{{ $errors->first('customers_email') }}</div>
              </div> 
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="customers_phone" id="customers_phone" value="{{ $user->users_phone}}" maxlength="17" autocomplete="off">
                <div class="error">{{ $errors->first('customers_phone') }}</div>
              </div> 
            </div>
            
               
            <div class="form-group-data">
              <button type="submit" class="btn red-btn" id="updateprofile">Update</button>  
            </div>

          </div>  
          </form>  
        </div>
      </div>
    </div>
  </div>