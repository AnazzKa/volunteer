<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('head'); ?>
    <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="<?php $base_url; ?>assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <?php $this->load->view('menu'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php $this->load->view('header'); ?>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <form role="form" id="form_search" method="post">
                                <div class="ibox-title">
                                    <h5>Appointment Details</h5>                        
                                </div>
                                <?php if(!empty($appointment)){ ?>

                                <div class="ibox-content">
                                    <div class="table-responsive" id="dvContents">
                                        <table class="table dataTables-example" >
                                            <thead style="background-color:#115E6E;color:#ffff;">
                                                <tr>
                                                    <th>Sl</th>

                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>                                                  
                                                    <th>Message</th>                                                  
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cnt = 0;
                                                foreach ($appointment as $row) {
                                                    $cnt++;
                                                    ?>
                                                    <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                        <td><?php echo $cnt; ?></td>                                                           

                                                        <td><?php echo $row->first_name; ?></td>                    
                                                        <td><?php echo $row->last_name; ?></td>
                                                        <td><?php echo $row->phone_number; ?></td>
                                                        <td><?php echo $row->email; ?></td>
                                                        <td><?php echo $row->message; ?></td>                    
                                                        <td><a href="<?php $base_url ?>profile?id=1"><i class="fa fa-address-book fa-2x"></i></a>  </td>
                                                    </tr>   
                                                    <?php } ?>



                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>                                                  
                                                        <th>Message</th>                                                  
                                                        <th>#</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                    <?php }else{ ?>
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
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $this->load->view('footer'); ?>
            </div>

            <?php // $this->load->view('chat');   ?>
        </div>
        <?php $this->load->view('script'); ?>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').DataTable({
                    "columnDefs": [{
                            "targets": [0,1, 2, 3, 4, 5, 6], // column or columns numbers
                            "orderable": false, // set orderable for selected columns

                        }]


                    });

            });
        </script>
    </body>
    </html>

