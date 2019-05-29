@extends('layouts.main_layout')

@section('main-content')
<div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{ secure_asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
  <div class="col-xs-12 col-sm-9 content">
    <div class="content-row">
      <div class="row">
        <div class="col-md-3">
          <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color: #19B5FE;text-align: center;">
                <br>
                <font size="5" color="white"><b>{{ $totalproject }}</b></font>
                <br>
              
                <font size="4" color="white"><b><i class="glyphicon glyphicon-home"></i>  Total Projects</b></font>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color:#26A65B;text-align: center;">
                <br>
                <font size="5" color="white"><b>{{ $completeproject }}</b></font>

                <br>
                <font size="4" color="white"><b><i class="fa fa-building-o"></i> Completed Projects</b></font>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color:#DB5A6B;text-align: center;">
                 <br>
                <font size="5" color="white"><b>{{$overdueprojectcount}}</b></font>

                <br>
                <font size="4" color="white"><b><i class="fa fa-building-o"></i>  Overdue Projects</b></font>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <div>
              <div style=" height: 100px;width: 220px;background-color:#F5AB35;text-align: center;">
                <br>
                <font size="5" color="white"><b>{{$inProgressCount}}</b></font>

                <br>
                <font size="4" color="white"><b><span class="glyphicon glyphicon-briefcase"></span> Jobs In Progress</b></font>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('script') 
  <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    });
  </script>
@endsection