<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid'] == 0)) {
header('location:logout.php');
} else {
if (isset($_GET['del'])) {
$id = $_GET['del'];
$sql = "delete from tblinvoice where BillingId ='$id'";
$query = $dbh->prepare($sql);
$query->execute();
echo "<script>alert('Invoice record deleted.');</script>";
echo "<script>window.location.href='invoices.php'</script>";
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>MS Plate Business Management System || Invoice </title>
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
<li class="active">Invoice</li>
</ol>
</div>
<!--//sub-heard-part-->
<div class="graph-visual tables-main" id="exampl-fahim">


<h3 class="inner-tittle two">Invoice </h3>
<div class="graph">
<div class="tables">
<table class="table" border="1">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Product Name</th>
<th>Sell price</th>
<th>Sell kg</th>
<th>Bpp kg</th>
<th>Profit</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$sql = "select distinct tblclient.pname,tblclient.kg,tblclient.perprice,tblinvoice.BillingId,tblinvoice.perprice as sellprice,tblinvoice.PostingDate,tblinvoice.kg as bkg,tblinvoice.Userid from  tblclient   
join tblinvoice on tblclient.ID=tblinvoice.Userid  order by tblinvoice.ID desc";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$cnt = 1;
if ($query->rowCount() > 0) {
foreach ($results as $row) { ?>
<tr class="active">
<th scope="row"><?php echo htmlentities($cnt); ?></th>
<!--                                                <td>-->
<?php // echo htmlentities($row->BillingId);
?><!--</td>-->
<td><?php echo htmlentities($row->PostingDate); ?></td>
<td><?php echo htmlentities($row->pname); ?></td>
<td><?php echo htmlentities($row->sellprice); ?></td>
<td><?php echo htmlentities($row->bkg); ?></td>
<td><?php
$price = $row->perprice;
$n = $row->kg;
$per_price = ceil($price / $n);
echo $per_price;

?></td>
<td><?php
/* Sell price - ( Sell kg X Bpp kg )*/

$sellp = $row->sellprice;
$sellkg = $row->bkg;
echo $profit = $sellp - ($sellkg * $per_price);
?></td>

<td>
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
<p style="margin-top:1%" align="center">
<i class="fa fa-print fa-2x" style="cursor: pointer;"
OnClick="CallPrint(this.value)"></i>
</p>
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
<script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl-fahim");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>