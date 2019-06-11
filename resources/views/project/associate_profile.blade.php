
 <!-- associate Profile Popup -->
<div class="modal fade" id="associateprofile">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Associate Profile</h4>
        
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <div class="manager-picture">
        <img src="{{asset('img/users/'.$user['users_profile_image'])}}" alt="" title="" id="managerimage" style="height: 100%;width: 100%;">
        </div>
        <center>
        <h4 id="managername">{{ $user['users_name'] }}&nbsp{{ $user['last_name'] }}</h4>
        
        <h5 id="managername" style="color: #586b6f8a;">{{ $user['associateType'] }}</h5>
        </center>
        <div class="manager-contact">
            <ul>
                <li>
                    <h5>Email</h5>
                    <p id="manageremail" style="font-size: 14px;">{{ $user['users_email'] }}</p>
                 </li>

                 <li>
                     <h5>Company</h5>
                     <p id="managercompany" style="font-size: 14px;">{{ $user['users_company'] }}</p>
                 </li>
                 <li>
                     <h5>Phone Number</h5>
                     <p id="managerphone" style="font-size: 14px;">{{ $user['users_phone'] }}
                     </p>
                 </li>
            </ul>
        </div>    
      </div>
    </div>
  </div>
</div>