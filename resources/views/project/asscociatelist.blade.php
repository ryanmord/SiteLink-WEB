<!-- Project Status Popup -->
<div class="modal fade" id="associate-list">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Individual Assessors</h4>
        
      </div>

      <!-- Modal body -->  
      <div class="modal-body">
      
      <input type="text" name="search-user" id="search-user" placeholder="Seach by name" style="border-width: 1px 1px 1px 1px;"><br><br>
       <input type="hidden" name="associate-ids" id="associate-ids" value=" ">
       <input type="hidden" name="pagenumber" id="pagenumber" value=" ">
      <div class="table-responsive" id="associatetable" style="max-height: 400px;overflow-y: scroll;">
      
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr bgcolor="#EEEEEE">
              <th></th>
              <th style="color: #111213de;" width="50px;">Image</th>
              <th style="color: #111213de;">User Name</th>
              <th style="color: #111213de;">Company</th>
              <th style="color: #111213de;">Email</th>
            </tr>
            </thead>
            
              <tbody id="usertable">
              </tbody>
              
              </table>

            </div>
            <div id="div-button">
           <center>
              <button type="button" data-dismiss="modal" id="add-individuals-users" class="btn red-btn">Add</button>&nbsp &nbsp 
                &nbsp &nbsp
                <button type="button" data-dismiss="modal" id="cancel-user" class="btn red-btn">Cancel</button>  
            </center>
            </div>
            <div id="no_any_user">
              <p style= "margin-left: 250px;">There are no any associate available</p>
            </div>
       <!--  <div class="project-level">
         
          <input type="hidden" name="status_pagenumber" id="status_pagenumber">
          <div style="overflow-y: scroll;max-height: 350px; background: white;" id="project-status-list">
            <ul id="statuslist">
             </ul>
          </div>                                                                                       
            </div>    --> 
          </div>
       </div>
  </div>
</div>