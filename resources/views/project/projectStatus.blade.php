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
            <p style= "text-align: center;"> There are no any notes available</p>
          </div>
          <input type="hidden" name="status_pagenumber" id="status_pagenumber">
          <div style="overflow-y: scroll;max-height: 350px; background: white;" id="project-status-list">
            <ul id="statuslist">
             </ul>
          </div>  
                                                                                   
       
          </div>  
        </div>
      </div>
  </div>
</div>