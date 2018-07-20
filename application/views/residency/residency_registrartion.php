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

                                        <div class="form-group col-md-4">                                    
                                            <button class="btn btn-primary" id="envelope" href="#signup" data-toggle="modal" data-target=".bs-modal-md"><i class="fa fa-envelope"></i></button>
                                        </div>

                                        <div class="modal fade bs-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <br>
                                    <div class="modal-body">
                                        <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade active in" id="signin">
                                                <form class="form-horizontal" method="post" action="appliying_application_mail_send">
                                                    <fieldset>
                                                        <!-- Sign In Form -->
                                                        <div class="control-group">
                                                          <label>To : </label>
<span class="emails"></span>
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
                                                        <textarea required="" id="messageinput" name="messageinput" class="form-control input-medium" placeholder="Message"></textarea>
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
                                    </div>
                            <div class="ibox-content col-md-12">
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive" >
                                            <table class="table dataTables-example" id="example">
                                                <thead style="background-color:#115E6E;color:#ffff;">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>                 
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
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

                    var lbl="";
                    var table = $('#example').DataTable();        
                    $.ajax({type: "POST",url: "<?php $base_url ?>get_all_residency_registrartion",data:{}, success: function(result){
              //console.log(result);
             var res=JSON.parse(result);
             table.rows.add(res).draw();
             table.rows().eq(0).each( function ( index ) {
    var row = table.row( index );
    var data = row.data();
 lbl+=" <i>"+data[3]+"</i> , ";
} );
$('.emails').html(lbl);
         }
     });

    });
 
            </script>

        </body>
        </html>
