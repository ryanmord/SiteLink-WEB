<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: left;margin-left: 50px;">Assign the category to associate
        </h4>
        <br>
      </div>
      <div class="modal-body">
        <form role="form" class="form-horizontal" id="associateapprove" method="Post" action="{{url('dashboard/user/'.$user['users_id'].'/1')}}">
          {{ csrf_field() }}
          @foreach($associatetype as $associate_type)
            <div class="form-group">
              <div class="col-md-4">
                <div class="radio" style="text-align: left;">
                  <label><input type="radio" value="{{ $associate_type->associate_type_id }}" name="optradio" checked>
                    &nbsp {{ $associate_type->associate_type }}</label>
                </div>
              </div>
          </div>
          @endforeach
          <div class="form-group">
          <input type="hidden" name="userid" id="userid">
            <div>
              <button class="btn btn-success" style="width: 80px; float: left; 
              margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" type="submit" id="approve">Approve</button>
              <button type="button" style="width: 80px; float: left; margin-bottom: 10px;" class="btn btn-danger" data-dismiss="modal">Close</button>  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>