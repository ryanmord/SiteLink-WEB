 <div class="modal fade" id="changepassword">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" style="float: left;"><i class="fa fa-angle-left">
         
       </i></button>
        <h4 class="modal-title">Change Password</h4>

        
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <div class="change-password">

        <form id="change-password" action="{{ url('/userChangePassword') }}" method="post">
        {{ csrf_field() }}
       
            <div class="form-group">

                <label>Old Password</label>
                <input type="Password" name="old_password" id="old_password" placeholder="Old Password">
                
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="Password" name="new_password" id="new_password" placeholder="New Password">
               
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="Password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                
            </div>  
            <label id="passworderr" class="error" style="color: #b70a0a;"></label>
            <div class="form-group">
               <button type="button" class="btn red-btn" id="updatepassword">Update</button>  
            </div>  
            </form>  
        </div>    
      </div>
    </div>
  </div>
</div>