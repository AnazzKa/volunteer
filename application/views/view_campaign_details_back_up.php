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
                                <div class="row">
                                <div class="form-group col-md-3">                                    
                                    <label>Date : </label> <span><?php $dat = $campaign[0]->time;$arr = explode("-", $dat);$aarr = explode(" ", $arr[2]);echo $aarr[0] . "-" . $arr[1] . "-" . $arr[0];  ?></span>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Time : </label><span><?php $dat = $campaign[0]->time;$aarr = explode(" ", $dat);echo $aarr[1]  ?> </span>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Campaign Name : </label><br><span><?php echo $campaign[0]->campaign_name; ?></span>
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <label>Description : </label><br><span><?php echo $campaign[0]->description; ?></span>
                                </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-md-3">   
                                    <label>Total Mails : </label><span class="label label-success"><?php echo count($mails); ?><span>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label >Delivered : </label> <span class="label label-primary" id="delivered_cnt"></span>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label >Rejected / Bounced :</label><span class="label label-danger" id="rejected_cnt"></span>                                 
                                </div>
                                <div class="form-group col-md-3">   
                                    <label >Opens : </label><span class="label label-warning" id="open_cnt"></span>                                 
                                </div>
                                </div>
                            </div>
                            <!-- model box -->
                            <div id="modal-form" class="modal fade in" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>

                                                    <p>Sign in today for more expirience.</p>

                                                    <form role="form">
                                                        <div class="form-group"><label>Email</label> <input placeholder="Enter email" class="form-control" type="email"></div>
                                                        <div class="form-group"><label>Password</label> <input placeholder="Password" class="form-control" type="password"></div>
                                                        <div>
                                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                                            <label> <div class="icheckbox_square-green" style="position: relative;"><input class="i-checks" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> Remember me </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-sm-6"><h4>Not a member?</h4>
                                                    <p>You can create an account:</p>
                                                    <p class="text-center">
                                                        <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                            <!-- model box -->
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
                                                    <td id="sts_<?php echo $row->eamil_id; ?>">
                                                        </td>
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
                 var del=0;
                 var rej=0;
                $('input[name^="emails"]').each(function () {
                    var email=this.value;
                    if(email!=''){
                        $.ajax({
                            type: "POST",
                            url: "<?php $base_url ?>get_email_open_count",
                            async: false,
                            data: {email:email},
                            success: function (response) {
                                console.log(response);
                                var data = JSON.parse(response);
                                $('#op_'+email).html("<span class='label label-warning'>"+data.opens+"</span>");
                                $('#cl_'+email).html("<span class='label label-info'>"+data.clicks+"</span>");
                                if(data.state=='sent'){
                                    del+=1;
                                    $('#sts_'+email).html("<span class='label label-primary'>Delivered</span>");
                                    // $('#op_'+email).append("<a data-toggle='modal' class='label label-success' href='#modal-form'>Details</a>");
                                }
                                else{
                                    rej+=1;
                                    if(data.state=='soft-bounced')
                                        $('#sts_'+email).html("<span class='label label-warning'>"+data.state+"</span>");
                                    else
                                       $('#sts_'+email).html("<span class='label label-danger'>"+data.state+"</span>"); 
                                }
                                if(data.opens>0){
                                    op+=1;
                                }
                            }
                        });
                    }
                });
                $('#open_cnt').text(op);
                $('#delivered_cnt').text(del);
                $('#rejected_cnt').text(rej);
            }
        });
    </script>
</body>
</html>