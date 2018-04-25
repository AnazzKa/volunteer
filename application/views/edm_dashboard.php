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
    <link href="<?php $base_url; ?>assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

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
                                <h5><?php echo $title; ?></h5>                        
                            </div>

                            <div class="ibox-content col-md-12">   
                               <!-- <div class="col-md-3"> 
                                   <a href="<?php $base_url; ?>edm"> <h5>Total Edm Contact</h5></a>
                                   <span class="label label-primary"><?php // echo  count($volunteer)+count($contacts)+count($appointment)+count($seminar_registration)+count($epilepsy_masterclass)+count($acyanotic_heart_disease)+count($edmlist); ?></span>
                               </div>
                               <div class="form-group col-md-3">                                    
                                 <a href="<?php $base_url ?>volunteer_view"><h5>Volunteer</h5></a>
                                 <span class="label label-primary"><?php // echo count($volunteer); ?></span>
                             </div>
                             <div class="form-group col-md-3">                                    
                               <a href="<?php $base_url ?>contact"> <h5>Contact</h5></a>
                               <span class="label label-primary"><?php // echo count($contacts); ?></span>
                           </div>
                           <div class="form-group col-md-3">                                                    
                             <a href="<?php $base_url ?>appointment"><h5>Appoinment</h5></a>
                             <span class="label label-primary"><?php // echo count($appointment); ?></span>
                         </div>
                         <div class="form-group col-md-3">                                                  
                           <a href="<?php $base_url ?>seminar_registration"> <h5>Seminar Registration English</h5></a>
                           <span class="label label-primary"><?php // echo count($seminar_registration); ?></span>
                       </div>
                       <div class="form-group col-md-3">                                                
                           <a href="<?php $base_url ?>epilepsy_masterclass"> <h5>Epilepsy Masterclass Registration</h5></a>
                           <span class="label label-primary"><?php // echo count($epilepsy_masterclass); ?></span>
                       </div>
                       <div class="form-group col-md-3">                                                    
                           <a href="<?php $base_url ?>acyanotic_heart_disease"> <h5>Acyanotic Heart Disease Seminar</h5></a>
                           <span class="label label-primary"><?php // echo count($acyanotic_heart_disease); ?></span>
                       </div>
                       <div class="form-group col-md-3">                                                    
                        <a href="<?php $base_url; ?>edm"> <h5>Edm Contact</h5></a>
                        <span class="label label-primary"><?php // echo count($edmlist); ?></span>
                    </div>
                    <div class="form-group col-md-3">                                                    
                        <a href="<?php $base_url ?>campaign"> <h5>Campaign</h5></a>
                        <span class="label label-primary"><?php // echo count($campaign_cnt); ?></span>
                    </div> -->
                    <div class="form-group col-md-4">
                        <div id="morris-donut-chart" ></div>
                    </div>
                    <div class="form-group col-md-3">
                        <div id="morris-donut-chart1" ></div>
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

<script type="text/javascript">
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{ label: "Total Edm Contact", value: <?php echo  count($volunteer)+count($contacts)+count($appointment)+count($seminar_registration)+count($epilepsy_masterclass)+count($acyanotic_heart_disease)+count($edmlist); ?> },
        { label: "Volunteer", value: <?php echo count($volunteer); ?> },
        { label: "Contact", value: <?php echo count($contacts); ?> } ,
        { label: "Appoinment", value: <?php echo count($appointment); ?> } ,
        { label: "Seminar English", value: <?php echo count($seminar_registration); ?> } ,
        { label: "Epilepsy ", value: <?php echo count($epilepsy_masterclass); ?> } ,
        { label: "Acyanotic", value: <?php echo count($acyanotic_heart_disease); ?> } ,
        { label: "Edm Contact", value: <?php echo count($edmlist); ?> } ,
        { label: "Campaign", value: <?php echo count($campaign_cnt); ?> } ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4','#1ab394'],
    });
    Morris.Donut({
        element: 'morris-donut-chart1',
        data: [{ label: "Total Mail", value: <?php echo  $total_mail[0]->cnt; ?> },
        { label: "Rejected", value: <?php echo $rejected[0]->cnt; ?> },
        { label: "Delivered", value: <?php echo $delivered[0]->cnt; ?> }  ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4','#1ab394'],
    });
</script>

</body>
</html>
