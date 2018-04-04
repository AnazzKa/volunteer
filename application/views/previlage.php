<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('head'); ?>
        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">

            <?php $this->load->view('menu'); ?>

            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('header'); ?>


                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <?php if ($msg != "") { ?>
                            <div class="col-md-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title navy-bg">
                                        <h5><?php echo $msg; ?></h5>
                                        <div class="ibox-tools">
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Users <small>Previlage</small></h5>

                                </div>
                                <div class="ibox-content">
                                    <div class="row">

                                        <form name="form1" id="idForm1" method="post">
                                            <div class="panel-body">
                                                <input type="hidden" name="userid" id="userid" value="<?php echo $user_id; ?>" />
                                                <?php
                                                $qry = "SELECT * FROM `al_module` WHERE `parent_module_id`=0";
                                                $reslut1['res'] = $this->privilege_model->get_result($qry);
                                                foreach ($reslut1['res'] as $row) {
                                                    $module_id = $row->module_id;
                                                    $module_head = $row->module_head;
                                                    $qry2 = "SELECT * FROM `al_permission` WHERE `user_id`=$user_id and `module_id`=$module_id";
                                                    $reslut2['res'] = $this->privilege_model->get_result($qry2);
                                                    $cnt = count($reslut2['res']);
                                                    ?>
                                                    <div class="form-group col-md-12">
                                                        <label class="col-md-2 control-label col-md-2" for="inputSuccess"><?php echo $module_head ?></label>
                                                        <div class="col-md-10">
                                                            <label class="checkbox-inline">
                                                                <input name="chk[]" type="checkbox" <?php if ($cnt > 0) { ?> checked <?php } ?>  id="<?php echo $module_id ?>" value="<?php echo $module_id ?>"><?php echo $module_head ?>
                                                            </label>
                                                            <?php
                                                            $qry3 = "SELECT * FROM `al_module` WHERE `parent_module_id`=$module_id";
                                                            $reslut3['res'] = $this->privilege_model->get_result($qry3);
                                                            foreach ($reslut3['res'] as $row1) {
                                                                $sub_module_id = $row1->module_id;
                                                                $sub_module_head = $row1->module_head;
                                                                $qry4 = "SELECT * FROM `al_permission` WHERE `user_id`=$user_id and `module_id`=$sub_module_id";
                                                                $reslut4['res'] = $this->privilege_model->get_result($qry4);
                                                                $cnt1 = count($reslut4['res']);
                                                                ?>
                                                                <label class="checkbox-inline">
                                                                    <input name="chk[]" type="checkbox" <?php if ($cnt1 > 0) { ?> checked <?php } ?>  id="<?php echo $sub_module_id ?>" value="<?php echo $sub_module_id ?>"><?php echo $sub_module_head ?>
                                                                </label>
                                                            <?php } ?>   

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <center> 
                                                        <button class="btn btn-primary" name="submit" type="submit">Update</button>    

                                                    </center>
                                                </section>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <?php $this->load->view('footer'); ?>
            </div>

            <?php // $this->load->view('chat'); ?>
        </div>
        <?php $this->load->view('script'); ?>

        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    </body>
</html>
