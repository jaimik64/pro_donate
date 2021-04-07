<?php
session_start();
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();


$con=mysqli_connect("localhost","id11970969_root","root007","id11970969_dms");



header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your applications MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {

/*	if ($_POST['STATUS'] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		//echo "<b>Transaction status is failure</b>" . "<br/>";
	}
*/
	if (isset($_POST) && count($_POST)>0 )
	{ 
	$od=$_POST['ORDERID'];
	$amt=$_POST['TXNAMOUNT'];
	$st=$_POST['STATUS'];
	$d=date('Y-m-d');
	$id=$_SESSION['id'];
	$no=$_COOKIE['cat'];
	$q1="select * from catagory where cat_name='$no'";
	$r1=mysqli_query($con,$q1);
	if($st=="TXN_FAILURE")
	{
	  echo "Transaction failed Redirecting.....";
	 header("Refresh:1;url=TxnTest.php");
    }

	while($c1=mysqli_fetch_array($r1))
	{
	    $catn=$c1['cat_no'];
	    $catna=$c1['cat_name'];
	}

    }
	else {
	echo "<b>Checksum mismatched.</b>";
	}
	//Process transaction as suspicious.
	
	if($st=="TXN_SUCCESS")
	{
	    	$q="insert into donation (t_amount,t_date,t_status,oid,cat_no,username)values('$amt','$d','$st','$od','$catn','$id')";
	    $q2="UPDATE wallet SET Balance=Balance+$amt";
	    $r3=mysqli_query($con,$q2);
	    $q3="UPDATE catagory SET cat_amt=cat_amt+$amt WHERE cat_no=$catn";
	    $r4=mysqli_query($con,$q3);
         $r2=mysqli_query($con,$q);

	}
 if($st=="TXN_SUCCESS")
	 {
	     $_SESSION['cn']=$catna;
	     $_SESSION['amt']=$amt;
	    
        header("location:download.php");
	 }
}
?>