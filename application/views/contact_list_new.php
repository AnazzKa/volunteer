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
                                        <h5>Contact Details</h5>    
                                        <div class="pull-right">
                                    <form action="" method="post">
                                    <div class="btn-group">
                                        <button type="submit" name="export" class="btn btn-primary">Export</button>                                        
                                    </div>
                                </form>
                                </div>                     
                                    </div>

                                    

<?php if(!empty($contacts)){ ?>
                                    <div class="ibox-content">
                                        <div class="table-responsive" id="dvContents">
                                            <table class="table dataTables-example" >
                                                <thead style="background-color:#115E6E;color:#ffff;">
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th class="date">Date</th>
                                                        <th>F Name</th>
                                                        <th>L Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Message</th>
                                                        <th>your-recipient</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cnt = 0;
                                                    foreach ($contacts as $row1) {
                                                        $cnt++;
                                                      $row_id=  $tme = $row1->submit_time;
                                                        $data['contacts_ne'] = $this->contact_model->get_all(1, $tme);
                                                         $date = date('r', $tme);
                                                        foreach ($data['contacts_ne'] as $row) {
                                                            ?>
                                                            <?php if ($row->field_order == 0) { ?>
                                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                <?php } ?>
                                                                <?php if ($row->field_order == 0) { ?>
                                                                    <td><?php echo $cnt; ?></td>  
                                                                <?php } ?>
                                                                    <?php if ($row->field_order == 0) { ?>
                                                                        <td>
                                                                            <?php $ne = new DateTime($date);
                                                                            echo $ne->format('d-m-Y');
                                                                            ?>
                                                                        </td>
                                                                    <?php } ?>
                                                                <?php if ($row->field_name == 'contact_first_name') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_last_name') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_us_mobile') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_us_email') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_us_message') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'your-recipient') { ?>
                                                                    <td> <?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_order == 5) { ?> 
                                                                <td>
                                                                <a href="<?php $base_url ?>contact_single_view?id=<?php echo my_simple_crypt($row_id,'e'); ?>"><i class="fa fa-address-book fa-2x"></i></a>  
                                                            </td>  
                                                                </tr> 
                                                            <?php }
                                                        }
                                                        ?>
<?php } ?>



                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sl</th>
                                                         <th class="date">Date</th>
                                                        <th>Name</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <th>Message</th>
                                                        <th>Type</th>
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

        <?php // $this->load->view('chat');     ?>
        </div>
<?php $this->load->view('script'); ?>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').DataTable({
                    "columnDefs": [{
                            "targets": [0, 1, 2, 3, 4, 5, 6,7,8], // column or columns numbers
                            "orderable": false, // set orderable for selected columns

                        }]


                });

            });
        </script>
    </body>
</html>

