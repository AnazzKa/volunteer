<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('head'); ?>
    <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php $base_url; ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
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

                            <div class="ibox-title">
                                <h5><?php echo $title; ?> Details</h5>                        
                            </div>

                            <div class="ibox-content col-md-12">
                                <div class="form-group col-md-1">                                    
                                    <a href="<?php $base_url ?>add_campaign"><button class="btn btn-primary">Add New Campaign</button></a>
                                </div>
                            </div>
                            <?php if(!empty($campaign)){ ?>
                            <div class="ibox-content">
                                <div class="table-responsive" id="dvContents">
                                    <table class="table dataTables-example" >
                                        <thead style="background-color:#115E6E;color:#ffff;">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>campaign Name</th>
                                                <th>Discription</th>
                                                <th>#</th>                                                  
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $cnt = 0;

                                            foreach ($campaign as $row) {
                                                $cnt++;
                                                ?>
                                                
                                                    <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                        <td><?php echo $cnt; ?></td>                                             
                                                        <td><?php  $dat = $row->time;$arr = explode("-", $dat);$aarr = explode(" ", $arr[2]);echo $aarr[0] . "-" . $arr[1] . "-" . $arr[0];  ?> </td>                    
                                                        <td><?php  $dat = $row->time;$aarr = explode(" ", $dat);echo $aarr[1]  ?></td>                    
                                                        <td><?php echo $row->campaign_name; ?></td>
                                                        <td><?php echo $row->description; ?></td>
                                                        <td><a href="<?php $base_url; ?>view_campaign_details?camp=<?php echo my_simple_crypt($row->campaignid,'e'); ?>"><button class="btn btn-primary"><i class="fa fa-arrow-right"></i></button></a></td>                                                   
                                                    </tr>
                                                 
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>campaign Name</th>
                                                    <th>Discription</th>
                                                    <th>#</th>                                                          
                                                </tr>
                                            </tfoot>
                                        </table>
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
                    </div>

                </div>
                <?php $this->load->view('footer'); ?>
            </div>

            <?php // $this->load->view('chat');   ?>
        </div>
        <?php $this->load->view('script'); ?>
        <script>
            $(document).ready(function () {

                <?php if($this->session->flashdata('messsage')!=""){ ?>
                   setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('Done','<?php echo $this->session->flashdata('messsage'); ?>');
                }, 1300);
                   <?php } ?>
                   $('.dataTables-example').DataTable({
                    "columnDefs": [{
                            "targets": [0,1, 2, 3,4], // column or columns numbers
                            "orderable": false, // set orderable for selected columns                            
                        }]
                    });
                   $("#super_power").on("change", function () {
                    var value = $(this).val().toLowerCase();
                    $(".dataTables-example tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                   $("#nationality").on("change", function () {
                    var value = $(this).val().toLowerCase();
                    $(".dataTables-example tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                   $("#gender").on("change", function () {
                    var value = $(this).val().toLowerCase();
                    $(".dataTables-example tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                   $('#envelope').on('click',function(){

                    var val = [];
                    $(':checkbox:checked').each(function(i){
                      val[i] = $(this).val();
                  });
                    $('#emails').val(val);  
                });

               });
           </script>

       </body>
       </html>
