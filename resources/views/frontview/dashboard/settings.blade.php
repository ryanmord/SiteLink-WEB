<div class="modal fade" id="settings">
  <div class="modal-dialog">
    <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Settings</h4>
          </div>

          <!-- Modal body -->  
          <div class="modal-body">
           <!--  <form action="{{route('updateSettings')}}" id="settings" method="POST">
            {{ csrf_field() }}  -->
            
              <div class="row">

                  <div class="form-group">
                    <div class="col-md-12"> 

                      <label style="margin-left: 80px;">Set Availability
                      <input type="checkbox" class="check_availability" id="availability" name="availability" value="0"></label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Notifications
                      <input type="checkbox" class="check_notification" id="notification" name="notification" value="0"></label>

                    </div>
                  </div>
                  
                  <br><br>

                  <div class="col-md-12">
                    <div class="form-group">
                    <center>
                    <label id="update-msg" style="color: #28a745;"></label><br>
                      <button type="button" class="btn red-btn" id="btn_save_settings">Save</button></center>
                    </div>
                  </div>

              </div>

            <!-- </form> -->
          </div>

    </div>
  </div>
</div>

