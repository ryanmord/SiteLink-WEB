@extends('layouts.main_layout')

@section('main-content')
 <div class="col-xs-12 col-sm-9 content">
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
                      <form role="form" class="form-horizontal" id="setting">
                       {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-md-2 control-label">Minimum Miles</label>
                          <div class="col-md-5">
                            <input type="text" required="" placeholder="Enter Minimum Miles" id="minmiles" class="form-control" name="minmiles">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Maximum Miles</label>
                          <div class="col-md-5">
                            <input type="text" required="" placeholder="Enter Maximum Miles" id="maxmiles" class="form-control" name="maxmiles">
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
<script type="text/javascript">
    $(document).ready(function() {
      $('#setting').submit(function(event){
        $.ajax({
            type: 'POST',
              url: '/project_management/public/index.php/changeSettings',
              data: $('form#setting').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          alert(msg);
        });

          event.preventDefault();
      });
    });
</script>
@endsection
