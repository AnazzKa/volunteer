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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cnt = 0;
                                                    foreach ($appointment as $row1) {
                                                        $cnt++;
                                                         $tme = $row1->submit_time;
                                                        $data['appointment_ne'] = $this->appointment_model->get_all(1, $tme);                                                        
                                                        foreach ($data['appointment_ne'] as $row) {                                                            
                                                            ?>
                                                            <?php if ($row->field_order == 0) { ?>
                                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                <?php } ?>
                                                                <?php if ($row->field_order == 0) { ?>
                                                                    <td><?php echo $cnt; ?></td>  
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'firstname') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'lastname') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'phonenumber') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_emailaddress') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'appointmentmessage') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>                                                                
                                                                <?php if ($row->field_order == 4) { ?>    
                                                                </tr> 
                                                            <?php
                                                            }
                                                        }
                                                        ?>
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
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
    <?php $this->load->view('footer'); ?>
                </div>

            <?php // $this->load->view('chat');    ?>
            </div>
    <?php $this->load->view('script'); ?>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').DataTable({
                    "columnDefs": [{
                            "targets": [0, 1, 2, 3, 4, 5], // column or columns numbers
                            "orderable": false, // set orderable for selected columns

                        }]


                });

            });
        </script>
    </body>
</html>

