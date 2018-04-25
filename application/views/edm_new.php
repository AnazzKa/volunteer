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
                            </div>
                            <div class="ibox-content col-md-12">
                                <form role="form" id="form_search" method="post">


                                    <div class="form-group col-md-2">      
                                        <select   id="category" class="form-control">                                            
                                                <option value="">All Type</option>
                                                <option value="General">General</option>
                                                <option value="edmlist">EDM LIST</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">                                    
                                            <select  id="type" class="form-control">
                                                <option value="">Category</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">                                    
                                            <!--<select onchange="this.form.submit()"  name="gender" class="form-control">-->
                                                <select id="gender"  name="gender" class="form-control">
                                                    <option <?php if ($s_gender == '') { ?>selected<?php } ?> value="">Gender</option>
                                                    <option <?php if ($s_gender == 'male') { ?>selected<?php } ?> value="male">Male</option>
                                                    <option <?php if ($s_gender == 'female') { ?>selected<?php } ?> value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">                                                    
                                                <select id="nationality" name="nationality" class="form-control">
                                                    <option value="">Nationality</option>
                                                    <?php foreach ($nationality as $row) { ?>
                                                    <option <?php if ($s_nationality == $row->nationality) { ?>selected<?php } ?> value="<?php echo $row->nationality ?>"><?php echo $row->nationality ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </form>
                                        <div class="form-group col-md-1">                                    
                                            <!-- <button class="btn btn-primary" id="envelope" href="#signup" data-toggle="modal" data-target=".bs-modal-md"><i class="fa fa-envelope"></i></button> -->
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive" >
                                            <table class="table dataTables-example" id="example">
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
                    var table = $('#example').DataTable();        
                    $.ajax({type: "POST",url: "<?php $base_url ?>get_all_edm_data",data:{cat:'',type:''}, success: function(result){
             // console.log(result);
             var res=JSON.parse(result);
             table.rows.add(res).draw();
         }
     });

 $('#gender').change( function() {
    var val=this.value;
    if(val!='')
     table.columns(2).search("^" +val+ "$", true, false, true).draw();
 else
    table.columns(2).search(this.value).draw();
    } );

     $('#nationality').change( function() {
     table.columns(3).search(this.value).draw();
    } );
     $('#category').change( function() {
     $.ajax({type: "POST",url: "<?php $base_url ?>get_category_options", data :{id:this.value}, success: function(result){
     $('#type option').remove();
     $('#type').append(result);
     }});
    $.ajax({type: "POST",url: "<?php $base_url ?>get_all_edm_data", data :{cat:this.value,type:''}, success: function(result){
              console.log(result);
             var res=JSON.parse(result);
             table.clear().draw();
             table.rows.add(res).draw();
         }
     });

    } );
     
      $('#type').change( function() {
        var cat =$("#category option:selected").val();       
$.ajax({type: "POST",url: "<?php $base_url ?>get_all_edm_data", data :{cat:cat,type:this.value}, success: function(result){
              console.log(result);
             var res=JSON.parse(result);
             table.clear().draw();
             table.rows.add(res).draw();
         }
     });
    } );
            


                });
 
            </script>

        </body>
        </html>
