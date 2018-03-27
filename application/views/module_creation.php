<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php $this->load->view('head'); ?>

        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">

        <link href="<?php $base_url; ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    </head>
    <body>

        <div id="wrapper">

            <?php $this->load->view('menu'); ?>

            <div id="page-wrapper" class="gray-bg">
                <?php $this->load->view('header'); ?>


                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <?php if ($msg != "") { ?>
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title navy-bg">
                                        <h5><?php echo $msg; ?></h5>
                                        <div class="ibox-tools">
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Module <small>Creation</small></h5>

                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <form role="form" method="post" action="" enctype="multipart/form-data">
                                            <div class="col-sm-6 b-r">                                                                

                                                <div class="form-group">
                                                    <label>Module Name</label> 
                                                    <input type="text" name="module_name" placeholder="Module Name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Parent Module</label> 
                                                    <select name="parent_module"  class="form-control">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($parent_module as $row) {
                                                            echo '<option value="' . $row->module_id . '">' . $row->module_name . '</option>';
                                                        }
                                                        ?>
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Icone</label> 
                                                    <input type="text" name="icone" placeholder="Module Icone" class="form-control">
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" name="save" type="submit"><strong>Save</strong></button>            
                                                </div>

                                            </div>
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Sort Order</label> 
                                                    <input type="text" name="sort_order" placeholder="Sort Order" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Module Head</label> 
                                                    <input type="text" name="module_head" placeholder="Module Head" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Module Link</label> 
                                                    <input type="text" name="module_link" placeholder="Module Link" class="form-control">
                                                </div>                                                                                                

                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="ibox-content">
                                    <div class="table-responsive" id="dvContents">
                                        <table class="table dataTables-example" >
                                            <thead style="background-color:#115E6E;color:#ffff;">
                                                <tr>
                                                    <th>Sl</th>

                                                    <th>Module</th>
                                                    <th>Parent</th>
                                                    <th>Order</th>
                                                    <th>Head</th>
                                                    <th>Link</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cnt = 0;
                                                foreach ($modules as $row) {
                                                    if ($row->parent_module_id != 0) {
                                                        $da['parent'] = $this->privilege_model->get_module($row->parent_module_id);
                                                        $parent = $da['parent'][0]->module_name;
                                                    } else {
                                                        $parent = "";
                                                    }
                                                    $cnt++;
                                                    ?>
                                                    <tr <?php if ($cnt % 2 == 0) { ?>class="gradeX" <?php } else { ?>class="gradeA" <?php } ?> >
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $row->module_name; ?></td>                    
                                                        <td><?php echo $parent ?></td>
                                                        <td><?php echo $row->sort_order; ?></td>
                                                        <td><?php echo $row->module_head; ?></td>
                                                        <td><?php echo $row->module_link; ?></td>                                                                                
                                                    </tr>   
                                                <?php } ?>



                                            </tbody>

                                        </table>
                                    </div>

                                </div>
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
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    </body>
</html>
