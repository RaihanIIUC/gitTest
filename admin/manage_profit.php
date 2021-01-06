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
        $accttype = $_POST['accounttype'];
        $cname = $_POST['cname'];
        $comname = $_POST['comname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zcode = $_POST['zcode'];
        $wphnumber = $_POST['wphnumber'];
        $cellphnumber = $_POST['cellphnumber'];
        $ophnumber = $_POST['ophnumber'];
        $email = $_POST['email'];
        $websiteadd = $_POST['websiteadd'];
        $notes = $_POST['notes'];

        $sql = "update tblclient set AccountType=:accttype,ContactName=:cname,CompanyName=:comname,Address=:address,City=:city,State=:state,ZipCode=:zcode,Workphnumber=:wphnumber,Cellphnumber=:cellphnumber,Otherphnumber=:ophnumber,Email=:email,WebsiteAddress=:websiteadd,Notes=:notes where ID=:eid";
        $query = $dbh->prepare($sql);
//$query->bindParam(':acctid',$acctid,PDO::PARAM_STR);
        $query->bindParam(':accttype', $accttype, PDO::PARAM_STR);
        $query->bindParam(':cname', $cname, PDO::PARAM_STR);
        $query->bindParam(':comname', $comname, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':state', $state, PDO::PARAM_STR);
        $query->bindParam(':zcode', $zcode, PDO::PARAM_STR);
        $query->bindParam(':wphnumber', $wphnumber, PDO::PARAM_STR);
        $query->bindParam(':cellphnumber', $cellphnumber, PDO::PARAM_STR);
        $query->bindParam(':ophnumber', $ophnumber, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':websiteadd', $websiteadd, PDO::PARAM_STR);
        $query->bindParam(':notes', $notes, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Client detail has been updated")</script>';
        echo "<script type='text/javascript'> document.location ='manage-product.php'; </script>";
    }
    if(isset($_GET['del'])){
        $cmpid=substr(base64_decode($_GET['del']),0,-5);
        $sql = "delete from tblcost where id='$cmpid'";
        $query = $dbh->prepare($sql);
        $query->execute();
        echo "<script>alert('Category record deleted.');</script>";
        echo "<script>window.location.href='manage-personal-cost.php'</script>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Client Management Sysytem|| Add Services</title>

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


    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <?php
        include_once('includes/header.php');
        include_once('includes/sidebar.php');
        ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Company</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container" style="padding-left:200px;">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                                    data-feather="database"></i></span></span>Manage Today's Details</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap" >
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Product Name </th>
                                                <th>buy kg</th>
                                                <th>Buy price </th>
                                                <th>Sell kg</th>
                                                <th>sell price</th>
                                                <th>bp in kg</th>
                                                <th>sp in kg</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $rno = mt_rand(10000, 99999);
                                            $sql = "select * from tblcost";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row32) { ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $row32->PostingDate	; ?></td>
                                                        <td><?php echo $row32->cost4; ?></td>
                                                        <td><?php echo $row32->cost1; ?></td>
                                                        <td><?php echo $row32->cost2; ?></td>
                                                        <td><?php echo $row32->cost3; ?></td>
                                                        <td><?php echo $row32->cost5; ?></td>
                                                        <?php
                                                        ?>
                                                        <td><?php
                                                            $division = $row32->cost6/$row32->cost1;
                                                            echo $division;
                                                            ?></td>
                                                        <td><?php
                                                             $division = $row32->cost5/$row32->cost3;
                                                             echo $division;
                                                            ?></td>


                                                        <td>
                                                            <a href="edit-total-cost.php?id=<?php echo($row32->id); ?>"
                                                               class="mr-25" data-toggle="tooltip"
                                                               data-original-title="Edit">edit</a>
                                                            <a href="manage-personal-cost.php?del=<?php echo base64_encode($row32->id . $rno); ?>"
                                                               data-toggle="tooltip" data-original-title="Delete"
                                                               onclick="return confirm('Do you really want to delete?');">del</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $cnt++;
                                                }
                                            } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

            <!-- Footer -->
            <?php include_once('includes/footer.php'); ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
    </body>
    </html>
<?php } ?>