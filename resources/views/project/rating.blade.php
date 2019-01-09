<!-- Project Status Popup -->
<div class="modal fade" id="rating-project">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-angle-left"></i></button>
        <center>
        <h4 class="modal-title">Project Complete</h4></center>
      </div>
      <center>
      <span style="font-size: 16px;letter-spacing: 2px; color: #4b5f5f;font-weight: 300;">Rate&Review the Associate</span></center>
      <!-- Modal body -->  
      <div class="modal-body">
        
        <div class="associate-manager-profile">
          <div class="manager-profile">
            <img src="{{asset('img/front/manager.jpg')}}" alt="" title="" id="associate-profile">
          </div> 

            <div class="manager-data row">
              <div class="col-md-12">
               <h4 style="float: center;" id="associate-name">George Sabastain</h4>
              </div>
              <div class="col-md-6">
                <h5>Email</h5>
                <p id="associate-email" style="font-size: 15px;">sabastina@gmail.com</p>
              </div>
              <div class="col-md-6">
                <h5>Phone Number</h5>
                <p id="associate-phone" style="font-size: 15px;">(123)123456</p>
              </div>
              <div class="col-md-12">
               <h5>Company</h5>
                <p id="associate-company" style="font-size: 15px;">ABC</p>
              </div>
            </div>  
        </div>

        <div class="rating-message">
          
          <div class="rating-label"><br>
            <label>Your Rating</label>
            <div class="rating-star" id="ratingStar">
              <i class="fa fa-star-o" data-id = "1.0"></i>
              <i class="fa fa-star-o" data-id = "2.0"></i>
              <i class="fa fa-star-o" data-id = "3.0"></i>
              <i class="fa fa-star-o" data-id = "4.0"></i>
              <i class="fa fa-star-o" data-id = "5.0"></i>
              <i class="fa fa-star-o" data-id = "5.0"></i>
            </div>
            <h5 class="rating-number" id="ratingNumber">0.0</h5>
          </div>

          <textarea name="" placeholder="Enter Review..."></textarea><br><br>
          <div class="rs-btn-bid">
          <center> 
              <button type="button" class="btn red-btn">Submit</button></center>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
