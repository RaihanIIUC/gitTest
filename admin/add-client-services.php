<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {


        $uid = intval($_GET['addid']);
        $invoiceid = mt_rand(100000000, 999999999);
        $kg = $_POST['kg'];
        $perprice = $_POST['perprice'];

            $sql = "insert into tblinvoice(Userid,BillingId,kg,perprice)values(:uid,:invoiceid,:kg,:perprice)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
            $query->bindParam(':invoiceid', $invoiceid, PDO::PARAM_STR);
            $query->bindParam(':kg', $kg, PDO::PARAM_STR);
            $query->bindParam(':perprice', $perprice, PDO::PARAM_STR);
           $result =  $query->execute();

            if ($result) {
                echo '<script>alert("Invoice created successfully. Invoice number is "+"' . $invoiceid . '")</script>';
                echo "<script>window.location.href ='invoices.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
    }
    ?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Ms Plate Business Management Sysytem || Assign Services </title>
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
        <!-- /js -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <!-- //js-->
    </head>
    <body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="inner-content">
                <!-- header-starts -->
                <?php include_once('includes/header.php'); ?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Assign Services</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">


                        <h3 class="inner-tittle two"> Assign Services</h3>
                        <div class="graph">
                            <div class="tables">
                                <form method="post">
                                    <table class="table" border="1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Buy kg</th>
                                            <th>Bpp kg</th>
                                            <th>Sell Price</th>
                                            <th>Sell kg</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $id = $_GET['addid'];
                                        $sql = "SELECT * from tblclient  WHERE  ID = '$id'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr class="active">
                                                    <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                    <td><?php echo htmlentities($row->pname); ?></td>
<!--                                                    <td>--><?php //echo htmlentities($row->perprice); ?><!--</td>-->
                                                    <td><?php  echo htmlentities($row->kg);?></td>
                                                    <td><?php
                                                        $price = $row->perprice;
                                                        $n= $row->kg;
                                                        $per_price=ceil($price/$n);
                                                        echo $per_price;

                                                        ?></td>
<!--                                                    <td>-->
<!--                                                        --><?php
//                                                        $total = $row->perprice / $row->kg;
//                                                        echo $total;
//                                                        ?>

                                                    </td>
                                                    <td><input type="text" name="perprice"
                                                               value=""></td>
                                                    <td><input type="text" name="kg"
                                                               value=""></td>
                                                </tr>
                                                <?php
                                            }
                                        } ?>
                                        <tr>
                                            <td colspan="6" align="center">
                                                <button type="submit" name="submit" class="btn btn-default">Submit
                                                </button>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                        </div>

                    </div>
                    <!--//graph-visual-->
                </div>
                <!--//outer-wp-->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
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