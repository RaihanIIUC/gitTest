<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
    header('location:logout.php');
} else{
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $cost1 = $_POST['cost1'];
        $cost2 = $_POST['cost2'];
        $cost3 = $_POST['cost3'];
        $cost4 = $_POST['cost4'];

        $sql="update tblcost set cost1=:cost1,cost2=:cost2,cost3=:cost3,cost4=:cost4 where id=:id";
        $query=$dbh->prepare($sql);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->bindParam(':cost1',$cost1,PDO::PARAM_STR);
        $query->bindParam(':cost2',$cost2,PDO::PARAM_STR);
        $query->bindParam(':cost3',$cost3,PDO::PARAM_STR);
        $query->bindParam(':cost4',$cost4,PDO::PARAM_STR);
        $totalview =  $query->execute();

        if ($totalview) {
            echo '<script>alert("Cost has been Updated.")</script>';
            echo "<script>window.location.href ='manage-personal-cost.php'</script>";
        }
        else
        {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }


    }

    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Client Management Sysytem|| Add Clients</title>

        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
        <!-- lined-icons -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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

                <?php include_once('includes/header.php');?>
                <!--//outer-wp-->
                <div class="outter-wp">
                    <!--/sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Add Clients</li>
                        </ol>
                    </div>
                    <!--/sub-heard-part-->
                    <!--/forms-->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Add Clients </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post">
                                    <div class="container">
                                        <!-- Title -->
                                        <div class="hk-pg-header">
                                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Add Company</h4>
                                        </div>
                                        <!-- /Title -->

                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <section class="hk-sec-wrapper">

                                                    <div class="row">
                                                        <div class="col-sm">



                                                            <form class="needs-validation" method="post" novalidate>
                                                                <?php
                                                                $id = $_GET['id'];
                                                                $sql="select * from tblcost where id = :id";
                                                                $query = $dbh -> prepare($sql);
                                                                $query->bindParam(':id',$id,PDO::PARAM_STR);
                                                                $query->execute();
                                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt=1;
                                                                if($query->rowCount() > 0)
                                                                {
                                                                foreach($results as $row32) { ?>
                                                                <div class="form-row">
                                                                    <div class="col-md-6 mb-10">
                                                                        <input type="hidden" class="form-control" id="validationCustom031" value="<?php echo $row32->id;?>" name="id" required>
                                                                    </div>
                                                                    <div class="col-md-6 mb-10">
                                                                        <label for="validationCustom031">Bus Rent</label>
                                                                        <input type="number" class="form-control" id="validationCustom031" value="<?php echo $row32->cost1;?>" name="cost1" required>
                                                                        <div class="invalid-feedback">Please provide a valid Bus Rent.</div>
                                                                    </div>

                                                                    <div class="col-md-6 mb-10">
                                                                        <label for="validationCustom032">private Rent</label>
                                                                        <input type="number" class="form-control" id="validationCustom032" value="<?php echo $row32->cost2;?>" name="cost2" required>
                                                                        <div class="invalid-feedback">Please provide a valid private Rent.</div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-10">
                                                                        <label for="validationCustom033">Storage Rent</label>
                                                                        <input type="number" class="form-control" id="validationCustom033" value="<?php echo $row32->cost3;?>" name="cost3" required>
                                                                        <div class="invalid-feedback">Please provide a valid Storage Rent.</div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-10">
                                                                        <label for="validationCustom034">Transport Rent</label>
                                                                        <input type="number" class="form-control" id="validationCustom034" value="<?php echo $row32->cost4;?>" name="cost4" required>
                                                                        <div class="invalid-feedback">Please provide a valid Transport Rent.</div>
                                                                    </div>


                                                                </div>


                                                                <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                                                    <?php
                                                                }
                                                                } ?>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </section>



                                            </div>
                                        </div>
                                    </div>
                                    <?php include_once('includes/footer.php');?>
                            </div>
                        </div>
                        <?php include_once('includes/sidebar.php');?>
                        <div class="clearfix"></div>
                    </div>
                    <script>
                        var toggle = true;

                        $(".sidebar-icon").click(function() {
                            if (toggle)
                            {
                                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                                $("#menu span").css({"position":"absolute"});
                            }
                            else
                            {
                                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                                setTimeout(function() {
                                    $("#menu span").css({"position":"relative"});
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
<?php }  ?>