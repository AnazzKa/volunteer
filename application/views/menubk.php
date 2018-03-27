<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('username'); ?></strong>
                            </span>  </span> </a>

                </div>
                <div class="logo-element">
                    AJCS
                </div>
            </li>
            <?php if ($this->session->userdata('user_cat') == 0) { ?>
                <li>
                    <a href="<?php $base_url ?>dashboard"><i class="fa fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span class="fa arrow"></span></a>                        
                </li>     
                <li>
                    <a href=""><i class="fa fa-users"></i> <span class="nav-label">Volunteer </span> <span class="fa arrow"></span></a>                        
                    <ul class="nav nav-second-level">
                        <?php if($this->session->userdata('designation_id')==1){ ?>
                        <li><a href="<?php $base_url ?>volunteer_view">Volunteers</a></li>
                        <?php } ?>
                        <li><a href="<?php $base_url ?>selected_volunteers">Approved</a></li>
                        <?php if($this->session->userdata('designation_id')==2){ ?>
                        <li><a href="<?php $base_url ?>clearance_volunteers">Active</a></li>
                        <?php } ?>
                        <?php if($this->session->userdata('designation_id')==0 ){ ?>
                        <li><a href="<?php $base_url ?>inactive_volunteers">Inactive</a></li>
                        <?php } ?>
                    </ul>
                </li> 
            <?php } ?>
            <?php if ($this->session->userdata('user_cat') == 1) { ?>
                <li>
                    <a href="<?php $base_url ?>dashboard"><i class="fa fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span class="fa arrow"></span></a>                        
                </li> 
                <li>
                    <a href=""><i class="fa fa-users"></i> <span class="nav-label">Volunteer </span> <span class="fa arrow"></span></a>                        
                    <ul class="nav nav-second-level">
                        <li><a href="<?php $base_url ?>volunteer_view">Volunteers</a></li>
                        <li><a href="<?php $base_url ?>selected_volunteers">Approved</a></li>
                        <li><a href="<?php $base_url ?>clearance_volunteers">Active</a></li>
                        <li><a href="<?php $base_url ?>inactive_volunteers">Inactive</a></li>
                    </ul>
                </li> 
                <li>
                    <a href="<?php $base_url ?>contact"><i class="fa fa-file-text"></i> <span class="nav-label">Contact</span> <span class="fa arrow"></span></a>                        
                </li>
                <li>
                    <a href="<?php $base_url ?>appointment"><i class="fa fa-building-o"></i> <span class="nav-label">Appointment</span> <span class="fa arrow"></span></a>                        
                </li>
                <li>
                    <a href="<?php $base_url ?>notifications"><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span> <span class="fa arrow"></span></a>                        
                </li>
                <li>
                    <a href=""><i class="fa fa-male"></i> <span class="nav-label">Users</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php $base_url ?>users">ADD</a></li>
                        <li><a href="<?php $base_url ?>users_view">View</a></li>

                    </ul>
                </li> 
            <?php } ?>


        </ul>

    </div>
</nav>