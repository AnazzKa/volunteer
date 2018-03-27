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
                                                    <label>Name</label> 
                                                    <input type="text" name="F_Name" placeholder="Enter F_Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>M_Name</label> 
                                                    <input type="text" name="M_Name" placeholder="M_Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>L_Name</label> 
                                                    <input type="text" name="L_Name" placeholder="Enter L_Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Birthday</label> 
                                                    <input type="date" name="Birthday"  class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Gender</label> <br>
                                                    Male <input name="Gender" type="radio" value="Male">
                                                    FeMale <input name="Gender" type="radio" value="Female">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nationality</label> 

                                                    <select name="Nationality"  class="form-control">
                                                        <?php
                                                        foreach ($nationality as $row) {
                                                            echo '<option value="' . $row->nationality . '">' . $row->nationality . '</option>';
                                                        }
                                                        ?>
                                                        ?>
                                                    </select>
                                                </div>

                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" name="save" type="submit"><strong>Save</strong></button>            
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Phone</label> 
                                                    <input type="text" name="Phone" placeholder="Enter Phone" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label> 
                                                    <input type="email" name="email" placeholder="Enter Email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Super power</label> 
                                                    <input type="text" name="superpower" placeholder="Super power" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>About jalila</label> 
                                                    <textarea name="about_jalila" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Emirates_id</label> 
                                                    <input type="file" name="Emirates_id[]" multiple  class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>passport_copy</label> 
                                                    <input type="file" name="passport_copy[]" multiple placeholder="passport_copy" class="form-control">
                                                </div>
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
