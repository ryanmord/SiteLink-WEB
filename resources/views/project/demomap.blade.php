 
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="pac-card" id="pac-card">
          <div>
            <div id="title">
              Set Site Address
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          </div>
          <div>
          <br>
          <input id="pac-input" type="text" name="pac-input" 
            placeholder="Enter a location" size="50" style="float: left;"> 
          <button type="button" style="float: left; margin-left: 50px;" data-dismiss="modal">OK</button>
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
 