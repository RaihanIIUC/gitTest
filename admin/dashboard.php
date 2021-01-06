<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
    header('location:logout.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>MS Plate Business Management System||Dashboard</title>

    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
          type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css'/>
    <!-- //lined-icons -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script src="js/light.js"></script>
    <script src="js/radar.js"></script>
    <link href="css/barChart.css" rel='stylesheet' type='text/css'/>
    <link href="css/fabochart.css" rel='stylesheet' type='text/css'/>
    <!--clock init-->
    <script src="js/css3clock.js"></script>
    <!--Easy Pie Chart-->
    <!--skycons-icons-->
    <script src="js/skycons.js"></script>

    <script src="js/jquery.easydropdown.js"></script>

    <!--//skycons-icons-->
</head>
<body>
<div class="page-container">
    <!--/content-inner-->
    <div class="left-content">
        <div class="inner-content">

            <?php include_once('includes/header.php'); ?>

            <div class="outter-wp">
                <!--custom-widgets-->
                <div class="custom-widgets">
                    <div class="row-one">
                        <div class="col-md-4 widget">
                            <div class="stats-left ">
                                <?php
                                $sql = "SELECT ID from tblclient ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $tclients = $query->rowCount();
                                ?>
                                <h5>Total</h5>
                                <h4> Product</h4>
                            </div>
                            <div class="stats-right">
                                <label><?php echo htmlentities($tclients); ?></label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 widget states-mdl">
                            <div class="stats-left">
                                <?php
                                $sql = "select * from tblcost order by PostingDate desc";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                foreach ($results

                                as $row32) { ?>

                                    <?php
                                    $add = $row32->cost1 + $row32->cost2;
                                    $substract = $add - $row32->cost3;
                                    $sum1 = $substract;
                                    for ($j = 1; $j <= 1; $j++) {

                                        $sum += $sum1;
                                    }
                                    ?>
                                <?php };?>
                                <h5>Cash</h5>
                                <h3>On my hand($)</h3>
                            </div>
                            <div class="stats-right">
                                <label>
                                    <?php echo $sum;?>
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php

                        } ?>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <div class="table">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Buying_price</th>
                        <th>Product_Amount</th>
                        <th>Per_kg_sell_Price</th>
                        <th>Sell_kg</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "select distinct tblclient.pname,tblclient.kg,tblclient.perprice,
                            tblinvoice.BillingId,tblinvoice.perprice as sellprice,tblinvoice.PostingDate,tblinvoice.kg as bkg,tblinvoice.Userid
                            
                            ,sum(tblinvoice.kg) as skg,sum(tblinvoice.perprice) as tprice
                             from  tblclient   
	                        join tblinvoice
	                         on tblclient.ID=tblinvoice.Userid  
	                         GROUP BY tblinvoice.Userid desc";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) { ?>
                            <tr class="active">
                                <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                <td><?php echo htmlentities($row->pname); ?></td>
                                <td><?php echo htmlentities($row->perprice); ?></td>
                                <td><?php echo htmlentities($row->kg); ?></td>
                                <td><?php
                                    $price = $row->perprice;
                                    $n = $row->kg;
                                    $per_price = ceil($price / $n);
                                    echo $per_price;

                                    ?></td>
                                <td><?php echo $row->skg; ?></td>

                                <td>
                                    <!--                     <a href="view-invoice.php?invoiceid=<?php /*echo $row->BillingId; */ ?>">View</a>-->

                                    <a href="add-client-services.php?addid=<?php echo $row->Userid; ?>">Edit</a>
                                    ||
                                    <a href="invoices.php?del=<?php echo $row->BillingId; ?>"
                                       data-toggle="tooltip" data-original-title="Delete"
                                       onclick="return confirm('Do you really want to delete?');">del</a>

                                </td>
                            </tr>
                            <?php $cnt = $cnt + 1;
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-5">

            </div>

        </div>
    </div>

</div>


<!--//content-inner-->
<?php include_once('includes/sidebar.php'); ?>

<script>
    var toggle = true;

    $(".sidebar-icon").click(function () {
        if (toggle) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position": "absolute"});
        }
        else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function () {
                $("#menu span").css({"position": "relative"});
            }, 400);
        }

        toggle = !toggle;
    });

</script>
<!--js -->
<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>