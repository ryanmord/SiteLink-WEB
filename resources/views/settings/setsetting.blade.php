@extends('layouts.main_layout')

@section('main-content')
 <div class="col-xs-12 col-sm-9 content">
 <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ secure_asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
 <center>
    <div class="panel panel-success" style="text-align: left;">
      <div class="panel-heading">
        <div class="panel-title"><b>Set project miles range</b>
        </div>
        <div class="panel-options">
          <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
          <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
          <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <form role="form" class="form-horizontal" id="setting" action="{{ url('/changeSettings') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-md-2 control-label">Minimum Miles</label>
            <div class="col-md-5">
              <input type="text" required="" placeholder="Enter Minimum Miles" id="minmiles" class="form-control" name="minmiles" maxlength="6">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Maximum Miles</label>
            <div class="col-md-5">
              <input type="text" required="" placeholder="Enter Maximum Miles" id="maxmiles" class="form-control" name="maxmiles" maxlength="10">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-3 col-md-3">
              <button class="btn btn-success" id="changesetting" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </center>
</div>
@stop
@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
  
</script>
  <script>
  document.getElementById("setting").onkeypress = function(e) {
  var key = e.charCode || e.keyCode || 0;     
  if (key == 13) {
    e.preventDefault();
    return false;
  }
}
    $(document).ready(function () {
      $(".loader").fadeOut("slow");
      $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
    $('body').on('click','#changesetting', function (event) {
    event.preventDefault(); 
   /*var date = new Date();
   var todaydate= (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();
*/
    $('#setting').validate({
     // initialize the plugin

        rules: {
            minmiles: {
                required: true,
                number: true,
                min:1
            },
            maxmiles: {
                required: true,
                number: true,
                min:1
                
            },
            
        }
       
    });
    if($("#setting").valid()) {
        $(".loader").fadeIn("slow");
        $.ajax({
            type: 'POST',
              url: $("#setting").attr("action"),
              data: $('form#setting').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          alert(msg);
          document.getElementById("minmiles").value = '';
          document.getElementById("maxmiles").value = '';
          
        });

        }

    });
  });
  </script>
@endsection
