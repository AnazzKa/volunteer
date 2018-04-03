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
        <script src="<?php $base_url; ?>assets/time_ago.js"></script>
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
                                <div class="ibox-title">
                                    <h5>Users Details</h5>

                                </div>
                                <?php if(!empty($users)){ ?>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead style="background-color:#115E6E;color:#ffff;">
                                                <tr>
                                                    <th>Sl</th>                                     
                                                    <th>Name</th>
                                                    
                                                    <th>Email</th>
                                                    
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 
                                                <?php
                                                $cnt = 0;
                                                foreach ($users as $row) {
                                                    $cnt++;
                                                    ?>
                                                    <tr id="<?php echo $row->user_id; ?>" <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                        <td><?php echo $cnt; ?></td>   
                                                        <td><?php echo $row->firstname; ?></td>                    
                                                        
                                                        <td><?php echo $row->email; ?></td>            
                                                        
                                                        <td>
                                                            <a href="<?php $base_url ?>previlage?id=<?php echo my_simple_crypt($row->user_id,'e'); ?>"><i class="fa fa-lock fa-2x"></i></a>   
                                                            <a href="<?php $base_url ?>user_details?id=<?php echo my_simple_crypt($row->user_id,'e'); ?>"><i class="fa fa-book fa-2x"></i></a>                   
                                                            <a onclick="delete_item('<?php echo my_simple_crypt($row->user_id,'e'); ?>')"><i class="fa fa-trash fa-2x"></i></a>

                                                        </td>
                                                    </tr>   
                                                <?php } ?>



                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Sl</th>                                     
                                                    <th>Name</th>
                                                    
                                                    <th>Email</th>
                                                    
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
                $('.dataTables-example').DataTable({
                    "dom": 'lTfigt',
                    "tableTools": {
                        "sSwfPath": "<?php $base_url; ?>assets/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                    }
                });
            });
        </script>
        <script>
            function delete_item(id)
            {
                if (confirm("Are you sure..?")) {
                    $('#' + id).hide(500);
                    $.ajax({
                        type: "POST",
                        url: "<?php $base_url ?>users/delete",
                        async: false,
                        data: {user_id:id},
                        success: function (response) {
                        }
                    });
                }

            }
        </script>
    </body>
</html>
