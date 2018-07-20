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
                                   <div class="form-group col-md-2">   
                                    <label>Total Mails : </label><span class="label label-success"><?php echo count($mails); ?><span>                                 
                                </div>
                                <div class="form-group col-md-2">   
                                    <label >Delivered : </label> <span class="label label-primary"><?php echo $delivary_cnt[0]->cnt; ?></span>                                 
                                </div>
                                <div class="form-group col-md-2">   
                                    <label >Rejected:</label><span class="label label-danger">
                                        <?php echo $rejected_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                                <div class="form-group col-md-2">   
                                    <label >Bounced :</label><span class="label label-default">
                                        <?php echo $bounced_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                                <div class="form-group col-md-2">   
                                    <label >Soft-Bounced :</label><span class="label label-info">
                                        <?php echo $soft_bounced_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                                <div class="form-group col-md-2">   
                                    <label >Queued  :</label><span class="label label-danger">
                                        <?php echo $queued_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2 pull-right">   
                                    <label >Clicks : </label><span class="label label-info">
                                        <?php echo $click_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                                <div class="form-group col-md-2 pull-right">   
                                    <label >Opens : </label><span class="label label-warning">
                                        <?php echo $open_cnt[0]->cnt; ?>
                                    </span>                                 
                                </div>
                                
                                </div>
                            </div>
                            <!-- model box -->
                            <div id="modal-form" class="modal fade in" aria-hidden="true" >
                                <div class="modal-dialog" style="width: 800px;">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6 b-r">
                                                    <h3 class="m-t-none m-b" id="email">Anas@nextgbl.com</h3>
                                                    <p>Open : <span class="label label-info" id="open">10</span></p>
                                                        <div>
                                                            <table class="table open_table">
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Device</th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        
                                                        
                                                </div>
                                                <div class="col-sm-6"><h4>
                                                    <span class="label label-info" id="status">Send</span>
                                                </h4>
                                                    <p>Click : <span class="label label-info" id="click">20</span></p>
                                                    <div>
                                                            <table class="table click_table">
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Device</th>
                                                                </tr>
                                                               
                                                            </table>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                            <!-- model box -->
                            <div class="ibox-content">
                                <div class="table-responsive" id="dvContents">
                                    <table class="table dataTables-example" >
                                        <thead style="background-color:#115E6E;color:#ffff;">
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Opens</th>
                                                <th>Clicks</th>                                
                                                <th>#</th>                                                  
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
                                                    <td>
                                                        <?php if($row->status=='sent')
                                                                $lbl="label-primary";
                                                                elseif ($row->status=='soft-bounced')
                                                                    $lbl="label-info";
                                                                elseif ($row->status=='bounced')
                                                                $lbl="label-default";
                                                                else
                                                                $lbl="label-danger"; 
                                                         ?>
                                                        <span class='label <?php echo $lbl; ?>'>
                                                            <?php echo $row->status; ?>
                                                            </span>
                                                        </td>
                                                    <td>
                                                        <span class='label label-warning'><?php echo $row->open_cnt; ?></span>
                                                    </td>
                                                    <td>
                                                        <span class='label label-info'><?php echo $row->click_cnt; ?></span>
                                                    </td>
                                                    <td>
                                                        <a data-toggle="modal" onclick="model_box('<?php echo $row->eamil_id; ?>','<?php echo $cnt; ?>')" class="btn btn-primary" href="#modal-form">
                                                        <i class="fa fa-arrow-right" id="ar_<?php echo $cnt; ?>" aria-hidden="true"></i>
                                                        <i class="fa fa-spinner" id="sp_<?php echo $cnt; ?>" style="display: none;" aria-hidden="true"></i>

</a>
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
                console.log('loding..')
                        $.post( "<?php $base_url ?>campaign_emails_data", 
                            { campaign:'<?php echo $_REQUEST['camp']; ?>' },
                            function (response) {
                                console.log(response);
                                var data = JSON.parse(response);
                                
                            }
                    );
                }
                
        });
            function model_box(val,cnt) {
                $(".open_table").find("tr:gt(0)").remove();
                $(".click_table").find("tr:gt(0)").remove();
                $('#ar_'+cnt).css('display','none');
                $('#sp_'+cnt).css('display','');
                    $.ajax({
                            type: "POST",
                            url: "<?php $base_url ?>get_email_open_count",
                            async: false,
                            data: {email:val},
                            success: function (response) {
                                // console.log(response);
                                var data = JSON.parse(response);
                                $('#email').text(data.email);
                                $('#status').text(data.state);
                                $('#open').text(data.opens);
                                $('#click').text(data.clicks);
                                var tb="";
                                console.log(data.opens_detail);
                                $( data.opens_detail ).each(function(key , value) {
                                    tb+="<tr>";
                                    tb+="<td>";
                                    if(value.location)
                                        tb+=value.location;
                                    else
                                        tb+='Location Unknow';
                                    tb+="</td>";
                                    tb+="<td>";
                                    if(value.ua)
                                        tb+=value.ua;
                                    else
                                       tb+='Device Unknow';
                                    tb+="</td>";
                                    tb+="<tr>";
                                });
                                var tbl="";
                                $( data.clicks_detail ).each(function(key , value) {
                                    tbl+="<tr>";
                                    tbl+="<td>";
                                    if(value.location)
                                        tbl+=value.location;
                                    else
                                        tbl+='Location Unknow';
                                    tbl+="</td>";
                                    tbl+="<td>";
                                    if(value.ua)
                                        tbl+=value.ua;
                                    else
                                        tb+='Device Unknow';
                                    tbl+="</td>";
                                    tbl+="<tr>";
                                });
                                $('.open_table').append(tb);
                                $('.click_table').append(tbl);
                            }
                        });
                    $('#sp_'+cnt).css('display','none');
                $('#ar_'+cnt).css('display','');
                }
    </script>
</body>
</html>