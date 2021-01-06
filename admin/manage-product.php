<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblclient where ID ='$id'";
        $query = $dbh->prepare($sql);
        $query->execute();
        echo "<script>alert('Product record deleted.');</script>";
        echo "<script>window.location.href='manage-product.php'</script>";
    }
    ?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title>MS Plate Business Management System || Manage Client </title>
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
                            <li class="active">Manage Clients</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">


                        <h3 class="inner-tittle two">Manage Clients </h3>
                        <div class="graph">
                            <div class="tables">
                                <table class="table" border="1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Buying Price</th>
                                        <th>Buy Kg</th>
                                        <th>Bpp kg</th>
                                        <th>Setting</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * from tblclient";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr class="active">
                                                <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                <td><?php echo htmlentities($row->CreationDate); ?></td>
                                                <td><?php echo htmlentities($row->pname); ?></td>
                                                <td><?php echo htmlentities($row->perprice); ?></td>
                                                <td><?php echo htmlentities($row->kg); ?></td>
                                                <td><?php
                                                    $price = $row->perprice;
                                                    $n = $row->kg;
                                                    $per_price = ceil($price / $n);
                                                    echo $per_price;

                                                    ?></td>
                                                <td>
                                                    <a href="edit-client-details.php?editid=<?php echo $row->ID; ?>">Edit</a>
                                                    ||
                                                    <a href="add-client-services.php?addid=<?php echo $row->ID; ?>">Assign
                                                        Services</a>
                                                    ||
                                                    <a href="manage-product.php?del=<?php echo $row->ID; ?>"
                                                       data-toggle="tooltip" data-original-title="Delete"
                                                       onclick="return confirm('Do you really want to delete?');">Del</i></a>

                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    </tbody>
                                </table>
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