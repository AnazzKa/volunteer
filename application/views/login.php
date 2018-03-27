<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Al Jalila | Login</title>
        <link href="<?php $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php $base_url; ?>assets/css/style.css" rel="stylesheet">
    </head>
    <body class="gray-bg" style="background: rgba(40,110,124,1);
background: -moz-linear-gradient(top, rgba(40,110,124,1) 0%, rgba(255,255,255,0.22) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(40,110,124,1)), color-stop(100%, rgba(255,255,255,0.22)));
background: -webkit-linear-gradient(top, rgba(40,110,124,1) 0%, rgba(255,255,255,0.22) 100%);
background: -o-linear-gradient(top, rgba(40,110,124,1) 0%, rgba(255,255,255,0.22) 100%);
background: -ms-linear-gradient(top, rgba(40,110,124,1) 0%, rgba(255,255,255,0.22) 100%);
background: linear-gradient(to bottom, rgba(40,110,124,1) 0%, rgba(255,255,255,0.22) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#286e7c', endColorstr='#ffffff', GradientType=0 );">
        <div style="margin:20px auto; width: 50%;">
            <center><img  src="<?php $base_url ?>assets/img/logo-top.png" ></center>
            </div>
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>   
                             
                <h3>Welcome to Al Jalila Childrens</h3>

                <p>Login in. To see it in action.</p>
                <br />
                <?php echo $msg; ?>
                <form class="m-t" role="form" method="post" action="<?php $base_url; ?>do_login">
<!--                    <div class="form-group">
                        <select class="form-control" name="roll"  required="">
                            <option value="1">Super Admin</option>
                            <option value="2">Users</option>
                        </select>
                    </div>-->
                    <div class="form-group">
                        <input type="email" name="username" class="form-control" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                </form>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="<?php $base_url; ?>assets/js/jquery-2.1.1.js"></script>
        <script src="<?php $base_url; ?>assets/js/bootstrap.min.js"></script>
    </body>
</html>
