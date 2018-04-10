<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php $this->load->view('head'); ?>

        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <?php $this->load->view('menu'); ?>

            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('header'); ?>

                <div class="wrapper wrapper-content">
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
                    <div class="row animated fadeInRight">
                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Contact Single View</h5>
                                    
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($contacts)) { ?> 
                            <div class="col-md-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content profile-content">
                                        <h4><strong><?php echo $contacts[0]->field_value . " " . $contacts[1]->field_value; ?></strong></h4>
                                        <p><i class="fa fa-map-marker"></i> 
                                            <?php
                                            $tme = $contacts[1]->submit_time;
                                            $date = date('r', $tme);
                                            $ne = new DateTime($date);
                                            echo $ne->format('d-m-Y');
                                            ?>
                                        </p>
                                        <h5>
                                            <strong>Phone : </strong> <?php echo $contacts[2]->field_value; ?>
                                        </h5>
                                        <h5>
                                            <strong>Email : </strong> <?php echo $contacts[3]->field_value; ?>
                                        </h5>
                                        <p>
                                            <?php echo $contacts[4]->field_value; ?> 
                                        </p>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content profile-content">
                                        <form action="<?php  $base_url; ?>contact_mail" method="post">
                                            <div class="form-group"> 
                                                <!--<input type="text" name="email" value="<?php //echo $contacts[3]->field_value; ?>" >-->
                                                <input type="text" name="email" value="anas@nextgbl.com" >
                                                <input required type="text" name="subject" placeholder="subject" class="form-control">                                                
                                            </div>
                                            <div class="form-group">                                                     
                                                <textarea required  name="messsage" placeholder="messsage" class="form-control"> </textarea>                                               
                                            </div>
                                            <div class="user-button">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" name="send" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title gray-bg">
                                        <h5>No Data Found</h5>
                                        <div class="ibox-tools">
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>
                <?php $this->load->view('footer'); ?>

            </div>
        </div>


        <?php $this->load->view('script'); ?>

    </body>

</html>
