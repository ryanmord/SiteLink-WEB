<!-- Project Status Popup -->
<div class="modal fade" id="project-status">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Project Notes</h4>
        
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
        <div class="project-level">
          <div id="no_any_status">
          <center>
            <p style= "font-size: 15px;"> There are no any notes available</p></center>
          </div>
          <input type="hidden" name="status_pagenumber" id="status_pagenumber">
          <div style="overflow-y: scroll;max-height: 350px; background: white;" id="project-status-list">
            <ul id="statuslist">
             </ul>
          </div>  
                                                                                   
           <div class="add-comment" id="add_project_status"> 
                 <br>      
              <form action="{{route('managerAddStatus')}}" id="status-form" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="project-id" id="project-id">
                <div class="form-group {{ $errors->has('subjecttxt') ? 'has-error' : '' }}">
                  
                  <select  name="subjecttxt" id="subjecttxt" class="form-control">
                    <option value="Note">Note</option>
                  </select>
                 <!--  <span class="text-danger">{{ $errors->first('subjecttxt') }}</span> -->
                </div>
                <div class="form-group {{ $errors->has('statustxt') ? 'has-error' : '' }}">
                  <textarea  name="statustxt" id="statustxt" placeholder="Add Status Details..." maxlength="255"></textarea>
                 <!--  <span class="text-danger">{{ $errors->first('statustxt') }}</span> -->
                </div>
                <div class="form-group">
                  <button type="button" id="add_status" class="btn red-btn">Add Notes</button>
                </div>
              </form>
              
            </div> 
           
          </div>  
        </div>
      </div>
  </div>
</div>