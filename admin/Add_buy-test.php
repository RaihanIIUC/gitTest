<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $cost1 = $_POST['cost1'];
        $cost2 = $_POST['cost2'];
        $cost3 = $_POST['cost3'];
        $cost4 = $_POST['cost4'];
        $total = $cost1 + $cost2 + $cost3 + $cost4;

        $totalsumquery = "SELECT id,total,(SELECT SUM(total) from tblcost cost WHERE cost.id <=costin.id)as totalsum FROM tblcost costin ORDER BY id;";
        $query = $dbh->prepare($totalsumquery);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $row320) {

                $totalsum = $row320->totalsum;
                echo $totalsum;
            }
        }

        $query = "insert into tblcost(cost1,cost2,cost3,cost4,totalsum,total) values('$cost1','$cost2','$cost3','$cost4','$total','$totalsum')";
        $query = $dbh->prepare($query);
        $query->bindParam(':acctid', $acctid, PDO::PARAM_STR);
        $query->bindParam(':cost1', $cost1, PDO::PARAM_STR);
        $query->bindParam(':cost2', $cost2, PDO::PARAM_STR);
        $query->bindParam(':cost3', $cost3, PDO::PARAM_STR);
        $query->bindParam(':cost4', $cost4, PDO::PARAM_STR);
//        $query->bindParam(':totalsum',$totalsum,PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $totalview = $query->execute();

        if ($totalview) {
            echo '<script>alert("Cost has been added.")</script>';
            echo "<script>window.location.href ='add-total-cost.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }


    }

    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Ms Plate Business Management Sysytem|| Add Buying History</title>

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
        <!--clock init-->
        <script src="js/css3clock.js"></script>
        <!--Easy Pie Chart-->
        <!--skycons-icons-->
        <script src="js/skycons.js"></script>
        <!--//skycons-icons-->
    </head>
    <body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="inner-content">

                <?php include_once('includes/header.php'); ?>
                <!--//outer-wp-->
                <div class="outter-wp">
                    <!--/sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Add Buying History</li>
                        </ol>
                    </div>
                    <!--/sub-heard-part-->
                    <!--/forms-->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Add Buying History </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post">
                                    <div class="container">
                                        <!-- Title -->
                                        <div class="hk-pg-header">
                                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                                                            class="feather-icon"><i
                                                                data-feather="external-link"></i></span></span>History
                                            </h4>
                                        </div>
                                        <!-- /Title -->

                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <section class="hk-sec-wrapper">

                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <form class="needs-validation" method="post" novalidate>
                                                        </div>


                                                    </div>

                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom033">Product Name </label>
                                                        <textarea class="form-control"
                                                                  id="validationCustom033"
                                                                  placeholder="Please Enter the Product name"
                                                                  name="cost4" rows="2" cols="20"
                                                                  required></textarea>

                                                    </div>

                                                    <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom032">Buying in Kg</label>
                                                <input type="number" class="form-control"
                                                       id="validationCustom032"
                                                       placeholder="Product in kg" name="cost2"
                                                       required>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom033">Buying Price</label>
                                                <input type="number" class="form-control"
                                                       id="validationCustom033"
                                                       placeholder="Tottal Price of the whole product" name="cost3"
                                                       required>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>


                                            <button class="btn btn-primary" type="submit"
                                                    name="submit">Submit
                                            </button>
                                </form>
                            </div>
                        </div>
                        </section>


                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <?php include_once('includes/sidebar.php'); ?>
    <div class="clearfix"></div>
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function () {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position": "absolute"});
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function () {
                    $("#menu span").css({"position": "relative"});
                }, 400);
            }

            toggle = !toggle;
        });
    </script>
    <!--js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
<?php } ?>
