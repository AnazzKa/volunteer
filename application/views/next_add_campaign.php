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
               
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            
                                <div class="ibox-title">
                                    <h5><?php echo $title; ?> Details</h5> 
                                    <div class="pull-right">
                                    
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary"  id="envelope" href="#signup" data-toggle="modal" data-target=".bs-modal-md">Send</button>                                        
                                    </div>
                                
                                </div>                       
                                </div>
                                 <!-- Modal -->
                                

<div class="modal fade bs-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <br>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="signin">
            <form class="form-horizontal" method="post" action="campaign_mail_send">
            <!-- <form class="form-horizontal" method="post"> -->
            <fieldset>
            <!-- Sign In Form -->
            <div class="control-group">
              <input type="hidden" name="emails" id="emails">              
              <input type="hidden" name="last_id" value="<?php echo $last_id; ?>">              
            </div>
            <div class="control-group">
              <label class="control-label" for="userid">Select Templates</label>
              <div class="controls">
                <select name="Templates" class="form-control">
                    <option value="">Default</option>
                    <option value="HeartEDM">Heart EDM</option>
                    <option value="HeartSeminarEDM">Heart Seminar EDM</option>
                </select>
              </div>
            </div>            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid">Subject</label>
              <div class="controls">
                <input required="" id="userid" name="subject" type="text" class="form-control input-medium" placeholder="Subject">
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
                <button id="signin" type="submit" href="#signup" data-toggle="modal" data-target=".bs-modal-md" class="btn btn-success">Send</button>
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
                                                <div class="ibox-content">

                                                    <div style="position:absolute;
    left:40%;
    ">
                                                        
 <style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;

}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="loader"></div>

                                                    </div>
                                                    <div class="table-responsive" id="dvContents" hidden="">
                                                        <table class="table dataTables-example" >
                                                            <thead style="background-color:#115E6E;color:#ffff;">
                                                                <tr>
                                                                    <th>#</th>                                                       
                                                                    <th>#</th>                       
                                                                    <th>Name</th>
                                                                    <th>Gender</th>
                                                                    <th>Nationality</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>                                                        
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $cnt = 0;
                                                                if($volunteer!=""){
                                                                foreach ($volunteer as $row) {
                                                                $cnt++;
                                                                ?>
                                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><input type="checkbox" name="vol[]" checked value="<?php echo $row->email; ?>"></td>
                                                                    <td><?php echo $row->firstname; ?></td>                    
                                                                    <td><?php echo $row->gender; ?></td>
                                                                    <td><?php echo $row->nationality; ?></td>
                                                                    <td><?php echo $row->phone; ?></td>
                                                                    <td><?php echo $row->email; ?></td>

                                                                </tr>   
                                                                <?php } } ?>
                                                                <!-- volunteer end -->
                                                                <!-- edm start -->
                                                                <?php

                                                                if($edmlist!=""){
                                                                foreach ($edmlist as $row) {
                                                                $cnt++;
                                                                ?>
                                                                <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><input type="checkbox" name="vol[]" checked value="<?php echo $row->email; ?>"></td>
                                                                    <td><?php echo $row->full_name; ?></td>                    
                                                                    <td><?php echo $row->gender; ?></td>
                                                                    <td><?php echo $row->Nationality; ?></td>
                                                                    <td><?php echo $row->phone; ?></td>
                                                                    <td><?php echo $row->email; ?></td>

                                                                </tr>   
                                                                <?php } } ?>
                                                                <!-- edm end -->
                                                                <!-- contact start -->
                                                                <?php
                                                                if($contacts!=""){
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
                                                                    <td><input type="checkbox" name="vol[]" checked value="<?php echo $data['contacts_ne'][3]->field_value; ?>"></td>  
                                                                    <?php } ?>
                                                                    
                                                                    <?php if ($row->field_name == 'contact_first_name') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                    <?php } ?>

                                                                    <?php if ($row->field_name == 'contact_us_mobile') { ?>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                    <?php } ?>
                                                                    <?php if ($row->field_name == 'contact_us_email') { ?>
                                                                    <td><?php echo $row->field_value; ?></td>
                                                                    <?php } ?>                                                            
                                                                    <?php if ($row->field_order == 5) { ?> 

                                                                </tr> 
                                                                <?php }
                                                            }
                                                            ?>
                                                            <?php } } ?>
                                                            <!-- conatct end -->
                                                            <!-- appoinment start -->
                                                            <?php
                                                            if($appointment!=""){
                                                            foreach ($appointment as $row1) {
                                                            $cnt++;
                                                            $tme = $row1->submit_time;
                                                            $data['appointment_ne'] = $this->appointment_model->get_all(1, $tme);

                                                            $date = date('r', $tme);
                                                            foreach ($data['appointment_ne'] as $row) {
                                                            ?>
                                                            <?php if ($row->field_order == 0) { ?>
                                                            <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                                <?php } ?>
                                                                <?php if ($row->field_order == 0) { ?>
                                                                <td><?php echo $cnt; ?></td>  
                                                                <td><input type="checkbox" name="vol[]" checked value="<?php echo $data['appointment_ne'][3]->field_value; ?>"></td>  
                                                                <?php } ?>


                                                                <?php if ($row->field_name == 'firstname') { ?>
                                                                <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>

                                                                <?php if ($row->field_name == 'phonenumber') { ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td><?php echo $row->field_value; ?></td>
                                                                <?php } ?>
                                                                <?php if ($row->field_name == 'contact_emailaddress') { ?>
                                                                <td><?php echo $row->field_value; ?></td>

                                                                <?php } ?>

                                                                <?php if ($row->field_order == 4) { ?>    
                                                            </tr> 
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php } } ?>
                                                    <!-- appoinment end -->
                                                    <!-- semianr englsh start -->
                                                    <?php
                                                    if($seminar_registration!=""){  
                                                    foreach ($seminar_registration as $row1) {
                                                    $cnt++;
                                                    $tme = $row1->submit_time;
                                                    $data['seminar_registration_ne'] = $this->seminar_registration_model->get_all(1, $tme);

                                                    $date = date('r', $tme);
                                                    foreach ($data['seminar_registration_ne'] as $row) {
                                                    ?>
                                                    <?php if ($row->field_order == 0) { ?>
                                                    <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                        <?php } ?>
                                                        <?php if ($row->field_order == 0) { ?>
                                                        <td><?php echo $cnt; ?></td>  
                                                        <td><input type="checkbox" name="vol[]" checked value="<?php echo $data['seminar_registration_ne'][4]->field_value; ?>"></td>
                                                        <?php } ?>

                                                        <?php if ($row->field_name == 'fullname') { ?>
                                                        <td><?php echo $row->field_value; ?></td>
                                                        <?php } ?>


                                                        <?php if ($row->field_name == 'phonenumber') { ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $row->field_value; ?></td>
                                                        <?php } ?>
                                                        <?php if ($row->field_name == 'emailaddress') { ?>
                                                        <td><?php echo $row->field_value; ?></td>

                                                        <?php } ?>                                                                

                                                        <?php if ($row->field_order == 5) { ?>    
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php } } ?>

                                            <!-- seminar englis end -->
                                            <!-- eplispdy master class strat -->
                                            <?php
                                            if($epilepsy_masterclass!=""){   
                                            foreach ($epilepsy_masterclass as $row1) {
                                            $cnt++;
                                            $tme = $row1->submit_time;
                                            $data['epilepsy_masterclass_ne'] = $this->epilepsy_masterclass_model->get_all(1, $tme);

                                            $date = date('r', $tme);
                                            foreach ($data['epilepsy_masterclass_ne'] as $row) {
                                            ?>
                                            <?php if ($row->field_order == 0) { ?>
                                            <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                <?php } ?>
                                                <?php if ($row->field_order == 0) { ?>
                                                <td><?php echo $cnt; ?></td>  
                                                <td><input type="checkbox" name="vol[]" checked value="<?php echo $data['epilepsy_masterclass_ne'][3]->field_value; ?>"></td> 
                                                <?php } ?>

                                                <?php if ($row->field_name == 'fullname') { ?>
                                                <td><?php echo $row->field_value; ?></td>
                                                <?php } ?>

                                                <?php if ($row->field_name == 'phonenumber') { ?>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $row->field_value; ?></td>
                                                <?php } ?>
                                                <?php if ($row->field_name == 'emailaddress') { ?>
                                                <td><?php echo $row->field_value; ?></td>

                                                <?php } ?>


                                                <?php if ($row->field_order == 5) { ?>    
                                            </tr> 
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php } } ?>
                                    <!-- eplispdy master class end -->
                                    <!-- acyanotic seminar start  -->
                                    <?php
                                    if($acyanotic_heart_disease!=""){  
                                    foreach ($acyanotic_heart_disease as $row1) {
                                    $cnt++;
                                    $tme = $row1->submit_time;
                                    $data['acyanotic_heart_disease_ne'] = $this->acyanotic_heart_disease_model->get_all(1, $tme);
                                    $date = date('r', $tme);
                                    foreach ($data['acyanotic_heart_disease_ne'] as $row) {
                                    ?>
                                    <?php if ($row->field_order == 0) { ?>
                                    <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                        <?php } ?>
                                        <?php if ($row->field_order == 0) { ?>
                                        <td><?php echo $cnt; ?></td>  
                                        <td><input type="checkbox" name="vol[]" checked value="<?php echo $data['acyanotic_heart_disease_ne'][3]->field_value; ?>"></td>
                                        <?php } ?>

                                        <?php if ($row->field_name == 'fullname') { ?>
                                        <td><?php echo $row->field_value; ?></td>
                                        <?php } ?>

                                        <?php if ($row->field_name == 'phonenumber') { ?>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $row->field_value; ?></td>
                                        <?php } ?>
                                        <?php if ($row->field_name == 'emailaddress') { ?>
                                        <td><?php echo $row->field_value; ?></td>

                                        <?php } ?>

                                        <?php if ($row->field_order == 5) { ?>    
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                            <?php } } ?>
                            <!-- acyanotic seminar end  -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>                                                       
                                <th>#</th>                                                       
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Phone</th>
                                <th>Email</th>                                                        
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

setTimeout(function() {
                
              $('#dvContents').show();
              $('.loader').hide();  

            }, 1000);

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
                            "orderable": false,
                            // set orderable for selected columns   
                        }],

                        "processing": true                 

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
