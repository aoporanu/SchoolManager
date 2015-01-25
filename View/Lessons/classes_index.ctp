<div class="row">
<?php if ( $user['role'] == 'teacher' ) { ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-title"><?php echo $user['username'] ?>'s profile</h1>
    </div>
</div>
<div class="row profile">
    <div class="col-md-12">
       <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_1_1">Overview</a></li>
                <li><a data-toggle="tab" href="#tab_1_2">Account</a></li>
                <li><a data-toggle="tab" href="#tab_1_3">Classes</a></li>
                <li><a data-toggle="tab" href="#tab_1_4">Help</a></li>
            </ul>
            <div class="tab-content">
                 <div id="tab_1_1" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-unstyled profile-nav">
                                <li> <!-- img --> </li>
                                <li><a href="#">Courses</a></li>
                            </ul>
                        </div>
                    </div>
                 </div>
                 <div id="tab_1_2" class="tab-pane">
                    <div class="row">
                        
                    </div>
                 </div>
                 <div id="tab_1_3" class="tab-pane">
                    <div class="row">
                        
                    </div>
                 </div>
                 <div id="tab_1_4" class="tab-pane">
                    <div class="row">
                        
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<?php } elseif ( $user['role'] == 'student' ) { ?>

<?php } ?>
</div>