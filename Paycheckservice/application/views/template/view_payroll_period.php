<!---Display payroll period--->
<body>
    <div>
        <div class="jumbotron"><h3 style="color: BLUE;"><i class="fa fa-calendar" style="font-size:80px; color:BLUE;"></i><?php echo $period; ?></h3></div>
        <div>
            <table style="width:900px;" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SSN</th>
                        <th>Rate</th>
                        <th>Hours</th>
                        <th>Pre-Tax Earnings</th>
                        <th>Fed</th>
                        <th>State</th>
                        <th>SOS/MED</th>
                        <th>After-Tax Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    <!---get hourly rate and hours worked--Calculate tax and wages---> 
                <?php
                    $total_week = "";
                    $total_month ="";
                    $total_cost = "";
                    $total_ftax = "";
                    $total_stax = "";
                    $total_otax = "";
                    foreach ($data as $val)
                    {
                        ?>
                            <tr>
                                <td><?php echo $val['Firstname'].' '. $val['Lastname']; ?></td>
                                <td><?php echo $val['SSN']; ?></td>
                                <td><?php echo $val['Hour_rate']; ?></td>
                                <td><?php echo $val['Hours']; ?></td>
                                <td><?php echo $pay = $val['Hour_rate']*$val['Hours']; ?></td>
                                <td><?php echo $f = $pay*($f_tax/100); ?></td>
                                <td><?php echo $s = $pay*($s_tax/100); ?></td>
                                <td><?php echo $o = $pay*($o_tax/100); ?></td>
                                <td><?php echo $wages = $pay-$f-$s-$o; ?></td>
                            </tr>
                        <?php
                        $total_week = $total_week + $wages;
                        $total_ftax = $total_ftax + $f;
                        $total_stax = $total_stax + $s;
                        $total_otax = $total_otax + $o;
                        
                    }
                ?>
                </tbody>
            </table>
            <table style="margin-top:50px;">
                <tr>
                    <th>Total Weekly Salary</th><td style="background-color:grey;"><?php echo $total_week; ?></td>
                </tr>
                <tr>
                    <th>Total Fed. Witholdings</th><td style="background-color:red;"><?php echo $total_ftax; ?></td>
                </tr>
                <tr>
                    <th>Total State Witholdings</th><td style="background-color:green;"><?php echo $total_stax; ?></td>
                </tr>
                <tr>
                    <th>Total SOS/MED Witholdings</th><td style="background-color:yellow;"><?php echo $total_otax; ?></td>
                </tr>
           </table>
            
            <div style="margin-top: 12px; ">
                <form method="POST" action="delete_payroll_period">
                    <input type="hidden" value="<?php echo $period; ?>" name="period">
                    <input  class="btn btn-info" type="submit" name="delete" value="DELETE">
                </form>
            </div>
        </div>
    </div>
</body>
