<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('head'); ?>
        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">
        <script src="<?php $base_url; ?>assets/time_ago.js"></script>
   
    </head>
    <body>

        <style>

        </style>
    </style>
    <div id="wrapper">
        <?php $this->load->view('menu'); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php $this->load->view('header'); ?>
            <div class="wrapper wrapper-content">
                <div class="row animated fadeInRight">
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

<?php if(!empty($volunteer)){ ?>

                    <div class="col-md-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo $volunteer[0]->firstname . " " . $volunteer[0]->middlename . " " . $volunteer[0]->lastname; ?></h5>
                                <span class="pull-right">
                                    <?php if ($volunteer[0]->star_rate == 2.5) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                                    <?php } ?>
                                    <?php if ($volunteer[0]->star_rate == 3) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                                    <?php } ?>
                                    <?php if ($volunteer[0]->star_rate == 3.5) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php } ?>
                                    <?php if ($volunteer[0]->star_rate == 4) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php } ?>
                                    <?php if ($volunteer[0]->star_rate == 4.5) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>

                                    <?php } ?>
                                    <?php if ($volunteer[0]->star_rate == 5) { ?>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                    <?php } ?>
                                </span>
                            </div>
                            <!--<div class="ibox-content">-->
                            <div class="lightBoxGallery">
                                <?php
                                if ($volunteer[0]->emirates_id != "")
                                    $emirates_id = $volunteer[0]->emirates_id;
                                else
                                    $emirates_id = "assets/img/noimage.jpg";
                                if ($volunteer[0]->passport_copy != "")
                                    $passport_copy = $volunteer[0]->passport_copy;
                                else
                                    $passport_copy = "assets/img/noimage.jpg";
                                ?>
                                <a href="<?php echo $emirates_id; ?>"  data-gallery=""> 
                                    <img alt="image" style="height:250px" class="img-responsive pull-left"  src="<?php echo $emirates_id; ?>"></a>                       
                                <a href="<?php echo $passport_copy; ?>"  data-gallery="">
                                    <img alt="image" style="height:250px"  class="img-responsive pull-left" src="<?php echo $passport_copy; ?>"></a>
                                <div id="blueimp-gallery" class="blueimp-gallery">
                                    <div class="slides" style="width:700px; height:600px;"></div>
                                    <h3 class="title"></h3>
                                    <a class="prev">‹</a>
                                    <a class="next">›</a>
                                    <a class="close">×</a>
                                    <a class="play-pause"></a>
                                    <ol class="indicator"></ol>
                                </div>
                            </div>
                            <!--</div>-->
                            <style>
                                .watermark {
                                    position: absolute;
                                    opacity: 0.25;
                                    font-size: 3em;
                                    width: 50%;
                                    text-align: center;
                                    z-index: 0;
                                    color: red;
                                    transform: rotate(300deg);
                                    -webkit-transform: rotate(360deg);
                                    padding-top: 15%;
                                    padding-left: 25%;
                                }
                            </style>

                            <div class="ibox-content profile-content">
                                <?php
                                if ($volunteer[0]->seleted_or_not == 0) {
                                    $watermark = "";
                                    $reminder = $volunteer[0]->reminder_nu;
                                }
                                if ($volunteer[0]->seleted_or_not == 1) {
                                    $watermark = "<img src='assets/img/pro_1.png' width='50%' height='50%'>";
                                    $reminder = $volunteer[0]->reminder_ap;
                                }
                                if ($volunteer[0]->seleted_or_not == 2) {
                                    $watermark = "<img src='assets/img/pro_2.jpg' width='50%' height='50%'>";
                                    $reminder = $volunteer[0]->reminder_cl;
                                }
                                if ($volunteer[0]->seleted_or_not == 3) {
                                    $watermark = "<img src='assets/img/pro_3.jpg' width='50%' height='50%'>";
                                    $reminder = $volunteer[0]->reminder_in;
                                }
                                ?>
                                <div class="watermark">
                                    <?php echo $watermark ?>
                                </div>

                                <center><h4><strong><span style="color:#115E6E">Super Power</span> -- <span><?php echo $volunteer[0]->superpower; ?></span></strong></h4></center>
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $volunteer[0]->id ?>" name="volunteer_id" >                                                                        
                                    <select style="margin-left:2px" onchange="this.form.submit()" name="status" class="btn btn-primary pull-right">
                                        <option <?php if ($volunteer[0]->seleted_or_not == 0) { ?>selected <?php } ?> value="0">Status</option>
                                        <?php if ($this->session->userdata('designation_id') == 1 || $this->session->userdata('designation_id') == 0) { ?>
                                            <option <?php if ($volunteer[0]->seleted_or_not == 1) { ?>selected <?php } ?> value="1">Approved</option>
                                        <?php } if ($this->session->userdata('designation_id') == 2 || $this->session->userdata('designation_id') == 0) { ?>
                                            <option <?php if ($volunteer[0]->seleted_or_not == 2) { ?>selected <?php } ?> value="2">Active</option>
                                        <?php } if ($this->session->userdata('designation_id') == 0) { ?>
                                            <option <?php if ($volunteer[0]->seleted_or_not == 3) { ?>selected <?php } ?> value="3">InActive</option>
                                        <?php } ?>
                                    </select> 
                                    
                                    <a href="<?php $base_url; ?>profile_print?id=<?php $pri_id=$volunteer[0]->id; echo my_simple_crypt($pri_id,'e'); ?>" target="_blank" > 
                                        <button type="button" name="selected" class="btn btn-success pull-right" ><i class="fa fa-print"></i> </button></a>
                                </form>
                                <div class="row m-t-lg" style="padding:10px;">                                   
                                    <h3 style="color:#115E6E"><strong>Basic Details</strong></h3>     
                                    <h5 class="col-md-3 no-padding" style="color: #1a94ab"><strong>Name</strong></h5>
                                    <h5 class="col-md-3">: <?php echo $volunteer[0]->firstname . " " . $volunteer[0]->middlename . " " . $volunteer[0]->lastname; ?></h5>
                                    <h5 class="col-md-3" style="color: #1a94ab"><strong>Gender</strong></h5>
                                    <h5 class="col-md-3">: <?php echo $volunteer[0]->gender; ?></h5>

                                    <h5 class="col-md-3 no-padding" style="color: #1a94ab"><strong>DOB</strong> </h5>
                                    <h5 class="col-md-3">: <?php
                                        $dat = $volunteer[0]->birthday;
                                        $arr = explode("-", $dat);
                                        echo $arr[2] . "-" . $arr[1] . "-" . $arr[0];
                                        ?></h5>

                                    <h5 class="col-md-3" style="color: #1a94ab"><strong>Age</strong></h5> 
                                    <h5 class="col-md-3">: <?php
                                        $d = $volunteer[0]->birthday;
                                        echo date_diff(date_create($d), date_create('today'))->y;
                                        ?></h5>

                                    <h5 class="col-md-3 no-padding" style="color: #1a94ab"><strong>Nationality</strong></h5>
                                    <h5 class="col-md-3">: <?php echo $volunteer[0]->nationality; ?></h5>

                                    <h5 class="col-md-3" style="color: #1a94ab"><strong>Date & Time</strong></h5>
                                    <h5 class="col-md-3">: <?php echo $volunteer[0]->time; ?></h5>

                                    <h5 class="col-md-3 no-padding" style="color: #1a94ab"><strong>About Jalila</strong> </h5>
                                    <h5 class="col-md-3">: <?php echo $volunteer[0]->about_jalila; ?></h5>                                    
                                </div>
                                <div class="row m-t-sm" style="padding:10px">
                                    <h3 style="color:#115E6E;"><strong>Contact Details</strong></h3>                                          

                                    <h5 class="col-md-3 no-padding" style="color: #1a94ab"><strong>Email</strong> </h5>
                                    <h5 class="col-md-3" >: <?php echo $volunteer[0]->email; ?></h5>

                                    <h5 class="col-md-3" style="color: #1a94ab"><strong>Phone</strong> </h5>
                                    <h5 class="col-md-3" style="padding-bottom:3%">: <?php echo $volunteer[0]->phone; ?></h5>
