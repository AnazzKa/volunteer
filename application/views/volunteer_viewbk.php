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
                                        <h5>Volunteer Details</h5>                        
                                    </div>

                                    <div class="ibox-content">

                                        <div class="form-group col-md-2">                                    
                                            <select name="gender" class="form-control">
                                                <option <?php if ($s_gender == '') { ?>selected<?php } ?> value="">Gender</option>
                                                <option <?php if ($s_gender == 'male') { ?>selected<?php } ?> value="male">Male</option>
                                                <option <?php if ($s_gender == 'female') { ?>selected<?php } ?> value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="nationality" class="form-control">
                                                <option value="">Nationality</option>
                                                <?php foreach ($nationality as $row) { ?>
                                                    <option <?php if ($s_nationality == $row->nationality) { ?>selected<?php } ?> value="<?php echo $row->nationality ?>"><?php echo $row->nationality ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
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
                                        <div class="form-group col-md-3">                                    
                                            <input type="text" value="<?php echo $s_name_phone; ?>" name="name_phone" placeholder="Name/phone" class="form-control">
                                            <input type="hidden" value="<?php echo $s_sort ?>" name="sort">
                                        </div>

                                        <button class="btn btn-white" name="search" type="submit"><i class="fa fa-search"></i></button>

                                    </div>


                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped" >
                                                <thead style="background-color:#115E6E;color:#ffff;">
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Date <button style="float:right" class="btn btn-primary btn-xs" name="search" type="submit"><i class="fa fa-arrow-up"></i><i class="fa fa-arrow-down"></i></button></th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Nationality</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Super Power</th> 
                                                        <th>#</th>
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
                                                    <td><?php 
                                                    $dat=$row->time;
                                                    $arr = explode("-", $dat); 
                                                    $aarr= explode(" ",$arr[2]);
                                                    echo $aarr[0]."-".$arr[1]."-".$arr[0] ?></td>
                                                    <td><?php echo $row->firstname; ?></td>                    
                                                    <td><?php echo $row->gender; ?></td>
                                                    <td><?php echo $row->nationality; ?></td>
                                                    <td><?php echo $row->phone; ?></td>
                                                    <td><?php echo $row->email; ?></td>                    
                                                    <td><?php echo $row->superpower; ?></td>
                                                    <td><a href="<?php $base_url ?>profile?id=<?php echo $row->id; ?>"><i class="fa fa-eye"></i></a>  </td>
                                                    </tr>   
                                                <?php } ?>



                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Date</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Nationality</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Super Power</th>  
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

            <?php // $this->load->view('chat');  ?>
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

    </body>
</html>
