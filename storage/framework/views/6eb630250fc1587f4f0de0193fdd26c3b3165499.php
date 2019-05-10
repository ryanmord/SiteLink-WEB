<?php $__env->startSection('main-content'); ?>
<div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('<?php echo e(asset('img/Loader.gif')); ?>') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-success">
        <?php if($message = session('message')): ?>
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong><?php echo e($message); ?></strong>
            </div>
        <?php endif; ?>
        <div class="panel-heading" style="height: 50px;">
            <h3 class="panel-title">
                <?php echo e(config('app.name')); ?> Projects 
                <?php if(session('loginusertype') == 'admin'): ?>
                    <a href="<?php echo e(url('/createProject')); ?>"><button type="button" class="btn btn-danger" style="float: right;text-align: center;">Create Project</button></a>
                <?php endif; ?>
            </h3>
        </div> 
        <div class="content-row">
            <div class="row">
                <div>
                    <ul id="myTab1" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#nonallocatedproject" data-toggle="tab">Scheduling <span class="badge" style="background-color:#DB5A6B;" id="open-count"></span></a></li>
                        <li><a href="#allocatedprojects" data-toggle="tab">In Progress <span class="badge" style="background-color:#DB5A6B;" id="allocated-count">
                        </span></a></li>
                      
                        <li><a href="#completedproject" data-toggle="tab">Complete <span class="badge" style="background-color:#DB5A6B;" id="complete-count"></span></a></li>
                        <li><a href="#cancelledproject" data-toggle="tab">Cancelled 
                            <span class="badge" style="background-color:#DB5A6B;" id="cancel-count"></span></a></li>
                        <li><a href="#onholdproject" data-toggle="tab">On Hold <span class="badge" style="background-color:#DB5A6B;" id="onhold-count"></span></a></li>
                      
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade" id="allocatedprojects">
                            <div id="div-no-allocated">
                                <center><p style="font-size: 20px;">No data found</p></center><br>
                              </div>
                            <div class="table-responsive" id="allocated-div-data">
                                
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr bgcolor="#EEEEEE">
                                                <th class="table-td-th" width="100" data-id="1" id="allocated-identifier-th" onclick="sortallocatedTable(0,'allocated-identifier-th','allocated-identifier-th-asc','allocated-identifier-th-desc')" style="cursor: pointer; text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="allocated-identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-identifier-th-asc"></i></th>

                                                <th class="table-td-th" width="120" data-id="1" id="allocated-name-th" onclick="sortallocatedTable(1,'allocated-name-th','allocated-name-th-asc','allocated-name-th-desc')" style="cursor: pointer;">Name <i class='fa fa-arrow-down fa-icon-sort' id="allocated-name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-name-th-asc"></i></th>

                                                <th class="table-td-th" data-id="1" id="allocated-address-th" onclick="sortallocatedTable(2,'allocated-address-th','allocated-address-th-asc','allocated-address-th-desc')" style="cursor: pointer;">Site Address <i class='fa fa-arrow-down fa-icon-sort' id="allocated-address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-address-th-asc"></i></th>

                                                <th  width="100" class="table-td-th" data-id="1" id="allocated-bid-th" onclick="sortallocatedTable(3,'allocated-bid-th','allocated-bid-th-asc','allocated-bid-th-desc')" style="cursor: pointer;">Final Bid <i class='fa fa-arrow-down fa-icon-sort' id="allocated-bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-bid-th-asc"></i></th>

                                                <th class="table-td-th" width="100">Scope</th>

                                                <?php if(session('loginusertype') == 'admin'): ?>
                                                 <th class="table-td-th" width="140" data-id="1" id="allocated-pmname-th" onclick="sortallocatedTable(4,'allocated-pmname-th','allocated-pmname-th-asc','allocated-pmname-th-desc')" style="cursor: pointer;">Project Manager <i class='fa fa-arrow-down fa-icon-sort' id="allocated-pmname-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-pmname-th-asc"></i></th>
                                                <?php endif; ?>

                                                <th class="table-td-th">Assigned To</th>

                                                <th class="table-td-th" width="100" data-id="1" id="allocated-created-th" onclick="sortallocatedTable(5,'allocated-created-th','allocated-created-th-asc','allocated-created-th-desc')" style="cursor: pointer;">Created <i class='fa fa-arrow-down fa-icon-sort' id="allocated-created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="allocated-created-th-asc"></i></th>
                                               
                                                <th class="table-td-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="allocated-data">
                                           
                                        </tbody>
                                    </table>
                                    <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="allocated-pagination">
                                            <!--  <li><a href="#">PREV</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li class="disabled"><a href="#">NEXT</a></li> -->
                                        </ul>
                                    </div>
                                    </div>
                                   
                                </div>
                                <?php if(session('loginusertype') != 'admin'): ?>
                                    <?php echo $__env->make('project.rating', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="tab-pane fade" id="completedproject">
                                <div id="div-no-complete">
                                <center><p style="font-size: 20px;">No data found</p></center><br>
                              </div>
                                <div class="table-responsive" id="complete-div-project">
                                 <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th" width="100" data-id="1" id="complete-identifier-th" onclick="completesortTable(0,'complete-identifier-th','complete-identifier-th-asc','complete-identifier-th-desc')" style="cursor: pointer;text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="complete-identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-identifier-th-asc"></i></th>

                                        <th class="table-td-th" width="120" data-id="1" id="complete-name-th" onclick="completesortTable(1,'complete-name-th','complete-name-th-asc','complete-name-th-desc')" style="cursor: pointer;">Name <i class='fa fa-arrow-down fa-icon-sort' id="complete-name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-name-th-asc"></i></th>

                                        <th class="table-td-th" data-id="1" id="complete-address-th" onclick="completesortTable(2,'complete-address-th','complete-address-th-asc','complete-address-th-desc')" style="cursor: pointer;">Site Address <i class='fa fa-arrow-down fa-icon-sort' id="complete-address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-address-th-asc"></i></th>
            
                                        <th class="table-td-th" width="100" data-id="1" id="complete-bid-th" onclick="completesortTable(3,'complete-bid-th','complete-bid-th-asc','complete-bid-th-desc')" style="cursor: pointer;">Final Bid <i class='fa fa-arrow-down fa-icon-sort' id="complete-bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-bid-th-asc"></i>
                                        </th>

                                        <th class="table-td-th">Scope</th>

                                        <?php if(session('loginusertype') == 'admin'): ?>
                                        <th class="table-td-th" width="90" data-id="1" id="complete-pm-th" onclick="completesortTable(4,'complete-pm-th','complete-pm-th-asc','complete-pm-th-desc')" style="cursor: pointer;text-align: left;">Project Manager <i class='fa fa-arrow-down fa-icon-sort' id="complete-pm-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-pm-th-asc"></i></th>
                                        <?php endif; ?>

                                        <th class="table-td-th">Assigned To</th>

                                        <th class="table-td-th" width="100" data-id="1" id="complete-created-th" onclick="completesortTable(5,'complete-created-th','complete-created-th-asc','complete-created-th-desc')" style="cursor: pointer;">Created 
                                        <i class='fa fa-arrow-down fa-icon-sort' id="complete-created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-created-th-asc"></i></th>

                                        <th class="table-td-th" width="110" data-id="1" id="complete-completed-th" onclick="completesortTable(6,'complete-completed-th','complete-completed-th-asc','complete-completed-th-desc')" style="cursor: pointer;">Completed <i class='fa fa-arrow-down fa-icon-sort' id="complete-completed-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="complete-completed-th-asc"></i></th>
            
                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="complete-data">
                                   
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="complete-pagination">
                                           
                                        </ul>
                                    </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cancelledproject">
                        <div id="div-no-cancel">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="cancel-div-data">
                            
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#EEEEEE">
                                            <th sclass="table-td-th" width="100" data-id="1" id="cancel-identifier-th" onclick="cancelsortTable(0,'cancel-identifier-th','cancel-identifier-th-asc','cancel-identifier-th-desc')" style="cursor: pointer;text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="cancel-identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-identifier-th-asc"></i></th>
                                            <th class="table-td-th" width="140" data-id="1" id="cancel-name-th" onclick="cancelsortTable(1,'cancel-name-th','cancel-name-th-asc','cancel-name-th-desc')" style="cursor: pointer;">Name <i class='fa fa-arrow-down fa-icon-sort' id="cancel-name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-name-th-asc"></i></th>
                                            <th class="table-td-th" data-id="1" id="cancel-address-th" onclick="cancelsortTable(2,'cancel-address-th','cancel-address-th-asc','cancel-address-th-desc')" style="cursor: pointer;">Site Address <i class='fa fa-arrow-down fa-icon-sort' id="cancel-address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-address-th-asc"></i></th>
          
                                            <th class="table-td-th" width="100" data-id="1" id="cancel-bid-th" onclick="cancelsortTable(3,'cancel-bid-th','cancel-bid-th-asc','cancel-bid-th-desc')" style="cursor: pointer;">Final Bid <i class='fa fa-arrow-down fa-icon-sort' id="cancel-bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-bid-th-asc"></i></th>
                                            <th class="table-td-th">Scope</th>
                                            <?php if(session('loginusertype') == 'admin'): ?>
                                            <th class="table-td-th" width="90" data-id="1" id="cancel-pmname-th" onclick="cancelsortTable(4,'cancel-pmname-th','cancel-pm-th-asc','cancel-pm-th-desc')" style="cursor: pointer;text-align: left;">Project Manager <i class='fa fa-arrow-down fa-icon-sort' id="cancel-pm-th-desc"></i>
                                            <i class='fa fa-arrow-up fa-icon-sort' id="cancel-pm-th-asc"></i></th>
                                            <?php endif; ?>
                                            <th class="table-td-th">Assigned To</th>
            
                                            <th class="table-td-th" width="100" data-id="1" id="cancel-created-th" onclick="cancelsortTable(5,'cancel-created-th','cancel-created-th-asc','cancel-created-th-desc')" style="cursor: pointer;">Created <i class='fa fa-arrow-down fa-icon-sort' id="cancel-created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-created-th-asc"></i></th>
            
                                            <th class="table-td-th" width="110" data-id="1" id="cancel-canceldate-th" onclick="cancelsortTable(6,'cancel-canceldate-th','cancel-canceldate-th-asc','cancel-canceldate-th-desc')" style="cursor: pointer;">Cancelled <i class='fa fa-arrow-down fa-icon-sort' id="cancel-canceldate-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="cancel-canceldate-th-asc"></i></th>
                                            <th class="table-td-th">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cancel-data">
                                        
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                                    <br>
                                    <div class="col-md-12">
                                        <ul class="pagination" id="cancel-pagination">
                                           
                                        </ul>
                                    </div>
                             </div>
                      
                        </div>
                    </div>
                    <div class="tab-pane fade" id="onholdproject">
                        <div id="div-no-onhold">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="onhold-div-data">
                      
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                        <th class="table-td-th" width="100" data-id="1" id="onhold-identifier-th" onclick="onholdsortTable(0,'onhold-identifier-th','onhold-identifier-th-asc','onhold-identifier-th-desc')" style="cursor: pointer;text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="onhold-identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-identifier-th-asc"></i></th>

                                        <th class="table-td-th" width="140" data-id="1" id="onhold-name-th" onclick="onholdsortTable(1,'onhold-name-th','onhold-name-th-asc','onhold-name-th-desc')" style="cursor: pointer;">Name <i class='fa fa-arrow-down fa-icon-sort' id="onhold-name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-name-th-asc"></i></th>

                                        <th class="table-td-th" data-id="1" id="onhold-address-th" onclick="onholdsortTable(2,'onhold-address-th','onhold-address-th-asc','onhold-address-th-desc')" style="cursor: pointer;">Site Address <i class='fa fa-arrow-down fa-icon-sort' id="onhold-address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-address-th-asc"></i></th>

                                        <th class="table-td-th" width="100" data-id="1" id="onhold-bid-th" onclick="onholdsortTable(3,'onhold-bid-th','onhold-bid-th-asc','onhold-bid-th-desc')" style="cursor: pointer;">Final Bid <i class='fa fa-arrow-down fa-icon-sort' id="onhold-bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-bid-th-asc"></i></th>

                                        <th class="table-td-th">Scope</th>

                                        <?php if(session('loginusertype') == 'admin'): ?>
                                        <th class="table-td-th" width="90" data-id="1" id="onhold-pmname-th" onclick="onholdsortTable(4,'onhold-pmname-th','onhold-pmname-th-asc','onhold-pmname-th-desc')" style="cursor: pointer;text-align: left;">Project Manager <i class='fa fa-arrow-down fa-icon-sort' id="onhold-pmname-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-pmname-th-asc"></i></th>
                                        <?php endif; ?>
                                        <th class="table-td-th">Assigned To</th>
            
                                        <th class="table-td-th" width="100" data-id="1" id="onhold-created-th" onclick="onholdsortTable(5,'onhold-created-th','onhold-created-th-asc','onhold-created-th-desc')" style="cursor: pointer;">Created <i class='fa fa-arrow-down fa-icon-sort' id="onhold-created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="onhold-created-th-asc"></i>
                                        </th>

                                        <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="onhold-data">
                                    
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="onhold-pagination">
                                
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="nonallocatedproject">
                        <div id="div-no-open">
                            <center><p style="font-size: 20px;">No data found</p></center><br>
                        </div>
                        <div class="table-responsive" id="open-div-project">
                           
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#EEEEEE">
                                    <th class="table-td-th" width="100" data-id="1" id="open-identifier-th" onclick="opensortTable(0,'open-identifier-th','open-identifier-th-asc','open-identifier-th-desc')" style="cursor: pointer;text-align: left;">Project Identifier <i class='fa fa-arrow-down fa-icon-sort-desc' id="open-identifier-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-identifier-th-asc"></i></th>
                                    <th class="table-td-th" width="140" data-id="1" id="open-name-th" onclick="opensortTable(1,'open-name-th','open-name-th-asc','open-name-th-desc')" style="cursor: pointer;">Name  <i class='fa fa-arrow-down fa-icon-sort' id="open-name-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-name-th-asc"></i></th>
                                    <th class="table-td-th">Total Bids</th>
                                    <th class="table-td-th" data-id="1" id="open-address-th" onclick="opensortTable(2,'open-address-th','open-address-th-asc','open-address-th-desc')" style="cursor: pointer;">Site Address <i class='fa fa-arrow-down fa-icon-sort' id="open-address-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-address-th-asc"></i></th>
                                    <th class="table-td-th" width="100" id="open-bid-th" onclick="opensortTable(3,'open-bid-th','open-bid-th-asc','open-bid-th-desc')" style="cursor: pointer;">Suggested Bid <i class='fa fa-arrow-down fa-icon-sort' id="open-bid-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-bid-th-asc"></i></th>
                                    <th class="table-td-th">Scope</th>
                                    <?php if(session('loginusertype') == 'admin'): ?>
                                    <th class="table-td-th" width="90" id="open-manager-th" onclick="opensortTable(4,'open-manager-th','open-manager-th-asc','open-manager-th-desc')" style="cursor: pointer;text-align: left;">Project Manager <i class='fa fa-arrow-down fa-icon-sort' id="open-manager-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-manager-th-asc"></i></th>
                                    <?php endif; ?>
                                    <th class="table-td-th" width="100" id="open-created-th" onclick="opensortTable(5,'open-created-th','open-created-th-asc','open-created-th-desc')" style="cursor: pointer;"> Created <i class='fa fa-arrow-down fa-icon-sort' id="open-created-th-desc"></i><i class='fa fa-arrow-up fa-icon-sort' id="open-created-th-asc"></i></th>
                                    <th class="table-td-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="open-data">
                                </tbody>
                            </table>
                            <div class="row content-row-pagination">
                            <br>
                                <div class="col-md-12">
                                <ul class="pagination" id="open-pagination">
                                
                                </ul>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?> 

<script type="text/javascript">

$(window).load(function() {

    $('#div-no-open').hide();
    $.ajax({
                type: 'GET',
                url: '<?php echo route('openProjectList'); ?>',
                data: {order_key:6,sortorder:2},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-open').hide();
                    $('#open-div-project').show();
                    $('#open-data').html('');
                    $('#open-data').html(msg.appendtd);
                    $('#open-count').text(msg.count);
                    setopenprojectpagination();
                    $(".loader").fadeOut("slow");
                }
                else
                {
                    $('#open-count').text(msg.count);
                    $('#open-div-project').hide();
                    $('#div-no-open').show();
                    $(".loader").fadeOut("slow");
                }
           });
    $.ajax({
            type: 'GET',
            url: '<?php echo route('inProgressList'); ?>',
            data: {order_key:5,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-allocated').hide();
                $('#allocated-div-data').show();
                $('#allocated-data').html('');
                $('#allocated-data').html(msg.appendtd);
                $('#allocated-count').text(msg.count);
                setallocatedpagination();
            }
            else
            {
                $('#allocated-count').text(msg.count);
                $('#allocated-div-data').hide();
                $('#div-no-allocated').show();
            }
        });
    $.ajax({
                type: 'GET',
                url: '<?php echo route('completeProjectList'); ?>',
                data: {order_key:6,sortorder:2},
                dataType: 'json',
            })
            .done(function(msg) {
                if(msg.count > 0)
                {
                    $('#div-no-complete').hide();
                    $('#complete-div-project').show();
                    $('#complete-data').html('');
                    $('#complete-data').html(msg.appendtd);
                    $('#complete-count').text(msg.count);
                    setcompletedpagination();
                }
                else
                {
                    $('#complete-count').text(msg.count);
                    $('#complete-div-project').hide();
                    $('#div-no-complete').show();
                }
           });
        $.ajax({
            type: 'GET',
            url: '<?php echo route('cancelProjectList'); ?>',
            data: {order_key:6,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-cancel').hide();
                $('#cancel-div-data').show();
                $('#cancel-data').html('');
                $('#cancel-data').html(msg.appendtd);
                $('#cancel-count').text(msg.count);
                setcancelpagination();
            }
            else
            {
                $('#cancel-count').text(msg.count);
                $('#cancel-div-data').hide();
                $('#div-no-cancel').show();
            }
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo route('onHoldProjectList'); ?>',
            data: {order_key:6,sortorder:2},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.count > 0)
            {
                $('#div-no-onhold').hide();
                $('#onhold-div-data').show();
                $('#onhold-data').html('');
                $('#onhold-data').html(msg.appendtd);
                $('#onhold-count').text(msg.count);
                setonholdpagination();
            }
            else
            {
                $('#onhold-count').text(msg.count);
                $('#onhold-div-data').hide();
                $('#div-no-onhold').show();
            }
        });
});
/*$('body').on('click','#complete-menu', function (event) {
    $('#star-rating').starRating('setRating', 0.0);
    $('#ratingNumber').html('0.0');
    document.getElementById("projectreview").value = '';
    var projectid = $(this).attr("data-id");
   
   $("#reviewerror").text('');
    document.getElementById('review-project-id').value = projectid;
    $.ajax({
            type: 'GET',
              url: '<?php //echo route('projectAssociate'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            $("#associate-name").text(msg.associatename);
            $("#associate-email").text(msg.associateemail);
            $("#associate-company").text(msg.associatecompany);
            $("#associate-phone").text(msg.associatephone);
            $('#associate-profile').attr('src',msg.associateimage );
          });

});*/
// fill rating star on mouse hover 

