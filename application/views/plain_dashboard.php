<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('head'); ?>
        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Toastr style -->
        <link href="<?php $base_url; ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <!-- Gritter -->
        <link href="<?php $base_url; ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('menu'); ?>


            <div id="page-wrapper" class="gray-bg dashbard-1">
                <?php $this->load->view('header'); ?>

                <div class="row  border-bottom white-bg dashboard-header">
                   
                 
                        
                                 
                    


                </div>

                <?php $this->load->view('footer'); ?>
            </div>

        </div>
        <?php $this->load->view('script'); ?>
    </body>
</html>
