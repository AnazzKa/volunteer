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
                                        <h5><?php echo $title; ?> Details</h5>                        
                                    </div>

                                    <div class="ibox-content col-md-12">
                                        

                                        
                                        <div class="form-group col-md-4">                                    
                                            <!--<select onchange="this.form.submit()"  name="gender" class="form-control">-->
                                            <select id="gender"  name="gender" class="form-control">
                                                <option <?php if ($s_gender == '') { ?>selected<?php } ?> value="">Gender</option>
                                                <option <?php if ($s_gender == 'male') { ?>selected<?php } ?> value="male">Male</option>
                                                <option <?php if ($s_gender == 'female') { ?>selected<?php } ?> value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <!--<select onchange="this.form.submit()" name="nationality" class="form-control">-->
                                            <select id="nationality" name="nationality" class="form-control">
                                                <option value="">Nationality</option>
                                                <?php foreach ($nationality as $row) { ?>
                                                    <option <?php if ($s_nationality == $row->nationality) { ?>selected<?php } ?> value="<?php echo $row->nationality ?>"><?php echo $row->nationality ?></option>
                                                <?php }
                                                ?>
                                            </select>
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
                                                        <th>Email</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    $cnt = 0;
                                                    foreach ($volunteer as $row) {
                                                        $cnt++;
                                                        ?>
                                                        <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo $row->firstname; ?></td>                    
                                                            <td><?php echo $row->gender; ?></td>
                                                            <td><?php echo $row->nationality; ?></td>
                                                            <td><?php echo $row->phone; ?></td>
                                                            <td><?php echo $row->email; ?></td>
                                                            
                                                        </tr>   
                                                    <?php } ?>
<!-- volunteer end -->
<!-- contact start -->
<?php
                                                    
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
<?php } ?>
<!-- conatct end -->
<!-- appoinment start -->
<?php
                                                       
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
    <?php } ?>
    <!-- appoinment end -->
    <!-- semianr englsh start -->
    <?php
                                                        
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
                                                        <?php } ?>

<!-- seminar englis end -->
<!-- eplispdy master class strat -->
<?php
                                                        
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
                                                        <?php } ?>
<!-- eplispdy master class end -->
<!-- acyanotic seminar start  -->
<?php
                                                        
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
                                                        <?php } ?>
<!-- acyanotic seminar end  -->
                                                </tbody>
                                                <tfoot>
                                                    <tr>
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
                            "targets": [0,1, 2, 3, 4, 5], // column or columns numbers
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
            });
        </script>

    </body>
</html>
