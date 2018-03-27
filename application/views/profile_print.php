<html>
    <head></head>
    <body onload="window.print()">
        <!--<body>-->
    <center>
        <h2 style="color: #115E6E">
            <?php echo $volunteer[0]->firstname . " " . $volunteer[0]->middlename . " " . $volunteer[0]->lastname; ?>
        </h2>
    </center>
    <center>
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
        <img height="50%" class="pull-left" src="<?php echo $emirates_id; ?>" >
        <img height="50%" class="pull-left" src="<?php echo $passport_copy; ?>" >
    </center>
    <center><h3 style="color: #115E6E">Super Power -- <?php echo $volunteer[0]->superpower; ?></h3></center>
    <table width="100%" style="padding-left:10%">
        <tr>
            <td><h3 style="color: #115E6E">Basic Details</h3></td>
        </tr>
        <tr>
            <td><h4><span style="color: #115E6E">Gender : </span><?php echo $volunteer[0]->gender; ?></h4></td>
            <td><h4><span style="color: #115E6E">DOB : </span><?php
                    $dat = $volunteer[0]->birthday;
                    $arr = explode("-", $dat);
                    echo $arr[0] . "-" . $arr[1] . "-" . $arr[2];
                    ?></h4></td>
            <td><h4><span style="color: #115E6E">Age : </span><?php $d = $volunteer[0]->birthday;
                    echo date_diff(date_create($d), date_create('today'))->y;
                    ?></h4></td>
        </tr>
        <tr>
            <td><h4><span style="color: #115E6E">Nationality : </span><?php echo $volunteer[0]->nationality; ?></h4></td>
            <td><h4><span style="color: #115E6E">Date & Time : </span><?php echo $volunteer[0]->time; ?></h4></td>
            <td><h4><span style="color: #115E6E">About Jalila : </span><?php echo $volunteer[0]->about_jalila; ?></h4></td>
        </tr>
        <tr>
            <td><h4 style="color: #115E6E"> Contact Details</h4></td>
        </tr>
        <tr>
            <td><h4><span style="color: #115E6E">Email : </span><?php echo $volunteer[0]->email; ?></h4></td>
            <td><h4><span style="color: #115E6E">Phone : </span><?php echo $volunteer[0]->phone; ?></h4></td>
        </tr>

    </table>










</body>
</html>