/*$("#star-rating").click(function() {
    var rating = $('#star-rating').starRating('getRating');
    var rating = rating.toFixed(1);
    $('#ratingNumber').html(rating);
});

//store user reviews 
$('#submit-review').click(function(){
    $(".loader").fadeIn("slow");
        var projectid = document.getElementById("review-project-id").value;
       
        var rating = $('#ratingNumber').html();
        var comment  = document.getElementById("projectreview").value;
        if(comment == '')
        {
            $(".loader").fadeOut("slow");
            $("#reviewerror").text('Please give comment');
            $("#projectreview").focus();
            return false;
        }
        $.ajax({
            type: 'GET',
              url: '<?php //echo route('projectComplete'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })
        .done(function(msg) {
            
          });
        $.ajax({
            type: 'GET',
            url: '<?php //echo route('managerReviewStore'); ?>',
            data: {projectid:projectid,rating:rating,comment:comment},
            dataType: 'json',
        })
        .done(function(msg) {
            $(".loader").fadeOut("slow");
            if(msg.status == 1)
            {
                alert(msg.message);
                location.reload();
            }
    });
});*/
</script>
<script type="text/javascript">
$(function() {

 $(".svg-star-rating").starRating({
    totalStars: 5,
    starShape: 'rounded',
    starSize: 20,
    emptyColor: '#D8D8D8',
    hoverColor: '#efce4a',
    activeColor: '#efce4a',
    ratedColor:'#efce4a',
    useGradient: false,
    disableAfterRate:false
  });



});
</script>

