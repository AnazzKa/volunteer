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
                                <!-- Modal -->
                                

<div class="modal fade bs-modal-md edm_mail_send" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <br>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="signin">
            <form class="form-horizontal" method="post" action="edm_mail_send">
            <fieldset>
            <!-- Sign In Form -->
            <div class="control-group">
              <input type="hidden" name="emails" id="emails">              
            </div>
            <div class="control-group">
              <label class="control-label" for="userid">Choose template</label>
                <select name="template" class="form-control">
                    <option value="">Test</option>
                </select>
              </div>
            
            <div class="control-group">
              <center><h2>OR</h2></center>
                
              </div>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid">Subject</label>
              <div class="controls">
                <input  id="userid" name="subject" type="text" class="form-control input-medium" placeholder="Subject">
              </div>
            </div>

            <!-- Password input-->
            <div class="control-group">
              <label class="control-label" for="passwordinput">Message</label>
              <div class="controls">
                <textarea  id="messageinput" name="messageinput" class="form-control input-medium" placeholder="Message"></textarea>
              </div>
            </div>                
            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="signin"></label>
              <div class="controls">
                <button id="signin" type="submit" name="send" class="btn btn-success">Send</button>
              </div>
            </div>
            </fieldset>
            </form>
        </div>
        
    </div>
      </div>            
      
    </div>
  </div>
</div>

<!-- model box end -->
<!-- new model box start -->
<div class="modal fade bs-modal-md campaign_add" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <br>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="signin">
            <form class="form-horizontal" method="post" action="campaign_add">
            <fieldset>
            <!-- Sign In Form -->
            <!-- Text input-->
            <div class="control-group">
              <!-- <label class="control-label" for="userid">Category</label> -->
              <div class="controls">
                <select name="campaign_cat" type="text" class="form-control input-medium" >
                    <option value="">Category</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <!-- <label class="control-label" for="userid">Type</label> -->
              <div class="controls">
                <select name="campaign_type" type="text" class="form-control input-medium" >
                    <option value="">Type</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <!-- <label class="control-label" for="userid">Campaign Name</label> -->
              <div class="controls">
                <input required=""  name="campaign_name" type="text" class="form-control input-medium" placeholder="Campaign Name">
              </div>
            </div>

            <!-- Password input-->
            <div class="control-group">
              <!-- <label class="control-label" for="passwordinput">Description</label> -->
              <div class="controls">
                <textarea required=""  name="description" class="form-control input-medium" placeholder="Description"></textarea>
              </div>
            </div>                
            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="signin"></label>
              <div class="controls">
                <button id="signin" type="submit" name="Save" class="btn btn-success">Save</button>
              </div>
            </div>
            </fieldset>
            </form>
        </div>
        
    </div>
      </div>            
      
    </div>
  </div>
</div>
<!-- new model box start -->

                                <div class="ibox-content col-md-12">

                                                    <div class="form-group col-md-1">                                    
                                                        <button class="btn btn-primary" id="envelope" href="#signup" data-toggle="modal" data-target=".edm_mail_send"><i class="fa fa-envelope"></i></button>
                                                    </div>
                                                    <div class="form-group col-md-1">                                    
                                                        <button class="btn btn-primary" href="#signup" data-toggle="modal" data-target=".campaign_add">Add Campaign</button>
                                                    </div>
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="table-responsive" id="dvContents">
                                                        <table class="table dataTables-example" >
                                                            <thead style="background-color:#115E6E;color:#ffff;">
                                                                <tr>
                                                                    <th>#</th>                                                       
                                                                                          
                                                                    <th>Name</th>
                                                                    <th>Gender</th>
                                                                    <th>Nationality</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>       <th><input type="checkbox"></th>                                                  
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $cnt = 0;
                                                                if($campaign!=""){
                                                                foreach ($campaign as $row) {
                                                                $cnt++;
                                                                ?>
                                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                    <td><?php echo $cnt; ?></td>
                                                                    
                                                                    <td><?php echo $row->firstname; ?></td>                    
                                                                    <td><?php echo $row->gender; ?></td>
                                                                    <td><?php echo $row->nationality; ?></td>
                                                                    <td><?php echo $row->phone; ?></td>
                                                                    <td><?php echo $row->email; ?></td>
<td><input type="checkbox" name="vol[]" value="<?php echo $row->email; ?>"></td>
                                                                </tr>   
                                                                <?php } } ?>
                                                                <!-- volunteer end -->
                                                                
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>                                                       
                                                                                     
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Phone</th>
                                <th>Email</th> <th>#</th>                                                         
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        
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
                            "targets": [0,1, 2, 3, 4, 5,6], // column or columns numbers
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