<br>
                                    <!-- <form action="" method="post"> -->
                                        <input type="hidden" value="<?php echo $volunteer[0]->id ?>" name="volunteer_id" >                                                                            <h3  style="color:#115E6E;"> <strong>Notes</strong> </h3>
                                        <textarea placeholder="Notes" name="reminder" id="reminder"  class="form-control" ></textarea>                                        
                                        <input onclick="comments(<?php echo $volunteer[0]->id ?>)" name="rem_btn" value="Save" class="btn btn-primary pull-right" >
                                    <!-- </form> -->

                                </div>
                                <div id="comm">
                                <?php
                                foreach ($comments as $row) {
                                   $user_id=$row->user_id;
                                    $d=$this->users_model->get_single_users($user_id);
                                    
                                    ?>
                                    <div class="feed-element">                                                                           
                                        <div class="media-body ">
                                                                     
                                            <strong><?php echo $d[0]->firstname; ?></strong><br>
                                            <small class="text-muted"><?php echo $row->date; ?></small>
                                            <div class="well">
                                                <?php echo $row->decription; ?>
                                            </div>                                        
                                        </div>
                                    </div>
                                <?php } ?>
</div>


                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">


                    </div>
                </div>
                <?php }else{ ?>
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


            <?php $this->load->view('footer'); ?>
        </div>

        <?php // $this->load->view('chat');  ?>
    </div>

    <?php //$this->load->view('script'); ?>
    <script src="<?php $base_url; ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php $base_url; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php $base_url; ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php $base_url; ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php $base_url; ?>assets/js/inspinia.js"></script>
    <script src="<?php $base_url; ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- blueimp gallery -->
    <script src="<?php $base_url; ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
    <script type="text/javascript">
        function comments(volun) {
            $('#comm').empty();
            var reminder=$('#reminder').val();
            var pro='<?php  echo $_REQUEST['id'];   ?>';
            $.ajax({
        type: "POST",
        url: "<?php $base_url ?>Profile/reminder",
        async: false,
        data: {volun:volun,reminder:reminder,pro:pro},
        success: function (response) {
                //alert(response);
         $('#comm').append(response);
// console.log(response);
$('#reminder').val('');
        }
    });
        }
    </script>
    
</body>
</html>
