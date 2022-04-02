<?php
require('php-includes/connect.php');
include('php-includes/check-login.php');
$email = $_SESSION['userid'];
?>
<?php
//pin request 
if(isset($_GET['pin_request'])){
	$bank = mysqli_real_escape_string($con,$_GET['bank']);
	$account = mysqli_real_escape_string($con,$_GET['account']);
	$trxid = mysqli_real_escape_string($con,$_GET['trxid']);
	$amount = mysqli_real_escape_string($con,$_GET['amount']);
	$date = date("Y-m-d H:i:s");
	
	// Change the line below to your timezone!
    date_default_timezone_set('Asia/Karachi');
    $date = date('Y-m-d H:i:s', time());
	
	if($amount!=''){
		//Inset the value to pin request
		$query = mysqli_query($con,"insert into pin_request(`email`,`bank`,`account`,`trxid`,`amount`,`date`) values('$email','$bank','$account','$trxid','$amount','$date')");
		if($query){
			echo '<script>alert("Pin request sent successfully");window.location.assign("pin-request.php");</script>';
		}
		else{
			//echo mysqli_error($con);
			echo '<script>alert("Payment has already been used.");window.location.assign("pin-request.php");</script>';
		}
	}
	else{
		echo '<script>alert("Please fill all the fields");</script>';
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PIN Code Request</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
    </head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PIN Request</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">PIN Code Request</h1>

                        <?php include('../announcement.php'); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">

                    	<form method="get">
<p style="color:red;" dir="rtl"><strong>
یاد رکھیں؛
</strong>
<br>
اس
<strong>
PIN
</strong>
کوڈ
<strong>
Request
</strong>
کے بعد
<strong>
30Minutes
</strong>
میں
<strong>
PIN
</strong>
کوڈ
<strong>
خودبخود
</strong>
آپ کے
<strong>
ebl
اکاؤنٹ 
</strong>
میں
<strong>
ADD
</strong>
ہو جاتا 
ہے
_
<strong>
بہ صورت دیگر
</strong>
اپنی
<strong>
پےمنٹ 
</strong>
کا
<strong>
Screenshot
</strong>
ہمیں
<strong>
WhatsApp
</strong>
کریں؟
<br><br>
اپنا
<strong>
اکاؤنٹ 
ڈیفالٹ
</strong>
پاسورڈ
<strong>
123456
</strong>
لازمی
<strong>
تبدیل
</strong>
کر لیں
<br>
<strong>
<a href="https://eblpakistan.com/Basic/Change_Password" class="ca">Change Password</a>
</strong>
<br>
<br>
<strong>
رات 10
</strong>
سے 
<strong>
صبح 9
</strong>
بجے تک
<strong>
نیا
PIN
</strong>
کوڈ نہیں
<strong>
لے
</strong>
سکتے
<br>
آپ 
<strong>
پہلے
</strong>
سے موجود
<strong>
PIN
</strong>
کوڈ
<strong>
24/7
</strong>
استعمال 
<strong>
کر 
</strong>
سکتے 
<strong>
ہیں
</strong>
</p>
                            	<label>Receiver #</label>
                                <input type="number" name="bank" dir="" placeholder="
جس اکاؤنٹ نمبر میں رقم بھیجی ہے؟
"class="form-control" required>

<legend><span class="number">1</span>Payment Details</legend>

                            <div class="form-group">
                                <label>Sender #</label>
                                <input type="text" name="account" dir="" placeholder="
جس اکاؤنٹ نمبر سے رقم بھیجی ہے؟
" class="form-control" required>
                            </div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<script  src="./script.js"></script>

                            	<label>Trx ID</label>
                                <input type="number" name="trxid" dir="" placeholder="
ٹرانزکشن آئی ڈی لکھیں؟
"class="form-control" required>
                            	<label>Amount</label>
                                <input type="number" name="amount" dir="" placeholder="
اماؤنٹ لکھیں؟
"class="form-control" required>
<br>
                            <div class="form-group">
                        	<input type="submit" name="pin_request" class="btn btn-lg btn-success btn-block" value="PIN Request">

                        </div>

						   <script>
    $(":input").inputmask();

   </script>
                        </form>
                    </div>
                </div>
 
 <br>
 <br>
                <!-- /.row -->
                <div class="row">
                        <div class="col-lg-12">
                    	<div class="table-responsive">
                    	<h1 class="page-header">PIN Request History</h1>
                        	<table class="table table-striped table-bordered">
                        	<tr>
                            	<th>S.n.</th>
                                <th>To</th>
                                <th>From</th>
                                <th>Trx ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <?php 
							$i=1;
							$query = mysqli_query($con,"select * from pin_request where email='$email' order by id desc");
							if(mysqli_num_rows($query)>0){
								while($row=mysqli_fetch_array($query)){
									$bank = $row['bank'];
									$account = $row['account'];
									$trxid = $row['trxid'];
									$amount = $row['amount'];
									$date = $row['date'];
									$status = $row['status'];
								?>
                                	<tr>
                                    	<td><?php echo $i; ?></td>
                                        <td><?php echo $bank; ?></td>
                                        <td><?php echo $account; ?></td>
                                        <td><?php echo $trxid; ?></td>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $status; ?></td>
                                    </tr>
                                <?php
									$i++;
								}
							}
							else{
							?>
                            	<tr>
                                	<td colspan="4">You have no pin request yet.</td>
                                </tr>
                            <?php
							}
							?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