<script type="text/javascript">
//pagination for allocated projects
    function setallocatedpagination(){
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#allocated-count').text();
    var limitPerPage = 15;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#allocated-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#allocated-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#next-page");
        });
        // Disable prev/next when at first/last page:
        $("#previous-page").toggleClass("disabled", currentPage === 1);
        $("#next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#allocated-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#allocated-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#allocated-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
} 
</script>
<script type="text/javascript">
//pagination for completed projects
function setcompletedpagination(){
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#complete-count').text();
    var limitPerPage = 15;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#complete-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#complete-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#complete-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#complete-previous-page").toggleClass("disabled", currentPage === 1);
        $("#complete-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#complete-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "complete-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "complete-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#complete-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#complete-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#complete-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#complete-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
}
</script>
<script type="text/javascript">
//pagination for open projects
    function setopenprojectpagination(){
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#open-count').text();
    var limitPerPage = 15;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#open-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#open-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#open-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#open-previous-page").toggleClass("disabled", currentPage === 1);
        $("#open-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#open-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "open-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "open-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#open-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#open-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#open-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#open-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
} 
</script>
<script type="text/javascript">
//pagination for onhold projects
function setonholdpagination(){
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#onhold-count').text();
    var limitPerPage = 15;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#onhold-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#onhold-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#onhold-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#onhold-previous-page").toggleClass("disabled", currentPage === 1);
        $("#onhold-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#onhold-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "onhold-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "onhold-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#onhold-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#onhold-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#onhold-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#onhold-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
});  
}
</script>
<script type="text/javascript">
//pagination for cancel projects
function setcancelpagination(){
   function getPageList(totalPages, page, maxLength) {
    if (maxLength < 5) throw "maxLength must be at least 5";

    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start); 
    }

    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
    if (totalPages <= maxLength) {
        // no breaks in list
        return range(1, totalPages);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        // no break on left of page
        return range(1, maxLength-sideWidth-1)
            .concat([0])
            .concat(range(totalPages-sideWidth+1, totalPages));
    }
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
        // no break on right of page
        return range(1, sideWidth)
            .concat([0])
            .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    // Breaks on both sides
    return range(1, sideWidth)
        .concat([0])
        .concat(range(page - leftWidth, page + rightWidth)) 
        .concat([0])
        .concat(range(totalPages-sideWidth+1, totalPages));
}

