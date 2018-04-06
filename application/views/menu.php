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

            <li>
                <a href="<?php $base_url ?>dashboard"><i class="fa fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span class="fa arrow"></span></a>                        
            </li>     

            <?php
            $user_id = $this->session->userdata('userid');
            $qry = "SELECT * FROM al_permission p INNER JOIN al_module m ON m.module_id=p.module_id WHERE m.parent_module_id='0' AND p.user_id='$user_id' ORDER BY m.sort_order ASC ";
            $reslut1['res'] = $this->privilege_model->get_result($qry);
            foreach ($reslut1['res'] as $row) {
                $module_id = $row->module_id;
                $module_head = $row->module_head;
                ?>                
                <li>
                    <a href="<?php $base_url; ?><?php echo $row->module_link; ?>"><?php echo $row->module_icone; ?>
                        <span class="nav-label"><?php echo $module_head; ?></span> <span class="fa arrow">

                        </span></a>
                    
                        <?php
                        $qry2 = "SELECT * FROM al_permission p INNER JOIN al_module m ON m.module_id=p.module_id WHERE m.parent_module_id='$module_id' AND p.user_id='$user_id' AND m.sort_order!=3 AND m.sort_order!=4 and m.sort_order!=5 ORDER BY m.sort_order ASC ";
                        $reslut1['resu'] = $this->privilege_model->get_result($qry2);
                        $arr_count= count($reslut1['resu']);
                        if($arr_count>0){ ?>
                        <ul class="nav nav-second-level">
                        <?php
                        foreach ($reslut1['resu'] as $row1) {
                            $module_sub_head = $row1->module_head;
                            $module_link = $row1->module_link;
                            ?>    
                            <li><a href="<?php $base_url ?><?php echo $module_link; ?>"><?php echo $module_sub_head; ?></a></li>                            
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li> 
            <?php } ?>



        </ul>

    </div>
</nav>