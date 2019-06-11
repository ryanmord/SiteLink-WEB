
        $('.owl-carousel').owlCarousel({
            margin:10,
            nav:true,
           navigation:true,
            items :1,
          itemsDesktop : [1199,1],
          itemsDesktopSmall : [979,1],
          itemsTablet : [768,1],
          itemsMobile: [479,1],

           navigationText: [
             "<i class='fa fa-chevron-left'></i>",
             "<i class='fa fa-chevron-right'></i>"
            ]

        })
   
    $(document).ready(function(){
    $('#managerprofile').click(function(){
      var projectid = document.getElementById("project_id").value;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('viewManagerProfile'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
           $("#managername").text(msg.managername);
           $("#manageremail").text(msg.manageremail);
           $("#managercompany").text(msg.managercompany);
           $("#managerphone").text(msg.managerphone);
           $('#managerimage').attr('src',msg.managerimage );
        });
    });
  });
 
    $(document).ready(function(){
    $('#addstatus').click(function(){
      var projectid = document.getElementById("project_id").value;
      $("#statuslist").empty();
      $.ajax({
            type: 'GET',
              url: '<?php echo route('viewStatus'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
            if(msg.status != 0)
            {
              document.getElementById('no_any_status').style.display='none'; 
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
                document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });
    $('body').on('click','#add_status', function (event) {
    event.preventDefault(); 
    var projectid = document.getElementById("project_id").value;
    document.getElementById("project-id").value = projectid;
    $("#status-form").validate({
    rules: {
            statustxt: {
                required: true,
            },subjecttxt: { 
              required: true,
            },messages:{
            subjecttxt: "Please Enter Subject",
            statustxt: "Please Enter Status",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
      }

  });
     if($("#status-form").valid()) {
      
        $.ajax({
            type: 'POST',
              url: $("#status-form").attr("action"),
              data: $('form#status-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
            var status = document.getElementById("statustxt").value;
            var subject = document.getElementById("subjecttxt").value;
            document.getElementById('no_any_status').style.display='none'; 
            var List = $('ul#statuslist');
             var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : status,
                 })
                  .appendTo(li);

          document.getElementById("statustxt").value = '';
          document.getElementById("subjecttxt").value = '';
          
        });

     }

  });
  });
  
      $("#progressProjectList li").click(function() {
        var projectid = $(this).attr('id');
        var onholdflag = $(this).attr("data-id");
        if(onholdflag == 1)
        {
          document.getElementById('add_project_status').style.display='none'; 
        }
        else
        {
          document.getElementById('add_project_status').style.display='block'; 
        }
        document.getElementById("project_id").value = projectid;
        
         $.ajax({
            type: 'GET',
              url: '<?php echo route('projectDetails'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
           $("#projectid").text(msg.projectid);
           $("#projectname").text(msg.projectname);
           $("#createddate").text(msg.createddate);
           $("#siteaddress").text(msg.siteaddress);
           $("#reportduedate").text(msg.reportduedate);
           $("#instructions").text(msg.instructions);
           $("#template").text(msg.template);
           $("#scope").text(msg.scope);
           $("#approxbid").text(msg.approxbid);
           $("#mybid").text(msg.mybid);
           $("#onsitedate").text(msg.onsitedate);
          
        });

      });
     
    
      $("#project-history li").click(function() {
        var projectid = $(this).attr('id');
        document.getElementById("project_history_id").value = projectid;
        $.ajax({
            type: 'GET',
              url: '<?php echo route('projectDetails'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
           $("#history_projectid").text(msg.projectid);
           $("#history_projectname").text(msg.projectname);
           $("#history_createddate").text(msg.createddate);
           $("#history_siteaddress").text(msg.siteaddress);
           $("#history_reportduedate").text(msg.reportduedate);
           $("#history_instructions").text(msg.instructions);
           $("#history_template").text(msg.template);
           $("#history_scope").text(msg.scope);
           $("#history_approxbid").text(msg.approxbid);
           $("#history_mybid").text(msg.mybid);
           $("#history_onsitedate").text(msg.onsitedate);
           $("#history_rating").text(msg.rating);
           var rating = msg.rating;
           if(rating == '0.0')
           {
             
             
            document.getElementById('ratingstar').innerHTML = "";
            $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            $("#ratingstar").append('<i class="fa fa-star-o"></i>');
            
           }
           else
           {
              var pointvalue = rating.toString().split(".")[1];
              document.getElementById('ratingstar').innerHTML = "";
              for(var i = 1; i <= rating; i++) {

                $("#ratingstar").append('<i class="fa fa-star"></i>');
              }
              if(pointvalue != 0)
              {
                $("#ratingstar").append('<i class="fa fa-star-half"></i>');
              }
           }
           
           $("#history_comment").text(msg.comment);
          
        });
      });
    $(document).ready(function(){
    $('#project-History').click(function(){
    var rating = $( "#history_rating" ).text();
    document.getElementById('ratingstar').innerHTML = "";
    if(rating == '0.0')
    {
      
      $("#ratingstar").append('<i class="fa fa-star-o"></i>');
      $("#ratingstar").append('<i class="fa fa-star-o"></i>');
      $("#ratingstar").append('<i class="fa fa-star-o"></i>');
      $("#ratingstar").append('<i class="fa fa-star-o"></i>');
      $("#ratingstar").append('<i class="fa fa-star-o"></i>');
    }
    else
    {
      var pointvalue = rating.toString().split(".")[1];
      document.getElementById('ratingstar').innerHTML = "";
      for(var i = 1; i <= rating; i++) {

        $("#ratingstar").append('<i class="fa fa-star"></i>');
      }
      if(pointvalue != 0)
      {
        $("#ratingstar").append('<i class="fa fa-star-half"></i>');
      }
    }
  });
    $('#project_history_manager').click(function(){
      var projectid = document.getElementById("project_history_id").value;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('viewManagerProfile'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {
           $("#managername").text(msg.managername);
           $("#manageremail").text(msg.manageremail);
           $("#managercompany").text(msg.managercompany);
           $("#managerphone").text(msg.managerphone);
           $('#managerimage').attr('src',msg.managerimage );
        });
    });
    $('#view-status').click(function(){
      var projectid = document.getElementById("project_history_id").value;
      $("#statuslist").empty();
      document.getElementById('add_project_status').style.display='none'; 
     $.ajax({
            type: 'GET',
              url: '<?php echo route('viewStatus'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {

            if(msg.status != 0)
            {
              document.getElementById('no_any_status').style.display='none'; 
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
                document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });
  });
    