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
                            <div class="col-lg-12">
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

                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Users <small>Add</small></h5>

                                </div>
                                <div class="ibox-content">
                                    <div class="row">

                                        <form role="form" method="post" action="" enctype="multipart/form-data">
                                            <div class="col-sm-6 b-r">                                                                
                                                <div class="form-group">   
                                                    <label>DB1</label>
                                                    <select name="db_o" class="form-control">
                                                        <option value="wp_volunteer">wp_volunteer</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" name="import" type="submit"><strong>Import</strong></button>            
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <label>DB2</label>
                                                <select name="db_t" class="form-control">
                                                    <option value="al_volunteer">al_volunteer</option>
                                                    </select>
                                                
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
    </body>
</html>
