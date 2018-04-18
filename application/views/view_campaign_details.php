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
                            <?php if(!empty($campaign)){ ?>
                            <div class="ibox-content col-md-12">
                                <div class="form-group col-md-3">                                    
                                    <label>Date : <?php $dat = $campaign[0]->time;$arr = explode("-", $dat);$aarr = explode(" ", $arr[2]);echo $aarr[0] . "-" . $arr[1] . "-" . $arr[0];  ?></label>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Time : <?php $dat = $campaign[0]->time;$aarr = explode(" ", $dat);echo $aarr[1]  ?> </label>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Campaign Name : <?php echo $campaign[0]->campaign_name; ?></label>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Description : <?php echo $campaign[0]->description; ?></label>
                                </div>
                                <div class="form-group col-md-3">   
                                    <label>Total Mails :<?php echo count($mails); ?></label>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label>Delivered :<?php echo $sent_cnt[0]->cnt; ?></label>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label>Rejected :<?php echo $rej_cnt[0]->cnt; ?></label>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label id="open_cnt">Opens : </label>                                 
                                </div>
                            </div>
                            
                            <div class="ibox-content">
                                <div class="table-responsive" id="dvContents">
                                    <table class="table " >
                                        <thead style="background-color:#115E6E;color:#ffff;">
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Opens</th>
                                                <th>Clicks</th>                                                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cnt = 0;
                                            foreach ($mails as $row) {
                                                $cnt++;
                                                ?>                                                
                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                    <td><?php echo $cnt; ?></td>                                             
                                                    <td><?php echo $row->email; ?>
                                                        <input type="hidden" name="emails[]" value="<?php echo $row->eamil_id; ?>">
                                                    </td>                    
                                                    <td><?php $sts= $row->status;
                                                    if($sts=='sent'){ echo "<span class='label label-primary'>Delivered</span>";}
                                                    else if($sts=='rejected'){ echo "<span class='label label-danger'>Rejected</span>";}
                                                    ?></td>
                                                    <td id="op_<?php echo $row->eamil_id; ?>">

                                                    </td>
                                                    <td id="cl_<?php echo $row->eamil_id; ?>">

                                                    </td>
                                                </tr>                                            
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Opens</th>
                                                    <th>Clicks</th>                                                          
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
             $('.dataTables-example').DataTable({
                "columnDefs": [{
                            "targets": [0,1, 2, 3,4], // column or columns numbers
                            "orderable": false, // set orderable for selected columns                            
                        }]
                    });

             setTimeout(function() {
               get_count();

           }, 1000);



             function get_count()
             {
                 var op=0;
                $('input[name^="emails"]').each(function () {
                    var email=this.value;
                   
                    if(email!=''){
                        $.ajax({
                            type: "POST",
                            url: "<?php $base_url ?>get_email_open_count",
                            async: false,
                            data: {email:email},
                            success: function (response) {
                                var data = JSON.parse(response);
                                $('#op_'+email).text(data.opens);
                                $('#cl_'+email).text(data.clicks);
                                if(data.opens>0){
                                    op+=1;
                                }
                            }
                        });

                    }

                });
                $('#open_cnt').text('Opens : '+op)
            }
        });
    </script>

</body>
</html>
