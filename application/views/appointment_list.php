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

<!--                                    <div class="ibox-content col-md-12">
                                            <div class="form-group col-md-4">                                    
                                                <input type="text" placeholder="From Date" onfocus="(this.type='date')"  value="<?php echo $f_date; ?>" name="f_date" class="form-control">                                            
                                            </div>

                                            <div class="form-group col-md-4">                                    
                                                <input type="text" placeholder="To Date" onfocus="(this.type='date')"  value="<?php echo $t_date; ?>" name="t_date" class="form-control">                                            
                                            </div>
                                            <div class="form-group col-md-4">                                    
                                                <select name="gender" class="form-control">
                                                    <option <?php if ($s_gender == '') { ?>selected<?php } ?> value="">Gender</option>
                                                    <option <?php if ($s_gender == 'male') { ?>selected<?php } ?> value="male">Male</option>
                                                    <option <?php if ($s_gender == 'female') { ?>selected<?php } ?> value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select name="nationality" class="form-control">
                                                    <option value="">Nationality</option>
                                                    <?php foreach ($nationality as $row) { ?>
                                                        <option <?php if ($s_nationality == $row->nationality) { ?>selected<?php } ?> value="<?php echo $row->nationality ?>"><?php echo $row->nationality ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select name="super_power" class="form-control">
                                                    <option <?php if ($s_superpower == '') { ?>selected<?php } ?> value="">Super Power</option>                                                
                                                    <option <?php if ($s_superpower == 'Art and craft') { ?>selected<?php } ?> value="Art and craft">Art and craft </option>
                                                    <option <?php if ($s_superpower == 'Balloon Artist') { ?>selected<?php } ?> value="Balloon Artist">Balloon Artist</option>
                                                    <option <?php if ($s_superpower == 'Beat Boxing') { ?>selected<?php } ?> value="Beat Boxing">Beat Boxing </option>
                                                    <option <?php if ($s_superpower == 'Caricaturist') { ?>selected<?php } ?> value="Caricaturist">Caricaturist</option>
                                                    <option <?php if ($s_superpower == 'Circus acts') { ?>selected<?php } ?> value="Circus acts">Circus acts </option>
                                                    <option <?php if ($s_superpower == 'Dancer') { ?>selected<?php } ?> value="Dancer">Dancer </option>
                                                    <option <?php if ($s_superpower == 'Juggler') { ?>selected<?php } ?> value="Juggler">Juggler </option>
                                                    <option <?php if ($s_superpower == 'Magician') { ?>selected<?php } ?> value="Magician ">Magician </option>
                                                    <option <?php if ($s_superpower == 'Musical instrument player') { ?>selected<?php } ?> value="Musical instrument player">Musical instrument player</option>
                                                    <option <?php if ($s_superpower == 'Painter') { ?>selected<?php } ?> value="Painter">Painter </option>
                                                    <option <?php if ($s_superpower == 'Photography/videography') { ?>selected<?php } ?> value="Photography/videography">Photography/videography</option>
                                                    <option <?php if ($s_superpower == 'Scientist') { ?>selected<?php } ?> value="Scientist">Scientist </option>
                                                    <option <?php if ($s_superpower == 'Singer') { ?>selected<?php } ?> value="Singer">Singer</option>
                                                    <option <?php if ($s_superpower == 'Storytelling') { ?>selected<?php } ?> value="Storytelling">Storytelling </option>
                                                    <option <?php if ($s_superpower == 'Ventriloquist') { ?>selected<?php } ?> value="Ventriloquist">Ventriloquist</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">                                    
                                                <input type="hidden" value="<?php echo $s_name_phone; ?>" name="name_phone" placeholder="Name/phone" class="form-control">
                                                <input type="hidden" value="<?php echo $s_sort ?>" name="sort">
                                                <button class="btn btn-primary" name="reset" type="reset"><i class="fa fa-undo"></i></button>
                                            <button class="btn btn-primary" name="search" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?php $base_url; ?>volunteer_print" target="_blank"> <button id="btnPrint" class="btn btn-primary" name="print" type="button"><i class="fa fa-print"></i></button></a>
                                            </div>
                                    </div>-->


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
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cnt = 0;
                                                    foreach ($appointment as $row) {
                                                        $cnt++;
                                                        ?>
                                                        <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                            <td><?php echo $cnt; ?></td>                                                           
                                                                                                                     
                                                            <td><?php echo $row->first_name; ?></td>                    
                                                            <td><?php echo $row->last_name; ?></td>
                                                            <td><?php echo $row->phone_number; ?></td>
                                                            <td><?php echo $row->email; ?></td>
                                                            <td><?php echo $row->message; ?></td>                    
                                                            <td><a href="<?php $base_url ?>profile?id=1"><i class="fa fa-address-book fa-2x"></i></a>  </td>
                                                        </tr>   
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
                                                        <th>#</th>
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
                            "targets": [0,1, 2, 3, 4, 5, 6], // column or columns numbers
                            "orderable": false, // set orderable for selected columns

                        }]


                });

            });
        </script>
    </body>
</html>

