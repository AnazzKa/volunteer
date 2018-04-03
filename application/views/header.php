<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
        <ul class="nav navbar-top-links navbar-right">
            <?php
            $noti_count="SELECT COUNT(*) as 'count' FROM `al_notification`";
            $data['noti_count'] = $this->users_model->get_count($noti_count);
            $data['notification'] = $this->users_model->get_notification();            
            ?>
            
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>  <span class="label label-warning"><?php echo $data['noti_count'][0]->count ?></span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <?php
                    foreach ($data['notification'] as $row) {
                        ?>
                        <li>
                            <div class="dropdown-messages-box">                               
                                <div class="media-body">
                                    <small class="pull-right"><?php echo $row->date; ?></small>
                                    <strong><?php echo $row->title; ?></strong>. <br>
                                    <small class="text-muted"><?php echo $row->decription; ?></small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                    <?php } ?>

                </ul>
            </li>  


            <li>
                <a href="<?php $base_url ?>do_logout">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
            <li>                
                <a href="import_table"><span class="btn btn-primary"> <i class="fa fa-undo"></i></span></a>
            </li>               
        </ul>

    </nav>
</div>