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
    <link href="<?php $base_url; ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
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
                            <!-- Modal -->
                            <div class="modal fade bs-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <br>
                                    <div class="modal-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="signin">
                                                <fieldset>
                                                    <!-- Sign In Form -->
                                                    <div class="control-group">
                                                      <input type="hidden" name="emails" id="emails">              
                                                  </div>
                                                  <label class="control-label" for="userid">New Category Add</label>
                                                  <!-- Text input-->
                                                  <div class="control-group">
                                                      <div class="controls">
                                                        <input required=""  id="category_name" type="text" class="form-control input-medium" placeholder="Name">
                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                  <div class="controls">
                                                    <textarea  id="category_description" type="text" class="form-control input-medium" placeholder="Decription"></textarea>
                                                </div>
                                            </div>                    
                                            <!-- Button -->
                                            <div class="control-group">
                                              <label class="control-label" for="signin"></label>
                                              <div class="controls pull-right" >
                                                <button id="category_save" type="submit" name="save" data-dismiss="modal" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>

                            </div>
                        </div>            

                    </div>
                </div>
            </div>
            <!-- model box end -->

             <!-- Modal -->
                            <div class="modal fade export" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <br>
                                    <div class="modal-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="export">
                                                <fieldset>
                                                    <!-- Sign In Form -->
                                                    <form action="<?php $base_url ?>import_excel_edm_contact" method="post" enctype="multipart/form-data" >
                                                    <div class="control-group">
                                                  <label class="control-label" for="userid">Eport Excel</label>
                                                  <!-- Text input-->
                                                  <div class="control-group">
                                                      <div class="controls">
                                                        <input required=""  name="export_category_name" type="text" class="form-control input-medium" placeholder="category_name">
                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                  <div class="controls">
                                                    <input required=""  name="export_excel_file" type="file" class="form-control input-medium" >
                                                </div>
                                            </div>                    
                                            <!-- Button -->
                                            <div class="control-group">
                                              <label class="control-label" for="signin"></label>
                                              <div class="controls pull-right" >
                                                <button id="export_excel" type="submit" name="save"  class="btn btn-success">Export</button>
                                            </div>
                                        </div>
</form>
                                    </fieldset>

                                </div>

                            </div>
                        </div>            

                    </div>
                </div>
            </div>
            <!-- model box end -->
            <div class="ibox-title">
                <h5><?php echo $title; ?> <small>Add</small></h5>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="envelope" href="#signup" data-toggle="modal" data-target=".bs-modal-md">Add Category</button>
                    </div>
                </div>

                <div class="pull-right" style="margin-right:2px">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="envelope" href="#export" data-toggle="modal" data-target=".export">Export Excel</button>
                    </div>
                </div>

            </div>
            <div class="ibox-content">
                <div class="row">


<form action="" method="POST">
                    <div class="col-md-12 b-r"> 
                        <div class="form-group">     
                            <select required class="form-control" id="category" name="category_name">
                                <option value="">Category</option>
                                <?php
                                foreach ($category as $row) {
                                    echo '<option value="' . $row->category_id . '">' . $row->category_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
<div id="divs">
                    <div id="fdiv0" class="col-md-12 b-r">                                                              
                        <div class="form-group col-md-2">                                                    
                            <input required type="text" name="F_Name[]" placeholder="Full Name" class="form-control">                   
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="edm_gender[]">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>                                               
                        </div>
                        <div class="form-group col-md-2">
                            <select name="Nationality[]"  class="form-control">
                             <option value="">Nationality</option>
                             <?php
                             foreach ($nationality as $row) {
                                echo '<option value="' . $row->nationality . '">' . $row->nationality . '</option>';
                            }
                            ?>                                                    
                        </select>
                    </div>                    
                    <div class="form-group col-md-2">                                                   
                        <input required type="text" name="phone[]" placeholder="Enter Phone" class="form-control">
                    </div>
                    <div class="form-group col-md-2">                                                   
                        <input required type="email" name="email[]" placeholder="Enter Email" class="form-control">
                    </div>   
                    <div class="col-md-2" id="btns0">
                        <button type="button" class="btn btn-sm btn-primary" onclick="copypaste(0)"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        
                    </div>                           
                </div> 
</div>
     <div class="col-md-1">
                        <button class="btn btn-sm btn-primary pull-right" type="submit" name="save">Save</button>
                    </div> 
</form>
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

        $('#category_save').on('click',function(){
            var cat=$('#category_name').val();
            var des=$('#category_description').val();
            $.ajax({
                type: "POST",
                url: "edm_add_category",
                async: false,
                data: {cat:cat,des:des},
                success: function (response) {
                 $('#category').html('');
                 $('#category').append(response);
                 $('.bs-modal-md').hide();
                 setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('Done','Category Added');

                }, 1300);    
                 $('#category_name').val('');
                 $('#category_description').val('');  
             }
         });
        });

    });
function copypaste(id)
{
    var nid=id+1;
    console.log(nid);
    var btn1="<button type='button' onclick='remove("+id+")' class='btn btn-sm btn-danger'><i class='fa fa-minus-square' aria-hidden='true'></i></button>";
    var btn2="<button type='button' onclick='copypaste("+nid+")' class='btn btn-sm btn-primary'><i class='fa fa-plus-square' aria-hidden='true'></i></button>";
    $("#btns"+id).children().remove();
    var newELem = $( "#fdiv"+id ).clone();
    newELem.attr('id','fdiv'+nid);
    $("#btns"+id).attr('id','btns');
    newELem.appendTo("#divs");
    $("#btns"+id).attr('id','btns'+nid);
    $("#btns").attr('id','btns'+id);
    $("#btns"+id).append(btn1);
    $("#btns"+nid).append(btn2);
}
function remove(id)
{
$( "#fdiv"+id ).remove();
}
</script>
</body>
</html>