$(function () {
    // Number of items and limits the number of items per page
    var projectcount = $('#cancel-count').text();
    var limitPerPage = 15;
    var totalPages = (Math.ceil(projectcount / limitPerPage));
    var paginationSize = 7; 
    var currentPage;
    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPages) return false;
        currentPage = whichPage;
        $("#cancel-data .content").hide()
            .slice((currentPage-1) * limitPerPage, 
                    currentPage * limitPerPage).show();
        // Replace the navigation items (not prev/next):            
        $("#cancel-pagination li").slice(1, -1).remove();
        getPageList(totalPages, currentPage, paginationSize).forEach( item => {
            $("<li>").addClass("page-item")
                     .addClass(item ? "current-page" : "disabled")
                     .toggleClass("active", item === currentPage).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text(item || "...")
            ).insertBefore("#cancel-next-page");
        });
        // Disable prev/next when at first/last page:
        $("#cancel-previous-page").toggleClass("disabled", currentPage === 1);
        $("#cancel-next-page").toggleClass("disabled", currentPage === totalPages);
        return true;
    }

    // Include the prev/next buttons:
    $("#cancel-pagination").append(
        $("<li>").addClass("page-item").attr({ id: "cancel-previous-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Prev")
        ),
        $("<li>").addClass("page-item").attr({ id: "cancel-next-page" }).append(
            $("<a>").addClass("page-link").attr({
                href: "javascript:void(0)"}).text("Next")
        )
    );
    // Show the page links
    $("#cancel-data").show();
    showPage(1);

    // Use event delegation, as these items are recreated later    
    $(document).on("click", "#cancel-pagination li.current-page:not(.active)", function () {
        return showPage(+$(this).text());
    });
    $("#cancel-next-page").on("click", function () {
        return showPage(currentPage+1);
    });

    $("#cancel-previous-page").on("click", function () {
        return showPage(currentPage-1);
    });
}); 
} 
</script>
<script type="text/javascript">
//sorting for open projects
    function opensortTable(n,id,arrowup,arrowdown)
    {
       var sortorder = $('#'+id).attr("data-id"); 
       $(".loader").fadeIn("slow");
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('openProjectList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#open-data').html('');
                    $('#open-data').html(msg.appendtd);
                    $('#open-count').text(msg.count);
                    setopenprojectpagination();
                 }
                 $(".loader").fadeOut("slow");
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc'); 
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
//sorting for completed projects
    function completesortTable(n,id,arrowup,arrowdown)
    {
       var sortorder = $('#'+id).attr("data-id"); 
       $(".loader").fadeIn("slow");
        $.ajax({
                  type: 'GET',
                  url: '<?php echo route('completeProjectList'); ?>',
                  data: {order_key:n,sortorder:sortorder},
                  dataType: 'json',
              })
              .done(function(msg) {
                 if(msg.appendtd != '')
                 {
                    $('#complete-data').html('');
                    $('#complete-data').html(msg.appendtd);
                    $('#complete-count').text(msg.count);
                    setcompletedpagination();
                 }
                 $(".loader").fadeOut("slow");
           });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc');
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
    //sorting for cancelled projects
    function cancelsortTable(n,id,arrowup,arrowdown)
    {
       var sortorder = $('#'+id).attr("data-id");
       $(".loader").fadeIn("slow"); 
        $.ajax({
            type: 'GET',
            url: '<?php echo route('cancelProjectList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#cancel-data').html('');
                $('#cancel-data').html(msg.appendtd);
                $('#cancel-count').text(msg.count);
                setcancelpagination();
            }
            $(".loader").fadeOut("slow");
        });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc');
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
    //sorting for onhold projects
    function onholdsortTable(n,id,arrowup,arrowdown)
    {
       var sortorder = $('#'+id).attr("data-id"); 
       $(".loader").fadeIn("slow");
        $.ajax({
            type: 'GET',
            url: '<?php echo route('onHoldProjectList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#onhold-data').html('');
                $('#onhold-data').html(msg.appendtd);
                $('#onhold-count').text(msg.count);
                setonholdpagination();
            }
            $(".loader").fadeOut("slow");
        });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc'); 
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
     //sorting for Inprogress projects
    function sortallocatedTable(n,id,arrowup,arrowdown)
    {
       var sortorder = $('#'+id).attr("data-id"); 
       $(".loader").fadeIn("slow");
        $.ajax({
            type: 'GET',
            url: '<?php echo route('inProgressList'); ?>',
            data: {order_key:n,sortorder:sortorder},
            dataType: 'json',
        })
        .done(function(msg) {
            if(msg.appendtd != '')
            {
                $('#allocated-data').html('');
                $('#allocated-data').html(msg.appendtd);
                $('#allocated-count').text(msg.count);
                setonholdpagination();
            }
            $(".loader").fadeOut("slow");
        });
        if(sortorder == 1)
        {
            $('#'+id).attr('data-id' , '2'); 
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('#'+arrowup).removeClass('fa-icon-sort');
            $('#'+arrowup).addClass('fa-icon-sort-desc');
        }
        else
        {
            $('#'+id).attr('data-id' , '1');
            $('.fa-arrow-up').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-up').addClass('fa-icon-sort');
            $('.fa-arrow-down').removeClass('fa-icon-sort-desc');
            $('.fa-arrow-down').addClass('fa-icon-sort');
            $('#'+arrowdown).removeClass('fa-icon-sort');
            $('#'+arrowdown).addClass('fa-icon-sort-desc'); 
        }
    }
    function projectInProgress(id)
    {
        if(confirm('Are you want to sure in progress this project?'))
        {
            $(".loader").fadeIn("slow");
            $.ajax({
                type: 'GET',
                url: '<?php echo route('projectInProgress'); ?>',
                data: {projectid:id},
                dataType: 'json',
            })
            .done(function(msg) {
                
                location.reload();
                $(".loader").fadeOut("slow");
           });
           
        }
        else
        {
            return false;
        }
    }
    function projectonHold(id)
    {
        if(confirm('Are you want to sure on hold this project?'))
        {
            $(".loader").fadeIn("slow");
            $.ajax({
                type: 'GET',
                url: '<?php echo route('projectOnHold'); ?>',
                data: {projectid:id},
                dataType: 'json',
            })
            .done(function(msg) {
                location.reload();
                $(".loader").fadeOut("slow");
           });
            
        }
        else
        {
            return false;
        }
    }
    function projectComplete(id)
    {
        if(confirm('Are you want to sure complete this project?'))
        {
            $(".loader").fadeIn("slow");
            $.ajax({
                type: 'GET',
                url: '<?php echo route('projectComplete'); ?>',
                data: {projectid:id},
                dataType: 'json',
            })
            .done(function(msg) {
                
                location.reload();
                $(".loader").fadeOut("slow");
           });
            
        }
        else
        {
            return false;
        }
    }
    function projectCancel(id)
    {
        if(confirm('Are you want to sure cancel this project?'))
        {
            $(".loader").fadeIn("slow");
            $.ajax({
                type: 'GET',
                url: '<?php echo route('projectCancel'); ?>',
                data: {projectid:id},
                dataType: 'json',
            })
            .done(function(msg) {
                
                location.reload();
                $(".loader").fadeOut("slow");
           });
           
        }
        else
        {
            return false;
        }
    }
        
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>