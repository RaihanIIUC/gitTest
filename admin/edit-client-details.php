<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $clientmsaid = $_SESSION['clientmsaid'];
        $pname=$_POST['pname'];
        $perprice =$_POST['perprice'];
        $kg=$_POST['kg'];
        $Notes=$_POST['Notes'];

        $sql = "update tblclient set pname=:pname,perprice=:perprice,kg=:kg,Notes=:Notes where ID=:eid";
        $query = $dbh->prepare($sql);
//$query->bindParam(':acctid',$acctid,PDO::PARAM_STR);
        $query->bindParam(':pname', $pname, PDO::PARAM_STR);
        $query->bindParam(':perprice', $perprice, PDO::PARAM_STR);
        $query->bindParam(':kg', $kg, PDO::PARAM_STR);
        $query->bindParam(':Notes', $Notes, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Product detail has been updated")</script>';
        echo "<script type='text/javascript'> document.location ='manage-product.php'; </script>";
    }
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Client Management Sysytem|| Update Clients</title>

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

                <?php //include_once('includes/header.php');?>
                <!--//outer-wp-->
                <div class="outter-wp">
                    <!--/sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Update Clients</li>
                        </ol>
                    </div>
                    <!--/sub-heard-part-->
                    <!--/forms-->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Update Clients </h2>
                        <div class="graph-form">
                            <?php
                            $id = $_GET['editid'];
                            $sql = "SELECT * from tblclient  WHERE  ID = '$id'";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) { ?>
                                    <div class="form-body">
                                        <form method="post">


                                            <div class="form-group"><label for="exampleInputEmail1"></label>Product Name<input
                                                        type="text" name="pname" value="<?php echo $row->pname ;?>"
                                                        class="form-control" required='true'></div>
                                            <div class="form-group"><label for="exampleInputEmail1"></label>Product
                                                Price<input type="text" name="perprice" value="<?php echo $row->perprice ;?>" class="form-control" required='true'></div>
                                            <div class="form-group"><label for="exampleInputEmail1"></label>Product
                                                kg<input type="text" name="kg" value="<?php echo $row->kg ;?>"
                                                         class="form-control" required='true'></div>

                                            <div class="form-group"><label for="exampleInputEmail1">Notes</label>
                                                <textarea type="text" name="Notes" value=""
                                                          class="form-control" required='true' rows="4"
                                                          cols="3"><?php echo $row->Notes ;?></textarea></div>


                                            <button type="submit" class="btn btn-default" name="submit" id="submit">
                                                Save
                                            </button>
                                        </form>
                                    </div>
                                    <?php
                                }
                            } ?>
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
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
<?php } ?>