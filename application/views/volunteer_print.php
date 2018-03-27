<html>
    <head></head>
    <body onload="window.print()">
    <!--<body>-->
        <table >
            <tr>
                <th>Sl</th>
                <th style="width:90px">Date</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Nationality</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Super Power</th>
            </tr>
            <?php
            $cnt = 0;
            foreach ($volunteer as $row) {
                $cnt++;
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php
                        $dat = $row->time;
                        $arr = explode("-", $dat);
                        $aarr = explode(" ", $arr[2]);
                        echo $aarr[0]."-".$arr[1]."-".$arr[0]
                        ?></td>
                    <td><?php echo $row->firstname; ?></td>                    
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo $row->nationality; ?></td>
                    <td><?php echo $row->phone; ?></td>
                    <td><?php echo $row->email; ?></td>                    
                    <td><?php echo $row->superpower; ?></td>                                                            
                </tr>   
            <?php } ?>
        </table>
        <style>
            table {
    border-collapse: collapse;
}
            table, th, td {
   border: 1px solid black;
}
        </style>
    </body>
    
</html>