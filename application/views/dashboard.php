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
                    <?php 
                    if (count($noti)>0) { ?>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title navy-bg" style="background: #115E6E;color: #fff">
                                    <h5><?php echo $noti[0]->title; ?></h5> 

                                    <div class="ibox-tools">
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata('designation_id') == 1 || $this->session->userdata('designation_id') == 0) { ?>
                        <a href="<?php $base_url ?>volunteer_view" >
                        <?php } ?>
                        <div class="col-md-3">
                            <div class="widget red-bg p-lg text-center">
                                <div class="m-b-md">
                                    <i class="fa fa-users"></i>
                                    <h1 class="m-xs"><?php echo $reg_volunteer[0]->count; ?></h1>
                                    <h4 class="font-bold no-margins">
                                        Registerd 
                                    </h4>
                                    <small>Volunteers</small>
                                </div>
                            </div>
                        </div>
                        <?php if ($this->session->userdata('designation_id') == 1 || $this->session->userdata('designation_id') == 0) { ?>
                        </a>
                    <?php } ?>
                    <a href="<?php $base_url ?>selected_volunteers" >
                        <div class="col-md-3">
                            <div class="widget gray-bg p-lg text-center">
                                <div class="m-b-md">
                                    <i class="fa fa-bell"></i>
                                    <h1 class="m-xs"><?php echo $app_volunteer[0]->count; ?></h1>
                                    <h3 class="font-bold no-margins">
                                        Approved
                                    </h3>
                                    <small>Volunteers</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php if ($this->session->userdata('designation_id') == 2 || $this->session->userdata('designation_id') == 0) { ?>
                        <a href="<?php $base_url ?>clearance_volunteers" >
                        <?php } ?>
                        <div class="col-md-3">
                            <div class="widget yellow-bg p-lg text-center">
                                <div class="m-b-md">
                                    <i class="fa fa-bell"></i>
                                    <h1 class="m-xs"><?php echo $active_volunteer[0]->count; ?></h1>
                                    <h3 class="font-bold no-margins">
                                        Active
                                    </h3>
                                    <small>Volunteers</small>
                                </div>
                            </div>
                        </div>
                        <?php if ($this->session->userdata('designation_id') == 2 || $this->session->userdata('designation_id') == 0) { ?>
                        </a>
                    <?php } ?>
                    <div class="col-md-3">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <i class="fa fa-bell"></i>
                                <h1 class="m-xs">0</h1>
                                <h3 class="font-bold no-margins">
                                    Pending
                                </h3>
                                <small>Verification</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <form action="" method="post"  > 
                                    <button type="button" class="btn btn-primary btn-xs" id="item_1" onclick="ch(1)">2017</button>
                                    <button type="button" class="btn btn-danger btn-xs" id="item_2" onclick="ch(0)">2018</button>
<!--                                    <button type="submit" name="year" <?php
//                                    if ($year == 2016) {
//                                        echo "class='btn btn-danger btn-xs'";
//                                    } else {
//                                        echo "class='btn btn-primary btn-xs'";
//                                    }
                                    ?> value="2016" >2016</button>
                                    <button type="submit" name="year" value="2017" <?php
//                                    if ($year == 2017) {
//                                        echo "class='btn btn-danger btn-xs'";
//                                    } else {
//                                        echo "class='btn btn-primary btn-xs'";
//                                    }
                                    ?>>2017</button>
                                    <button type="submit" name="year" value="2018" <?php
//                                    if ($year == 2018) {
//                                        echo "class='btn btn-danger btn-xs'";
//                                    } else {
//                                        echo "class='btn btn-primary btn-xs'";
//                                    }
                                    ?>>2018</button>                                                                    -->
                                </form>
                            </div>
                            <div class="ibox-content">
                                <div>
                                    <canvas id="barChart" height="140"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php $this->load->view('footer'); ?>
            </div>

            <?php //$this->load->view('chat');   ?>
        </div>
        <?php $this->load->view('script'); ?>
        <script>
            $(document).ready(function () {               
                de();
            });
            var reg = [<?php echo $reg_bar ?>];
            var app = [<?php echo $app_bar ?>];
            var act = [<?php echo $act_bar ?>];
            var inc = [<?php echo $pen_bar ?>];
            function ch(d)
            {
                if(d==0){
                reg = [<?php echo $reg_bar ?>];
                app = [<?php echo $app_bar ?>];
                act = [<?php echo $act_bar ?>];
                inc = [<?php echo $pen_bar ?>];
                $('#item_2').removeClass('btn-primary');
                $('#item_1').removeClass('btn-danger');
                $('#item_1').addClass('btn-primary');
                $('#item_2').addClass('btn-danger');
            }else if(d==1){
                reg = [<?php echo $reg_bar_1 ?>];
                app = [<?php echo $app_bar_1 ?>];
                act = [<?php echo $act_bar_1 ?>];
                inc = [<?php echo $pen_bar_1 ?>];
                $('#item_2').removeClass('btn-danger');
                $('#item_1').removeClass('btn-primary');
                $('#item_1').addClass('btn-danger');
                $('#item_2').addClass('btn-primary');
            }
                console.log(reg);
                console.log(app);
                console.log(act);
                console.log(inc);
                de();
            }

            function de() {

                var barData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [
                        {
                            label: "Registerd",
                            backgroundColor: 'rgba(237, 85, 101, 0.5)',
                            pointBorderColor: "#fff",
                            data: reg
                        },
                        {
                            label: "Approved",
                            backgroundColor: 'rgba(220, 220, 220,0.5)',
                            borderColor: "rgba(220, 220, 220,0.7)",
                            pointBackgroundColor: "rgba(220, 220, 220,1)",
                            pointBorderColor: "#fff",
                            data: app
                        },
                        {
                            label: "Active",
                            backgroundColor: 'rgba(248, 172, 89,0.5)',
                            borderColor: "rgba(248, 172, 89,0.7)",
                            pointBackgroundColor: "rgba(248, 172, 89,1)",
                            pointBorderColor: "#fff",
                            data: act
                        },
                        {
                            label: "Pending",
                            backgroundColor: 'rgba(26, 179, 148,0.5)',
                            borderColor: "rgba(26, 179, 148,0.7)",
                            pointBackgroundColor: "rgba(26, 179, 148,1)",
                            pointBorderColor: "#fff",
                            data: inc
                        }
                    ]
                };

                var barOptions = {
                    responsive: true
                };


                var ctx2 = document.getElementById("barChart").getContext("2d");
                new Chart(ctx2, {type: 'bar', data: barData, options: barOptions});

            }
        </script>

    </body>
</html>
