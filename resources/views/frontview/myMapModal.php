 
<div class="modal fade" id="myMapModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="pac-card" id="pac-card">
            
              <div id="title">
                Set Address <button type="button" class="close" data-dismiss="modal" id="close_mapbtn">&times;</button>
              </div>
            
         
            <div class = "form-group field-customers-company">
             
              <input id="pac-input" type="text" name="pac-input" placeholder="Enter a location"   style="float: left;width: 400px;margin-top: 5px;"> 
              <button type="button" style="float: left; margin-left: 20px;margin-top: 10px;" data-dismiss="modal" id="close_map">OK</button>
            </div>
          </div>
          
          <div id="map"></div>
          
          <div id="infowindow-content">
            <img src="" width="16" height="16" id="place-icon">
            <span id="place-name"  class="title"></span><br>
            <span id="place-address"></span>
          </div>
        </div>
       
      </div>
    </div>
  </div>
 