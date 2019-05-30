  <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet">
  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    @include('layouts.include_css')
  <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
 
  <!-- <link href="{{asset('/css/jquery.multiselect.css')}}" rel="stylesheet"/> -->
  <script>

  $(function() {

    $( "#onsitedate" ).datepicker({
         minDate: 0 
    });
    
  });
  </script>
 <script>
  $(function() {
    $( "#reportdate" ).datepicker(
      {
          minDate: 0 
      });
  });
  </script>