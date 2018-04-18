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

                                        <form role="form" method="post" action="<?php $base_url ?>next_add_capmaign" enctype="multipart/form-data">
                                            <div class="col-sm-6 b-r">                                                                
                                                <div class="form-group">      
                                            <select onchange="get_cateory(this.value)"  name="type" class="form-control">
                                                <!-- <select id="category"  name="category" class="form-control"> -->
                                                    <option <?php if ($s_category == '') { ?>selected<?php } ?> value="">All Type</option>
                                                    <option <?php if ($s_category == 'General') { ?>selected<?php } ?> value="General">General</option>
                                                    <option <?php if ($s_category == 'edmlist') { ?>selected<?php } ?> value="edmlist">EDM LIST</option>
                                                </select>
                                            </div>
                                            <div class="form-group">                                    
                                        <select id="category" name="category" class="form-control">
                                            <!-- <select id="type"  name="type" class="form-control"> -->
                                                <option <?php if ($s_type == '') { ?>selected<?php } ?> value="">All Category</option><option <?php if ($s_type == 'Volunteer') { ?>selected<?php } ?> value="Volunteer">Volunteer</option>
                                                <option <?php if ($s_type == 'Contact') { ?>selected<?php } ?> value="Contact">Contact</option>
                                                <option <?php if ($s_type == 'Appointment') { ?>selected<?php } ?> value="Appointment">Appointment</option>
                                                <option <?php if ($s_type == 'SeminarRegistrationEnglish') { ?>selected<?php } ?> value="SeminarRegistrationEnglish">Seminar Registration English</option>
                                                <option <?php if ($s_type == 'EpilepsyMasterclass') { ?>selected<?php } ?> value="EpilepsyMasterclass">Epilepsy Masterclass</option>
                                                <option <?php if ($s_type == 'AcyanoticHeartDisease') { ?>selected<?php } ?> value="AcyanoticHeartDisease">Acyanotic Heart Disease</option>
                                                <?php foreach ($category as $row) { ?>
                                                            <option <?php if ($s_edm_category == $row->category_id) { ?>selected<?php } ?> value="<?php echo $row->category_id ?>"><?php echo $row->category_name ?></option>
                                                            <?php }
                                                            ?>
                                            </select>
                                        </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Campaign Name</label> 
                                                    <input required type="text" name="campaign_name" placeholder="Campaign Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label> 
                                                    <textarea name="decription" placeholder="Description" class="form-control"></textarea> 
                                                </div>
                                                
                                                  <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" name="next" type="submit"><strong>next</strong></button>            
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

            });
            function get_cateory(id)
                {
                    $.ajax({
                            type: "POST",
                            url: "<?php $base_url ?>get_category_options",
                            async: false,
                            data: {id:id},
                            success: function (response) {
                                console.log(response);
                                $("#category option").remove();
                                $('#category').append(response);
                            }
                        });
                }
        </script>
    </body>
</html>
